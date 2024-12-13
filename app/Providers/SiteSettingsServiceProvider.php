<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SiteSettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //

        if (Schema::hasTable('settings')) {

            // $groups = [];
            // $settings = [];
            // foreach (Setting::with('image')->orderBy('group_sorting')->get() as $key => $value) {

            //     $settings[$value->field] = $value->value;
            //     if($value->type == "image"){
            //         $settings[$value->field] = $value->image;
            //     }
            //     array_push($groups,$value->grouping);

            // }

            // $settings['grouping'] = implode(',',array_unique($groups));         
            // $settings['menus'] = Menu::with('children.children.children')->get();


            // config(['_s' => $settings]);
        }
    }
}
