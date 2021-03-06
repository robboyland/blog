<?php namespace Blog\Repository\Article;

use Post;
use Tag;
use Blog\Repository\RepositoryAbstract;
use Blog\Repository\Tag\TagInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentArticle extends RepositoryAbstract implements ArticleInterface {

    protected $article;
    protected $tag;

    // Class expects an Eloquent model
    public function __construct(Model $article, TagInterface $tag)
    {
        $this->article = $article;
        $this->tag = $tag;
    }

    /**
     * Retrieve article by id
     * regardless of status
     *
     * @param  int $id Article ID
     * @return stdObject object of article information
     */
    public function byId($id)
    {
        return $this->article->with('user')
                             ->with('tags')
                             ->where('id', $id)
                             ->first();
    }

    /**
     * Get paginated articles
     *
     * @param int $page Number of articles per page
     * @param int $limit Results per page
     * @param boolean $all Show published or all
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function byPage($page=1, $limit=10, $all=false)
    {
        $result = new \StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = $this->article->with('user')
                               ->with('category')
                               ->with('tags')
                               ->orderBy('created_at', 'desc');

        $articles = $query->skip( $limit * ($page-1) )
                        ->take($limit)
                        ->get();

        $result->totalItems = $this->totalArticles($all);
        $result->items = $articles->all();

        return $result;
    }

    /**
     * Get single article by URL
     *
     * @param string  URL slug of article
     * @return object object of article information
     */
    public function bySlug($slug)
    {
        $slug = $this->slug($slug);

        return $this->article->with('user')
                             ->with('category')
                             ->with('tags')
                             ->with('comments')
                             ->where('slug', $slug)
                             ->first();
    }

   /**
     * Get articles by their tag
     *
     * @param string  URL slug of tag
     * @param int Number of articles per page
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function byTag($tag, $page=1, $limit=10)
    {
        $foundTag = $this->tag->where('slug', $tag)->first();

        $result = new \StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        if( !$foundTag )
        {
            return $result;
        }

        $articles = $this->tag->articles()
                        ->orderBy('articles.created_at', 'desc')
                        ->skip( $limit * ($page-1) )
                        ->take($limit)
                        ->get();

        $result->totalItems = $this->totalByTag();
        $result->items = $articles->all();

        return $result;
    }

    /**
     * Create a new Article
     *
     * @param array  Data to create a new object
     * @return boolean
     */
    public function create(array $data)
    {
        $post = Post::create([
                    'title'       => $data['title'],
                    'body'        => $data['body'],
                    'user_id'     => $data['user_id'],
                    'category_id' => $data['category_id'],
                    'slug'        => $data['slug']
                ]);

        $post->tags()->sync($data['tags']);

        return true;
    }

    /**
     * Update an existing Article
     *
     * @param array  Data to update an Article
     * @return boolean
     */
    public function update(array $data)
    {
        $article = $this->article->find($data['id']);

        $article->title         = $data['title'];
        $article->body          = $data['body'];
        $article->category_id   = $data['category_id'];
        $article->slug          = $data['slug'];
        $article->save();

        $article->tags()->sync($data['tags']);

        return true;
    }

    /**
     * Delete an Article
     *
     * @param int Article id
     * @return void
     */
    public function delete($id)
    {
        Post::destroy($id);
    }

    /**
     * Sync tags for article
     *
     * @param \Illuminate\Database\Eloquent\Model  $article
     * @param array  $tags
     * @return void
     */
    protected function syncTags(Model $article, array $tags)
    {
        // Create or add tags
        $found = $this->tag->findOrCreate( $tags );

        $tagIds = array();

        foreach($found as $tag)
        {
            $tagIds[] = $tag->id;
        }

        // Assign set tags to article
        $article->tags()->sync($tagIds);
    }

    /**
     * Get total article count
     *
     * @todo I hate that this is public for the decorators.
     *       Perhaps interface it?
     * @return int  Total articles
     */
    protected function totalArticles($all = false)
    {
        if( ! $all )
        {
            // return $this->article->where('status_id', 1)->count();
            return $this->article->count();
        }

        return $this->article->count();
    }

    /**
     * Get total article count per tag
     *
     * @todo I hate that this is public for the decorators
     *       Perhaps interface it?
     * @param  string  $tag  Tag slug
     * @return int     Total articles per tag
     */
    protected function totalByTag($tag)
    {
        return $this->tag->bySlug($tag)
                    ->articles()
                    ->count();
    }

}
