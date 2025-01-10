<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class BlogModel extends Model
{
    protected $table = 'blog';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getSingleSlug($slug)
    {
        return self::where('slug', '=', $slug)
                    ->where('blog.status', '=', 0)
                    ->where('blog.is_delete', '=', 0)
                    ->first();
    }

    static public function getRecord()
    {
        return self::select('blog.*')
                ->where('blog.is_delete', '=', 0)
                ->orderBy('blog.id', 'desc')
                ->paginate(20);
    }

    static public function getRecordActive()
    {
        return self::select('blog.*')
                ->where('blog.is_delete', '=', 0)
                ->where('blog.status', '=', 0)
                ->orderBy('blog.name', 'asc')
                ->get();
    }

    static public function getBlog()
    {
        $return = self::select('blog.*');
        if(!empty(Request::get('search')))
        {
            $return = $return->where('blog.title', 'like', '%'.Request::get('search').'%');
        }
        $return = $return->where('blog.is_delete', '=', 0)
                ->where('blog.status', '=', 0)
                ->orderBy('blog.id', 'desc')
                ->paginate(20);

        return $return;
    }

    static public function getPopular()
    {
        $return = self::select('blog.*');
        $return = $return->where('blog.is_delete', '=', 0)
                ->where('blog.status', '=', 0)
                ->orderBy('blog.total_view', 'desc')
                ->limit(5)
                ->get();

        return $return;
    }


    public function getImage()
    {
        if(!empty($this->image_name) && file_exists('upload/blog/'.$this->image_name))
        {
            return url('upload/blog/'.$this->image_name);
        }
        else
        {
            return "";
        }
    }

    public function getCategory()
    {
        return $this->belongsTo(BlogCategoryModel::class, 'blog_category_id');
    }

}
