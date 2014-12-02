<?php namespace Blog\Repository\Category;

use Blog\Service\Cache\CacheInterface;

class CacheDecorator extends AbstractCategoryDecorator
{
    protected $cache;

    public function __construct(CategoryInterface $category, CacheInterface $cache)
    {
        parent::__construct($category);
        $this->cache = $cache;
    }

    public function all()
    {
        $key = md5('categories');

        if( $this->cache->has($key) )
        {
            return $this->cache->get($key);
        }

        $categories = $this->category->all();

        $this->cache->put($key, $categories);

        return $categories;
    }
}
