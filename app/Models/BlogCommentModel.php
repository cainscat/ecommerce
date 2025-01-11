<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCommentModel extends Model
{
    protected $table = 'blog_comment';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
