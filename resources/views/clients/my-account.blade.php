@extends('layouts.user')

@section('content')
        <!-- Kenne's Breadcrumb Area End Here -->
        <!-- Begin Kenne's Page Content Area -->
        <main class="page-content">
            <div class="account-page-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="account-orders-tab" data-bs-toggle="tab" href="#account-orders" role="tab" aria-controls="account-orders" aria-selected="false">Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-address-tab" data-bs-toggle="tab" href="#account-address" role="tab" aria-controls="account-address" aria-selected="false">Addresses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-details-tab" data-bs-toggle="tab" href="#account-details" role="tab" aria-controls="account-details" aria-selected="false">Account Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-logout-tab" href="login-register.html" role="tab" aria-selected="false">Logout</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-9">
                            <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                                <div class="tab-pane fade show active" id="account-orders" role="tabpanel" aria-labelledby="account-orders-tab">
                                    <div class="myaccount-orders">
                                        <h4 class="small-title">MY ORDERS</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <tbody>
                                                    <tr>
                                                        <th>Mã đơn hàng</th>
                                                        <th>Ngày đặt</th>
                                                        <th>Trạng thái</th>
                                                        <th>Tổng tiền</th>
                                                        <th></th>
                                                    </tr>
                                                    @foreach ($orders as $item)
                                                    <tr>
                                                        <td><a class="account-order-id" href="{{route('orders.show', $item->id)}}">{{$item->order_code}}</a></td>
                                                        <td>{{$item->created_at->format('d-m-Y')}}</td>
                                                        <td>{{$status_order[$item->status_order]}}</td>
                                                        <td>{{ number_format($item->total_payment, 0, '', '.') }} VNĐ</td>
                                                        <td>
                                                            <a href="{{route('orders.show', $item->id)}}" class="kenne-btn kenne-btn_sm"><span>View</span></a>
                                                            <form action="{{route('orders.update', $item->id)}}" method="post" class="d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                @if ($item->status_order === $type_cho_xac_nhan)
                                                                <input type="hidden" name="huy_don_hang" value="1">
                                                                <button type="submit" class="bg-danger kenne-btn kenne-btn_sm mt-2"
                                                                onclick="return confirm('Bạn có xác nhận hủy đơn hàng không?')">Hủy</button>
                                                                    
                                                                @elseif($item->status_order === $type_dang_van_chuyen)
                                                                    
                                                                <input type="hidden" name="da_nhan_hang" value="1">
                                                                <button type="submit" class="bg-success kenne-btn kenne-btn_sm mt-2"
                                                                onclick="return confirm('Xác nhận bạn đã nhận hàng')"
                                                                >Đã nhận hàng</button>
                                                                @endif
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-address" role="tabpanel" aria-labelledby="account-address-tab">
                                    <div class="myaccount-address">
                                        <p>The following addresses will be used on the checkout page by default.</p>
                                        <div class="row">
                                            <div class="col">
                                                <h4 class="small-title">Billing Adress</h4>
                                                <address>
                                                    1234 Heaven Stress, Beverly Hill OldYork UnitedState of Lorem
                                                </address>
                                            </div>
                                            <div class="col">
                                                <h4 class="small-title">Shipping Address</h4>
                                                <address>
                                                    1234 Heaven Stress, Beverly Hill OldYork UnitedState of Lorem
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                                    <div class="myaccount-details">
                                        <form action="#" class="kenne-form">
                                            <div class="kenne-form-inner">
                                                <div class="single-input single-input-half">
                                                    <label for="account-details-firstname">First Name*</label>
                                                    <input type="text" id="account-details-firstname">
                                                </div>
                                                <div class="single-input single-input-half">
                                                    <label for="account-details-lastname">Last Name*</label>
                                                    <input type="text" id="account-details-lastname">
                                                </div>
                                                <div class="single-input">
                                                    <label for="account-details-email">Email*</label>
                                                    <input type="email" id="account-details-email">
                                                </div>
                                                <div class="single-input">
                                                    <label for="account-details-oldpass">Current Password(leave blank to leave
                                                        unchanged)</label>
                                                    <input type="password" id="account-details-oldpass">
                                                </div>
                                                <div class="single-input">
                                                    <label for="account-details-newpass">New Password (leave blank to leave
                                                        unchanged)</label>
                                                    <input type="password" id="account-details-newpass">
                                                </div>
                                                <div class="single-input">
                                                    <label for="account-details-confpass">Confirm New Password</label>
                                                    <input type="password" id="account-details-confpass">
                                                </div>
                                                <div class="single-input">
                                                    <button class="kenne-btn kenne-btn_dark" type="submit"><span>SAVE
                                                    CHANGES</span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Kenne's Account Page Area End Here -->
        </main>
@endsection
@section('js')
    
@endsection