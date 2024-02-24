<?php
namespace App\Models\Auth;

use App\Models\Gender;
use App\Models\Position;
use App\Models\Franchise;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $hidden  = ['password', 'remember_token'];
    protected $guarded = ['id'];
    protected $casts   = [
        'active'            => 'boolean',
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function roleIds()
    {
        return $this->roles->pluck('id')->toArray();
    }

    public function franchise()
    {
        return $this->hasOne(Franchise::class, 'id', 'franchise_id');
    }

    public function gender()
    {
        return $this->hasOne(Gender::class, 'id', 'gender_id');
    }

    public function position()
    {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }
}
