<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Table\Event;
use App\Models\Table\EventNon;

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
    public function boot(): void
    {
        view()->composer(['fe-layouts.master'], function ($view) {
            $total = 0;
            if (Auth::check()) {
                $event = Event::where('id_user', Auth::user()->id)
                    ->where('konfirmasi_bayar', 0)
                    ->where('status', 1)
                    ->count();

                $eventNon = EventNon::where('id_user', Auth::user()->id)
                    ->where('konfirmasi_bayar', 0)
                    ->where('status', 1)
                    ->count();

                $total = $event + $eventNon;
            }

            $headerData = array(
                'event' => $total,
            );
            $view->with('headerData', $headerData);
        });
    }
}
