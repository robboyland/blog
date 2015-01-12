<?php namespace Blog\Newsletters;

use Illuminate\Support\ServiceProvider;

class NewsletterListServiceProvider extends ServiceProvider {

    /**
     * Register binding in IoC container
     */
    public function register()
    {
        $this->app->bind(
            'Blog\Newsletters\NewsletterList',
            'Blog\Newsletters\Mailchimp\NewsletterList'
        );
    }

}
