<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = 'orders';

    static public function getSingle($id)
    {
        return self::find($id);
    }

}
