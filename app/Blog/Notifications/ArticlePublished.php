<?php namespace Blog\Notifications;

interface ArticlePublished {

    /**
     * Notify lesson subscribers
     *
     * @param $title
     * @param $body
     * @return mixed
     */
    public function notify($title, $body);

}
