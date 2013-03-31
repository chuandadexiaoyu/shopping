<?php

Interface ItemRepositoryInterface
{
    public function search($forWhat);

    public function validate($data);
    public function delete($id);

    public function carts();
    public function vendors();
}