<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class BaseWebController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sessionMessage($message, $type = 'success'): void
    {
        if ($type === 'error') {
            $type = 'danger';
        }
        session()?->flash('flash_message', [
            'message' => $message,
            'type'    => $type,
        ]);
    }
}
