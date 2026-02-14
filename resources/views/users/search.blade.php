<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search result for') . $query }}
        </h2>
    </x-slot>
    @if ($users->isEmpty())
        <p class="text-center py-6 text-gray-500">No users found</p>
    @else
        @foreach ($users as $user)
            <div class="py-6">
                <x-profile-card :user="$user">
                    @if (auth()->id() == $user->id)
                        <x-primary-button href="{{ route('profile.edit') }}">
                            Edit Profile
                        </x-primary-button>
                    @else
                        <x-connection-actions :user="$user" :connection="auth()->user()?->connectionWith($user)"></x-connection-actions>
                    @endif
                </x-profile-card>
            </div>
        @endforeach
    @endif
</x-app-layout>
