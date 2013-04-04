<?php

class Cart extends Eloquent {

    public function items()
    {
        return $this->belongsToMany('Item');
    }
}