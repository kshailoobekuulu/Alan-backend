<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Dotenv\Exception\ValidationException;
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
    public function getCart(Request $request){
        $productsInCart = session()->get('products');
        $products = Product::find(array_keys($productsInCart));
        foreach ($products as $product) {
            $product->quantity = $productsInCart[$product->id];
        }
        return $products;
    }

    /**
     * @OA\Post(
     *      path="/add-to-cart",
     *      operationId="storeProductsToCart",
     *      tags={"Cart"},
     *      summary="Store product",
     *      description="Add products to the cart.The type field must be 'action' or 'product'",
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
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *       ),
     * )
     */
    public function addToCart(Request $request){
        try {
            $request->validate([
                'id' => 'required|integer|min:1',
                'quantity' => 'required|integer|min:1',
            ]);
        } catch (ValidationException $e){
            return response()->json('Bad request', 400);
        }
        $id = $request['id'];
        if (!Product::find($id)) return response()->json('Not Found',404);
        $products = session()->get('products', []);
        $products[$id] = $request->quantity;
        session()->put('products',$products);
        return response()->json('Successfully added', 201);

    }
    /**
     * @OA\Delete(
     *      path="/remove-from-cart",
     *      operationId="deleteProduct",
     *      tags={"Cart"},
     *      summary="Delete existing product from Cart",
     *      description="Deletes a product",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/DeleteCartRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      )
     * )
     */
    public function removeFromCart(Request $request) {
        $products = session()->get('products', []);
        if (!isset($products[$request->id])) {
            return response()->json('Bad Request', 400);
        }
        unset($products[$request->id]);
        session()->put('products',$products);
        return response()->json('Succesfully deleted', 201);
    }
}
