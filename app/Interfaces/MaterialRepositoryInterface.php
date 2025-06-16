<?php

namespace App\Interfaces;

use App\DTOs\MaterialDTO;

interface MaterialRepositoryInterface
{
    public function index();
    public function getById($id);
    public function store(MaterialDTO $data);
    public function update(MaterialDTO $data, $id);
    public function delete($id);
}
