<?php

class Item extends Eloquent 
{
    protected $guarded = array();

    public static $rules = array(
        'name'      => 'required|max:40',
        'details'   => 'max:250',
        'sku'       => 'max:20',
    );

    public function vendors()
    {
        return $this->belongsToMany('Vendor', 'itemvendors', 'vendor_id', 'item_id')
            ->withPivot(array('confirmed','last_known_price'));
    }

    public function carts()
    {
        return $this->belongsToMany('Cart', 'cartitems', 'item_id', 'cart_id')
            ->withPivot(array('quantity','price_approx','price_actual'));        
    }
    
    public function accounts()
    {
        return $this->belongsToMany('Account', 'cartitems', 'item_id', 'acct_id')
            ->withPivot(array('quantity','price_approx','price_actual'));        
    }

}
