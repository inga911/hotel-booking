<?php

namespace App\Providers;

use App\Models\SmtpSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrapFive();
        // if (Schema::hasTable('smtp_settings')) {
        //     $settings = SmtpSetting::first();

        //     if ($settings) {
        //         $data = [
        //             'driver' => $settings->mailer,
        //             'host' => $settings->host,
        //             'port' => $settings->port,
        //             'username' => $settings->username,
        //             'password' => $settings->password,
        //             'encryption' => $settings->encryption,
        //             'from' => [
        //                 'address' => $settings->from_address,
        //                 'name' => 'HotelBooking'
        //             ]
        //         ];

        //         Config::set('mail', $data);
        //     }
        // }
    }
}
