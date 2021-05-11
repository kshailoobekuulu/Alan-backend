<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Product::where('name', 'like', '%' . $request->q . '%');

        if ($request->category) {
            $query = $query->whereHas('categories', function ($q) use ($request) {
                $q->where('category_id', $request->category);
            });
        }

        $products = $query->paginate(10);
        return view('admin.products.index',['products' => $products, 'quantity' => $products->total()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'price' => ['required', 'regex:/^[1-9][0-9]*/'],
            'photo' => 'image|required',
        ]);
        $product = new Product();
        if ($request->active) {
            $product->active = true;
        }else {
            $product->active = false;
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $image = Image::make($request->photo);
        $name = time() . '.' . $request->file('photo')->getClientOriginalExtension();
        $path = public_path(Product::IMAGES_PATH);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $image->save($path . $name);
        $product->photo = Product::IMAGES_PATH . $name;
        $product->save();
        $product->categories()->attach($request->categories);
        return redirect(route('products.index')) -> with('success', 'Продукт добавлен успешно');

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit', [
            'product' => $product,
        ]);
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
        $request->validate([
            'name' => 'required|max:100',
            'price' => ['required', 'regex:/^[1-9][0-9]*/'],
            'photo' => 'image',

        ]);
        $image = null;
        if ($request->hasfile('photo')) {
            $image = Image::make($request->photo);
            $name = time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $path = public_path(Product::IMAGES_PATH);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $image->save($path . $name);
        }
        $product = Product::find($id);
        $product->update(\request()->only('name','price'));
        if ($request->active) {
            $product->active = true;
        }else {
            $product->active = false;
        }
        if ($image) {
            $product->photo = Product::IMAGES_PATH . $name;
        }
        $product->save();
        $product->categories()->detach($request->categories);
        $product->categories()->attach($request->categories);
        return redirect(route('products.index')) -> with('success', 'Продукт изменен успешно');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        try {
            $product->delete();
        } catch(QueryException $e){
            return back()->withErrors('Невозможно удалить продукт. Возможно этот продукт есть в заказах');
        }
        return redirect(route('products.index')) -> with('success', 'Продукт успешно удалена');
    }
}
