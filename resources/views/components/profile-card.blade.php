@props(['user'])
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg ">
        <div class="flex flex-row justify-between align-middle items-center gap-5">
            <div class="flex flex-row gap-5 align-middle justify-start items-center w-1/2">
                <img src="{{ $user->avatar }}" class="w-24 h-24 rounded-full object-cover" alt="Avatar" />
                <div>
                    <h2 class="text-2xl font-semibold">{{ $user->name }}</h2>
                    <p class="text-gray-600 mt-2">email: {{ $user->email }}</p>
                    @if ($user->bio)
                        <p class="text-gray-600 mt-2">bio: {{ $user->bio }}</p>
                    @endif
                </div>
            </div>
            @if (auth()->check() && auth()->id() === $user->id)
                <x-primary-button href="{{ route('profile.edit') }}">
                    Edit Profile
                </x-primary-button>
            @endif
            {{ $slot }}
        </div>
    </div>
</div>
