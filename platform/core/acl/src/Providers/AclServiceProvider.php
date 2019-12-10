<?php

namespace Botble\ACL\Providers;

use Botble\ACL\Facades\AclManagerFacade;
use Botble\ACL\Http\Middleware\Authenticate;
use Botble\ACL\Http\Middleware\RedirectIfAuthenticated;
use Botble\ACL\Models\Activation;
use Botble\ACL\Models\Role;
use Botble\ACL\Models\User;
use Botble\ACL\Repositories\Caches\RoleCacheDecorator;
use Botble\ACL\Repositories\Eloquent\ActivationRepository;
use Botble\ACL\Repositories\Eloquent\RoleRepository;
use Botble\ACL\Repositories\Eloquent\UserRepository;
use Botble\ACL\Repositories\Interfaces\ActivationInterface;
use Botble\ACL\Repositories\Interfaces\RoleInterface;
use Botble\ACL\Repositories\Interfaces\UserInterface;
use Botble\Base\Supports\Helper;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Event;
use Exception;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

/**
 * Class AclServiceProvider
 * @package Botble\ACL
 */
class AclServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
        /**
         * @var Router $router
         */
        $router = $this->app['router'];

        $router->aliasMiddleware('auth', Authenticate::class);
        $router->aliasMiddleware('guest', RedirectIfAuthenticated::class);

        $this->app->bind(UserInterface::class, function () {
            return new UserRepository(new User);
        });

        $this->app->bind(ActivationInterface::class, function () {
            return new ActivationRepository(new Activation);
        });

        $this->app->bind(RoleInterface::class, function () {
            return new RoleCacheDecorator(new RoleRepository(new Role));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    /**
     *
     */
    public function boot()
    {
        $this->app->register(EventServiceProvider::class);

        $this->setNamespace('core/acl')
            ->loadAndPublishConfigurations(['general', 'permissions'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->publishPublicFolder()
            ->publishAssetsFolder()
            ->loadRoutes(['web', 'api'])
            ->loadMigrations();

        config()->set(['auth.providers.users.model' => User::class]);

        $this->app->register(HookServiceProvider::class);

        $loader = AliasLoader::getInstance();
        $loader->alias('AclManager', AclManagerFacade::class);

        $this->garbageCollect();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id'          => 'cms-core-role-permission',
                    'priority'    => 2,
                    'parent_id'   => 'cms-core-platform-administration',
                    'name'        => 'core/acl::permissions.role_permission',
                    'icon'        => null,
                    'url'         => route('roles.list'),
                    'permissions' => ['roles.list'],
                ])
                ->registerItem([
                    'id'          => 'cms-core-user',
                    'priority'    => 3,
                    'parent_id'   => 'cms-core-platform-administration',
                    'name'        => 'core/acl::users.users',
                    'icon'        => null,
                    'url'         => route('users.list'),
                    'permissions' => ['users.list'],
                ]);

            admin_bar()->registerLink('User', route('users.create'), 'add-new');
        });
    }

    /**
     * Garbage collect activations and reminders.
     *
     * @return void
     */
    protected function garbageCollect()
    {
        $config = $this->app['config']->get('core.acl.general');

        $this->sweep($this->app->make(ActivationInterface::class), $config['activations']['lottery']);
    }

    /**
     * Sweep expired codes.
     *
     * @param  mixed $repository
     * @param  array $lottery
     * @return void
     */
    protected function sweep($repository, array $lottery)
    {
        if ($this->configHitsLottery($lottery)) {
            try {
                $repository->removeExpired();
            } catch (Exception $exception) {
                info($exception->getMessage());
            }
        }
    }

    /**
     * Determine if the configuration odds hit the lottery.
     *
     * @param  array $lottery
     * @return bool
     */
    protected function configHitsLottery(array $lottery)
    {
        return mt_rand(1, $lottery[1]) <= $lottery[0];
    }
}
