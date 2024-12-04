<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategoryModel extends Model
{
    use HasFactory;
    protected $table = 'sub_category';

    static public function getSingle($id)
    {
        returnself::find($id);
    }

    static public function getRecord()
    {
        return self::select('sub_category.*', 'users.name as created_by_name', 'category.name as category_name')
                ->join('category', 'category.id', '=', 'sub_category.category_id')
                ->join('users', 'users.id', '=', 'sub_category.created_by')
                ->where('sub_category.is_delete', '=', 0)
                ->orderBy('sub_category.id', 'desc')
                ->paginate(20);
    }



}