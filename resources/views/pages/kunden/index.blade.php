<?php

use App\Models\Customer;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Kunden')] class extends Component
{
    use WithPagination;

    #[Computed]
    public function customers()
    {
        return auth()->user()->customers()
            ->withCount('projects')
            ->orderBy('name')
            ->paginate(10);
    }

    public function delete(int $id): void
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        session()->flash('status', "Kunde «{$customer->name}» wurde gelöscht.");
    }
};
?>

<div>
    <h1 class="text-2xl font-bold">Meine Kunden</h1>

    @if (session('status'))
        <p class="mt-4 rounded-lg bg-emerald-50 px-4 py-3 text-emerald-800 ring-1 ring-emerald-200">{{ session('status') }}</p>
    @endif

    <table class="mt-6 w-full overflow-hidden rounded-lg bg-white text-left ring-1 ring-gray-200">
        <thead class="bg-gray-100 text-sm text-gray-600">
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">E-Mail</th>
                <th class="px-4 py-2">Ort</th>
                <th class="px-4 py-2">Projekte</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($this->customers as $customer)
                <tr wire:key="customer-{{ $customer->id }}">
                    <td class="px-4 py-2 font-medium">
                        <a href="/kunden/{{ $customer->id }}" wire:navigate class="hover:underline">{{ $customer->name }}</a>
                    </td>
                    <td class="px-4 py-2">{{ $customer->email }}</td>
                    <td class="px-4 py-2">{{ $customer->city }}</td>
                    <td class="px-4 py-2">{{ $customer->projects_count }}</td>
                    <td class="space-x-3 whitespace-nowrap px-4 py-2 text-right text-sm">
                        <a href="/kunden/{{ $customer->id }}/bearbeiten" wire:navigate class="text-blue-600 hover:underline">Bearbeiten</a>
                        <button wire:click="delete({{ $customer->id }})" wire:confirm="Kunde «{{ $customer->name }}» wirklich löschen?" class="text-red-600 hover:underline">Löschen</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">Du hast noch keine Kunden.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $this->customers->links() }}
    </div>
</div>
