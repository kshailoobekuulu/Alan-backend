<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Order;
use App\Models\Product;
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
        $query = Order::where(function ($q) use ($request) {
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
        return view('admin.orders.index', ['orders' => $orders, 'quantity' => $orders->total()]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('admin.orders.show', [
            'order' => $order,
            'products' => $order->products,
            'actions' => $order->actions,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $total_price = 0;
        try {
            $order = Order::find($id);
        } catch (QueryException $e) {
            return back()->withErrors('Невозможно найти заказ.');
        }
        $productsId = [];
        $actionsId = [];
        $total_price = 0;
        if ($request['products']) {
            foreach ($request['products'] as $product) {
                $productsId[] = $product['id'];
            }
        }
        if ($request['actions']) {
            foreach ($request['actions'] as $action) {
                $actionsId[] = $action['id'];
            }
        }
        $productsDB = Product::find($productsId);
        $actionsDB = Action::find($actionsId);
        if ($request['actions']) {
            foreach ($actionsDB as $actionDB) {
                foreach ($request['actions'] as $action) {
                    if ($action['id'] == $actionDB->id) {
                        $total_price += ($actionDB->price) * ($action['quantity']);
                    }
                }
            }
        }
        if ($request['products']) {
            foreach ($productsDB as $productDB) {
                foreach ($request['products'] as $product) {
                    if ($product['id'] == $productDB->id) {
                        $total_price += ($productDB->price) * ($product['quantity']);
                    }
                }
            }
        }

        $order->update($request->only('additional_information', 'status', 'address'));
        $order->total_price = $total_price;
        $order->save();

        $order->products()->detach($order->products);
        $order->actions()->detach($order->actions);
        if ($request->products) {
            foreach ($request->products as $product) {
                $order->products()->attach([$product['id'] => ['quantity' => $product['quantity']]]);
            }
        }
        if ($request->actions) {
            foreach ($request->actions as $action) {
                $order->actions()->attach([$action['id'] => ['quantity' => $action['quantity']]]);
            }
        }
        return redirect(route('orders.index'))->with('success', 'Заказ изменен успешно');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        try {
            $order->delete();
        } catch (QueryException $e) {
            return back()->withErrors('Невозможно удалить заказ.');
        }
        return redirect(route('orders.index'))->with('success', 'Заказ успешно удален');
    }
}
