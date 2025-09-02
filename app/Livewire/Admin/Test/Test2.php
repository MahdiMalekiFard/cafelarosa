<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Test;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class Test2 extends Component
{
    public string $message = 'loading...';
    public bool $loadData  = false;
    public int $sleepTime  = 0;
    public int $delay      = 0;

    public function mount(int $sleepTime = 1): void
    {
        $this->sleepTime = $sleepTime;
    }

    #[On('init')]
    public function init(): void
    {
        $this->loadData = true;
        $this->fetchData();
    }

    public function fetchData(): void
    {
        $response = Http::get("https://httpbin.org/delay/{$this->sleepTime}");
        if ($response->successful()) {
            $this->message = 'Hello World!';
        }
    }

    public function render()
    {
        return view('livewire.admin.test.test2');
    }
}
