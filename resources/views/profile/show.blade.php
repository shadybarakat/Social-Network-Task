<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
            <img
                src="{{ $user->avatar }}"
                class="w-24 h-24 rounded-full object-cover"
                alt="Avatar"
            />

            <div>
                <h2 class="text-2xl font-semibold">{{ $user->name }}</h2>
                <h2 class="text-2xl font-semibold">{{ $user->email }}</h2>

                @if ($user->bio)
                    <p class="text-gray-600 mt-2">{{ $user->bio }}</p>
                @endif
            </div>

            @if (auth()->check() && auth()->id() === $user->id)
    <a
        href="{{ route('profile.edit') }}"
        class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
    >
        Edit Profile
    </a>
    @else
                <button 
                    class="add-friend-btn px-2 py-1 bg-green-500 text-white rounded"
                    data-url="{{ route('connections.send', $user->id) }}">
                    Add Friend
                </button>
@endif

        </div>
    </div>
    </div>
</x-app-layout>
