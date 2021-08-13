<?php

namespace Azuriom\Plugin\Ban\Providers;

use Azuriom\Models\Permission;
use Azuriom\Extensions\Plugin\BasePluginServiceProvider;

class BanServiceProvider extends BasePluginServiceProvider
{
    /**
     * Register any plugin services.
     *
     * @return void
     */
    public function register()
    {
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

        Permission::registerPermissions([
            'ban.admin' => 'ban::admin.permission',
        ]);
    }

    /**
     * Returns the routes that should be able to be added to the navbar.
     *
     * @return array
     */
    protected function routeDescriptions()
    {
        return [
            'ban.index' => 'ban::messages.title',
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
            'ban' => [
            	'name' => 'ban::admin.nav.title',
            	'icon' => 'fas fa-hammer',
            	'route' => 'ban.admin.settings',
            	'permission' => 'ban.admin'
            ],
        ];
    }
}
