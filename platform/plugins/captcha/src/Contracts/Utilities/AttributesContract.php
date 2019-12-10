<?php

namespace Botble\Captcha\Contracts\Utilities;

interface AttributesContract
{
    const ATTR_TYPE = 'data-type';
    const ATTR_THEME = 'data-theme';
    const ATTR_SIZE = 'data-size';

    /**
     * Get image type attribute.
     *
     * @return array
     * @author ARCANEDEV
     */
    public function getImageAttribute();

    /**
     * Get audio type attribute.
     *
     * @return array
     * @author ARCANEDEV
     */
    public function getAudioAttribute();

    /**
     * Build attributes.
     *
     * @param  string $siteKey
     * @param  array $items
     *
     * @return string
     * @author ARCANEDEV
     */
    public function build($siteKey, array $items = []);

    /**
     * Prepare the name and id attributes.
     *
     * @param  string|null $name
     *
     * @return array
     * @author ARCANEDEV
     */
    public function prepareNameAttribute($name);
}
