<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSettingModel extends Model
{
    protected $table = 'payment_setting';

    static public function getSingle()
    {
        return self::find(1);
    }
}
