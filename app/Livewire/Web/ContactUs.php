<?php

declare(strict_types=1);

namespace App\Livewire\Web;

use App\Actions\Contact\StoreContactAction;
use Illuminate\View\View;
use Livewire\Component;

class ContactUs extends Component
{
    public string $name;
    public string $email;
    public string $message;
    public string $phone;

    public string $resultMessage='';
    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|string|email|max:255',
            'phone'   => 'required|numeric|regex:/^09[1-9][0-9]{8}$/|digits:11',
            'message' => 'required|string',
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();
        StoreContactAction::run($validated);
        $this->resultMessage = trans('website.components.contact_us.form.success_message');
    }

    public function render():View
    {
        return view('livewire.web.contact-us');
    }
}
