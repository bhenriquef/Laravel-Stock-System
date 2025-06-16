<?php

namespace App\Http\Controllers;

use App\Classes\ResponseClass;
use App\DTOs\ShippingDTO;
use App\Http\Requests\StoreShippingsRequest;
use App\Http\Requests\UpdateShippingsRequest;
use App\Http\Resources\ShippingResource;
use App\Interfaces\ShippingRepositoryInterface;
use App\Models\Shippings;
use Illuminate\Support\Facades\DB;

class ShippingsController extends Controller
{
    private ShippingRepositoryInterface $ShippingRepositoryInterface;

    public function __construct(ShippingRepositoryInterface $ShippingRepositoryInterface)
    {
        $this->ShippingRepositoryInterface = $ShippingRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->ShippingRepositoryInterface->index();
        return ResponseClass::sendResponse(ShippingResource::collection($data), '', 200);
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
    public function store(StoreShippingsRequest $request)
    {
        $dto = ShippingDTO::fromArray($request->validated());

        DB::beginTransaction();
        try{
            $Shippings = $this->ShippingRepositoryInterface->store($dto);

            DB::commit();
            return ResponseClass::sendResponse(new ShippingResource($Shippings), 'Shippings Create Successful', 201);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Shippings = $this->ShippingRepositoryInterface->getById($id);
        return ResponseClass::sendResponse(new ShippingResource($Shippings), '', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shippings $Shippings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShippingsRequest $request, $id)
    {
        $dto = ShippingDTO::fromArray($request->validated());
        DB::beginTransaction();
        try{
            $Shippings = $this->ShippingRepositoryInterface->update($dto, $id);
            DB::commit();
            return ResponseClass::sendResponse(new ShippingResource($Shippings), 'Shippings Update Successful', 200);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->ShippingRepositoryInterface->delete($id);

        return ResponseClass::sendResponse('Product Delete Successfull', 'Product Delete Successfull', 204);
    }
}
