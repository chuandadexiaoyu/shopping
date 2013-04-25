<?php

class Cart extends Eloquent 
{
    protected $guarded = array();

    public static $rules = array(
    );

    public function items()
    {
        return $this->belongsToMany('Item', 'cartitems', 'cart_id', 'item_id')
            ->withPivot(array('quantity','price_approx','price_actual'));
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

}