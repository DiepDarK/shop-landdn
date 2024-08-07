@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý đơn hàng</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                        </div>


                        <div class="card-body">
                            <table class="table table-bordered mb-0">
                                <thead>

                                    <th class="col-6">Thông tin người đặt hàng</th>
                                    <th class="col-6">Thông tin người nhận hàn</th>
                                </thead>
                                <tbody>
                                    <td>
                                        <ul>
                                            <li><h5>Tên tài khoản: <span class="text-danger">{{$order->user->name}}</span></h5></li>
                                            <li><h5>Email: <span class="text-danger">{{$order->user->email}}</span></h5></li>
                                            <li><h5>Số điện thoại: <span class="text-danger">{{$order->user->phone}}</span></h5></li>
                                            <li><h5>Địa chỉ: <span class="text-danger">{{$order->user->address}}</span></h5></li>
                                            <li><h5>Tài khoản: <span class="text-danger">{{$order->user->role}}</span></h5></li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            <li>
                                                <h5>Tên người nhận: <span class="text-danger">{{ $order->name_P }}</span>
                                                </h5>
                                            </li>
                                            <li>
                                                <h5>Email người nhận: <span class="text-danger">{{ $order->email_P }}</span>
                                                </h5>
                                            </li>
                                            <li>
                                                <h5>Số điện thoại: <span class="text-danger">{{ $order->phone_P }}</span>
                                                </h5>
                                            </li>
                                            <li>
                                                <h5>Địa chỉ người nhận: <span
                                                        class="text-danger">{{ $order->address_P }}</span></h5>
                                            </li>
                                            <li>
                                                <h5>Ghi chú: <span class="text-danger">{{ $order->note }}</span>
                                                </h5>
                                            </li>
                                            <li>
                                                <h5>Ngày đặt hàng: <span
                                                        class="text-danger">{{ $order->created_at->format('d-m-Y') }}</span>
                                                </h5>
                                            </li>
                                            <li>
                                                <h5>Trạng thái đơn hàng: <span
                                                        class="text-danger">{{ $status_order[$order->status_order] }}</span>
                                                </h5>
                                            </li>
                                            <li>
                                                <h5>Trạng thái thanh toán: <span
                                                        class="text-danger">{{ $status_pay[$order->status_pay] }}</span>
                                                </h5>
                                            </li>
                                            <li>
                                                <h5>Tổng tiền sản phẩm: <span
                                                        class="text-danger">{{ $order->payment }}</span></h5>
                                            </li>
                                            <li>
                                                <h5>Tổng tiền ship: <span class="text-danger">{{ $order->ship }}</span>
                                                </h5>
                                            </li>
                                            <li>
                                                <h5>Tổng tiền thanh toán: <span
                                                        class="text-danger">{{ $order->total_payment }}</span></h5>
                                            </li>
                                        </ul>
                                    </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">Sản phẩm của đơn hàng</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-content table-responsive">
                                <table class="table-bordered mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th class="col">Hình ảnh</th>
                                            <th class="col">Mã sản phẩm</th>
                                            <th class="col-3">Tên sản phẩm</th>
                                            <th class="col">Đơn giá</th>
                                            <th class="col">Số lượng</th>
                                            <th class="col">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderDetail as $item)
                                            @php
                                                $product = $item->product;
                                            @endphp
                                            <tr>
                                                <td class="col"><img class="img-fluid"
                                                        src="{{ Storage::url($product->image) }}" style="max-width: 150px"
                                                        alt="">
                                                    </a></td>
                                                <td class="col">{{ $product->product_code }}
                                                </td>
                                                <td class="col ">{{ $product->name }}
                                                </td>
                                                <td class="col"><span
                                                        class="amount">{{ number_format($item->unit_price, 0, '', '.') }}đ</span>
                                                </td>
                                                <td class="col">{{ $item->quantity }}</td>
                                                <td class="col"><span
                                                        class="subtotal">{{ number_format($item->into_money, 0, '', '.') }}đ</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection

@section('js')
    <script>
        function showLogo(event) {
            const logo_category = document.getElementById('logo_category');
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                logo_category.src = reader.result;
                logo_category.style.display = 'block';
            }
            if (file) {
                reader.readAsDataURL(file)
            }
        }
    </script>
@endsection
