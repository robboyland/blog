<?php namespace Blog\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Blog\Social\TwitterPublisher;

class SocialServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->registerTwitterProvider();
    }

    public function registerTwitterProvider()
    {
        $this->app->bindShared('Blog\Social\TwitterPublisher', function($app)
        {
            $guzzle = new Client(['defaults' => ['auth' => 'oauth']]);
            $oauth = new OAuth1([
                'consumer_key' => getenv('TWITTER_CONSUMER_KEY'),
                'consumer_secret' => getenv('TWITTER_CONSUMER_SECRET'),
                'token' => getenv('TWITTER_API_TOKEN'),
                'token_secret' => getenv('TWITTER_API_TOKEN_SECRET')
            ]);
            $guzzle->getEmitter()->attach($oauth);
            return new TwitterPublisher($guzzle);
        });
    }
}
