<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\Interfaces\SiblingsInterface;
use Bkwld\Croppa\Facades\Croppa;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, SiblingsInterface
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

    public function setAvatarAttribute($value)
    {
        Croppa::delete('/storage/avatars/' . $this->avatar);
        $this->attributes['avatar'] = $value;
    }

    public function getTitleAttribute() {
        return $this->name;
    }

    public function getAvatarUrl()
    {
        $filename = $this->getAvatarAttribute($this->avatar);
        return \Storage::url('avatars/'.$filename);
    }

    public function setRandomAvatar()
    {
        $url  = 'https://source.unsplash.com/random/';
        $time = time();
        Storage::disk('public')->put('avatars/'.$time.'.jpg', file_get_contents($url));
        $this->avatar = $time.'.jpg';
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

    public static function rules($userId)
    {
        return [
            'name'     => ['required', 'min:4', 'max:255'],
            'email'    => ['required', 'email', Rule::unique('users')->ignore($userId)],
            'username' => ['required', 'min:4', 'max:255', Rule::unique('users')->ignore($userId)],
            'password' => ['nullable', 'min:4', 'confirmed'],
            'avatar'   => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:1024'],
        ];
    }

    // Siblings
    public function previous()
    {
        $previous = self::where('id', '<', $this->id)->orderBy('id', 'desc')->first();
        return $previous ?? self::orderBy('id', 'desc')->first();
    }

    public function next()
    {
        $next = self::firstWhere('id', '>', $this->id);
        return $next ?? self::first();
    }

    public function getShowUrl()
    {
        return route('users.show', $this);
    }
}
