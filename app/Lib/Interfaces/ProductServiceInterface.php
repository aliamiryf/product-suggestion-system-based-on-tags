<?php

namespace App\Lib\Interfaces;

interface ProductServiceInterface
{
    public function getAllProduct($filters = []);

    public function getProduct($id);
}
