<?php

use App\Models\Customer;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Kunde')] class extends Component
{
    public Customer $customer;

    public function mount(Customer $customer): void
    {
        $this->customer = $customer->load('projects');
    }
};
?>

<div>
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">{{ $customer->name }}</h1>
        <a href="/kunden/{{ $customer->id }}/bearbeiten" wire:navigate class="rounded-lg bg-emerald-600 px-4 py-2 font-semibold text-white hover:bg-emerald-700">Bearbeiten</a>
    </div>

    @if (session('status'))
        <p class="mt-4 rounded-lg bg-emerald-50 px-4 py-3 text-emerald-800 ring-1 ring-emerald-200">{{ session('status') }}</p>
    @endif

    <div class="mt-6 grid gap-6 md:grid-cols-3">
        <section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <h2 class="font-semibold">Kontakt</h2>
            <dl class="mt-4 space-y-3 text-sm">
                <div><dt class="text-gray-500">E-Mail</dt><dd>{{ $customer->email }}</dd></div>
                <div><dt class="text-gray-500">Telefon</dt><dd>{{ $customer->phone ?? '–' }}</dd></div>
                <div><dt class="text-gray-500">Ort</dt><dd>{{ $customer->city }}</dd></div>
                <div><dt class="text-gray-500">Stundensatz</dt><dd>CHF {{ $customer->hourly_rate }}</dd></div>
            </dl>
        </section>

        <section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200 md:col-span-2">
            <h2 class="font-semibold">Notizen</h2>
            @if ($customer->notes)
                <p class="mt-4 text-sm text-gray-700">{!! nl2br($customer->notes) !!}</p>
            @else
                <p class="mt-4 text-sm text-gray-500">Keine Notizen.</p>
            @endif
        </section>
    </div>

    <section class="mt-6 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
        <h2 class="font-semibold">Projekte</h2>
        <ul class="mt-4 divide-y divide-gray-100">
            @foreach ($customer->projects as $project)
                <li wire:key="project-{{ $project->id }}" class="flex items-center justify-between py-2">
                    <span>{{ $project->name }}</span>
                    <span class="rounded-full px-2 py-0.5 text-xs {{ $project->status->color() }}">{{ $project->status->label() }}</span>
                </li>
            @endforeach
        </ul>
    </section>
</div>
