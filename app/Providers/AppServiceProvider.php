<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\SMTPModel;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $mailersetting = SMTPModel::getSingle();
        if(!empty($mailersetting)){
            $data_mail = [
                'driver'    =>$mailersetting->mail_mailer,
                'host'      =>$mailersetting->mail_host,
                'port'      =>$mailersetting->mail_port,
                'encryption'=>$mailersetting->mail_encryption,
                'username'  =>$mailersetting->mail_username,
                'password'  =>$mailersetting->mail_password,
                'from'      =>[
                    'address' => $mailersetting->mail_from_address,
                    'name' => $mailersetting->name,
                    ]
                ];
                Config::set('mail', $data_mail);
        }
    }
}
