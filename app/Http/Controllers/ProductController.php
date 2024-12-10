<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;

class ProductController extends Controller
{
    public function getCategory($slug, $subslug = '')
    {
        $getCategory = CategoryModel::getSingleSlug($slug);
        $getSubCategory = SubCategoryModel::getSingleSlug($subslug);

        if(!empty($getCategory) && !empty($getSubCategory))
        {
            $data['getSubCategory'] = $getSubCategory;
            $data['getCategory'] = $getCategory;
            return view('product.list', $data);
        }

        else if(!empty( $getCategory))
        {
            $data['getCategory'] = $getCategory;
            return view('product.list', $data);
        }
        else
        {
            abort(404);
        }

    }





}
