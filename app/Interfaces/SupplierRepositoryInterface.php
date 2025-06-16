<?php

namespace App\Interfaces;

use App\DTOs\SupplierDTO;

interface SupplierRepositoryInterface
{
    public function index();
    public function getById($id);
    public function store(SupplierDTO $data);
    public function update(SupplierDTO $data, $id);
    public function delete($id);
}
