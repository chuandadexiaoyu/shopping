<?php

class ShoppingDatesController extends BaseController 
{
    public $name = 'Shopping Date ';

    public function __construct(ShoppingDate $data)
    {
        $this->data = $data;
    }

    public function next()
    {
        $now = new DateTime;
        return $this->data->where('shopping_date','>',$now)->min('shopping_date');
    }

    public function carts($id)
    {
        $found = $this->findOrFail($id);
        return Cart::where('shopping_date','=',$found->shopping_date)->get();
    }

}