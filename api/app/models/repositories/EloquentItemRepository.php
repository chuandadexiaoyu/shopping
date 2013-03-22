<?php

class EloquentItemRepository implements ItemRepositoryInterface
{
    public function all()
    {
        return Item::all();
    }

    public function find($id)
    {
        return Item::find($id);
    }

    public function validate($data)
    {
        return Item::validate($data);
    }

    public function carts()
    {
        return Item::carts();
    }

    public function vendors()
    {
        return Item::vendors();
    }

}