<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActionResource;
use App\Models\Action;

class ActionController extends Controller
{
    /**
     * @OA\Get(
     *      path="/actions",
     *      operationId="getActionsList",
     *      tags={"Actions"},
     *      summary="Get list of actions",
     *      description="Returns list of actions",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ActionResource")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      ),
     *     )
     */
    public function index()
    {
        $actionsProducts = Action::with(['products'])->get();
        if ($actionsProducts !== null) return ActionResource::collection($actionsProducts);
        return response()->json('Actions not found',404);
    }
}
