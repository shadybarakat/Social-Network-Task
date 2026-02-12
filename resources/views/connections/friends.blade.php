<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Friends') }}
        </h2>
    </x-slot>

    @foreach($friends as $friend)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg ">
                <div class="max-w-xl flex flex-row justify-center align-middle items-center gap-5">
            <img
                src="{{ $friend->avatar }}"
                class="w-24 h-24 rounded-full object-cover"
                alt="Avatar"
            />
            <div>
                <h2 class="text-2xl font-semibold">{{ $friend->name }}</h2>

                @if ($friend->bio)
                    <p class="text-gray-600 mt-2">{{ $friend->bio }}</p>
                @endif
            </div>
        </div>
    </div>
    </div>
    @endforeach
</x-app-layout>
