<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * @OA\Get(
     *      path="/get-cart",
     *      operationId="getCartList",
     *      tags={"Cart"},
     *      summary="Get list of producs from Cart",
     *      description="Returns list of producs from Cart",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CartResource")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      ),
     *     )
     */
    public function getCart(){
        return session()->get('products');
    }

    /**
     * @OA\Post(
     *      path="/add-to-cart",
     *      operationId="storeProductsToCart",
     *      tags={"Cart"},
     *      summary="Store product",
     *      description="Store cart product",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCartRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *       ),
     * )
     */
    public function addToCart(Request $request){
        if(session()->has('products')){
            $products=session()->get('products',[]);
            $products[]=$request->all();
            session()->put('products',$products);
        }
        else $request->session()->put('products',[$request->all()]);
        return ['success'=>true];
    }
}
