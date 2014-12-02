<?php namespace Blog\Providers;

use Tag;
use Post;
use Blog\Service\Cache\LaravelCache;
use Blog\Repository\Article\CacheDecorator;
use Blog\Repository\Tag\EloquentTag;
use Blog\Repository\Article\EloquentArticle;
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
            return new EloquentTag(new Tag);
        });
    }

}
