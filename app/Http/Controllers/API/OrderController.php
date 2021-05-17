<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Action;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * @OA\Get(
     *      path="/orders",
     *      operationId="getOrdersList",
     *      tags={"Orders"},
     *      summary="Get list of orders",
     *      description="Returns list of orders",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/OrderResource")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      ),
     *     )
     */
    public function index()
    {
        $orders = session()->get('zakaz', []);
        $ordersDB = Order::find($orders);
        return OrderResource::collection($ordersDB);
    }

    /**
     * @OA\Post(
     *      path="/orders",
     *      operationId="store orders",
     *      tags={"Orders"},
     *      summary="Store orders",
     *      description="Store ordered product",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreOrderRequest")
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
    public function store(Request $request)
    {
        try {
            $request->validate([
                'address' => 'required',
                'phone' => 'required'
            ]);
        } catch (ValidationException $e){
            return response()->json('Bad request', 400);
        }
        $productsId = [];
        $actionsId = [];
        $total_price = 0;
        if ($request['products']) {
            foreach ($request['products'] as $product) {
                $productsId[] = $product['id'];
            }
        }
        if ($request['actions']) {
            foreach ($request['actions'] as $action) {
                $actionsId[] = $action['id'];
            }
        }
        $productsDB = Product::find($productsId);
        $actionsDB = Action::find($actionsId);
        if ($request['actions']) {
            foreach ($actionsDB as $actionDB) {
                foreach ($request['actions'] as $action) {
                    if ($action['id'] === $actionDB->id) {
                        $total_price += ($actionDB->price) * ($action['quantity']);
                    }
                }
            }
        }
        if ($request['products']) {
            foreach ($productsDB as $productDB) {
                foreach ($request['products'] as $product) {
                    if($product['id'] === $productDB->id) {
                        $total_price += ($productDB->price) * ($product['quantity']);
                    }
                }
            }
        }
        $order = new Order();
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->total_price = $total_price;
        $order->status = 'in_progress';
        $order->save();
        if ($request['actions']) {
            foreach ($actionsDB as $actionDB) {
                foreach ($request['actions'] as $action) {
                    if($action['id'] === $actionDB->id) {
                        $order->actions()->attach([$actionDB->id => ['quantity' => $action['quantity']]]);
                    }
                }
            }
        }
        if ($request['products']) {
            foreach ($productsDB as $productDB) {
                foreach ($request['products'] as $product) {
                    if($product['id'] === $productDB->id) {
                        $order->products()->attach([$productDB->id => ['quantity' => $product['quantity']]]);
                    }
                }
            }
        }
        $SessionOrder = session()->get('zakaz', []);
        while (count($SessionOrder) >= 5) {
            array_shift($SessionOrder);
        }
        $SessionOrder[] = $order->id;
        session()->put('zakaz',$SessionOrder);
        return response()->json('Successful operation',200);
    }
}
