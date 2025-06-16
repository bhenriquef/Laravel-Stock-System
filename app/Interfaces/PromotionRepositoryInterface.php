<?php

namespace App\Interfaces;

use App\DTOs\PromotionDTO;

interface PromotionRepositoryInterface
{
    public function index();
    public function getById($id);
    public function store(PromotionDTO $data);
    public function update(PromotionDTO $data, $id);
    public function delete($id);
}
