<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind('path.public', function() {
        //     return realpath(base_path().'/../public_html');
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.welcome','App\Http\ViewComposer\PublicComposer@getRandomProduct');
        View::composer('frontend.welcome','App\Http\ViewComposer\PublicComposer@getFeatures');
        View::composer('frontend.welcome','App\Http\ViewComposer\PublicComposer@getSlider');
        View::composer('frontend.profile.sidebar','App\Http\ViewComposer\PublicComposer@getUser');
        View::composer(['frontend.product','frontend.welcome','frontend.layouts.header','frontend.layouts.footer'],'App\Http\ViewComposer\PublicComposer@getCategory');
        View::composer(['frontend.layouts.header'],'App\Http\ViewComposer\PublicComposer@getCartData');
        View::composer(['frontend.layouts.header', 'frontend.layouts.footer', 'frontend.pages.about', 'frontend.pages.contact', 'frontend.checkout'],'App\Http\ViewComposer\PublicComposer@aboutInfo');
    }
}
