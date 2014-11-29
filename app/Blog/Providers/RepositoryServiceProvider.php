<?php namespace Blog\Providers;

use Tag;
use Post;
use Blog\Service\Cache\LaravelCache;
use Blog\Repositories\Article\CacheDecorator;
use Blog\Repositories\Tag\EloquentTag;
use Blog\Repositories\Article\EloquentArticle;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('Blog\Repositories\Article\ArticleInterface', function($app)
        {
            $article =  new EloquentArticle(
                new Post,
                $app->make('Blog\Repositories\Tag\TagInterface')
            );

            return new CacheDecorator(
                $article,
                new LaravelCache($app['cache'], 'articles', 10)
            );
        });

        $this->app->bind('Blog\Repositories\Tag\TagInterface', function($app)
        {
            return new EloquentTag(new Tag);
        });
    }

}
