<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogModel;
use App\Models\BlogCategoryModel;
use Auth;
use Str;

class BlogController extends Controller
{
    public function list()
    {
        $data['getRecord'] = BlogModel::getRecord();
        $data['header_title'] = "Blog";
        return view('admin.blog.list', $data);
    }

    public function add()
    {
        $data['getCategory'] = BlogCategoryModel::getRecordActive();
        $data['header_title'] = "Add New Blog";
        return view('admin.blog.add', $data);
    }

    public function insert(Request $request)
    {
       $blog = new BlogModel;
       $blog->title = trim($request->title);
       $blog->blog_category_id = trim($request->blog_category_id);
       $blog->description = trim($request->description);
       $blog->status = trim($request->status);
       $blog->meta_title = trim($request->meta_title);
       $blog->meta_description = trim($request->meta_description);
       $blog->meta_keywords = trim($request->meta_keywords);
       $blog->save();

       if(!empty($request->file('image_name')))
       {
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/blog/', $filename);
            $blog->image_name = trim($filename);
       }

       $slug = Str::slug($request->title);
       $count = BlogModel::where('slug', '=', $slug)->count();
       if(!empty($count))
       {
            $blog->slug = $slug.'-'.$blog->id;
       }
       else
       {
            $blog->slug = trim($slug);
       }

       $blog->save();

       return redirect('admin/blog/list')->with('success', "Blog Successfully Created");

    }

    public function edit($id)
    {
        $data['getCategory'] = BlogCategoryModel::getRecordActive();
        $data['getRecord'] = BlogModel::getSingle($id);
        $data['header_title'] = "Edit Blog";
        return view('admin.blog.edit', $data);
    }

    public function update($id, Request $request)
    {
       $blog = BlogModel::getSingle($id);
       $blog->title = trim($request->title);
       $blog->blog_category_id = trim($request->blog_category_id);
       $blog->description = trim($request->description);
       $blog->status = trim($request->status);
       $blog->meta_title = trim($request->meta_title);
       $blog->meta_description = trim($request->meta_description);
       $blog->meta_keywords = trim($request->meta_keywords);
       $blog->save();

       if(!empty($request->file('image_name')))
       {
            if(!empty($blog->getImage()))
            {
                unlink('upload/blog/'.$blog->image_name);
            }
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/blog/', $filename);
            $blog->image_name = trim($filename);
            $blog->save();
       }

       return redirect('admin/blog/list')->with('success', "Blog Successfully Updated");

    }

    public function delete($id)
    {
        $blog = BlogModel::getSingle($id);
        $blog->is_delete = 1;
        $blog->save();

        return redirect()->back()->with('success', "Blog Successfully Deleted");

    }
}
