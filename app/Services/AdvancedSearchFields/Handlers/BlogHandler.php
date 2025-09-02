<?php

declare(strict_types=1);

namespace App\Services\AdvancedSearchFields\Handlers;

class BlogHandler extends BaseHandler
{
    public function handle(): array
    {
        return [
            $this->add('id', __('validation.attributes.id'), self::NUMBER),
            $this->add('published', __('validation.attributes.mobile'), self::SELECT, [
                $this->option('1', __('core.published')),
                $this->option('0', __('core.unpublished')),
            ]),
            $this->add('total_view', 'total_view', self::NUMBER),
        ];
    }
}
