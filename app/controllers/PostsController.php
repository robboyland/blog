<?php

use Blog\Services\PostCreator;

class PostsController extends \BaseController {

    public function __construct(PostCreator $postCreator)
    {
        $this->postCreator = $postCreator;

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
        $post = Post::where('slug', '=', $slug)->firstOrFail();;

        $comments = Comment::with('user')->where('post_id', '=', $post->id)->get();

        return View::make('posts.show', compact('post', 'comments'));
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
        $post = Post::findOrFail($id);

        $validator = Validator::make($data = Input::all(), ['title' => 'required', 'body' => 'required', 'user_id' => 'required']);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $post = Post::find($id);
        $post->title        = Input::get('title');
        $post->body         = Input::get('body');
        $post->category_id  = Input::get('category_id');
        $post->save();
        $post->tags()->sync(Input::get('tags'));

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
        Post::destroy($id);

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
