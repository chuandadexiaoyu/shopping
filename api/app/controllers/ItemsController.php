<?php

class ItemsController extends BaseController 
{
    public $name = 'Item';

    public function __construct(Item $data)
    {
        $this->data = $data;
    }

    public function vendors($id)
    {
        $found = $this->findOrFail($id);
        return $found->vendors;
    }

    public function carts($id)
    {
        $found = $this->findOrFail($id);
        return $found->carts;
    }

    public function accounts($id)
    {
        $found = $this->findOrFail($id);
        return $found->accounts;
    }

}