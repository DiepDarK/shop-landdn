<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderConfirm;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Auth::user()->order;
        $status_order = Order::STATUS_ORDER;

        $type_cho_xac_nhan = Order::CHO_XAC_NHAN;
        $type_dang_van_chuyen = Order::DANG_VAN_CHUYEN;

        return view('clients.my-account', compact('orders', 'status_order', 'type_cho_xac_nhan', 'type_dang_van_chuyen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cart = session()->get('cart', []);
        if (!empty($cart)) {
            $total = 0;
            $subTotal = 0;

            foreach ($cart as $item) {
                $subTotal += $item['price'] * $item['quantity'];
            }
            $shipping = 30000;
            $total = $subTotal + $shipping;
            return view('clients.orders.create', compact('cart', 'subTotal', 'total', 'shipping'));
        }
        return redirect()->route('cart.list');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        // dd($request->all());
        // dd(session('cart'));
        if ($request->isMethod('POST')) {
            DB::beginTransaction();
            try {

                $params = $request->except('_token');
                $params['order_code'] =  $this->generateUniqueOrderCode();
                $order = Order::query()->create($params);
                $orderId = $order->id;
                $carts = session()->get('cart', []);
                foreach ($carts as $key => $item) {
                    $product = Product::query()->findOrFail($key);
                    if ($product->quantity < $item['quantity']) {
                        DB::rollBack();
                        return redirect()->route('cart.list')->with('error', 'Có sản phẩm vượt quá số lượng');
                    }

                    $into_money = $item['price'] * $item['quantity'];
                    $order->orderDetail()->create([
                        'order_id' => $orderId,
                        'product_id' => $key,
                        'unit_price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'into_money' => $into_money
                    ]);
                    $product->quantity -= $item['quantity'];
                    $product->save();
                }
                DB::commit();

                // Trừ đi số lượng sản phẩm


                //Gửi mail khi đặt hàng thành công
                Mail::to($order->email_P)->queue(new OrderConfirm($order));


                session()->put('cart', []);
                return redirect()->route('orders.index')->with('success', 'Đặt hàng thành công !');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('cart.list')->with('error', 'Có lỗi khi tạo đơn hàng. Vui lòng xem lại thông tin thanh toán !');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::query()->findOrFail($id);
        $status_order = Order::STATUS_ORDER;
        $status_pay = Order::STATUS_PAY;

        return view('clients.orders.show', compact('order', 'status_order', 'status_pay'));
    }

    /**
     * Show the form for editing the specified resource.
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::query()->findOrFail($id);
        $orderDetail = OrderDetail::query()->findOrFail($id);
        $product = Product::query()->findOrFail($id);

        try {
            DB::beginTransaction();
            if ($request->has('huy_don_hang')) {
                $order->update(['status_order' => Order::DA_HUY]);

                $orderDetails = OrderDetail::query()->where('order_id', $id)->get();

                foreach ($orderDetails as $orderDetail) {
                    $product = Product::query()->findOrFail($orderDetail->product_id);
                    $product->quantity += $orderDetail->quantity;
                    $product->save();
                }
            } elseif ($request->has('da_nhan_hang')) {
                $order->update(['status_order' => Order::DA_GIAO_HANG]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function generateUniqueOrderCode()
    {
        do {
            $orderCode = 'ORD-' . Auth::id() . '-' . now()->timestamp;
        } while (Order::where('order_code', $orderCode)->exists());
        return $orderCode;
    }
}
