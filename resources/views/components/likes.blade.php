@props(['post'])

<div class="relative inline-block group text-sm text-gray-600">

    <!-- Like button -->
    <button class="like-btn flex items-center gap-1 font-semibold text-blue-500"
        data-url="{{ route('posts.like', $post->id) }}">
        Like
        <span class="like-count">{{ $post->likes->count() }}</span>
    </button>

    <!-- Likes dropdown -->
    <div
        class="absolute left-0 top-full mt-2 z-20
               hidden group-hover:block
               bg-white border rounded-lg shadow-lg
               w-48 p-2">
        @foreach ($post->likes as $like)
            <a href="{{ route('users.profile', $like->user) }}"
                class="flex items-center gap-2 px-2 py-1 rounded
                       hover:bg-gray-100 transition">
                <img src="{{ $like->user->avatar }}" class="w-6 h-6 rounded-full">
                <span class="text-gray-800 text-sm">
                    {{ $like->user->name }}
                </span>
            </a>
        @endforeach
    </div>

</div>
