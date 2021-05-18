<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use http\Env\Url;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('products')->orderBy('created_at','desc')->get();
        return view('admin.categories.index',['categories' => $categories]);
//        return response()->json($categories,200,[],JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'slug' => 'required|regex:/^[a-zA-Z][a-zA-Z\-\_]*[a-zA-Z]$/|max:100|unique:categories,slug',
            'photo' => 'image|required',
            'category_icon' => 'image|required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;

        $image = Image::make($request->photo);
        $name = time() . '.' . $request->file('photo')->getClientOriginalExtension();
        $path = public_path(Category::IMAGES_PATH);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $image->save($path . $name);
        $category->photo = Category::IMAGES_PATH . $name;

        $image = Image::make($request->category_icon);
        $name = time() . '.' . $request->file('category_icon')->getClientOriginalExtension();
        $path = public_path(Category::IMAGES_PATH);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $image->save($path . $name);
        $category->category_icon = Category::IMAGES_PATH . $name;
        $category->save();
        $category->products()->attach($request->products);
        return redirect(route('categories.index')) -> with('success', 'Категория добавлена успешно');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = Category::where('slug',$slug)->first();
        return view('admin.categories.edit',['category' => $category]);
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
            'slug' => 'required|regex:/^[a-zA-Z][a-zA-Z\-\_]*[a-zA-Z]$/|max:100|unique:categories,slug'.','.$id,
            'photo' => 'image',
            'category_icon' => 'image',
        ]);
        $category = Category::find($id);
        $image = null;
        if ($request->hasfile('photo')) {
            $image = Image::make($request->photo);
            $name = time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $path = public_path(Category::IMAGES_PATH);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $image->save($path . $name);
        }
        if ($image) {
            $category->photo = Category::IMAGES_PATH . $name;
        }
        $image = null;
        if ($request->hasfile('category_icon')) {
            $image = Image::make($request->category_icon);
            $name = time() . '.' . $request->file('category_icon')->getClientOriginalExtension();
            $path = public_path(Category::IMAGES_PATH);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $image->save($path . $name);
        }
        if ($image) {
            $category->category_icon = Category::IMAGES_PATH . $name;
        }
        $category->update($request->only(['name','slug']));
        $category->save();
        $category->products()->detach($category->products);
        $category->products()->attach($request->products);

        return redirect(route('categories.index')) -> with('success', 'Категория изменен успешно');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        try {
            $category->delete();
        } catch(QueryException $e){
            return back()->withErrors('Невозможно удалить категорию. Возможно эта категория содержит продукты.');
        }
        return redirect(route('categories.index')) -> with('success', 'Категрия успешно удалена');
    }
}
