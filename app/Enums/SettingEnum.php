<?php

declare(strict_types=1);

namespace App\Enums;

enum SettingEnum: string
{
    case COMPANY_ADDRESS  = 'company_address';
    case COMPANY_LOCATION = 'company_location';
    case COMPANY_PHONE    = 'company_phone';
    case COMPANY_EMAIL    = 'company_email';
    case SOCIAL_MEDIAS    = 'social_medias';

    public function help(): string
    {
        return match ($this) {
            self::COMPANY_ADDRESS => 'setting.help.company_address',
            self::COMPANY_PHONE   => 'setting.help.company_phone',
            self::COMPANY_EMAIL   => 'setting.help.company_email',
            self::SOCIAL_MEDIAS   => 'setting.help.social_medias',
            default               => '',
        };
    }

    public function defaultValue(): string
    {
        return match ($this) {
            self::COMPANY_ADDRESS => 'Iran, Tehran, Valiasr St, No 123',
            self::COMPANY_PHONE   => '+98 912 123 4567',
            self::COMPANY_EMAIL   => 'info@metanext.biz',
            default               => '',
        };
    }

    public function extra(): array
    {
        return match ($this) {
            self::COMPANY_ADDRESS  => [],
            self::COMPANY_PHONE    => [],
            self::SOCIAL_MEDIAS    => [
                'instagram' => 'https://www.instagram.com',
                'telegram'  => 'https://www.telegram.com',
                'facebook'  => 'https://www.facebook.com',
                'linkedin'  => 'https://www.linkedin.com',
            ],
            self::COMPANY_LOCATION => [
                'latitude'  => '36.28076602440517',
                'longitude' => '59.65480743251223',
            ],
            default                => [],
        };
    }
}
