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
                    <h4 class="fs-18 fw-semibold m-0">Quản lý danh mục sản phẩm</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <form action="{{ route('admins.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên danh mục</label>
                                            <input type="text" id="name" name="name"
                                                class="form-control @error('name')
                                                is-invalid
                                            @enderror"
                                                value="{{ $category->name }}" placeholder="Tên danh mục">
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-sm-10 mb-3 d-flex gap-2">
                                            <label for="status" class="form-label">Trạng thái:</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status1" value="1"
                                                {{ $category->status == true ? 'checked': '' }} >
                                                <label class="form-check-label text-success" for="status1">
                                                    Hiển thị
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status2" value="0"
                                                {{ $category->status == false ? 'checked': '' }}>
                                                <label class="form-check-label text-danger" for="status2">
                                                    Ẩn
                                                </label>
                                            </div>
                                      </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="logo" class="form-label">Logo</label>
                                            <input type="file" id="logo" name="logo"
                                                class="form-control" onchange="showLogo(event)">
                                                <img class="mt-2" id="logo_category" src="{{ Storage::url($category->logo)}}" alt="Logo" style="width: 150px;">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Thay đổi</button>
                                    </div>
                                </div>
                            </form>
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
        reader.onload = function(){
            logo_category.src = reader.result;
            logo_category.style.display = 'block';
        }
        if (file) {
            reader.readAsDataURL(file)
        }
    }
</script>
@endsection
