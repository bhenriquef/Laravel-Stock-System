<?php

namespace App\Repositories;
use App\Models\Shippings;
use App\DTOs\ShippingDTO;

class ShippingRepository
{   
    public function index(){
        return Shippings::all();
    }

    public function getById($id)
    {
        return Shippings::findOrFail($id);
    }

    public function store(ShippingDTO $data)
    {
        $data = ShippingDTO::toArray($data);
        return Shippings::create($data);
    }

    public function update(ShippingDTO $data, $id)
    {
        $data = ShippingDTO::toArray($data);
        $Shippings = Shippings::find($id);
        $Shippings->update($data);
        return $Shippings;
    }

    public function delete($id){
        return Shippings::destroy($id);
    }

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }
}
