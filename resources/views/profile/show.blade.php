<x-app-layout>
    <div class="py-12">
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
</x-app-layout>
