@props(['post', 'connection'])
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6"> 
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
        <!-- content -->
        <div class="flex items-center mb-2">
            <a href="{{ route('users.profile',$post->user) }}" class="font-semibold text-gray-800">{{ $post->user->name }}</a>
                @if($post->user->id != auth()->id())
                <div class="ml-4">
            @if(!$connection)
                <button 
                    class="add-friend-btn px-2 py-1 bg-green-500 text-white rounded"
                    data-url="{{ route('connections.send', $post->user->id) }}">
                    Add Friend
                </button>
            @elseif($connection->status == 'pending')
                @if($connection->receiver_id == auth()->id())
                    <span class="text-yellow-500">
                <button 
                    class="accept-friend-btn px-2 py-1 bg-gray-500 text-gray rounded"
                    data-url="{{ route('connections.accept', $connection) }}">
                    Accept Request
                </button>
                    </span>
                @else
                    <span class="text-gray-500">Pending</span>
                @endif
            @elseif($connection->status == 'accepted')
                <span class="text-green-500">Friend</span>
            @endif
        </div>
        @endif
            <div class="ml-auto text-gray-500 text-sm">{{ $post->created_at->diffForHumans() }}</div>
        </div>
        <p class="text-gray-900 mb-2">{{ $post->content }}</p>

        <!-- Likes -->
        <div class="flex items-center space-x-4 mb-2">
            <button 
                class="like-btn flex items-center text-blue-500 font-semibold" 
                data-url="{{ route('posts.like', $post->id) }}">
                Like<span class="ml-1 like-count">{{ $post->likes->count() }}</span>
            </button>
        </div>

        <!-- Comments -->
        <div class="border-t border-gray-200 pt-2">
            <div class="space-y-1 comment-list">
                @foreach ($post->comments as $comment)
                    <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</p>
                @endforeach
            </div>

            <!-- Add Comment -->
            <form class="comment-form mt-2 flex items-center space-x-2" data-url="{{ route('posts.comment', $post->id) }}">
                @csrf
                <input type="text" name="content" placeholder="Add a comment..." class="border rounded p-2 flex-1">
                <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded">Comment</button>
            </form>
        </div>

                            @can('update',$post)
                                               <div class="sm:flex sm:items-center gap-5 my-5 pt-6">
            <a class="mx-5 text-sm/6 font-semibold" href="{{ route('posts.update', $post->id) }}">Edit post</a>
            <form method="POST" action="{{ route('posts.delete', $post->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="mx-5 text-sm/6 font-semibold text-red-700">Delete</button>
            </form>
    </div>
                    @endcan
    </div>
    </div>
</div>
