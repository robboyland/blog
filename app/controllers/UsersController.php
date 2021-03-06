<?php

use Blog\Newsletters\NewsletterList;

class UsersController extends \BaseController {

    /**
     * @var Blog\Newsletter\NewsletterList
     */
    private $newsletterList;


    public function __construct(NewsletterList $newsletterList)
    {
        $this->newsletterList = $newsletterList;
    }

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
        $users = User::all();
		return View::make('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make($data = Input::all(), ['name' => 'required|min:3', 'email' => 'required|email|unique:users', 'password' => 'required|confirmed', 'password_confirmation' => 'required']);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('password'))
        ]);

        return Redirect::route('posts.index')->with('flash_message', 'Account created');
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = Auth::user();

        return View::make('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        Auth::user()->updateCredentials(Input::all());

        $email = Auth::user()->email;

        $method = Input::get('notify') ? 'subscribeTo' : 'unsubscribeFrom';

		$this->newsletterList->{$method}('ArticlePublishedSubscribers', $email);

        return Redirect::route('posts.index')->with('flash_message', 'Details Updated');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}