<?php

namespace App\Http\Controllers;

use App\Classes\ResponseClass;
use App\DTOs\ClientDTO;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Interfaces\ClientRepositoryInterface;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    private ClientRepositoryInterface $clientRepositoryInterface;

    public function __construct(ClientRepositoryInterface $clientRepositoryInterface)
    {
        $this->clientRepositoryInterface = $clientRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->clientRepositoryInterface->index();
        return ResponseClass::sendResponse(ClientResource::collection($data), '', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $dto = ClientDTO::fromArray($request->validated());

        DB::beginTransaction();
        try{
            $client = $this->clientRepositoryInterface->store($dto);

            DB::commit();
            return ResponseClass::sendResponse(new ClientResource($client), 'Client Create Successful', 201);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $client = $this->clientRepositoryInterface->getById($id);
        return ResponseClass::sendResponse(new ClientResource($client), '', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, $id)
    {
        $dto = ClientDTO::fromArray($request->validated());
        DB::beginTransaction();
        try{
            $client = $this->clientRepositoryInterface->update($dto, $id);
            DB::commit();
            return ResponseClass::sendResponse(new ClientResource($client), 'Client Update Successful', 200);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->clientRepositoryInterface->delete($id);

        return ResponseClass::sendResponse('Product Delete Successfull', 'Product Delete Successfull', 204);
    }
}
