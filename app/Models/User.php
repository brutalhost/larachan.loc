<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
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
        'password'          => 'hashed',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function setPasswordAttribute($password): void
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getAvatarAttribute($value)
    {
        $defaultAvatar = 'default-avatar-m_1920.png';

        return $value ?? $defaultAvatar;
    }

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function isAdmin(): bool
    {
        $admin_id = Config::get('app.admin_id');
        return $this->id === $admin_id;
    }

    public static function rules($userId) {
        return [
        'name'     => ['required', 'min:4', 'max:255'],
        'email'    => ['required', 'email', Rule::unique('users')->ignore($userId)],
        'username' => ['required', 'min:4', 'max:255', Rule::unique('users')->ignore($userId)],
        'password' => ['nullable', 'min:4', 'confirmed'],
        'avatar' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:1024'],
    ];
    }
}
