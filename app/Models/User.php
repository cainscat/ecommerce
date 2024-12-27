<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Request;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    static public function getSingle($id)
    {
        return User::find($id);
    }

    static public function getAdmin()
    {
        return User::select('users.*')
            ->where('is_admin', '=', 1)
            ->where('is_delete', '=', 0)
            ->orderBy('id','desc')
            ->get();
    }

    static public function getTotalCustomer()
    {
        return self::select('id')
                ->where('is_admin', '=', 0)
                ->where('is_delete', '=', 0)
                ->count();
    }

    static public function getTotalTodayCustomer()
    {
        return self::select('id')
                ->where('is_admin', '=', 0)
                ->where('is_delete', '=', 0)
                ->whereDate('created_at', '=', date('Y-m-d'))
                ->count();
    }

    static public function getCustomer()
    {
        $return = User::select('users.*');

        if(!empty(Request::get('id')))
        {
            $return = $return->where('id', '=', Request::get('id'));
        }
        if(!empty(Request::get('name')))
        {
            $return = $return->where('name', 'like', '%'.Request::get('name').'%');
        }
        if(!empty(Request::get('email')))
        {
            $return = $return->where('email', 'like', '%'.Request::get('email').'%');
        }
        if(!empty(Request::get('from_date')))
        {
            $return = $return->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if(!empty(Request::get('to_date')))
        {
            $return = $return->whereDate('created_at', '<=', Request::get('to_date'));
        }

        $return = $return ->where('is_admin', '=', 0)
            ->where('is_delete', '=', 0)
            ->orderBy('id','desc')
            ->paginate(30);

        return $return;
    }

    static public function checkEmail($email)
    {
        return User::select('users.*')
        ->where('email', '=', $email)
        ->first();
    }


}
