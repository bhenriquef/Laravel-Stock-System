<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Repositories\MaterialRepository;
use App\Classes\ResponseClass;
use App\Http\Resources\MaterialResource;
use App\Interfaces\MaterialRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\DTOs\MaterialDTO;
use Illuminate\Http\JsonResponse;

class MaterialController extends Controller
{
    private MaterialRepositoryInterface $MaterialRepositoryInterface;

    public function __construct(MaterialRepositoryInterface $MaterialRepositoryInterface)
    {
        $this->MaterialRepositoryInterface = $MaterialRepositoryInterface;
    }

    /**
     * Materials | List
     * 
     * Display a listing of Materials.
     * 
     * @authenticated
     */
    public function index() : JsonResponse
    {
        $data = $this->MaterialRepositoryInterface->index();
        return ResponseClass::sendResponse(MaterialResource::collection($data), '', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Materials | New
     * 
     * Store a newly created Material in database.
     * @authenticated
     */
    public function store(StoreMaterialRequest $request) : JsonResponse
    {
        $dto = MaterialDTO::fromArray($request->validated());

        DB::beginTransaction();
        try{
            $Material = $this->MaterialRepositoryInterface->store($dto);

            DB::commit();
            return ResponseClass::sendResponse(new MaterialResource($Material), 'Material Create Successful', 201);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Materials | Show
     * 
     * Display the specified Material.
     * 
     * @authenticated
     */
    public function show($id) : JsonResponse
    {
        $Material = $this->MaterialRepositoryInterface->getById($id);
        return ResponseClass::sendResponse(new MaterialResource($Material), '', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $Material)
    {
        //
    }

    /**
     * Materials | Update
     * 
     * Update the specified Material in database.
     * @authenticated
     */
    public function update(UpdateMaterialRequest $request, $id) : JsonResponse
    {
        $dto = MaterialDTO::fromArray($request->validated());
        DB::beginTransaction();
        try{
            $Material = $this->MaterialRepositoryInterface->update($dto, $id);
            DB::commit();
            return ResponseClass::sendResponse(new MaterialResource($Material), 'Material Update Successful', 200);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Materials | Delete
     * 
     * Remove the specified Material from database.
     * @authenticated
     */
    public function destroy($id) : JsonResponse
    {
        $this->MaterialRepositoryInterface->delete($id);

        return ResponseClass::sendResponse('Material Delete Successful', 'Material Delete Successful', 204);
    }
}
