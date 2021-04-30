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
        $products = [];
        if ($productsInCart !== null) {
            $productsI = Product::find(array_keys($productsInCart));
            foreach ($productsI as $product) {
                $product->quantity = $productsInCart[$product->id];
            }
            $products=$productsI;
        }
        $actionsInCart = session()->get('actions');
        $actions=[];
        if ($actionsInCart !== null) {
            $actionsI = Action::find(array_keys($actionsInCart));
            foreach ($actionsI as $action) {
                $action->quantity = $actionsInCart[$action->id];
            }
            $actions = $actionsI;
        }
        return ['products' => $products,'actions' => $actions];
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
     *          description="'Action successfully added' or 'Product successfully added'",
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
        if ($request['type'] === 'product') {
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
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/DeleteCartRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="'Action successfully removed' or 'Product successfully removed'",
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
        if ($request['type'] === 'product') {
            $products = session()->get('products', []);
            if (!isset($products[$request->id])) {
                return response()->json('Bad Request', 400);
            }
            unset($products[$request->id]);
            session()->put('products',$products);
            return response()->json('Product succesfully deleted', 201);
        }
        if ($request['type'] === 'action') {
            $actions = session()->get('actions', []);
            if (!isset($actions[$request->id])) {
                return response()->json('Bad Request', 400);
            }
            unset($actions[$request->id]);
            session()->put('actions',$actions);
            return response()->json('Actions succesfully deleted', 201);
        }
    }
}
