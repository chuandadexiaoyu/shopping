<?php

class UsersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return User::all();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return User::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * A catch-all method which will be called when no other 
	 * matching method is found on the controller.
	 *
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function missingMethod($parameters)
	{
	    echo 'missing';
	}


	 /*********************************************************************************
     ** Actions
     **/

    /**
     * Show the login form
     */
    public function getLogin()
    {
        return View::make('users.login');
    }

    /**
     * Log a user in if they have submitted valid credentials 
     */
    public function postLogin()
    {
        $users = array(
                'username' => Input::get('username'),
                'password' => Input::get('password')
            );

        if (Auth::attempt($users)) {
            return Redirect::route('home');
        }
        return Redirect::back()
            ->with('message', 'Invalid credentials. Please try again.')
            ->withInput();
    }

    /**
     * log a user out
     */
    public function getLogout()
    {
        if (Auth::check()) {
            Auth::logout();
            return Redirect::route('login')->with('message', 'You are now logged out');
        }
        return Redirect::route('home');
    }

}