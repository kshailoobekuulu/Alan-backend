<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use http\Env\Response;
use Illuminate\Http\Request;

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
        $orders=Order::all();
        return OrderResource::collection($orders);
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
        $products = $request->products;
        $actions = $request->actions;
        $total_price = 0;
        foreach ($products as $product) {
            $total_price += ($product['price'])*($product['quantity']);
        }
        foreach ($actions as $action) {
            $total_price += ($action['price'])*($action['quantity']);
        }
        $order = new Order();
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->total_price=$total_price;
        $order->status = 'in_progress';
        $order->save();
        foreach ($products as $product) {
            $order->products()->attach([$product["id"] => ['quantity' => $product["quantity"]]]);
        }
        foreach ($actions as $action) {
            $order->actions()->attach([$action["id"] => ['quantity' => $action["quantity"]]]);
        }
//        return [$order,'products'=>$products,'actions'=>$actions];
        return \response()->json('Successful operation',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
//[{
//    "id": 1,
//  "quantity": 3,
//  "type": "action"
//},{
//    "id": 2,
//  "quantity": 3,
//  "type": "action"
//},{
//    "id": 3,
//  "quantity": 3,
//  "type": "action"
//},{
//    "id": 1,
//  "quantity": 3,
//  "type": "product"
//},{
//    "id": 1,
//  "quantity": 3,
//  "type": "product"
//}]

