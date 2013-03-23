<?php

class EloquentVendorRepository implements VendorRepositoryInterface
{
    public function get(){                  return Vendor::get(); }
    // public function all(){              return Item::all(); }
    // public function find($id){          return Item::find($id); }
    // public function validate($data){    return Item::validate($data);  }
    // public function carts(){            return Item::carts();  }
    // public function vendors(){          return Item::vendors();  }
}