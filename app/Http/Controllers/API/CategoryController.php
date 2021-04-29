<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Action;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *      path="/categories",
     *      operationId="getCategoriesList",
     *      tags={"Categories"},
     *      summary="Get list of categories",
     *      description="Returns list of categories",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CategoryResource")
     *       ),
     *     @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      ),
     *     )
     */
    public function index()
    {
        if(Category::all()!==null) return CategoryResource::collection(Category::all());
        return response()->json('Category not found',404);
    }

    public function store()
    {
//        $category=new Category();
//        $category->fill(\request(['name','slug','photo','category_icon']));
//        $category->save();                                                   //жасай тургандар бар
//        return response()->json($category,200);
    }

    /**
     * @OA\Get(
     *     path="/categories/{slug}",
     *     operationId="categoriesProducts",
     *     tags={"Categories"},
     *     summary="Get categories products by SLUG",
     *
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="The SLUG of category",
     *         required=true,
     *         example="Category_slug_1",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *     ),
     *     @OA\Response(response="404",description="Not Found")
     * )
     *
     * Display a listing of the resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug)
    {
        $category=Category::where('slug',$slug)->first();
//        $category=Category::find($slug);
        if($category){
            if($category->products()->exists()) return ProductResource::collection($category->products);
            return response()->json('Products not found',404);
        }
        return response()->json('Category not found',404);
    }

    public function update(Request $request, $id)
    {
//        $category=Category::find($id);
//        if($category){
//            if($request->has('name')) $category->name=$request->name;
//            if ($request->has('slug')) $category->slug=$request->slug;
//            if($request->has('category_item'))  $category->category_item=$request->category_item;
//            if($request->has('photo'))  $category->photo=$request->photo;
//            $category->save();
//            if($request->has('products'))
//                $category->products()->attach($request->input('products'));
//            return response()->json($category,200);
//        }
//        return response()->json('Category not found',404);
    }

    public function destroy($id)
    {
//        if(Category::find($id)){
//            Category::findOrFail($id)->delete();
//            return \response()->json('Deleted',202);
//        }
//        return response()->json('Category not found',404);
    }

    public function products($id){
//        $category=Category::find($id);
//        if($category){
//            if($category->products()->exists()) return response()->json(ProductResource::collection($category->products),200);
//            return response()->json('Product not found',404);
//        }
//        return response()->json('Category not found',404);
    }
}
