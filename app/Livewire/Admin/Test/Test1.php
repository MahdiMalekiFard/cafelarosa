<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Test;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;

#[Lazy(isolate: true)]
class Test1 extends Component
{
    public string $message   = '';

    public function mount(): void {}

    #[On('init')]
    public function init(): void
    {
        $this->fetchData();
    }

    public function fetchData(): void
    {
        $this->message = 'Fetching data...';

        try {
            // Make a synchronous request
            $response = Http::get('https://httpbin.org/delay/1');

            if ($response->successful()) {
                $this->message = 'Data received';
            } else {
                $this->message = 'Failed to fetch data';
            }
        } catch (Exception $e) {
            // Handle exceptions such as network issues
            $this->message = 'Error fetching data';
        }
    }

    public function render(): View
    {
        return view('livewire.admin.test.test1');
    }
}
