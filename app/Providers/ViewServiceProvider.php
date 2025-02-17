<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $menus = DB::table('menus')
            ->join('form_permissions', 'form_permissions.menu_id', '=', 'menus.id')
            ->join('roles', 'form_permissions.role_id', '=', 'roles.id')
            ->where('roles.id', auth()->user()->role_id)
            ->select('menus.*')
            ->get();
            $view->with('globalMenus', $menus);
        });
    }
}
