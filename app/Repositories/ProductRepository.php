<?php

namespace App\Repositories;
use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;
use App\DTOs\ProductDTO;

class ProductRepository implements ProductRepositoryInterface
{

    public function index(){
        return Product::all();
    }

    public function getById($id)
    {
        return Product::findOrFail($id);
    }

    public function store(ProductDTO $data)
    {
        $data = ProductDTO::toArray($data);
        return Product::create($data);
    }

    public function update(ProductDTO $data, $id)
    {
        $data = ProductDTO::toArray($data);
        $Product = Product::find($id);
        $Product->update($data);
        return $Product;
    }

    public function delete($id){
        return Product::destroy($id);
    }

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }
}
