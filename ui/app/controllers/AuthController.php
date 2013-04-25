<?php

class AuthController extends BaseController
{
    public function getLogin()
    {
        return View::make('user/login');
    }

    public function postLogin()
    {
        $user = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        if (Auth::attempt($user)) {
            return Redirect::route('home')
                ->with('flash_notice', 'You are successfully logged in.');
        }

        // authentication failure! lets go back to the login page
        return Redirect::route('login')
            ->with('flash_error', 'Your username/password combination was incorrect.')
            ->withInput();
    }

    public function getLogout()
    {
        Auth::logout();

        return Redirect::route('login')
            ->with('flash_notice', 'You are successfully logged out.');
    }

}