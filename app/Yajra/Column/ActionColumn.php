<?php

declare(strict_types=1);

namespace App\Yajra\Column;

use Illuminate\Contracts\View\View;

class ActionColumn implements ColumnContract
{
    public function __construct(private $view) {}
    
    public function __invoke($row): View
    {
        return view($this->view, ['row' => $row]);
    }
}
