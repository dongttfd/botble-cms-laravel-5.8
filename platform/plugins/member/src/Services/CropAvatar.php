<?php

namespace Botble\Member\Services;

use Storage;

/**
 * Class CropAvatar
 * @package Botble\CropAvatar
 * @since 08/19/2015 07:50
 */
class CropAvatar
{
    /**
     * @var mixed
     */
    private $src;
    /**
     * @var mixed
     */
    private $data;
    /**
     * @var mixed
     */
    private $dst;
    /**
     * @var mixed
     */
    private $msg;
    /**
     * @var mixed
     */
    private $props;

    /**
     * @param $src
     * @param $data
     * @param $file
     * @since 08/19/2015
     */
    public function __construct($src, $data, $file)
    {
        $this->src = $src;
        $this->props = $file;
        $this->setData($data);
        $this->crop($this->data);
    }

    /**
     * @param $data
     * @since 08/19/2015
     */
    private function setData($data)
    {
        if (!empty($data)) {
            $this->data = json_decode(stripslashes($data));
        }
    }

    /**
     * Crop avatar and set URL, return message
     *
     * @param $data
     * @since 08/19/2015
     */
    private function crop($data)
    {
        if (!empty($data)) {
            $tmpFile = storage_path() . DIRECTORY_SEPARATOR . microtime(true) . '.' . $this->props['ext'];
            $tmpThumbFile = storage_path() . DIRECTORY_SEPARATOR . microtime(true) . '_thumb.' . $this->props['ext'];
            file_put_contents($tmpFile, Storage::read($this->props['path']));
            $type = exif_imagetype($tmpFile);
            $src_img = null;
            switch ($type) {
                case IMAGETYPE_GIF:
                    $src_img = imagecreatefromgif($tmpFile);
                    break;

                case IMAGETYPE_JPEG:
                    $src_img = imagecreatefromjpeg($tmpFile);
                    break;

                case IMAGETYPE_PNG:
                    $src_img = imagecreatefrompng($tmpFile);
                    break;
            }

            if (!$src_img) {
                $this->msg = __('plugins/member::dashboard.read_image_failed');
                return;
            }

            $dst_img = imagecreatetruecolor(220, 220);
            $result = imagecopyresampled(
                $dst_img,
                $src_img,
                0,
                0,
                $data->x,
                $data->y,
                220,
                220,
                $data->width,
                $data->height
            );

            if ($result) {
                switch ($type) {
                    case IMAGETYPE_GIF:
                        $result = imagegif($dst_img, $tmpThumbFile);
                        break;

                    case IMAGETYPE_JPEG:
                        $result = imagejpeg($dst_img, $tmpThumbFile);
                        break;

                    case IMAGETYPE_PNG:
                        $result = imagepng($dst_img, $tmpThumbFile);
                        break;
                }

                if (!$result) {
                    $this->msg = __('plugins/member::dashboard.save_cropped_image_failed');
                    return;
                } else {
                    // cleanup
                    Storage::put($this->props['realPath'], file_get_contents($tmpThumbFile), 'public');
                    unlink($tmpFile);
                    unlink($tmpThumbFile);

                    $this->dst = str_replace(public_path(), '', config('avatar.folder.upload')) . DIRECTORY_SEPARATOR . $this->props['realPath'];
                    $this->msg = 'success';
                }
            } else {
                $this->msg = __('plugins/member::dashboard.failed_to_crop_image');
                return;
            }

            imagedestroy($src_img);
            imagedestroy($dst_img);
        } else {
            $this->msg = __('plugins/member::dashboard.failed_to_load_data');
            return;
        }
    }

    /**
     * Get avatar URL uploaded
     * @return string
     * @since 08/19/2015
     */
    public function getResult()
    {
        return !empty($this->data) ? $this->dst : $this->src;
    }

    /**
     * Get crop message: failed or successfully
     * @return string
     * @since 08/19/2015
     */
    public function getMsg()
    {
        return $this->msg;
    }
}
