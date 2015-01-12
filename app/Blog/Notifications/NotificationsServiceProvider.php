<?php namespace Blog\Notifications;

use Illuminate\Support\ServiceProvider;

class NotificationsServiceProvider extends ServiceProvider {

    /**
     * Set binding in IoC container
     */
    public function register()
    {
        $this->app->bind(
            'Blog\Notifications\ArticlePublished',
            'Blog\Notifications\Mailchimp\ArticlePublished'
        );
    }

}
