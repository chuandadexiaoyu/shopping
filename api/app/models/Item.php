<?php

class Item extends BaseModel
{
    public static $rules = array(
        'name' => 'required|min:2|max:40',
        'details' => 'between:4,250',
        'sku' => 'between:4,20'
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

    public function validate($data)
    {
        return Validator::make($data, static::$rules);
    }

    public function search($findWhat)
    {
        // If we were passed an integer, find the primary key
        if(is_numeric($findWhat)) {
            return parent::find($findWhat);            
        } 

        if(is_array($findWhat)) {
            $params = $findWhat;
        } else {
            $params = array();
            parse_str($findWhat, $params);            
        }

        // search for submitted parameters
        // TODO: Figure out how to use $this->getTable() to get the table name
        $foundItems = parent::from('items');
        foreach($params as $key => $value) {
            $foundItems->where($key, 'like', '%'.$value.'%', 'and');
        }
        if (count($foundItems->get())==1) {
            return $foundItems->first();
        }
        return $foundItems->get();
    }

}
