@props(['post', 'connection' => null])
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <!-- content -->
            <div class="flex items-center mb-2">
                <img src="{{ $post->user->avatar }}" class="w-8 h-8 mr-2 rounded-full object-cover" alt="Avatar" />
                <a href="{{ route('users.profile', $post->user) }}"
                    class="font-semibold text-gray-800">{{ $post->user->name }}</a>
                @if ($post->user->id != auth()->id())
                    <x-connection-actions :user="$post->user" :connection="$connection"></x-connection-actions>
                @endif
                <div class="ml-auto text-gray-500 text-sm">{{ $post->created_at->diffForHumans() }}</div>
            </div>
            <p class="text-gray-900 mb-2">{{ $post->content }}</p>

            <!-- Likes -->
            <x-likes :post="$post"></x-likes>

            <!-- Comments -->
            <x-comments :post="$post"></x-comments>

            @can('update', $post)
                <x-post-actions :post="$post"></x-post-actions>
            @endcan
        </div>
    </div>
</div>
