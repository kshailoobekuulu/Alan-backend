<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PhotoResource;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/banners",
     *     operationId="bannersAll",
     *     tags={"Banners"},
     *     summary="Display all Banners",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/BannerShowRequest"),
     *             )
     *         )
     *     ),
     *     @OA\Response(response="404",description="Banner not found")
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if(Banner::all()!==null) return response()->json(Banner::all(),200);
        return response()->json('Product not found',404);
    }

    /**
     * @OA\Post(
     * path="/banners",
     * summary="Store banner data",
     * description="Store banner data",
     * operationId="bannerStore",
     * tags={"Banners"},
     * security={
     *    {"api_key": {}},
     * },@OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="The description of Banner",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),@OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="The title of Banner",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),@OA\Parameter(
     *         name="photos",
     *         in="query",
     *         description="The photo of Banner",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass banner credentials",
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
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/banners/{id}",
     *     operationId="bannersGet",
     *     tags={"Banners"},
     *     summary="Get banner by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of banner",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/BannerShowRequest")
     *     ),
     *     @OA\Response(response="404",description="Banner not found")
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
        $banner=Banner::find($id);
        if($banner) return response()->json($banner,200);
        return response()->json('banner not found',404);
    }

    /**
     * @OA\Put(
     *     path="/banners/{id}",
     *     operationId="bannersUpdate",
     *     tags={"Banners"},
     *     summary="Update banner by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of banner",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/BannerShowRequest")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ActionStoreRequest")
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
        $banner=Banner::find($id);
        if($banner){
            if($request->has('description')) $banner->description=$request->description;
            if($request->has('title')) $banner->title=$request->title;
            $banner->save();
            if($request->has('photos')) $banner->photos()->attach($request->input('photos'));
            return response()->json($banner,200);
        }
        return response()->json('Banner not found',404);
    }

    /**
     * @OA\Delete(
     *     path="/banners/{id}",
     *     operationId="bannersDelete",
     *     tags={"Banners"},
     *     summary="Delete banner by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of banner",
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
     *     @OA\Response(response="404",description="Banner not found")
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
        $banner=Banner::find($id);
        if($banner){
            $banner->delete();
            return \response()->json('Deleted',202);
        }
        return \response()->json('Banner not found',404);
    }
    /**
     * @OA\Get(
     *     path="/banners/{id}/photos",
     *     operationId="photosProducts",
     *     tags={"Banners"},
     *     summary="Display all banner photos",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of banner",
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
     *                 @OA\Items(ref="#/components/schemas/PhotoShowRequest"),
     *             )
     *         )
     *     ),
     *     @OA\Response(response="404",description="Photos not found")
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function photos($id)
    {
        $banner=Banner::find($id);
        if($banner){
            if($banner->photos()->exists()) return PhotoResource::collection($banner->photos);
            return response()->json('Photos not found');
        }
        return response()->json('Banner not found',404);
    }
}
