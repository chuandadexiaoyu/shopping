<?php

class EloquentItemRepository implements ItemRepositoryInterface
{
    public function carts()
    {
        return Item::carts();
    }

    public function destroy($id)
    {
        $item = new Item; 
        return $item->destroy($id); 
    }
    
    public function search($forWhat)
    {
        $item = new Item; 
        return $item->search($forWhat); 
    }
    
    public function create(array $data)
    {
        $item = new Item; 
        return $item->create($data); 
    }
    
    public function validate($data, $context=Null)
    {
        $item = new Item; 
        return $item->validate($data, $context); 
    }
    
    public function vendors()
    {
        return Item::vendors(); 
    }
}




