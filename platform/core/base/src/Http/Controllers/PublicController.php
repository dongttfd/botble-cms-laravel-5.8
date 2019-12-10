<?php

namespace Botble\Base\Http\Controllers;

use Botble\Base\Events\RenderingJsonFeedEvent;
use Botble\Base\Events\RenderingSingleEvent;
use Botble\Base\Events\RenderingSiteMapEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Supports\MembershipAuthorization;
use Botble\Page\Repositories\Interfaces\PageInterface;
use Botble\Setting\Supports\SettingStore;
use Botble\Slug\Repositories\Interfaces\SlugInterface;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use JsonFeedManager;
use SeoHelper;
use SiteMapManager;
use Theme;

class PublicController extends Controller
{
    /**
     * @var SlugInterface
     */
    protected $slugRepository;

    /**
     * PublicController constructor.
     * @param SlugInterface $slugRepository
     * @param SettingStore $settingStore
     */
    public function __construct(SlugInterface $slugRepository, SettingStore $settingStore)
    {
        $this->slugRepository = $slugRepository;

        if (!$settingStore->get('show_site_name')) {
            SeoHelper::meta()->setTitle($settingStore->get('site_title', ''));
            if ($settingStore->get('seo_title')) {
                SeoHelper::meta()->setTitle($settingStore->get('seo_title'));
            }
        }
    }

    /**
     * @param SettingStore $settingStore
     * @param MembershipAuthorization $authorization
     * @param BaseHttpResponse $response
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     *
     */
    public function getIndex(
        SettingStore $settingStore,
        MembershipAuthorization $authorization,
        BaseHttpResponse $response
    )
    {
        $authorization->authorize();

        if (defined('PAGE_MODULE_SCREEN_NAME')) {
            $homepage = $settingStore->get('show_on_front');
            if ($homepage) {
                $homepage = app(PageInterface::class)->findById($homepage);
                if ($homepage) {
                    return $this->getView($homepage->slug, $response);
                }
            }
        }

        Theme::breadcrumb()->add(__('Home'), url('/'));

        return Theme::scope('index')->render();
    }

    /**
     * @param string $key
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse|\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     *
     */
    public function getView($key, BaseHttpResponse $response)
    {
        $slug = $this->slugRepository->getFirstBy(['key' => $key, 'prefix' => '']);

        if ($slug) {
            $result = apply_filters(BASE_FILTER_PUBLIC_SINGLE_DATA, $slug);

            if (isset($result['slug']) && $result['slug'] !== $key) {
                return $response->setNextUrl(route('public.single', $result['slug']));
            }

            event(new RenderingSingleEvent($slug));

            if (!empty($result) && is_array($result)) {
                return Theme::scope($result['view'], $result['data'], Arr::get($result, 'default_view'))->render();
            }
        }

        return abort(404);
    }

    /**
     * @return mixed
     *
     */
    public function getSiteMap()
    {
        event(RenderingSiteMapEvent::class);

        // show your site map (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return SiteMapManager::render('xml');
    }

    /**
     * Generate JSON feed
     * @return array
     *
     */
    public function getJsonFeed()
    {
        event(RenderingJsonFeedEvent::class);

        return JsonFeedManager::render();
    }
}
