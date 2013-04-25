<?php

class CartsController extends BaseController 
{
    public $name = 'Cart';

    public function __construct(Cart $data)
    {   
        $this->data = $data;
    }

    public function items($id)
    {
        $found = $this->findOrFail($id);
        return $found->items;
    }

    public function user($id)
    {
        $found = $this->findOrFail($id);
        return $found->user;
    }

}