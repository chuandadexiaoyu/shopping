<?php

Interface ItemRepositoryInterface
{
    public function all();
    public function find($id);

    public function validate($data);

    public function carts();
    public function vendors();
}