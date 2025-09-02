<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, InteractsWithMedia;

    protected array $guard_name = ['api'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'family', 'block', 'mobile', 'password', 'email', 'mobile_verify_at', 'remember_token',
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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
             ->singleFile()
             ->registerMediaConversions(function () {
                 $this->addMediaConversion('thumb')->crop(100, 100);
                 $this->addMediaConversion('512')->crop(512, 512);
             });
        $this->addMediaCollection('cart_melli_front')->singleFile();
        $this->addMediaCollection('cart_melli_back')->singleFile();
        $this->addMediaCollection('activity_permission')->singleFile();
    }

    public function getFullNameAttribute(): string
    {
        return $this->name . ' ' . $this->mobile;
    }

    public function rolesName(): string
    {
        $temp = array_column($this->roles->toArray(), 'name');

        return implode(',', $temp);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }
}
