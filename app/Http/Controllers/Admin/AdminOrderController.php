<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách đơn hàng';
        $listOrder = Order::query()->orderByDesc('id')->get();
        $status_order = Order::STATUS_ORDER;
        $status_pay = Order::STATUS_PAY;
        // $status_pay = Order::STATUS_PAY;

        return view('admins.orders.index', compact('title','listOrder','status_order','status_pay'));
    }

    /**
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Thông tin chi tiết đơn hàng';
        $order = Order::query()->findOrFail($id);
        $status_order = Order::STATUS_ORDER;
        $status_pay = Order::STATUS_PAY;
        // $status_pay = Order::STATUS_PAY;

        return view('admins.orders.show', compact('title','order','status_order','status_pay'));
    
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::query()->findOrFail($id);
         $currentStatus = $order->status_order;
         $newStatus = $request->input('status_order');
         $status = array_keys(Order::STATUS_ORDER);
         // Kiểm tra nếu đơn hàng đã bị hủy thì không được thay đổi trạng thái nữa
         if ($currentStatus === Order::DA_HUY) {
            return redirect()->route('admins.orders.index')->with('error', 'Đơn hàng');
         }

         //Kiểm tra nếu trạng thái mới không được sau trạng thái hiện tại
         if (array_search($newStatus, $status) < array_search($currentStatus, $status)) {
            return redirect()->route('admins.orders.index')->with('error', 'Đơn hàng không thể cập nhật ngược lại trạng thái');
        }
        $order->status_order = $newStatus;
        $order->save();
        return redirect()->route('admins.orders.index')->with('seccess', 'Cập nhật trạng thái thành công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Khi người dùng hủy đơn hang thì mới được xóa
    }
}
