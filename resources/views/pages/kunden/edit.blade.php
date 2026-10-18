<?php

use App\Models\Customer;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Kunde bearbeiten')] class extends Component
{
    public int $customerId;

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $city = '';

    public string $hourly_rate = '';

    public string $notes = '';

    public function mount(Customer $customer): void
    {
        $this->customerId = $customer->id;
        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->phone = $customer->phone ?? '';
        $this->city = $customer->city;
        $this->hourly_rate = (string) $customer->hourly_rate;
        $this->notes = $customer->notes ?? '';
    }

    public function save(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('customers', 'email')->ignore($this->customerId)],
            'phone' => ['nullable', 'string', 'max:30'],
            'city' => ['required', 'string', 'max:255'],
            'hourly_rate' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $customer = Customer::findOrFail($this->customerId);
        $customer->update([
            ...$validated,
            'phone' => $validated['phone'] ?: null,
            'notes' => $validated['notes'] ?: null,
        ]);

        session()->flash('status', 'Kunde wurde gespeichert.');

        $this->redirect("/kunden/{$customer->id}", navigate: true);
    }
};
?>

<div class="mx-auto max-w-xl">
    <h1 class="text-2xl font-bold">Kunde bearbeiten</h1>

    <form wire:submit="save" class="mt-6 space-y-4 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
        @foreach (['name' => 'Name', 'email' => 'E-Mail', 'phone' => 'Telefon (optional)', 'city' => 'Ort', 'hourly_rate' => 'Stundensatz (CHF)'] as $field => $label)
            <div>
                <label for="{{ $field }}" class="block text-sm font-medium">{{ $label }}</label>
                <input id="{{ $field }}" type="{{ $field === 'email' ? 'email' : 'text' }}" wire:model="{{ $field }}"
                       class="mt-1 w-full rounded-lg border px-3 py-2 @error($field) border-red-500 @else border-gray-300 @enderror">
                @error($field) <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        @endforeach

        <div>
            <label for="notes" class="block text-sm font-medium">Notizen</label>
            <textarea id="notes" rows="5" wire:model="notes" class="mt-1 w-full rounded-lg border px-3 py-2 @error('notes') border-red-500 @else border-gray-300 @enderror"></textarea>
            @error('notes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="rounded-lg bg-emerald-600 px-4 py-2 font-semibold text-white hover:bg-emerald-700">Speichern</button>
            <a href="/kunden/{{ $customerId }}" wire:navigate class="text-sm text-gray-600 hover:underline">Abbrechen</a>
        </div>
    </form>
</div>
