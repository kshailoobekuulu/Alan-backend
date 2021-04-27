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
        $products=Order::has('products')->get();
        $actions=Order::has('actions')->get();
        return ['products'=>$products,'actions'=>$actions];
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
     *          @OA\JsonContent(ref="#/components/schemas/Order")
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
        $datas=$request->json()->all();
        $products=[];
        $actions=[];
        foreach ($datas as $data) {
            if($data['type']==='product') {
                $products[]=$data;
            }
            $actions[]=$data;
        }
        return ['products'=>$products,'actions'=>$actions];
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

