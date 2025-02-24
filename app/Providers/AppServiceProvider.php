<?php

namespace App\Providers;

use Illuminate\Support\Facades\Process;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if ($user = Auth::user()) { // Works for both admin & normal users
                // Get the latest 5 notifications
                $latestNotifications = $user->notifications()->latest()->take(5)->get();

                // Get the unread notification count
                $unreadCount = $user->unreadNotifications->count();

                // Pass data to all views
                $view->with([
                    'latestNotificationCount' => $latestNotifications,
                    'unreadCount' => $unreadCount
                ]);
            }
        });

        if (app()->runningInConsole() === false) {
            Process::run('php artisan queue:work --tries=3 --timeout=90 > /dev/null 2>&1 &');
        }
    }

}
