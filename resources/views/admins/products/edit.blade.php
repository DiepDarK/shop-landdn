@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection
@section('css')
    <!-- Quill css -->
    <link href="{{ asset('assets/admin/libs/quill/quill.core.js') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý danh sách sản phẩm</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <form action="{{ route('admins.products.update', $product->id) }}" method="POST"
                                enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="product_code" class="form-label">Mã sản phẩm</label>
                                            <input type="text" id="product_code" name="product_code"
                                                class="form-control @error('product_code')
                                                is-invalid
                                            @enderror"
                                                value="{{ $product->product_code }}" placeholder="Mã sản phẩm">
                                            @error('product_code')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên sản phẩm</label>
                                            <input type="text" id="name" name="name"
                                                class="form-control @error('name')
                                                is-invalid
                                            @enderror"
                                                value="{{ $product->name }}" placeholder="Tên sản phẩm">
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Giá sản phẩm</label>
                                            <input type="number" id="price" name="price"
                                                class="form-control @error('price')
                                                is-invalid
                                            @enderror"
                                                value="{{ $product->price }}" placeholder="Giá sản phẩm">
                                            @error('price')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="sale_price" class="form-label">Giá sản phẩm</label>
                                            <input type="number" id="sale_price" name="sale_price"
                                                class="form-control @error('sale_price')
                                                is-invalid
                                            @enderror"
                                                value="{{ $product->sale_price }}" placeholder="Giá khuyễn mãi">
                                            @error('sale_price')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Danh mục</label>
                                            <select name="category_id"
                                                class="form-select @error('category_id')
                                                is-invalid
                                            @enderror">
                                                <option selected>--- Chọn danh mục ---</option>
                                                @foreach ($listCategory as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $product->category_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="quantity" class="form-label">Số lượng</label>
                                            <input type="number" id="quantity" name="quantity"
                                                class="form-control @error('quantity')
                                                is-invalid
                                            @enderror"
                                                value="{{ $product->quantity }}" placeholder="Số lượng sản phẩm">
                                            @error('quantity')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="date_add" class="form-label">Ngày nhập</label>
                                            <input type="date" id="date_add" name="date_add"
                                                class="form-control @error('date_add')
                                                is-invalid
                                            @enderror"
                                                value="{{ $product->date_add }}" placeholder="Ngày nhập sản phẩm">
                                            @error('date_add')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="short_description" class="form-label">Mô tả ngắn</label>
                                            <textarea id="short_description" name="short_description"
                                                class="form-control @error('short_description')
                                                is-invalid
                                            @enderror"
                                                value=" {{ old('short_description') }}" placeholder="Mô tả ngắn sản phẩm" rows="3">{{ $product->short_description }}</textarea>
                                            @error('short_description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="col-sm-10 mb-3 d-flex gap-2">
                                                <label for="status" class="form-label">Trạng thái:</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="status1" value="1"
                                                        {{ $product->status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label text-success" for="status1">
                                                        Hiển thị
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="status2" value="0"
                                                        {{ $product->status == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label text-danger" for="status2">
                                                        Ẩn
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tùy chỉnh riêng:</label>
                                            <div class="ps-3 form-switch mb-2 d-flex justify-content-between">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="is_new"
                                                        name='is_new' {{ $product->is_new == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_new">New</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="is_hot"
                                                        name='is_hot' {{ $product->is_hot == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_hot">Hot</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="is_sale"
                                                        name='is_sale' {{ $product->is_sale == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_sale">Sale</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="is_show_home"
                                                        name='is_show_home'
                                                        {{ $product->is_show_home == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_show_home">Show Home</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Mô tả chi tiết</label>
                                            <div id="quill-editor" style="height: 400px;">
                                            </div>
                                            <textarea name="content" id="content" class="d-none"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Ảnh sản phẩm</label>
                                            <input type="file" id="image" name="image" class="form-control"
                                                onchange="showImage(event)">
                                            <img class="mt-2" id="image_product"
                                                src="{{ Storage::url($product->image) }}" alt="image"
                                                style="width: 150px;">
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Tất cả ảnh</label>
                                            <i id="add-row"
                                                class="mdi mdi-plus bg-light text-muted fs-18 rounded-2 border ms-3 p-1"
                                                style="cursor: pointer"></i>
                                            <table class="table align-middle table-nowrap mb-0">
                                                <tbody id="image-table-body">
                                                    @foreach ($product->productImage as $index => $image)
                                                        <tr>
                                                            <td class="d-flex align-items-center">
                                                                <img class="me-2" id="preview_{{ $index }}"
                                                                    src="{{ Storage::url($image->image) }}"
                                                                    alt="image" style="width: 50px;">
                                                                <input type="file" id="image"
                                                                    name="listImage[{{ $image->id }}]"
                                                                    class="form-control"
                                                                    onchange="previewImage(this, {{ $index }})">
                                                                    <input type="hidden" name="listImage[{{ $image->id }}]" value="{{$image->id}}">
                                                            </td>
                                                            <td>
                                                                {{-- <i class="mdi mdi-delete bg-light text-muted fs-18 rounded-2 border p-1"
                                                                style="cursor: pointer"></i> --}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
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
    <!-- Quill Editor Js -->
    <script src="{{ asset('assets/admin/libs/quill/quill.core.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/quill/quill.min.js') }}"></script>

    <script>
        function showImage(event) {
            const image_product = document.getElementById('image_product');
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                image_product.src = reader.result;
                image_product.style.display = 'block';
            }
            if (file) {
                reader.readAsDataURL(file)
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill("#quill-editor", {
                theme: "snow",
            })

            //Hiển thị nội dung cũ
            var old_content = `{!! $product->content !!}`;
            quill.root.innerHTML = old_content;

            // Cập nhật lại textaria ẩn khi nội dung của quill-edit thay đổi
            quill.on('text-change', function() {
                var html = quill.root.innerHTML;
                document.getElementById('content').value = html;
            })
        })
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rowCount = {{count($product->productImage)}};
            document.getElementById('add-row').addEventListener('click', function() {
                var tableBody = document.getElementById('image-table-body');
                var newRow = document.createElement('tr');
                newRow.innerHTML = `
            <td class="d-flex align-items-center">
                <img class="me-2" id="preview_${rowCount}"
                    src="https://visualpharm.com/assets/619/Gallery-595b40b85ba036ed117dc142.svg"
                    alt="image" style="width: 50px;">
                <input type="file" id="image" name="listImage[id_${rowCount}]"
                    class="form-control" onchange="previewImage(this, ${rowCount})">
            </td>
            <td>
                <i class="mdi mdi-delete bg-light text-muted fs-18 rounded-2 border p-1"
                    style="cursor: pointer"onclick="removeRow(this)"></i>
            </td>`;

                tableBody.appendChild(newRow);
                rowCount++;
            })
        });

        function previewImage(input, rowIndex) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(`preview_${rowIndex}`).setAttribute('src', e.target.result)
                }
                reader.readAsDataURL(input.files[0])
            }
        }

        function removeRow(item) {
            var row = item.closest('tr');
            row.remove();
        }
    </script>
@endsection
