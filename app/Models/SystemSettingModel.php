<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSettingModel extends Model
{
    protected $table = 'system_setting';

    static public function getSingle()
    {
        return self::find(1);
    }

    public function getLogo()
    {
        if(!empty($this->logo) && file_exists('upload/setting/'.$this->logo))
        {
            return url('upload/setting/'.$this->logo);
        }
        else
        {
            return "";
        }
    }

    public function getFooterLogo()
    {
        if(!empty($this->footer_logo) && file_exists('upload/setting/'.$this->footer_logo))
        {
            return url('upload/setting/'.$this->footer_logo);
        }
        else
        {
            return "";
        }
    }

    public function getFevicon()
    {
        if(!empty($this->fevicon) && file_exists('upload/setting/'.$this->fevicon))
        {
            return url('upload/setting/'.$this->fevicon);
        }
        else
        {
            return "";
        }
    }

    public function getFooterPaymentIcon()
    {
        if(!empty($this->footer_payment_icon) && file_exists('upload/setting/'.$this->footer_payment_icon))
        {
            return url('upload/setting/'.$this->footer_payment_icon);
        }
        else
        {
            return "";
        }
    }

}
