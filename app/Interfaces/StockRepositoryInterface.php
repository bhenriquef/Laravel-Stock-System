<?php

namespace App\Interfaces;

use App\DTOs\StockDTO;

interface StockRepositoryInterface
{
    public function index();
    public function getById($id);
    public function store(StockDTO $data);
    public function update(StockDTO $data, $id);
    public function delete($id);
}
