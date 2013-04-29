<?php

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

    public function update()
    {
        $pk = Input::get('pk');
        $field = Input::get('name');
        $value = Input::get('value');
        $table = Input::get('table');

        if (!$pk or !$field or !$table)
            App::abort(500, 'primary key, field, and table must be entered');

        // Write the record to the database
        // $this->
        return Response::make('foo', 200);
    }

    public function destroy()
    {
        $json   = Input::json();
        $id     = $json->get('id');
        $table  = $json->get('table');

        // send to a different controller, based on the table
        if ($table == 'dates_table') {
            $page = 'dates';
        } elseif ($table == 'item_table') {
            $page = 'items';
        } elseif ($table == 'vendor_table') {
            $page = 'vendors';
        } elseif ($table == 'account_table') {
            $page = 'accounts';
        } elseif ($table == 'user_table') {
            $page = 'users';
        } else {
            App::abort(500, 'invalid table selected');
        }

        $this->deleteApi($page, $id);
        return;
    }

}
