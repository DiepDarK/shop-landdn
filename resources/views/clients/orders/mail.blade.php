@component('mail::message')
    # Xác nhận đơn hàng

    Xin chào {{ $order->name_P}},

    Cảm ơn bạn đã đặt hàng từ LANDDN. Đây là thông tin đơn hàng của bạn.

    -Mã đơn hàng: {{ $order->order_code}}

    -Sản phẩm đã đặt
    @foreach ($order->orderDetail as $item)
        + {{ $item->product->name}} x {{ $item->quantity}}: {{ number_format($item->into_money)}} VNĐ
    @endforeach

    -Tổng số tiền: {{ number_format($order->total_payment)}} VNĐ

    Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận thông tin giao hàng.

    Cảm ơn bạn đã tin tưởng mua sắm tại LANDDN!

    Trân trọng.
@endcomponent