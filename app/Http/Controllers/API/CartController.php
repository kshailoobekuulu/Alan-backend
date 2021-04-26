<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Action;
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
     *      summary="Get list of 'products' and 'actions' from Cart",
     *      description="Returns list of 'products' and 'actions' from Cart",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CartResource"),
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
        $actionsInCart = session()->get('actions');
        $actions = Action::find(array_keys($actionsInCart));
        foreach ($actions as $action) {
            $action->quantity = $actionsInCart[$action->id];
        }
        return ['products'=>$products,'actions'=>$actions];
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
                'type' => 'required|in:product,action'
            ]);
        } catch (ValidationException $e){
            return response()->json('Bad request', 400);
        }
        if ($request['type']==='product') {
            $id = $request['id'];
            if (!Product::find($id)) return response()->json('Not Found',404);
            $products = session()->get('products', []);
            $products[$id] = $request->quantity;
            session()->put('products',$products);
            return response()->json('Product successfully added', 201);
        }
        $id = $request['id'];
        if (!Action::find($id)) return response()->json('Not Found',404);
        $actions = session()->get('actions', []);
        $actions[$id] = $request->quantity;
        session()->put('actions',$actions);
        return response()->json('Action successfully added', 201);
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
