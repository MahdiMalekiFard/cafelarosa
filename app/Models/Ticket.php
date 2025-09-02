<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\TicketDepartmentEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'description',
        'department',
        'user_id',
        'closed_by',
        'status',
        'key',
        'priority',
    ];

    protected $casts = [
        'status'     => TicketStatusEnum::class,
        'department' => TicketDepartmentEnum::class,
        'priority'   => TicketPriorityEnum::class,
    ];

    public static function boot(): void
    {
        parent::boot();
        static::creating(function (Ticket $ticket) {
            $ticket->key = (string) floor(time() - 999999999);
        });
    }

    public function messages(): HasMany
    {
        return $this->hasMany(TicketMessage::class);
    }
}
