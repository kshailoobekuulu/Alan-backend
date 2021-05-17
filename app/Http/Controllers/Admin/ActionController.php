<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Action;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actions = Action::all();
        return view('admin.actions.index', [
            'actions' => $actions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.actions.create');
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
            'price' => ['required', 'regex:/^[1-9][0-9]*/'],
            'title' => 'required|max:100',
            'photo' => 'image|required',
        ]);
        $action = new Action();
        $action->price = $request->price;
        $action->title = $request->title;
        $image = Image::make($request->photo);
        $name = time() . '.' . $request->file('photo')->getClientOriginalExtension();
        $path = public_path(Action::IMAGES_PATH);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $image->save($path . $name);
        $action->photo = Action::IMAGES_PATH . $name;
        $action->save();
        foreach ($request->product as $item) {
            try {
                $action->products()->attach([$item['product'] => ['quantity' => $item['quantity']]]);
            } catch(QueryException $e){
                continue;
            }
        }
        return $this->index();
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
        $action = Action::findOrFail($id);
        return view('admin.actions.edit', compact('action'));
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
            'price' => ['required', 'regex:/^[1-9][0-9]*/'],
            'title' => 'required|max:100',
            'photo' => 'image',

        ]);
        $image = null;
        if ($request->hasfile('photo')) {
            $image = Image::make($request->photo);
            $name = time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $path = public_path(Action::IMAGES_PATH);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $image->save($path . $name);
        }
        $action = Action::find($id);
        $action->update(\request()->only('price','title'));
        if ($image) {
            $action->photo = Action::IMAGES_PATH . $name;
        }
        $action->save();
        $action->products()->detach($action->products);
        foreach ($request->product as $item) {
            try {
                $action->products()->attach([$item['product'] => ['quantity' => $item['quantity']]]);
            } catch(QueryException $e){
                continue;
            }
        }

        return redirect(route('actions.index')) -> with('success', 'Акция изменена успешно');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $action = Action::find($id);
        try {
            $action->delete();
        } catch(QueryException $e){
            return back()->withErrors('Невозможно удалить акцию.');
        }
        return redirect(route('actions.index')) -> with('success', 'Акция успешно удалена');
    }
}
