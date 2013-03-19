<?php

class Item extends Eloquent {

    public function vendors()
    {
        return $this->belongsToMany('Vendor', 'item_vendors');
    }

    public function carts()
    {
        return $this->belongsToMany('Carts');
    }
}