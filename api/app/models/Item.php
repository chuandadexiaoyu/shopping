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

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
    }

    public static function search($findWhat)
    {
        // If we were passed an integer, find the primary key
        if(is_integer($findWhat)) {
            return parent::find($findWhat);            
        } 

        // search for the given parameters
        $params = array();
        parse_str($findWhat, $params);
        // TODO: Figure out how to search for more than one parameter
        $foundItems = DB::table('items');
        foreach($params as $key => $value) {
            $foundItems->where($key, 'like', '%'.$value.'%', 'and');
        }
        if (count($foundItems->get())==1) {
            return $foundItems->first();
        }
        return $foundItems->get();
    }
}
