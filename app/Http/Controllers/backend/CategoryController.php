<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller {
    public function index() {
        $category = Category::latest()->get();
        return view("backend.pages.category.all", compact("category"));

    }
    public function create() {
        return view("backend.pages.category.create");

    }
    public function store(Request $request) {
        $request->validate([
            'category_name' => 'required|max:100',
            'category_image' => 'required',
        ]);

        $image = $request->file('category_image');
        $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        Image::make($image)->resize(120, 120)->save(public_path('frontend/uploads/category/' . $image_name));
        $image_url = 'frontend/uploads/category/' . $image_name;

        Category::create([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_slug)),
            'category_image' => $image_url,
        ]);

        toastr()->success('Category created');
        return redirect('/all/category');
    }

    public function edit($id) {
        $category = Category::find($id);
        return view('backend.pages.category.edit', compact('category'));
    }
    public function update(Request $request) {
        $category_Id = $request->category_id;
        $old_image = $request->old_image;

        if ($request->hasFile('category_image')) {
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            $image = $request->file('category_image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(120, 120)->save(public_path('frontend/uploads/category/' . $image_name));
            $image_url = 'frontend/uploads/category/' . $image_name;

            Category::where('id', $category_Id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_slug)),
                'category_image' => $image_url,
            ]);

        } else {
            Category::where('id', $category_Id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_slug)),
            ]);
        }
        toastr()->success('Category updated');
        return redirect('/all/category');
    }

    public function delete($id) {
        $category = Category::find($id);
        $old_image = $category->category_image;
        unlink($old_image);
        Category::where('id', $id)->delete();

        toastr()->success('Category deleted');
        return back();
    }
}
