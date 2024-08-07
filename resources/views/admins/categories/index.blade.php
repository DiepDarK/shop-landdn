@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection
@section('css')
    
@endsection
@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Quản lý danh mục sản phẩm</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0 align-content-center">{{$title}}</h5>
                        <a href="{{route('admins.categories.create')}}" class="btn btn-success m-1"><i data-feather='plus-square'> </i> Thêm danh mục</a>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="table-responsive">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{session('success')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                </div>
                            @endif
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Logo</th>
                                        <th scope="col">Tên Danh Mục</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listCategory as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1}}</th>
                                        <td>
                                            <img src="{{ Storage::url($item->logo)}}" alt="" width="150px">
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td class="{{$item->status == true ? 'text-success' : 'text-danger'}}">{{$item->status == true ? 'Hiện' : 'Ẩn'}}</td>
                                        <td>                                                       
                                            <a href="{{route('admins.categories.edit', $item->id)}}"><i class="mdi mdi-pencil bg-success text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                            
                                            <form action="{{route('admins.categories.destroy', $item->id)}}" method="post" class="d-inline" onsubmit="return confirm('Chắc chắn xóa danh mục này?')">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="border-0 bg-white"><i class="mdi mdi-delete bg-warning text-muted fs-18 rounded-2 border p-1"></i></button>
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