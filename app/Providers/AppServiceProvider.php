<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Value;
use App\Models\Variation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;


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

        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);

        $_s = [];

       if (Schema::hasTable('settings')) {
            $settings_Data = Setting::pluck('value','field');
            $_s = $settings_Data;
       }
       View::share('_s',$_s);

        

    }



}
