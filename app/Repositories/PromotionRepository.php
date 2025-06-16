<?php

namespace App\Repositories;
use App\Models\Promotions;
use App\DTOs\PromotionDTO;

class PromotionRepository
{   
    public function index(){
        return Promotions::all();
    }

    public function getById($id)
    {
        return Promotions::findOrFail($id);
    }

    public function store(PromotionDTO $data)
    {
        $data = PromotionDTO::toArray($data);
        return Promotions::create($data);
    }

    public function update(PromotionDTO $data, $id)
    {
        $data = PromotionDTO::toArray($data);
        $Promotions = Promotions::find($id);
        $Promotions->update($data);
        return $Promotions;
    }

    public function delete($id){
        return Promotions::destroy($id);
    }

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }
}
