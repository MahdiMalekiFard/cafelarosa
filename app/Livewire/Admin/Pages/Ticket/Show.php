<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Pages\Ticket;

use AllowDynamicProperties;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

#[AllowDynamicProperties] class Show extends Component
{
    use WithPagination;

    /** @var Ticket */
    public $ticket;

    public $comment;

    public function mount(Ticket $ticket): void
    {
        $this->ticket = $ticket;
    }

    public function rules(): array
    {
        return [
            'comment' => 'required',
        ];
    }

    public function submit(): void
    {
        $this->validate();
        $this->ticket->messages()->create([
            'message' => $this->comment,
            'user_id' => auth()->id(),
        ]);
        $this->reset('comment');
        if ($this->ticket->status === TicketStatusEnum::CLOSE) {
            $this->ticket->update([
                'status'    => TicketStatusEnum::OPEN,
                'closed_by' => null,
            ]);
        }

        $this->render();
    }

    public function render(): View
    {
        return view('livewire.admin.pages.ticket.show', [
            'comments' => $this->ticket->messages()->latest()->get(),
        ]);
    }
}
