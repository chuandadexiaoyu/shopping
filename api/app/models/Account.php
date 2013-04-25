<?php

class Account extends Eloquent {

    protected $primaryKey = 'number';

    protected $guarded = array();

    public static $rules = array(
        'number'    => 'required|integer|min:0',
        'name'      => 'required|max:40',
    );

    public function items()
    {
        return $this->belongsToMany('Item', 'cartitems', 'acct_id', 'item_id')
            ->withPivot(array('quantity','price_approx','price_actual'));
    }

}
