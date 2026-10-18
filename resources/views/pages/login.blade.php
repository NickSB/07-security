<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Anmelden')] class extends Component
{
    public string $email = '';

    public string $password = '';

    public function login(): void
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials)) {
            $this->addError('email', 'E-Mail oder Passwort ist falsch.');

            return;
        }

        session()->regenerate();

        $this->redirectIntended('/kunden');
    }
};
?>

<div class="mx-auto mt-12 max-w-sm">
    <h1 class="text-2xl font-bold">Anmelden</h1>

    <form wire:submit="login" class="mt-6 space-y-4 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
        <div>
            <label for="email" class="block text-sm font-medium">E-Mail</label>
            <input id="email" type="email" wire:model="email" autofocus class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2">
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium">Passwort</label>
            <input id="password" type="password" wire:model="password" class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2">
            @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full rounded-lg bg-emerald-600 px-4 py-2 font-semibold text-white hover:bg-emerald-700">Anmelden</button>
    </form>
</div>
