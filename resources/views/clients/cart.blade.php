@extends('layouts.user')
@section('css')
@endsection
@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <!-- Kenne's Breadcrumb Area End Here -->
    <!-- Begin Uren's Cart Area -->
    <div class="kenne-cart-area">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('cart.update') }}" method="POST">
                        @csrf
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="kenne-product-remove">Remove</th>
                                        <th class="kenne-product-thumbnail">Images</th>
                                        <th class="cart-product-name">Product</th>
                                        <th class="kenne-product-price">Unit Price</th>
                                        <th class="kenne-product-quantity">Quantity</th>
                                        <th class="kenne-product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $key => $item)
                                        <tr>
                                            <td class="kenne-product-remove"><a href=""><i class="fa fa-trash"
                                                        title="Remove"></i></a></td>
                                            <td class="kenne-product-thumbnail"><a href="{{ route('detail', $key) }}"><img
                                                        src="{{ Storage::url($item['image']) }}" style="max-width: 150px"
                                                        alt="Uren's Cart Thumbnail">
                                                    <input type="hidden" name="cart[{{ $key }}][image]"
                                                        value="{{ $item['image'] }}">
                                                </a></td>
                                            <td class="kenne-product-name"><a
                                                    href="{{ route('detail', $key) }}">{{ $item['name'] }}</a>
                                                <input type="hidden" name="cart[{{ $key }}][name]"
                                                    value="{{ $item['name'] }}">
                                            </td>
                                            <td class="kenne-product-price"><span
                                                    class="amount">{{ number_format($item['price'], 0, '', '.') }}đ</span>
                                                <input type="hidden" name="cart[{{ $key }}][price]"
                                                    value="{{ $item['price'] }}">
                                            </td>
                                            <td class="quantity">
                                                <label>Quantity</label>
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box quantityInput"
                                                        data-price="{{ $item['price'] }}" value="{{ $item['quantity'] }}"
                                                        type="text" name="cart[{{ $key }}][quantity]">
                                                    <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                </div>
                                            </td>
                                            <td class="product-subtotal"><span
                                                    class="subtotal">{{ number_format($item['price'] * $item['quantity'], 0, '', '.') }}đ</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="coupon-all">
                                    <div class="coupon">
                                        <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                            placeholder="Coupon code" type="text">
                                        <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                    </div>
                                    <div class="coupon2">
                                        <input class="button" name="update_cart" value="Update cart" type="submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Cart totals</h2>
                                    <ul>
                                        <li>Subtotal <span
                                                class="sub-total">{{ number_format($subtotal, 0, '', '.') }}đ</span>
                                        </li>
                                        <li>Shipping <span
                                                class="shipping">{{ number_format($shipping, 0, '', '.') }}đ</span>
                                        </li>
                                        <li>Total <span class="total">{{ number_format($total, 0, '', '.') }}đ</span></li>
                                    </ul>
                                    <a href="{{ route('orders.create') }}">Proceed to checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Uren's Cart Area End Here -->
@endsection
@section('js')
    <script>
        $('.cart-plus-minus').append(
            '<div class="dec qtybutton"><i class="fa fa-angle-down"></i></div><div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>'
        );

        //Hàm update giờ hàng
        function updateTotal() {
            var subtotal = 0;
            //tính tiền của các sản phẩm có trong giỏ hàng
            $('.quantityInput').each(function() {
                var $input = $(this);
                var price = parseFloat($input.data('price'));
                var quantity = parseFloat($input.val());
                subtotal += price * quantity;
            })

            // Lấy số tiền vận chuyển
            var shipping = parseFloat($('.shipping').text().replace(/\./g, '').replace('đ', ''));
            var total = subtotal + shipping;


            //Cập nhật giá trị
            $('.sub-total').text(subtotal.toLocaleString('vi-VN') + 'đ');
            $('.total').text(total.toLocaleString('vi-VN') + 'đ');
        }

        $('.qtybutton').on('click', function() {
            var $button = $(this);
            var $input = $button.parent().find('input');
            var oldValue = parseFloat($input.val());
            if ($button.hasClass('inc')) {
                var newVal = oldValue + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 1) {
                    var newVal = oldValue - 1;
                } else {
                    newVal = 1;
                }
            }
            $input.val(newVal);

            //Cập nhật lại giá trị của Tổng giá của từng sản phẩm
            var price = parseFloat($input.data('price'));
            var subtotalElement = $input.closest('tr').find('.subtotal');
            var newSubtotal = newVal * price;
            subtotalElement.text(newSubtotal.toLocaleString('vi-VN') + 'đ');

            updateTotal();
        });

        // Xử lí nếu ng dùng nhập số âm
        $('.quantityInput').on('change', function() {
            var value = parseInt($(this).val(), 10);
            if (isNaN(value) || value < 1) {
                alert('Số lượng phải lớn hơn bằng 1');
                $(this).val(1);
            }
            updateTotal();
        })

        //Xử lí xóa sản phẩm trong giỏ hàng\
        $('.kenne-product-remove').on('click', function() {
            event.preventDefault();
            var $row = $(this).closest('tr');
            $row.remove();
            updateTotal();
        })
        updateTotal();
    </script>
@endsection
