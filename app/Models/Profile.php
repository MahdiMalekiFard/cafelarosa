<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasSchemalessAttributes;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory, HasSchemalessAttributes,HasUser;

    protected $table = 'profiles';

    protected $fillable = [
        'user_id',
        'address',
        'bio',
        'latitude',
        'longitude',
        'mobile_verify_at',
        'email_verify_at',
        'fcm_token',
        'last_login_at',
        'google_id',
        'enable_notification',
        'enable_subscription',
        'extra_attributes',
    ];

    protected $casts = [
        'mobile_verify_at'    => 'datetime',
        'email_verify_at'     => 'datetime',
        'last_login_at'       => 'datetime',
        'enable_notification' => 'boolean',
        'enable_subscription' => 'boolean',
    ];
}
