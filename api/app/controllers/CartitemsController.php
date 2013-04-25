<?php

class CartitemsController extends BaseController 
{
    public $name = 'Cart/Item';

    public function __construct(Cartitems $data)
    {
        $this->data = $data;
    }

}