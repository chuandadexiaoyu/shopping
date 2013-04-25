<?php

class AccountsController extends BaseController 
{
    public $name = 'Account';

    public function __construct(Account $data)
    {
        $this->data = $data;
    }

    public function items($id)
    {
        $found = $this->findOrFail($id);
        return $found->items;
    }

}