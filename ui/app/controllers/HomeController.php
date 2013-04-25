<?php

class HomeController extends BaseController 
{
    public function getHomepage()
    {
        if (!Auth::user())
            return Redirect::route('login');

        if (Auth::user()->username=='admin')
            return Redirect::route('admin');

        if (Auth::user()->homepage && Auth::user()->homepage!='admin')
            return Redirect::to(Auth::user()->homepage);
        
        return Redirect::route('entry');
    }
}