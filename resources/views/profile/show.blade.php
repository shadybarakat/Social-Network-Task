<x-app-layout>
    <div class="py-12">
        <x-profile-card :user="$user">
            @if(auth()->id() != $user->id)
            <x-connection-actions :user="$user" :connection="auth()->user()?->connectionWith($user)"></x-connection-actions>
       @endif
        </x-profile-card>
    </div>
</x-app-layout>
