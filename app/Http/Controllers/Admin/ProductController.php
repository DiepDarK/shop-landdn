<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách sản phẩm';
        $listProduct = Product::orderByDesc('status')->get();

        return view('admins.products.index', compact('title', 'listProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm sản phẩm';
        $listCategory = Category::query()->get();

        return view('admins.products.create', compact('title', 'listCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        if ($request->isMethod("POST")) {
            $params = $request->except('_token');

            // CHuyển đổi checkbox thành boolean
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_sale'] = $request->has('is_sale') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

            //Xử lí hình ảnh đại diện
            if ($request->hasFile('image')) {
                $params['image'] = $request->file('image')->store('uploads/products', 'public');
            } else {
                $params['image'] = null;
            }

            //Thêm sản phẩm
            $product = Product::query()->create($params);

            // Lấy id sản phẩm vừa thêm để thêm được nhiều ảnh 
            $productID = $product->id;

            //Xử lí list ảnh
            if ($request->hasFile('listImage')) {
                foreach ($request->file('listImage') as $image) {
                    if ($image) {
                        $path = $image->store('uploads/ProductImage/id_' . $productID, 'public');
                        $product->productImage()->create(
                            [
                                'product_id' => $productID,
                                'image' => $path,
                            ]
                        );
                    }
                }
            }
            return redirect()->route('admins.products.index')->with('success', 'Thêm sản phẩm thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Chỉnh sửa sản phẩm';
        $listCategory = Category::query()->get();
        $product = Product::query()->findOrFail($id);
        return view('admins.products.edit', compact('title', 'listCategory','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod("PUT")) {
            $params = $request->except('_token','_method');

            // CHuyển đổi checkbox thành boolean
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_sale'] = $request->has('is_sale') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

            $product = Product::query()->findOrFail($id); 

            //Xử lí hình ảnh đại diện
            if ($request->hasFile('image')) {
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                $params['image'] = $request->file('image')->store('uploads/products', 'public');
            } else {
                $params['image'] = $product->image;
            }

            //Xử lí ảnh liên kết
                $currentImages = $product->productImage->pluck('id')->toArray();
                $arrayCombine = array_combine($currentImages, $currentImages);

                // Trường hợp xóa
                foreach ($arrayCombine as $key => $value) {
                    //Tìm kiếm id hình ảnh trong mảng hình ảnh mới đẩy lên
                    // Nếu không tồn tại id thì tức là người dùng đã xóa hình ảnh đó
                    if (!array_key_exists($key, $request->listImage)) {
                        $productImage = ProductImage::query()->find($key);
                        //Xóa hình ảnh đó
                        if ($productImage && Storage::disk('public')->exists($productImage->image)) {
                            Storage::disk('public')->delete($productImage->image);
                            $productImage->delete();
                        }
                    }
                }
                // TRường hợp thếm hoặc sửa
                foreach ($request->listImage as $key => $image) {
                    if (!array_key_exists($key, $arrayCombine)) {
                        if ($request->hasFile("listImage.$key")) {
                            $path = $image->store('uploads/ProductImage/id_' . $id, 'public');
                            $product->productImage()->create([
                                'product_id' => $id,
                                'image' => $path,
                            ]);
                        } else if (is_file($image) && $request->hasFile("listImage.$key")) {
                            // Trường hợp thày đổi hình ảnh
                            $productImage = ProductImage::query()->find($key);
                            if ($productImage && Storage::disk('public')->exists($productImage->image)) {
                                Storage::disk('public')->delete($productImage->image);
                            }
                            $path = $image->store('uploads/ProductImage/id_' . $id, 'public');
                            $productImage->update([
                                'image' => $path,
                            ]);
                        }
                    }
                }
            
            $product->update($params);
            return redirect()->route('admins.products.index')->with('success', 'Cập nhật thông tin sản phẩm thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Xóa ảnh sản phẩm
        $product = Product::query()->findOrFail($id);
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Xóa tất cả anh liên kết
        $product->productImage()->delete();

        //Xóa toàn bộ ảnh trong thư mục
        $path = 'uploads/ProductImage/id_' . $id;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->deleteDirectory($path);
        }

        $product->delete();
        return redirect()->route('admins.products.index')->with('success', 'Xóa sản phẩm thành công');
    }
}
