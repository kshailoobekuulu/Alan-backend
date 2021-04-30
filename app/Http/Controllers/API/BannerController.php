<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Models\Banner;

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
        $banners = Banner::all();
        if ($banners !== null) return BannerResource::collection($banners);
        return response()->json('Banners not found',404);
    }

}
