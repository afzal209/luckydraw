<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Payment_Gateway;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            $paypal = Payment_Gateway::first();

    if ($paypal) {
        config([
            'payment.paypal_client_id' => $paypal->paypal_live_client_id,
            'payment.paypal_secret' => $paypal->paypal_live_client_secret,
            'payment.paypal_mode' => $paypal->paypal_mode,
        ]);
    }

    }
}
