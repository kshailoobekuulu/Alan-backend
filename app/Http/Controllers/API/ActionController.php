<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExampleStoreRequest;
use App\Http\Resources\ActionResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Action;
use http\Env\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/actions",
     *     operationId="actionsAll",
     *     tags={"Actions"},
     *     summary="Display all actions",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="The page number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/ExampleShowRequest"),
     *             )
     *         )
     *     ),
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
//        return ActionResource::collection(Action::get());
        return response()->json(Action::all(),200);
    }
    /**
     * @OA\Get(
     *     path="/actions/{id}/orders",
     *     operationId="actionsOrders",
     *     tags={"Actions"},
     *     summary="Display all action orders",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of action",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/ExampleShowRequest"),
     *             )
     *         )
     *     ),
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function orders($id){
//        return OrderResource::collection(Action::findOrFail($id)->orders);
        return response()->json(Action::findOrFail($id)->orders);
    }
    /**
     * @OA\Get(
     *     path="/actions/{id}/products",
     *     operationId="actionsProducts",
     *     tags={"Actions"},
     *     summary="Display all action products",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of action",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/ExampleShowRequest"),
     *             )
     *         )
     *     ),
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function products($id){
//        return ProductResource::collection(Action::findOrFail($id)->products);
        return response()->json(Action::findOrFail($id)->products);
    }

    /**
     * @OA\Post(
     * path="/actions",
     * summary="Store actions data",
     * description="Store actions data",
     * operationId="actionStore",
     * tags={"Actions"},
     * security={
     *    {"api_key": {}},
     * },
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass action credentials",
     *    @OA\JsonContent(
     *       required={"price","title"},
     *       @OA\Property(property="price", type="integer", example="20"),
     *       @OA\Property(property="title", type="string", example="About actions"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     *
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExampleStoreRequest $request)
    {
        $item=new Action();
        $item->fill($request->all());
        $item->save();
        return response()->json('',200);
    }
//    there i have a few work

    /**
     * @OA\Get(
     *     path="/actions/{id}",
     *     operationId="actionsGet",
     *     tags={"Actions"},
     *     summary="Get action by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of action",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/ExampleShowRequest")
     *     ),
     * )
     *
     * Display a listing of the resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
//        return new ActionResource(Action::findOrfail($id));
        return response()->json(Action::findOrFail($id));
    }

    /**
     * @OA\Put(
     *     path="/actions/{id}",
     *     operationId="actionsUpdate",
     *     tags={"Actions"},
     *     summary="Update action by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of actions",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/ExampleShowRequest")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ExampleStoreRequest")
     *     ),
     * )
     *
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $item=Action::findOrFail($id);
        $item->update($request->all());
        $item->save();
    }

    /**
     * @OA\Delete(
     *     path="/actions/{id}",
     *     operationId="actionsDelete",
     *     tags={"Actions"},
     *     summary="Delete action by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of action",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="202",
     *         description="Deleted",
     *     ),
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        Action::findOrFail($id)->delete();
//        return response(null, HttpResponse::HTTP_ACCEPTED);
    }
}
