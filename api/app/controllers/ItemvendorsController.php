<?php

class ItemvendorsController extends BaseController 
{
    public $name = 'Item/Vendor';

    public function __construct(Itemvendor $data)
    {
        $this->data = $data;
    }

}