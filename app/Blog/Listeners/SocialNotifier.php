<?php namespace Blog\Listeners;

use Blog\Social\TwitterPublisher;

class SocialNotifier
{
    private $twitter;

    public function __construct(TwitterPublisher $twitter)
    {
        $this->twitter = $twitter;
    }

    public function whenPostWasPublished($title)
    {
        $this->twitter->publish($title);
    }
}
