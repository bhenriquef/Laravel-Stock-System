<?php

namespace App\Http\Controllers;

use App\Classes\ResponseClass;
use App\DTOs\SupplierDTO;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Interfaces\SupplierRepositoryInterface;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    private SupplierRepositoryInterface $SupplierRepositoryInterface;

    public function __construct(SupplierRepositoryInterface $SupplierRepositoryInterface)
    {
        $this->SupplierRepositoryInterface = $SupplierRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->SupplierRepositoryInterface->index();
        return ResponseClass::sendResponse(SupplierResource::collection($data), '', 200);
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
    public function store(StoreSupplierRequest $request)
    {
        $dto = SupplierDTO::fromArray($request->validated());

        DB::beginTransaction();
        try{
            $Supplier = $this->SupplierRepositoryInterface->store($dto);

            DB::commit();
            return ResponseClass::sendResponse(new SupplierResource($Supplier), 'Supplier Create Successful', 201);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Supplier = $this->SupplierRepositoryInterface->getById($id);
        return ResponseClass::sendResponse(new SupplierResource($Supplier), '', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $Supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, $id)
    {
        $dto = SupplierDTO::fromArray($request->validated());
        DB::beginTransaction();
        try{
            $Supplier = $this->SupplierRepositoryInterface->update($dto, $id);
            DB::commit();
            return ResponseClass::sendResponse(new SupplierResource($Supplier), 'Supplier Update Successful', 200);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->SupplierRepositoryInterface->delete($id);

        return ResponseClass::sendResponse('Product Delete Successfull', 'Product Delete Successfull', 204);
    }
}
