<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Friends') }}
        </h2>
    </x-slot>


    @if ($friends->isEmpty())
        <p class="text-center py-6 text-gray-500">No Posts Yet</p>
    @else
        @foreach ($friends as $friend)
            <div class="py-6">
                <x-profile-card :user="$friend">
                    <span class="text-green-500">Friend</span>
                </x-profile-card>
            </div>
        @endforeach
    @endif
</x-app-layout>
