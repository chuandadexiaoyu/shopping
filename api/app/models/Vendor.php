<?php

class Vendor extends Eloquent 
{
    protected $guarded = array();

    public static $rules = array(
        'name'  => 'required|max:40'
    );

    public function items()
    {
        return $this->belongsToMany('Item', 'itemvendors', 'item_id', 'vendor_id')
            ->withPivot(array('confirmed','last_known_price'));
    }
}