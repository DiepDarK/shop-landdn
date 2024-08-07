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
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0 align-content-center">{{ $title }}</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mã đơn hàng</th>
                                            <th scope="col">Ngày đặt</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Tổng tiền</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col"></th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($listOrder as $item)
                                            <tr>
                                                <td><a class="account-order-id"
                                                        href="{{ route('orders.show', $item->id) }}">{{ $item->order_code }}</a>
                                                </td>
                                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $status_pay[$item->status_pay] }}</td>
                                                <td>{{ number_format($item->total_payment, 0, '', '.') }} VNĐ</td>
                                                <td>
                                                    @if ($item->status_order == 'da_huy' || $item->status_order == 'da_giao_hang')
                                                        {{ $status_order[$item->status_order] }}
                                                    @else
                                                        <form action="{{ route('admins.orders.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="status_order" class="form-select" id=""
                                                                onchange="confirmSubmit(this)"
                                                                data-default-value="$item->status_order">
                                                                @foreach ($status_order as $key => $value)
                                                                    <option value="{{ $key }}"
                                                                        {{ $key == $item->status_order ? 'selected' : '' }}
                                                                        {{ $key == 'da_huy' ? 'disabled' : '' }}>
                                                                        {{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                        </form>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admins.orders.show', $item->id) }}"><i
                                                            class="mdi mdi-eye bg-primary text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
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
        function confirmSubmit(selectElement) {
            var form = selectElement.form;
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;
            var defaultValue = selectElement.getAttribute('data-default-value');

            if (confirm('Bạn có chắc chắn thay đổi trạng thái đơn hàng thành "' + selectedOption + '" không?')) {
                form.submit();
            } else {
                selectElement.value = defaultValue;
            }
        }
    </script>
@endsection
