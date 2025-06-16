<?php

namespace App\Repositories;
use App\Models\Material;
use App\DTOs\MaterialDTO;

class MaterialRepository
{   
    public function index(){
        return Material::all();
    }

    public function getById($id)
    {
        return Material::findOrFail($id);
    }

    public function store(MaterialDTO $data)
    {
        $data = MaterialDTO::toArray($data);
        return Material::create($data);
    }

    public function update(MaterialDTO $data, $id)
    {
        $data = MaterialDTO::toArray($data);
        $Material = Material::find($id);
        $Material->update($data);
        return $Material;
    }

    public function delete($id){
        return Material::destroy($id);
    }

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }
}
