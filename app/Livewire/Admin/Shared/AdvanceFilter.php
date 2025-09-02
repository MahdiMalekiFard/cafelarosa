<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Shared;

use Livewire\Component;

class AdvanceFilter extends Component
{
    public $filters = [];
    
    public function mount($filters = [])
    {
        $this->filters = $filters;
    }
    
    public function render()
    {
        return view('livewire.admin.shared.advance-filter');
    }
}
