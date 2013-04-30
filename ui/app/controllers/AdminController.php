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
        $table = Input::get('table');
        $value = Input::get('value');

        if (!$pk or !$field or !$table)
            App::abort(500, 'primary key, field, and table must be entered');

        $resourceName = $this->getResourceName($table);

        // Write the record to the database
        // $this->putApi($resourceName, $id, Input::data());
    }

    public function destroy()
    {
        $json   = Input::json();
        $id     = $json->get('id');
        $table  = $json->get('table');

        $resourceName = $this->getResourceName($table);
        $this->deleteApi($resourceName, $id);
        return;
    }

    private function getResourceName($tableName)
    {
        // get the name of each resource, based on the table name
        if ($tableName == 'dates_table') {
            return 'dates';
        } elseif ($tableName == 'item_table') {
            return 'items';
        } elseif ($tableName == 'vendor_table') {
            return 'vendors';
        } elseif ($tableName == 'account_table') {
            return 'accounts';
        } elseif ($tableName == 'user_table') {
            return 'users';
        } else {
            App::abort(500, 'invalid table selected ('.$tableName.')');
        }
    }

}
