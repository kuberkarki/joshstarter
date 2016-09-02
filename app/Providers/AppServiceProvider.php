<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\News;
use App\Page;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.eventday', function($view)
        {
           $frontarray['onenews'] = News::latest()->first();
            $frontarray['mainmenu']=Page::where('type','Main Menu')->get();
            $frontarray['OurExpertServices']=Page::where('type','Our Expert Services')->get();
                $view->with('frontarray', $frontarray);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
