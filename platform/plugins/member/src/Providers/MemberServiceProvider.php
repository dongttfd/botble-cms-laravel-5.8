<?php

namespace Botble\Member\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Botble\Base\Supports\Helper;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Member\Http\Middleware\RedirectIfMember;
use Botble\Member\Http\Middleware\RedirectIfNotMember;
use Botble\Member\Models\Member;
use Botble\Member\Models\MemberActivityLog;
use Botble\Member\Repositories\Caches\MemberActivityLogCacheDecorator;
use Botble\Member\Repositories\Caches\MemberCacheDecorator;
use Botble\Member\Repositories\Eloquent\MemberActivityLogRepository;
use Botble\Member\Repositories\Eloquent\MemberRepository;
use Botble\Member\Repositories\Interfaces\MemberActivityLogInterface;
use Botble\Member\Repositories\Interfaces\MemberInterface;
use Event;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class MemberServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * 
     */
    public function register()
    {
        config([
            'auth.guards.member'     => [
                'driver'   => 'session',
                'provider' => 'members',
            ],
            'auth.providers.members' => [
                'driver' => 'eloquent',
                'model'  => Member::class,
            ],
            'auth.passwords.members' => [
                'provider' => 'members',
                'table'    => 'member_password_resets',
                'expire'   => 60,
            ],
            'auth.guards.member-api' => [
                'driver'   => 'passport',
                'provider' => 'members',
            ],
        ]);

        /**
         * @var Router $router
         */
        $router = $this->app['router'];

        $router->aliasMiddleware('member', RedirectIfNotMember::class);
        $router->aliasMiddleware('member.guest', RedirectIfMember::class);

        $this->app->bind(MemberInterface::class, function () {
            return new MemberCacheDecorator(new MemberRepository(new Member));
        });

        $this->app->bind(MemberActivityLogInterface::class, function () {
            return new MemberActivityLogCacheDecorator(new MemberActivityLogRepository(new MemberActivityLog));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    /**
     * 
     */
    public function boot()
    {
        $this->setNamespace('plugins/member')
            ->loadAndPublishConfigurations(['general', 'permissions', 'assets'])
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes(['web', 'api'])
            ->loadMigrations()
            ->publishAssetsFolder()
            ->publishPublicFolder();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-core-member',
                'priority'    => 22,
                'parent_id'   => null,
                'name'        => 'plugins/member::member.menu_name',
                'icon'        => 'fa fa-users',
                'url'         => route('member.list'),
                'permissions' => ['member.list'],
            ]);
        });

        $this->app->register(EventServiceProvider::class);
    }
}
