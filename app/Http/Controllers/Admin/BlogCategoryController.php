<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategoryModel;
use Auth;
use Str;

class BlogCategoryController extends Controller
{
    public function list()
    {
        $data['getRecord'] = BlogCategoryModel::getRecord();
        $data['header_title'] = "Blog Category";
        return view('admin.blogcategory.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Blog Category";
        return view('admin.blogcategory.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'slug' => 'required|unique:blog_category'
        ]);

       $category = new BlogCategoryModel;
       $category->name = trim($request->name);
       $category->slug = trim($request->slug);
       $category->status = trim($request->status);
       $category->meta_title = trim($request->meta_title);
       $category->meta_description = trim($request->meta_description);
       $category->meta_keywords = trim($request->meta_keywords);
       $category->save();

       return redirect('admin/blog_category/list')->with('success', "Blog Category Successfully Created");

    }

    public function edit($id)
    {
        $data['getRecord'] = BlogCategoryModel::getSingle($id);
        $data['header_title'] = "Edit Blog Category";
        return view('admin.blogcategory.edit', $data);
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'slug' => 'required|unique:blog_category,slug,'.$id
        ]);

       $category = BlogCategoryModel::getSingle($id);
       $category->name = trim($request->name);
       $category->slug = trim($request->slug);
       $category->status = trim($request->status);
       $category->meta_title = trim($request->meta_title);
       $category->meta_description = trim($request->meta_description);
       $category->meta_keywords = trim($request->meta_keywords);
       $category->save();

       return redirect('admin/blog_category/list')->with('success', "Blog Category Successfully Updated");

    }

    public function delete($id)
    {
        $category = BlogCategoryModel::getSingle($id);
        $category->is_delete = 1;
        $category->save();

        return redirect()->back()->with('success', "Blog Category Successfully Deleted");

    }
}
