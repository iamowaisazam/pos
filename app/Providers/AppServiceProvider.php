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
use App\Enums\Setting;


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

        $_s = Setting::DATA;

        // if (Schema::hasTable('settings')) {

        //     $users = Cache::remember('users', 10, function () {
        //         return DB::table('users')->get();
        //     });

        //     $settings_Data = Setting::pluck('value','field');
        //     $_s = $settings_Data;
        // }
        
        View::share('_s',$_s);

    }



}
