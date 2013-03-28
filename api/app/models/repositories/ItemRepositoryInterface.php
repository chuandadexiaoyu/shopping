<?php

Interface ItemRepositoryInterface
{
    public function all();
    public function search($forWhat);

    public function validate($data);

    public function carts();
    public function vendors();
}