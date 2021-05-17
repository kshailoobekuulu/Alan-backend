<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $query = Order::where(function ($q) use($request){
            $q->where('phone', 'LIKE', '%' . $request->q . '%')
                ->orWhere('address', 'LIKE', '%' . $request->q . '%')
                ->orWhere('additional_information', 'LIKE', '%' . $request->q . '%');
        })->orderBy('created_at', 'desc');
        if ($request->status) {
            $query = $query->where('status', $request->status);
        }
        if ($request->date) {
            $dayAfter = (new \DateTime($request->date))->modify('+1 day')->format('Y-m-d');
            $query->where('created_at', '<', $dayAfter)->where('created_at', '>=', $request->date);
        } else {
            $today = Carbon::now()->format('Y-m-d');
            $dayAfter = (new \DateTime($today))->modify('+1 day')->format('Y-m-d');
            $query->where('created_at', '<', $dayAfter)->where('created_at', '>=', $today);
        }
        $orders = $query->paginate(10);
        return view('admin.orders.index' , ['orders' => $orders, 'quantity' => $orders->total()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('admin.orders.show', [
            'order' => $order,
            'products' =>$order->products,
            'actions' =>$order->actions,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        return dd($request);
        try {
            $order = Order::find($id);
        } catch(QueryException $e){
            return back()->withErrors('Невозможно найти заказ.');
        }
        $order->update($request->only('additional_information', 'status', 'address'));


        $order->products()->detach($order->products);
        $order->actions()->detach($order->actions);
        foreach ($request->products as $product) {
            $order->products()->attach([$product->id => ['quantity' => $product->quantity]]);
        }
        foreach ($request->actions as $action) {
            $order->actions()->attach([$action->id => ['quantity' => $action->quantity]]);
        }

//        $order->update($request->only('additional_information', 'status', 'address'));
//        $order->additional_information = $request->input('additional_information');
//        $order->status = $request->input('status');
//        $order->address = $request->input('address');
//        $total_price = 0;
//        foreach($products as $product){
//            $product->pivot->quantity = $request->quantity[$product->id];
//            $product->pivot->save();
//            $total_price += $product->pivot->quantity * $product->price;
//        }
//        $order->total_price = $total_price;
        $order->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
