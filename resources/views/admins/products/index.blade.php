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
                    <h4 class="fs-18 fw-semibold m-0">Quản lý sản phẩm</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title mb-0 align-content-center">{{ $title }}</h5>
                            <a href="{{ route('admins.products.create') }}" class="btn btn-success m-1"><i
                                    data-feather='plus-square'> </i> Thêm danh mục</a>
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
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mã</th>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Tên sản phẩm</th>
                                            <th scope="col">Danh mục</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Giá khuyến mãi</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Sửa</th>
                                            <th scope="col">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listProduct as $index => $item)
                                            <tr>
                                                <th scope="row">{{ $item->product_code }}</th>
                                                <td>
                                                    <img src="{{ Storage::url($item->image) }}" alt=""
                                                        width="150px">
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->category->name }}</td>
                                                <td>{{ number_format($item->price) }}đ</td>
                                                <td>{{ number_format(empty($item->sale_price) ? 'Chưa có' : $item->sale_price) }}đ
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td class="{{ $item->status == true ? 'text-success' : 'text-danger' }}">
                                                    {{ $item->status == true ? 'Hiện' : 'Ẩn' }}</td>
                                                <td>
                                                    <a href="{{ route('admins.products.edit', $item->id) }}"><i
                                                            class="mdi mdi-pencil bg-success text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admins.products.destroy', $item->id) }}"
                                                        method="post" class=""
                                                        onsubmit="return confirm('Chắc chắn xóa sản phẩm này?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="border-0 bg-white"><i
                                                                class="mdi mdi-delete bg-warning text-muted fs-18 rounded-2 border p-1"></i></button>
                                                    </form>
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
@endsection
