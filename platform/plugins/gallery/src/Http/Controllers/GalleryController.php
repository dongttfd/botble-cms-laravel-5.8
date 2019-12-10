<?php

namespace Botble\Gallery\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Forms\FormBuilder;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Gallery\Forms\GalleryForm;
use Botble\Gallery\Tables\GalleryTable;
use Botble\Gallery\Http\Requests\GalleryRequest;
use Botble\Gallery\Repositories\Interfaces\GalleryInterface;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;

class GalleryController extends BaseController
{

    /**
     * @var GalleryInterface
     */
    protected $galleryRepository;

    /**
     * @param GalleryInterface $galleryRepository
     *
     */
    public function __construct(GalleryInterface $galleryRepository)
    {
        $this->galleryRepository = $galleryRepository;
    }

    /**
     * Display all galleries
     * @param GalleryTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Throwable
     */
    public function getList(GalleryTable $dataTable)
    {
        page_title()->setTitle(trans('plugins/gallery::gallery.list'));

        return $dataTable->renderTable();
    }

    /**
     * Show create form
     * @return string
     *
     */
    public function getCreate(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/gallery::gallery.create'));

        return $formBuilder->create(GalleryForm::class)->renderForm();
    }

    /**
     * Insert new Gallery into database
     *
     * @param GalleryRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function postCreate(GalleryRequest $request, BaseHttpResponse $response)
    {
        $gallery = $this->galleryRepository->getModel();
        $gallery->fill($request->input());
        $gallery->user_id = Auth::user()->getKey();
        $gallery->is_featured = $request->input('is_featured', false);

        $gallery = $this->galleryRepository->createOrUpdate($gallery);

        event(new CreatedContentEvent(GALLERY_MODULE_SCREEN_NAME, $request, $gallery));

        return $response
            ->setPreviousUrl(route('galleries.list'))
            ->setNextUrl(route('galleries.edit', $gallery->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * Show edit form
     *
     * @param int $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     *
     */
    public function getEdit($id, Request $request, FormBuilder $formBuilder)
    {
        $gallery = $this->galleryRepository->findOrFail($id);

        event(new BeforeEditContentEvent(GALLERY_MODULE_SCREEN_NAME, $request, $gallery));

        page_title()->setTitle(trans('plugins/gallery::gallery.edit') . ' "' . $gallery->name . '"');

        return $formBuilder->create(GalleryForm::class, ['model' => $gallery])->renderForm();
    }

    /**
     * @param int $id
     * @param GalleryRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function postEdit($id, GalleryRequest $request, BaseHttpResponse $response)
    {
        $gallery = $this->galleryRepository->findOrFail($id);
        $gallery->fill($request->input());
        $gallery->is_featured = $request->input('is_featured', false);

        $this->galleryRepository->createOrUpdate($gallery);

        event(new UpdatedContentEvent(GALLERY_MODULE_SCREEN_NAME, $request, $gallery));

        return $response
            ->setPreviousUrl(route('galleries.list'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function getDelete(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $gallery = $this->galleryRepository->findOrFail($id);
            $this->galleryRepository->delete($gallery);
            event(new DeletedContentEvent(GALLERY_MODULE_SCREEN_NAME, $request, $gallery));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $ex) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.cannot_delete'));
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function postDeleteMany(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            $gallery = $this->galleryRepository->findOrFail($id);
            $this->galleryRepository->delete($gallery);
            event(new DeletedContentEvent(GALLERY_MODULE_SCREEN_NAME, $request, $gallery));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
