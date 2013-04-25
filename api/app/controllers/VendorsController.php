<?php

class VendorsController extends BaseController 
{
    public $name = 'Vendor';

    public function __construct(Vendor $data)
    {
        $this->data = $data;
    }

    public function items($id)
    {
        $found = $this->findOrFail($id);
        return $found->items;
    }

}