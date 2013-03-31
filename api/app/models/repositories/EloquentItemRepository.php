<?php

class EloquentItemRepository implements ItemRepositoryInterface
{
    public function carts(){            return Item::carts();  }
    public function delete($id){        $item = new Item; return $item->delete($id); }
    public function search($forWhat){   $item = new Item; return $item->search($forWhat); }
    public function validate($data){    $item = new Item; return $item->validate($data); }
    public function vendors(){          return Item::vendors();  }
}



