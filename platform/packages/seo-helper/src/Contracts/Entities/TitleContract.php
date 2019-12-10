<?php

namespace Botble\SeoHelper\Contracts\Entities;

use Botble\SeoHelper\Contracts\RenderableContract;

interface TitleContract extends RenderableContract
{
    /**
     * Get title only (without site name or separator).
     *
     * @return string
     * @author ARCANEDEV
     */
    public function getTitleOnly();

    /**
     * Set title.
     *
     * @param  string $title
     *
     * @return self
     * @author ARCANEDEV
     */
    public function set($title);

    /**
     * Get site name.
     *
     * @return string
     * @author ARCANEDEV
     */
    public function getSiteName();

    /**
     * Set site name.
     *
     * @param  string $siteName
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setSiteName($siteName);

    /**
     * Get title separator.
     *
     * @return string
     * @author ARCANEDEV
     */
    public function getSeparator();

    /**
     * Set title separator.
     *
     * @param  string $separator
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setSeparator($separator);

    /**
     * Set title first.
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setFirst();

    /**
     * Set title last.
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setLast();

    /**
     * Check if title is first.
     *
     * @return bool
     */
    public function isTitleFirst();

    /**
     * Get title max lenght.
     *
     * @return int
     * @author ARCANEDEV
     */
    public function getMax();

    /**
     * Set title max lenght.
     *
     * @param  int $max
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setMax($max);

    /**
     * Make a Title instance.
     *
     * @param  string $title
     * @param  string $siteName
     * @param  string $separator
     *
     * @return self
     * @author ARCANEDEV
     */
    public static function make($title, $siteName = '', $separator = '-');
}
