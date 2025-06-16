<?php

namespace App\Interfaces;

use App\DTOs\ClientDTO;

interface ClientRepositoryInterface
{
    public function index();
    public function getById($id);
    public function store(ClientDTO $data);
    public function update(ClientDTO $data, $id);
    public function delete($id);
}
