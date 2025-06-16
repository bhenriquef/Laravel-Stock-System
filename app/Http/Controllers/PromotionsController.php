<?php

namespace App\Http\Controllers;

use App\Classes\ResponseClass;
use App\DTOs\PromotionDTO;
use App\Http\Requests\StorePromotionsRequest;
use App\Http\Requests\UpdatePromotionsRequest;
use App\Http\Resources\PromotionResource;
use App\Interfaces\PromotionRepositoryInterface;
use App\Models\Promotions;
use Illuminate\Support\Facades\DB;

class PromotionsController extends Controller
{
    private PromotionRepositoryInterface $PromotionRepositoryInterface;

    public function __construct(PromotionRepositoryInterface $PromotionRepositoryInterface)
    {
        $this->PromotionRepositoryInterface = $PromotionRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->PromotionRepositoryInterface->index();
        return ResponseClass::sendResponse(PromotionResource::collection($data), '', 200);
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
    public function store(StorePromotionsRequest $request)
    {
        $dto = PromotionDTO::fromArray($request->validated());

        DB::beginTransaction();
        try{
            $Promotion = $this->PromotionRepositoryInterface->store($dto);

            DB::commit();
            return ResponseClass::sendResponse(new PromotionResource($Promotion), 'Promotion Create Successful', 201);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Promotion = $this->PromotionRepositoryInterface->getById($id);
        return ResponseClass::sendResponse(new PromotionResource($Promotion), '', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotions $Promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromotionsRequest $request, $id)
    {
        $dto = PromotionDTO::fromArray($request->validated());
        DB::beginTransaction();
        try{
            $Promotion = $this->PromotionRepositoryInterface->update($dto, $id);
            DB::commit();
            return ResponseClass::sendResponse(new PromotionResource($Promotion), 'Promotion Update Successful', 200);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->PromotionRepositoryInterface->delete($id);

        return ResponseClass::sendResponse('Product Delete Successfull', 'Product Delete Successfull', 204);
    }
}
