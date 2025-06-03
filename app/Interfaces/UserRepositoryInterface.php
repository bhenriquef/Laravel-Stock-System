<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function index();
    public function getById($id);
    public function store(array $data);
    public function update(array $data,$id);
    public function getByEmail(string $email);
    public function delete($id);
}
