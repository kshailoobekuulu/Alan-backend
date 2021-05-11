<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banners.index', [
            'banners' => $banners,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
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
            'description' => 'required|max:255',
            'title' => 'required|max:100',
            'photo' => 'image|required',
        ]);
        $banner = new Banner();

        $image = Image::make($request->photo);
        $name = time() . '.' . $request->file('photo')->getClientOriginalExtension();
        $path = public_path(Banner::IMAGES_PATH);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $image->save($path . $name);
        $banner->photo = Banner::IMAGES_PATH . $name;

        $banner->description = $request->description;
        $banner->title = $request->title;
        $banner->save();
        return redirect(route('banners.index')) -> with('success', 'Баннер добавлена успешно');
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
        $banner = Banner::find($id);
        return view('admin.banners.edit', [
           'banner' => $banner,
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
            'description' => 'required|max:255',
            'title' => 'required|max:100',
            'photo' => 'image',
        ]);
        $banner = Banner::find($id);

        $image = null;
        if ($request->hasfile('photo')) {
            $image = Image::make($request->photo);
            $name = time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $path = public_path(Banner::IMAGES_PATH);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $image->save($path . $name);
        }
        if ($image) {
            $banner->photo = Banner::IMAGES_PATH . $name;
        }

        $banner->update($request->only(['description','title']));
        $banner->save();

        return redirect(route('banners.index')) -> with('success', 'Баннер изменен успешно');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        try {
            $banner->delete();
        } catch(QueryException $e){
            return back()->withErrors('Невозможно удалить баннер.');
        }
        return redirect(route('banners.index')) -> with('success', 'Баннер успешно удален');
    }
}
