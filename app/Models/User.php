<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const RULE = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'sale_point_id'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role(): BelongsTo {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role): bool {
        return strtolower($this->role->name) === strtolower($role);
    }

    public function initial(): string {
        if(strlen($this->name) > 1)
            return strtoupper(substr($this->name, 0, 2));
        return strtoupper($this->name);
    }

    public static function not_admin() {
        return User::where('role_id',2)->get();
    }

    public function sale_point() : BelongsTo {
        return $this->belongsTo(SalePoint::class);
    }

    public function encrypt()
    {
        $this->password = Hash::make($this->password);
    }

    public function is_admin()
    {
        return $this->hasRole('magasin') ;
    }
}
