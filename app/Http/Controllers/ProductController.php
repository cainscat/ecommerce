<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;

class ProductController extends Controller
{
    public function getCategory($slug)
    {
        $getCategory = CategoryModel::getSingleSlug($slug);

        if(!empty( $getCategory))
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
