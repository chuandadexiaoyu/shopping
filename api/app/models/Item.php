<?php

class Item extends BaseModel
{
    public static $rules = array(
        'name' => 'required|min:2|max:40',
        'details' => 'between:0:250',
        'sku' => 'between:0:20'
    );

    public function vendors()
    {
        return $this->belongsToMany('Vendor', 'item_vendors');
        return 'test';
    }

    public function carts()
    {
        return $this->belongsToMany('Cart', 'cart_items');
    }

    public static function find($findWhat, $columns = array('*'))
//    public static function find($findWhat, $columns = array('*'))
    {
        parent::find($findWhat, $columns);
    }
}