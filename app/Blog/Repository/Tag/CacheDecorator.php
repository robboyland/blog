<?php namespace Blog\Repository\Tag;

use Blog\Service\Cache\CacheInterface;

class CacheDecorator extends AbstractTagDecorator
{
    protected $cache;

    public function __construct(TagInterface $tag, CacheInterface $cache)
    {
        parent::__construct($tag);
        $this->cache = $cache;
    }

    public function all()
    {
        $key = md5('tags');

        if( $this->cache->has($key) )
        {
            return $this->cache->get($key);
        }

        $tags = $this->tag->all();

        $this->cache->put($key, $tags);

        return $tags;
    }
}