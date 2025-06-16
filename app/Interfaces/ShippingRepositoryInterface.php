<?php

namespace App\Interfaces;

use App\DTOs\ShippingDTO;

interface ShippingRepositoryInterface
{
    public function index();
    public function getById($id);
    public function store(ShippingDTO $data);
    public function update(ShippingDTO $data, $id);
    public function delete($id);
}
