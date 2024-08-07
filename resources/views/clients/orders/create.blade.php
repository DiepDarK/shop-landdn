@extends('layouts.user')
@section('css')
@endsection
@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <!-- Kenne's Breadcrumb Area End Here -->
    <!-- Begin Kenne's Checkout Area -->
    <div class="checkout-area">
        <div class="container">
            <form action="{{ route('orders.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="checkbox-form">
                            <h3>Chi tiết thanh toán</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Họ tên người nhận <span class="required text-danger">*</span></label>
                                        <input placeholder="Nhập tên người nhận" name="name_P" type="text"
                                            value="{{ Auth::user()->name }}">
                                        @error('name_P')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Email <span class="required text-danger">*</span></label>
                                        <input placeholder="Nhập email người nhận" name="email_P" type="text"
                                            value="{{ Auth::user()->email }}">
                                        @error('email_P')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Số điện thoại người nhận <span class="required text-danger">*</span></label>
                                        <input placeholder="Nhập số điện thoại người nhận" name="phone_P" type="text"
                                            value="{{ Auth::user()->phone }}">
                                        @error('phone_P')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Địa chỉ người nhận <span class="required">*</span></label>
                                        <input placeholder="Địa chỉ người nhận" name="address_P" type="text"
                                            value="{{ Auth::user()->address }}">
                                        @error('addresss_P')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="different-address">
                                <div class="order-notes">
                                    <div class="checkout-form-list checkout-form-list-2">
                                        <label>Ghi chú đặt hàng</label>
                                        <textarea id="checkout-mess" cols="30" rows="10" name="note" placeholder="Lời nhắn cho cửa hàng"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="your-order">
                            <h3>Đơn hàng của bạn</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name">Sản phẩm</th>
                                            <th class="cart-product-total">Tổng cộng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $key => $item)
                                            <tr class="cart_item">
                                                <td class="cart-product-name"> {{ $item['name'] }}<strong
                                                        class="product-quantity">
                                                        × {{ $item['quantity'] }}đ</strong></td>
                                                <td class="cart-product-total text-center"><span
                                                        class="amount">{{ number_format($item['price'] * $item['quantity'], 0, '', '.') }}đ</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td class="text-center"><span
                                                    class="amount">{{ number_format($subTotal, 0, '', '.') }}đ</span>
                                                <input type="hidden" name="payment" value="{{ $subTotal }}">
                                            </td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                            <th>Shipping</th>
                                            <td class="text-center"><span
                                                    class="amount">{{ number_format($shipping, 0, '', '.') }}đ</span>
                                                <input type="hidden" name="ship" value="{{ $shipping }}">
                                            </td>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td class="text-center"><strong><span
                                                        class="amount">{{ number_format($total, 0, '', '.') }}đ</span>
                                                    <input type="hidden" name="total_payment" value="{{ $total }}">
                                            </td></strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="#payment-1">
                                                <h5 class="panel-title">
                                                    <a href="javascript:void(0)" class="" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne" aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                        Direct Bank Transfer.
                                                    </a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-button-payment">
                                        <button type="submit" name="cod">Thanh toán COD</button>
                                        <button type="submit" name="momo">Thanh toán MOMO</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Kenne's Checkout Area End Here -->
@endsection
@section('js')
@endsection
