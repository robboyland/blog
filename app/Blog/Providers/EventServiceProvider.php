<?php namespace Blog\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app['events']->listen('PostWasPublished',
                                     'Blog\Listeners\SocialNotifier@whenPostWasPublished');
    }

}
