<?php

class PostsController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth', ['except' => 'show']);
    }

	/**
	 * Display a listing of posts
	 *
	 * @return Response
	 */
	public function index()
	{
		// $posts = Post::all();
        $posts = Post::where('user_id', '=', Auth::user()->id)->get();
		return View::make('posts.index', compact('posts'));
	}

	/**
	 * Show the form for creating a new post
	 *
	 * @return Response
	 */
	public function create()
	{
        $categories = DB::table('categories')->orderBy('name', 'asc')->lists('name','id');

		return View::make('posts.create', compact('categories'));
	}

	/**
	 * Store a newly created post in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), ['title' => 'required', 'body' => 'required', 'user_id' => 'required', 'category_id' => 'required']);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Post::create($data);

		return Redirect::route('posts.index')->with('flash_message', 'New Post Created');
	}

	/**
	 * Display the specified post.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = Post::findOrFail($id);

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
        $categories = DB::table('categories')->orderBy('name', 'asc')->lists('name','id');

		return View::make('posts.edit', compact('post', 'categories'));
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

		$post->update($data);

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

}
