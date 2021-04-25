<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
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
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/BannerResource")
     *       ),
     *     @OA\Response(response="404",description="Fot Found")
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $banners=Banner::all();
        if($banners!==null) return BannerResource::collection($banners);
        return response()->json('Banners not found',404);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
//        $banner=Banner::find($id);
//        if($banner) return response()->json($banner,200);
//        return response()->json('banner not found',404);
    }

    public function update(Request $request, $id)
    {
//        $banner=Banner::find($id);
//        if($banner){
//            if($request->has('description')) $banner->description=$request->description;
//            if($request->has('title')) $banner->title=$request->title;
//            $banner->save();
//            if($request->has('photos')) $banner->photos()->attach($request->input('photos'));
//            return response()->json($banner,200);
//        }
//        return response()->json('Banner not found',404);
    }

    public function destroy($id)
    {
//        $banner=Banner::find($id);
//        if($banner){
//            $banner->delete();
//            return \response()->json('Deleted',202);
//        }
//        return \response()->json('Banner not found',404);
    }
}
