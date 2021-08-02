<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;



class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a = Order::all();
        foreach ($a as $key => $value) {
            $order_id = $value->order_id;
        }
        $order = DB::table('tpl_order')
            ->select(
                'tpl_order.order_id',
                'tpl_order.updated_at',
                'tpl_order.status',
                'users.username',
                'tpl_order.note'
            )
            ->join('users', 'users.id', '=', 'tpl_order.user_id')
            ->get();
        $order_detail = DB::table('tpl_order_dt')
            ->join('tpl_order', 'tpl_order.order_id', '=', 'tpl_order_dt.order_id')
            ->join('tpl_product', 'tpl_product.product_id', '=', 'tpl_order_dt.product_id')
            ->select(
                'tpl_product.product_img',
                'tpl_product.product_name',
                'tpl_order.*',
                'tpl_order_dt.*'
            )
            ->get();
        return view('pages.server.order.list')
            ->with('order', $order)
            ->with('order_detail', $order_detail);
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
        $order_detail = DB::table('tpl_order')
            ->select(
                'tpl_order.order_id',
                'tpl_order.created_at',
                'tpl_order.updated_at',
                'tpl_order.status',
                'tpl_order.note',
                'users.id',
                'users.lastName',
                'users.firstName',
                'users.username',
                'users.phone',
                'users.address',
                'users.email',
            )
            ->join('users', 'users.id', '=', 'tpl_order.user_id')
            ->where('tpl_order.order_id', $id)->first();

        $order = DB::table('tpl_order')
            ->join('tpl_order_dt', 'tpl_order.order_id', '=', 'tpl_order_dt.order_id')
            ->join('tpl_product', 'tpl_order_dt.product_id', '=', 'tpl_product.product_id')
            ->where('tpl_order.order_id', $id)->get();


        return view('pages.server.order.show')
            ->with('order_detail', $order_detail)
            ->with('order', $order);
    }

    public function update_status_0($id)
    {

        $order = Order::find($id);
        $order->status = 0;
        $order->save();
        Session::put('info', 'Đơn Hàng Đang Được Vận Chuyển');
        return redirect()->route('HoaDon.index');
    }
    public function update_status_1($id)
    {

        $order = Order::find($id);
        $order->status = 1;
        $order->save();
        Session::put('seccondary', 'Đơn Hàng Đang Chờ Xử Lý');
        return redirect()->route('HoaDon.index');
    }

    public function update_status_2($id)
    {

        $order = Order::find($id);
        $order->status = 2;
        $order->save();
        Session::put('success', 'Đơn Hàng Được Giao Thành Công');
        return redirect()->route('HoaDon.index');
    }

    public function update_status_3($id)
    {

        $order = Order::find($id);
        $order->status = 3;
        $order->save();
        Session::put('error', 'Đơn Hàng Bị Hủy Đơn');
        return redirect()->route('HoaDon.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
