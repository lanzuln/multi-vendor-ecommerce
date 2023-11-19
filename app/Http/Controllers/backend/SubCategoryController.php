<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SubCategoryController extends Controller {
    public function index() {
        $SubCategory = SubCategory::latest()->get();
        return view("backend.pages.sub_category.all", compact("SubCategory"));

    }
    public function create() {
        $allCategory= Category::orderBy('category_name', 'ASC')->get();
        return view("backend.pages.sub_category.create", compact('allCategory'));

    }
    public function store(Request $request) {
        $request->validate([
            'sub_category_name' => 'required|max:100',
            'category_id' => 'required',
        ]);

        SubCategory::create([
            'name' => $request->sub_category_name,
            'slug' => strtolower(str_replace(' ', '-', $request->sub_category_name)),
            'category_id' => $request->category_id,
        ]);

        toastr()->success('Sub category created');
        return redirect('/all/subcategory');
    }

    public function edit($id) {
        $allCategory= Category::orderBy('category_name', 'ASC')->get();
        $SubCategory = SubCategory::find($id);
        return view('backend.pages.sub_category.edit', compact('allCategory','SubCategory'));
    }
    public function update(Request $request) {
        $category_Id = $request->category_id;

            SubCategory::where('id', $category_Id)->update([
                'name' => $request->sub_category_name,
                'slug' => strtolower(str_replace(' ', '-', $request->sub_category_name))
            ]);

        toastr()->success('Sub Category updated');
        return redirect('/all/subcategory');
    }

    public function delete($id) {
        $category = SubCategory::find($id);
        $old_image = $category->category_image;
        unlink($old_image);
        SubCategory::where('id', $id)->delete();

        toastr()->success('Category deleted');
        return back();
    }
}
