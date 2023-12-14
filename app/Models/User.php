<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Address;
use App\Models\Discount;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;



class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory;
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'discount_id',
        'discount_type',
        'discount_amount',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin' || $this->is_admin;
    }


    public function getFilamentAvatarUrl(): ?string
    {
       return false;
    }

    public function getProfilePhotoUrlAttribute() : ?string
    {
        return '';
    }


    // Attribute
    public function getRoleAttribute()
    {
        $user_role =  DB::table('model_has_roles')->select('role_id')->where('model_id', $this->id)->first();
        $role = 'user';

        if($user_role){
            $role = DB::table('roles')->where('id', $user_role->role_id)->first()->name;
        }

        return $role;

    }


    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
