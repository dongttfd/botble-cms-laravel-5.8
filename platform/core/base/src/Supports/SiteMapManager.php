<?php

namespace Botble\Base\Supports;

use AdminBar;

class SiteMapManager
{
    /**
     * @var mixed
     */
    protected $siteMap;

    /**
     * SiteMapManager constructor.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     *
     */
    public function __construct()
    {
        // create new site map object
        $this->siteMap = app()->make('sitemap');

        // set cache (key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean))
        // by default cache is disabled
        $this->siteMap->setCache('public.sitemap', config('core.base.general.cache_siteMap'));

        $this->siteMap->add(url('/'), '2019-03-02 10:00', '1.0', 'daily');

        AdminBar::setIsDisplay(false);
    }

    /**
     * @param $url
     * @param $date
     * @param string $priority
     * @param string $sequence
     * @return $this
     *
     */
    public function add($url, $date, $priority = '1.0', $sequence = 'daily')
    {
        if (!$this->siteMap->isCached()) {
            $this->siteMap->add($url, $date, $priority, $sequence);
        }

        return $this;
    }

    /**
     * @param string $type
     * @return mixed
     *
     */
    public function render($type = 'xml')
    {
        // show your site map (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $this->siteMap->render($type);
    }
}
