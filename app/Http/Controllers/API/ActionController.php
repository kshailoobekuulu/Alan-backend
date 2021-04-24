<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExampleStoreRequest;
use App\Http\Resources\ActionResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Action;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
//        return \App\Virtual\Resources\ActionResource()->collection(Action::all());
//        return response()->json(Action::all(),200);
        return ActionResource::collection(Action::with(['products'])->get());
//        return new ActionResource(Action::findOrFail(2)->products);

    }

    public function store()
    {
//        return \response()->json(request('products'));
//        $productsArray = [];
//        $action=new Action();
//        $action->fill(request(['price','title']));
//        $action->save();
//        foreach (request('products') as $product){;
//            $action->products()->attach([$product["id"] => ['quantity' => $product["quantity"]]]);
//        }
//        return response()->json('Successfully',200);
//        return $action;
//        foreach ($request->get('products') as $productId){
//            $productsArray[] = Product::findOrFail($productId);
//        }
//        return \response()->json($productsArray);
    }

    public function show($id)
    {
//        return (Action::findOrfail($id)->products);
//        return response()->json(Action::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
//        $item=Action::findOrFail($id);
//        $item->update($request->all());
//        $item->save();
    }

    public function destroy($id)
    {
//        Action::findOrFail($id)->delete();
//        return \response()->json('Deleted',202);
    }
}
