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
    }

    public function carts()
    {
        return $this->belongsToMany('Cart', 'cart_items');
    }

    public function validate($data)
    {
        // If this function was not passed an array,
        // it needs to receive an object with an all()
        // function that can be converted to an array.
        if (!is_array($data) and  method_exists($data, 'all')) {
            $data = $data->all();
        }
        return Validator::make($data, static::$rules);
    }

    public function search($findWhat)
    {
        // If we were passed an integer, find the primary key
        if(is_numeric($findWhat)) {
            return parent::find($findWhat);            
        } 

        // TODO: Parse and validate parameters
        // TODO: Validate it should return a failure if 2 of the same parameter
        if (!is_array($findWhat) and method_exists($findWhat, 'all')) {
            $params = $findWhat->all();
        } elseif (is_array($findWhat)) {
            $params = $findWhat;
        } else {
            $params = array();
            parse_str($findWhat, $params);
        }

        // search for submitted parameters
        // TODO: Figure out how to use other parameters: =, >=, <=, >, < 
        $table = $this->getTable();
        $foundItems = parent::from($table);
        foreach($params as $key => $value) {
            $foundItems->where($key, 'like', '%'.$value.'%', 'and');
        }
        if (count($foundItems->get())==1) {
            return $foundItems->first();
        }
        return $foundItems->get();
    }

}
