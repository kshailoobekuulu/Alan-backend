<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Action;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/categories",
     *     operationId="categoriessAll",
     *     tags={"Categories"},
     *     summary="Display all Categories",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(ref="#/components/schemas/CategoryShowRequest")
     *     ),
     *     @OA\Response(response="404",description="Category not found")
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if(Category::all()!==null) return response()->json(Category::all(),200);
        return response()->json('Category not found',200);
    }

    /**
     * @OA\Post(
     * path="/categories",
     * summary="Store category data",
     * description="Store category data",
     * operationId="categoryStore",
     * tags={"Categories"},
     * security={
     *    {"api_key": {}},
     * },@OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="The name of Category",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),@OA\Parameter(
     *         name="slug",
     *         in="query",
     *         description="The slug of Category",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),@OA\Parameter(
     *         name="photo",
     *         in="query",
     *         description="The photo of category",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),@OA\Parameter(
     *         name="icon",
     *         in="query",
     *         description="The icon of category",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
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
     *       @OA\Property(property="message", type="string", example="Fill all required fields")
     *        )
     *     ),
     *  @OA\Response(response="201",description="Created")
     * )
     *
     *
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $category=new Category();
        $category->fill(\request(['name','slug','photo','category_icon']));
        $category->save();                                                   //жасай тургандар бар
        return response()->json($category,200);
    }

    /**
     * @OA\Get(
     *     path="/categories/{id}",
     *     operationId="categoriesGet",
     *     tags={"Categories"},
     *     summary="Get category by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of category",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/CategoryShowRequest")
     *     ),
     *     @OA\Response(response="404",description="Category not found")
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
        $category=Category::find($id);
        if($category) return response()->json($category,200);
        return response()->json('Category not found',404);
    }

    /**
     * @OA\Put(
     *     path="/categories/{id}",
     *     operationId="categoriesUpdate",
     *     tags={"Categories"},
     *     summary="Update category by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of category",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/CategoryShowRequest")
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
        $category=Category::find($id);
        if($category){
            if($request->has('name')) $category->name=$request->name;
            if ($request->has('slug')) $category->slug=$request->slug;
            if($request->has('category_item'))  $category->category_item=$request->category_item;
            if($request->has('photo'))  $category->photo=$request->photo;
            $category->save();
            if($request->has('products'))
                $category->products()->attach($request->input('products'));
            return response()->json($category,200);
        }
        return response()->json('Category not found',404);
    }

    /**
     * @OA\Delete(
     *     path="/categories/{id}",
     *     operationId="categoriesDelete",
     *     tags={"Categories"},
     *     summary="Delete category by ID",
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
     *     @OA\Response(response="404",description="Category not found")
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
        if(Category::find($id)){
            Category::findOrFail($id)->delete();
            return \response()->json('Deleted',202);
        }
        return response()->json('Category not found',404);
    }
    /**
     * @OA\Get(
     *     path="/categories/{id}/products",
     *     operationId="categoriesProducts",
     *     tags={"Categories"},
     *     summary="Display all category products",
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
     *                 @OA\Items(ref="#/components/schemas/ProductShowRequest"),
     *             )
     *         )
     *     ),
     *     @OA\Response(response="404",description="Product not found")
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function products($id){
        $category=Category::find($id);
        if($category){
            if($category->products()->exists()) return response()->json(ProductResource::collection($category->products),200);
            return response()->json('Product not found',404);
        }
        return response()->json('Category not found',404);
    }
}
