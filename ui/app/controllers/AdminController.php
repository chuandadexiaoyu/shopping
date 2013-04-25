<?php

use Guzzle\Http\Client;

class AdminController extends BaseController
{
    public function index()
    {
        $accounts = $this->getApi('accounts');
        $items = $this->getApi('items');
        $users = $this->getApi('users');
        $vendors = $this->getApi('vendors');
        $dates = $this->getApi('dates');

        return View::make('admin/index')
            ->with('dates', $dates)
            ->with('users', $users)
            ->with('items', $items)
            ->with('accounts', $accounts)
            ->with('vendors', $vendors);
    }

}
