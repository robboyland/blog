<?php namespace Blog\Social;

use GuzzleHttp\Client;

class TwitterPublisher
{
    private $postTweetUrl = 'https://api.twitter.com/1.1/statuses/update.json';

    private $guzzle;

    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function publish($status)
    {
        return $this->guzzle->post($this->getPostTweetUrl($status));
    }

    private function getPostTweetUrl($status)
    {
        return $this->postTweetUrl . '?' . http_build_query(compact('status'));
    }
}
