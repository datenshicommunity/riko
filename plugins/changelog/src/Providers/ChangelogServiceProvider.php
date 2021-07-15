<?php

namespace Azuriom\Plugin\Changelog\Providers;

use Azuriom\Models\Permission;
use Illuminate\Pagination\Paginator;
use Azuriom\Extensions\Plugin\BasePluginServiceProvider;

class ChangelogServiceProvider extends BasePluginServiceProvider
{
    /**
     * Register any plugin services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMiddlewares();

        //
    }

    /**
     * Bootstrap any plugin services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();

        $this->loadViews();

        $this->loadTranslations();

        $this->loadMigrations();

        $this->registerRouteDescriptions();

        $this->registerAdminNavigation();

        $this->registerUserNavigation();

        Paginator::useBootstrap();

        Permission::registerPermissions(['changelog.admin' => 'changelog::admin.permissions.admin']);
    }

    /**
     * Returns the routes that should be able to be added to the navbar.
     *
     * @return array
     */
    protected function routeDescriptions()
    {
        return [
            'changelog.index' => 'changelog::messages.plugin_name',
        ];
    }

    /**
     * Return the admin navigations routes to register in the dashboard.
     *
     * @return array
     */
    protected function adminNavigation()
    {
        return [
            'changelog' => [
                'name' => 'changelog::admin.nav.title',
                'icon' => 'fas fa-clipboard-list',
                'route' => 'changelog.admin.updates.index',
                'permission' => 'changelog.admin',
            ],
        ];
    }

    /**
     * Return the user navigations routes to register in the user menu.
     *
     * @return array
     */
    protected function userNavigation()
    {
        return [
            //
        ];
    }
}
