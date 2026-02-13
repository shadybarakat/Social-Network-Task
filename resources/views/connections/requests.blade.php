<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Friend Requests') }}
        </h2>
    </x-slot>
    @if ($requests->isEmpty())
        <p class="text-center py-6 text-gray-500">No Friend Requests Yet</p>
    @else
        @foreach ($requests as $request)
            <div class="py-6">
                <x-profile-card :user="$request->sender">
                    <x-connection-actions :user="$request->sender" :connection="$request"></x-connection-actions>
                </x-profile-card>
            </div>
        @endforeach
    @endif
</x-app-layout>
