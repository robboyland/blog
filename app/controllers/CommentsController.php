<?php

class CommentsController extends \BaseController {


	/**
	 * Store a newly created resource in storage.
	 * POST /comments
	 *
	 * @return Response
	 */
	public function store()
	{

        $validator = Validator::make($data = Input::all(), ['body' => 'required', 'post_id' => 'required', 'user_id' => 'required']);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        Comment::create($data);

        return Redirect::back()->with('flash_message', 'Comment Added');
    }


}