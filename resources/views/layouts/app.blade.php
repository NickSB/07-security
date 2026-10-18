<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-900 antialiased">
    <header class="border-b border-gray-200 bg-white">
        <div class="mx-auto flex max-w-5xl items-center justify-between px-4 py-4">
            <div class="flex items-center gap-8">
                <a href="/kunden" wire:navigate class="font-semibold">{{ config('app.name') }}</a>
                @auth
                    <nav class="text-sm">
                        <a href="/kunden" wire:navigate class="{{ request()->is('kunden*') ? 'font-semibold text-emerald-700' : 'text-gray-600 hover:text-gray-900' }}">Kunden</a>
                    </nav>
                @endauth
            </div>

            @auth
                <div class="flex items-center gap-4 text-sm">
                    <span class="text-gray-600">{{ auth()->user()->name }}</span>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="text-gray-600 underline hover:text-gray-900">Abmelden</button>
                    </form>
                </div>
            @endauth
        </div>
    </header>

    <main class="mx-auto max-w-5xl px-4 py-8">
        {{ $slot }}
    </main>
</body>
</html>
