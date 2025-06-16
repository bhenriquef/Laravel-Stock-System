<?php

namespace App\Repositories;
use App\Models\Client;
use App\DTOs\ClientDTO;

class ClientRepository
{   
    public function index(){
        return Client::all();
    }

    public function getById($id)
    {
        return Client::findOrFail($id);
    }

    public function store(ClientDTO $data)
    {
        $data = ClientDTO::toArray($data);
        return Client::create($data);
    }

    public function update(ClientDTO $data, $id)
    {
        $data = ClientDTO::toArray($data);
        $Client = Client::find($id);
        $Client->update($data);
        return $Client;
    }

    public function delete($id){
        return Client::destroy($id);
    }

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }
}
