<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-post-card :post="$post" :withConnection="false">
        </x-post-card>
    </div>
</x-app-layout>
