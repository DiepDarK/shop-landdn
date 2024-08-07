<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh mục sản phẩm';
        $listCategory = Category::orderByDesc('status')->get();

        return view('admins.categories.index', compact('title','listCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm Danh mục sản phẩm';
        return view('admins.categories.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        if ($request->isMethod('POST')) {
            $param = $request->except('_token');
            if ($request->hasFile('logo')) {
                $file_path = $request->file('logo')->store('uploads/categories','public');
            } else {
                $file_path = null;
            }
            $param['logo'] = $file_path;
            Category::create($param);
            return redirect()->route('admins.categories.index')->with('success', 'Thêm danh mục thành công');
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
        $title = 'Sửa danh mục sản phẩm';

        $category = Category::findOrFail($id);

        return view('admins.categories.edit', compact('title', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $param = $request->except('_token', '_method');
            $category = Category::findOrFail($id);

            if ($request->hasFile('logo')) {
                if ($category->logo && Storage::disk('public')->exists($category->logo)) {
                    Storage::disk('public')->delete($category->logo);
                }
                $file_path = $request->file('logo')->store('uploads/categories','public');
            } else {
                $file_path = $category->logo;
            }
            $param['logo'] = $file_path;
            $category->update($param);
            return redirect()->route('admins.categories.index')->with('success', 'Cập nhật danh mục thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        if ($category->logo && Storage::disk('public')->exists($category->logo)) {
            Storage::disk('public')->delete($category->logo);
        }
        return redirect()->route('admins.categories.index')->with('success', 'Xóa danh mục thành công');

    }
}
