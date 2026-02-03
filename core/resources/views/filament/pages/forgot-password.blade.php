<x-filament-panels::page>


<form wire:submit.prevent="submit" class="space-y-4">
    <x-filament::input.wrapper>
        {{-- <x-filament::input.label for="email" value="Email Address" /> --}}
        <x-filament::input id="email" wire:model.defer="email" type="email" placeholder="Enter your email" required />
    </x-filament::input.wrapper>

    <x-filament::button type="submit">
        Send Reset Link
    </x-filament::button>
</form>

@if (session()->has('success'))
    <div class="text-green-600">{{ session('success') }}</div>
@endif

@if (session()->has('error'))
    <div class="text-red-600">{{ session('error') }}</div>
@endif
</x-filament-panels::page>
