<?php

class UsersController extends BaseController 
{
    public $name = 'User';

    public function __construct(User $data)
    {
        $this->data = $data;
    }

    public function carts($id)
    {
        $found = $this->findOrFail($id);
        return $found->carts;
    }

}