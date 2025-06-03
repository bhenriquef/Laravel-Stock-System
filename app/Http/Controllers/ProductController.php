<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;
use App\Classes\ResponseClass;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepositoryInterface;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    /**
     * Products | List
     * 
     * Display a listing of products.
     * 
     * @authenticated
     */
    public function index()
    {
        $data = $this->productRepositoryInterface->index();
        return ResponseClass::sendResponse(ProductResource::collection($data), '', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Products | New
     * 
     * Store a newly created product in database.
     * @authenticated
     */
    public function store(StoreProductRequest $request)
    {
        $details = [
            'name' => $request->name,
            'details' => $request->details,
        ];

        DB::beginTransaction();
        try{
            $product = $this->productRepositoryInterface->store($details);

            DB::commit();
            return ResponseClass::sendResponse(new ProductResource($product), 'Product Create Successful', 201);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Products | Show
     * 
     * Display the specified product.
     * 
     * @authenticated
     */
    public function show($id)
    {
        $product = $this->productRepositoryInterface->getById($id);
        return ResponseClass::sendResponse(new ProductResource($product), '', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Products | Update
     * 
     * Update the specified product in database.
     * @authenticated
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $details = [
            'name' => $request->name,
            'details' => $request->details,
        ];
        DB::beginTransaction();
        try{
            $product = $this->productRepositoryInterface->update($details, $id);
            DB::commit();
            return ResponseClass::sendResponse(new ProductResource($product), 'Product Update Successful', 201);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Products | Delete
     * 
     * Remove the specified product from database.
     * @authenticated
     */
    public function destroy($id)
    {
        $this->productRepositoryInterface->delete($id);

        return ResponseClass::sendResponse('Product Delete Successful', 'Product Delete Successful', 204);
    }
}
