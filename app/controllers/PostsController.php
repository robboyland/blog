<?php

use Blog\Services\PostCreator;
use Blog\Services\PostEditor;
use Blog\Repositories\Article\ArticleInterface;
use Illuminate\Events\Dispatcher;

class PostsController extends \BaseController {

    public function __construct(PostCreator $postCreator,
                                PostEditor $postEditor,
                                ArticleInterface $article,
                                Dispatcher $events)
    {
        $this->postCreator = $postCreator;
        $this->postEditor  = $postEditor;
        $this->article = $article;
        $this->events = $events;

        $this->beforeFilter('auth', ['except' => ['show', 'byTag', 'byCategory']]);
    }

    /**
     * Display a listing of posts
     *
     * @return Response
     */
    public function index()
    {
        $series= Series::where('user_id', '=', Auth::user()->id)->get();
        $posts = Post::where('user_id', '=', Auth::user()->id)->get();
        return View::make('posts.index', compact('posts', 'series'));
    }

    /**
     * Show the form for creating a new post
     *
     * @return Response
     */
    public function create()
    {
        $categories = DB::table('categories')->orderBy('name', 'asc')->lists('name','id');
        $tags = Tag::all();
        return View::make('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created post in storage.
     *
     * @return Response
     */
    public function store()
    {
        $result = $this->postCreator->make(Input::all());

        if ($result !== true)
        {
            return Redirect::back()->withInput()->withErrors($result);
        }

        $this->events->fire('PostWasPublished', Input::get('title'));

        return Redirect::route('posts.index')->with('flash_message', 'New Post Created');
    }

    /**
     * Display the specified post.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
        $post = $this->article->bySlug($slug);

        return View::make('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = DB::table('categories')
                        ->orderBy('name', 'asc')
                        ->lists('name','id');

        // all tags
        $tags = Tag::all();

        // tag ids that post has been assigned
        $tagIds = array();
        foreach($post->tags as $tag)
        {
            $tagIds[] = $tag->id;
        }

        return View::make('posts.edit', compact('post', 'categories', 'tags', 'tagIds'));
    }

    /**
     * Update the specified post in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $result = $this->postEditor->update(Input::all(), $id);

        if ($result !== true)
        {
            return Redirect::back()->withInput()->withErrors($result);
        }

        return Redirect::route('posts.index')->with('flash_message', 'Post Updated');
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->article->delete($id);

        return Redirect::route('posts.index')->with('flash_message', 'Post Deleted');
    }

    public function byTag($tag)
    {
        $tagpage = Tag::find($tag);
        $posts = Tag::find($tag)->posts;
        return View::make('tags.posts', compact('posts', 'categories', 'tags', 'tag', 'tagpage'));
    }

    public function byCategory($category)
    {
        $catpage = Category::find($category);
        $posts = Category::find($category)->posts;

        return View::make('categories.posts', compact('posts', 'categories', 'tags', 'category', 'catpage'));
    }

}
