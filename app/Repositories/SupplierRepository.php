<?php

namespace App\Repositories;
use App\Models\Supplier;
use App\DTOs\SupplierDTO;

class SupplierRepository
{   
    public function index(){
        return Supplier::all();
    }

    public function getById($id)
    {
        return Supplier::findOrFail($id);
    }

    public function store(SupplierDTO $data)
    {
        $data = SupplierDTO::toArray($data);
        return Supplier::create($data);
    }

    public function update(SupplierDTO $data, $id)
    {
        $data = SupplierDTO::toArray($data);
        $Supplier = Supplier::find($id);
        $Supplier->update($data);
        return $Supplier;
    }

    public function delete($id){
        return Supplier::destroy($id);
    }

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }
}
