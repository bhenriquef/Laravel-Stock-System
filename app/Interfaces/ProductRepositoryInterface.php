<?php

namespace App\Interfaces;
use App\DTOs\ProductDTO;

interface ProductRepositoryInterface
{
    public function index();
    public function getById($id);
    public function store(ProductDTO $data);
    public function update(ProductDTO $data,$id);
    public function delete($id);
}
