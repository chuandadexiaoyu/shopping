<?php

class EloquentItemRepository implements ItemRepositoryInterface
{
    public function carts(){            return Item::carts();  }
    public function destroy($id){       $item = new Item; return $item->destroy($id); }
    public function search($forWhat){   $item = new Item; return $item->search($forWhat); }
    public function validate($data){    $item = new Item; return $item->validate($data); }
    public function vendors(){          return Item::vendors();  }
}



