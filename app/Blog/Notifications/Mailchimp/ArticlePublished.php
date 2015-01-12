<?php namespace Blog\Notifications\Mailchimp;

use Blog\Notifications\ArticlePublished as ArticlePublishedInterface;
use Mailchimp;

class ArticlePublished implements ArticlePublishedInterface {

    /**
     * List ID
     */
    const ARTICLE_SUBSCRIBERS_ID = 'f619b6e024';

    /**
     * @var Mailchimp
     */
    protected $mailchimp;

    /**
     * @param Mailchimp $mailchimp
     */
    function __construct(Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    /**
     * Notify lesson subscribers through Mailchimp
     *
     * @param $title
     * @param $body
     * @return mixed
     */
    public function notify($title, $body)
    {
        // Can be stored in a config file instead...
        $options = [
            'list_id'    => self::ARTICLE_SUBSCRIBERS_ID,
            'subject'    => 'New Article: ' . $title,
            'from_name'  => 'Blog',
            'from_email' => getenv('MAILCHIMP_FROM_EMAIL'),
            'to_name'    => 'Blog Subscriber'
        ];

        $content = [
            'html' => $body,
            'text' => strip_tags($body)
        ];

        $campaign = $this->mailchimp->campaigns->create('regular', $options, $content);

        $this->mailchimp->campaigns->send($campaign['id']);
    }

}
