<?php

namespace Botble\SeoHelper\Entities;

use Botble\SeoHelper\Contracts\Entities\TitleContract;
use Botble\SeoHelper\Exceptions\InvalidArgumentException;
use Illuminate\Support\Str;

/**
 * Class     Title
 *
 * @package  Botble\SeoHelper\Entities
 */
class Title implements TitleContract
{

    /**
     * The title content.
     *
     * @var string
     */
    protected $title = '';

    /**
     * The site name.
     *
     * @var string
     */
    protected $siteName = '';

    /**
     * The title separator.
     *
     * @var string
     */
    protected $separator = '-';

    /**
     * Display the title first.
     *
     * @var bool
     */
    protected $titleFirst = true;

    /**
     * The maximum title length.
     *
     * @var int
     */
    protected $max = 55;

    /**
     * Make the Title instance.
     *
     * @param  array $configs
     * @author ARCANEDEV
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Start the engine.
     * @author ARCANEDEV
     * @throws InvalidArgumentException
     */
    protected function init()
    {
        $this->set(null);
        if (setting('show_site_name', false)) {
            $this->setSiteName(setting('site_title', ''));
            if (setting('seo_title')) {
                $this->setSiteName(setting('seo_title'));
            }
        }
        $this->setSeparator(config('packages.seo-helper.general.title.separator', '-'));
        $this->switchPosition(config('packages.seo-helper.general.title.first', true));
        $this->setMax(config('packages.seo-helper.general.title.max', 55));
    }

    /**
     * Get title only (without site name or separator).
     *
     * @return string
     * @author ARCANEDEV
     */
    public function getTitleOnly()
    {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param  string $title
     *
     * @return \Botble\SeoHelper\Entities\Title
     * @author ARCANEDEV
     */
    public function set($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get site name.
     *
     * @return string
     * @author ARCANEDEV
     */
    public function getSiteName()
    {
        return $this->siteName;
    }

    /**
     * Set site name.
     *
     * @param  string $siteName
     *
     * @return \Botble\SeoHelper\Entities\Title
     * @author ARCANEDEV
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;

        return $this;
    }

    /**
     * Get title separator.
     *
     * @return string
     * @author ARCANEDEV
     */
    public function getSeparator()
    {
        return $this->separator;
    }

    /**
     * Set title separator.
     *
     * @param  string $separator
     *
     * @return \Botble\SeoHelper\Entities\Title
     * @author ARCANEDEV
     */
    public function setSeparator($separator)
    {
        $this->separator = trim($separator);

        return $this;
    }

    /**
     * Set title first.
     *
     * @return \Botble\SeoHelper\Entities\Title
     * @author ARCANEDEV
     */
    public function setFirst()
    {
        return $this->switchPosition(true);
    }

    /**
     * Set title last.
     *
     * @return \Botble\SeoHelper\Entities\Title
     * @author ARCANEDEV
     */
    public function setLast()
    {
        return $this->switchPosition(false);
    }

    /**
     * Switch title position.
     *
     * @param  bool $first
     *
     * @return \Botble\SeoHelper\Entities\Title
     * @author ARCANEDEV
     */
    protected function switchPosition($first)
    {
        $this->titleFirst = boolval($first);

        return $this;
    }

    /**
     * Check if title is first.
     *
     * @return bool
     * @author ARCANEDEV
     */
    public function isTitleFirst()
    {
        return $this->titleFirst;
    }

    /**
     * Get title max length.
     *
     * @return int
     * @author ARCANEDEV
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Set title max length.
     *
     * @param  int $max
     *
     * @return \Botble\SeoHelper\Entities\Title
     * @author ARCANEDEV
     * @throws InvalidArgumentException
     */
    public function setMax($max)
    {
        $this->checkMax($max);

        $this->max = $max;

        return $this;
    }

    /**
     * Make a Title instance.
     *
     * @param  string $title
     * @param  string $siteName
     * @param  string $separator
     *
     * @return \Botble\SeoHelper\Entities\Title
     * @author ARCANEDEV
     * @throws InvalidArgumentException
     */
    public static function make($title, $siteName = '', $separator = '-')
    {
        return new self();
    }

    /**
     * Render the tag.
     *
     * @return string
     * @author ARCANEDEV
     */
    public function render()
    {
        $separator = null;
        if ($this->getTitleOnly()) {
            $separator = $this->renderSeparator();
        }
        $output = $this->isTitleFirst()
            ? $this->renderTitleFirst($separator)
            : $this->renderTitleLast($separator);

        $output = Str::limit(strip_tags($output), $this->getMax());

        return '<title>' . e($output) . '</title>';
    }

    /**
     * Render the separator.
     *
     * @return string
     * @author ARCANEDEV
     */
    protected function renderSeparator()
    {
        return empty($separator = $this->getSeparator()) ? ' ' : ' ' . $separator . ' ';
    }

    /**
     * Render the tag.
     *
     * @return string
     * @author ARCANEDEV
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * Check title max length.
     *
     * @param  int $max
     *
     * @throws \Botble\SeoHelper\Exceptions\InvalidArgumentException
     * @author ARCANEDEV
     */
    protected function checkMax($max)
    {
        if (!is_int($max)) {
            throw new InvalidArgumentException('The title maximum lenght must be integer.');
        }

        if ($max <= 0) {
            throw new InvalidArgumentException('The title maximum lenght must be greater 0.');
        }
    }

    /**
     * Render title first.
     *
     * @param  string $separator
     *
     * @return string
     * @author ARCANEDEV
     */
    protected function renderTitleFirst($separator)
    {
        $output = [];
        $output[] = $this->getTitleOnly();

        if ($this->hasSiteName()) {
            $output[] = $separator;
            $output[] = $this->getSiteName();
        }

        return implode('', $output);
    }

    /**
     * Render title last.
     *
     * @param  string $separator
     *
     * @return string
     * @author ARCANEDEV
     */
    protected function renderTitleLast($separator)
    {
        $output = [];

        if ($this->hasSiteName()) {
            $output[] = $this->getSiteName();
            $output[] = $separator;
        }

        $output[] = $this->getTitleOnly();

        return implode('', $output);
    }

    /**
     * Check if site name exists.
     *
     * @return bool
     * @author ARCANEDEV
     */
    protected function hasSiteName()
    {
        return !empty($this->getSiteName());
    }
}
