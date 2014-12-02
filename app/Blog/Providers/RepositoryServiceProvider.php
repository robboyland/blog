<?php namespace Blog\Providers;

use Tag;
use Post;
use Category;
use Blog\Service\Cache\LaravelCache;
use Blog\Repository\Article\CacheDecorator;
use Blog\Repository\Tag\EloquentTag;
use Blog\Repository\Article\EloquentArticle;
use Blog\Repository\Category\EloquentCategory;
use Blog\Repository\Category\CacheDecorator as CategoryCacheDecorator;
use Blog\Repository\Tag\CacheDecorator as TagCacheDecorator;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('Blog\Repository\Article\ArticleInterface', function($app)
        {
            $article =  new EloquentArticle(
                new Post,
                $app->make('Blog\Repository\Tag\TagInterface')
            );

            return new CacheDecorator(
                $article,
                new LaravelCache($app['cache'], 'articles', 10)
            );
        });

        $this->app->bind('Blog\Repository\Tag\TagInterface', function($app)
        {
            $tag = new EloquentTag(new Tag);

            return new TagCacheDecorator(
                $tag,
                new LaravelCache($app['cache'], 'articles', 10)
            );
        });

        $this->app->bind('Blog\Repository\Category\CategoryInterface', function($app)
        {
            $category = new EloquentCategory(new Category);

            return new CategoryCacheDecorator(
                $category,
                new LaravelCache($app['cache'], 'categories', 10)
            );
        });
    }

}
