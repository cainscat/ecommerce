<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    protected $table = 'notification';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function insertRecord($user_id, $url, $message)
    {
        $save = new NotificationModel;
        $save->user_id = $user_id;
        $save->url = $url;
        $save->message = $message;
        $save->save();
    }

}
