<?php

namespace App\Http\Controllers;

use App\Classes\ResponseClass;
use App\DTOs\StockDTO;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Http\Resources\StockResource;
use App\Interfaces\StockRepositoryInterface;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    private StockRepositoryInterface $StockRepositoryInterface;

    public function __construct(StockRepositoryInterface $StockRepositoryInterface)
    {
        $this->StockRepositoryInterface = $StockRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->StockRepositoryInterface->index();
        return ResponseClass::sendResponse(StockResource::collection($data), '', 200);
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
    public function store(StoreStockRequest $request)
    {
        $dto = StockDTO::fromArray($request->validated());

        DB::beginTransaction();
        try{
            $Stock = $this->StockRepositoryInterface->store($dto);

            DB::commit();
            return ResponseClass::sendResponse(new StockResource($Stock), 'Stock Create Successful', 201);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Stock = $this->StockRepositoryInterface->getById($id);
        return ResponseClass::sendResponse(new StockResource($Stock), '', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $Stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockRequest $request, $id)
    {
        $dto = StockDTO::fromArray($request->validated());
        DB::beginTransaction();
        try{
            $Stock = $this->StockRepositoryInterface->update($dto, $id);
            DB::commit();
            return ResponseClass::sendResponse(new StockResource($Stock), 'Stock Update Successful', 200);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->StockRepositoryInterface->delete($id);

        return ResponseClass::sendResponse('Product Delete Successfull', 'Product Delete Successfull', 204);
    }
}
