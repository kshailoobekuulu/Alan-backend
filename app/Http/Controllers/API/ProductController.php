<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *      path="/products",
     *      operationId="getProductsList",
     *      tags={"Products"},
     *      summary="Get list of products",
     *      description="Returns list of products",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      ),
     *     )
     */
    public function index()
    {
        $products = Product::all();
        if ($products !== null) return ProductResource::collection($products);
        return response()->json('Products not found');
    }
}
