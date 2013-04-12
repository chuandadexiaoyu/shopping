<?php

Interface ItemRepositoryInterface
{
    public function search($forWhat);

    public function validate($data, $context=Null);
    public function destroy($id);
    public function create(array $data);

    public function carts();
    public function vendors();
}

