@props(['post'])

<div class="border-t border-gray-200 pt-2" data-post-id="{{ $post->id }}">
    <div class="space-y-1 comment-list">
        @foreach ($post->comments as $comment)
            <p>
                <a href="{{ route('users.profile', $comment->user) }}">
                    <strong>{{ $comment->user->name }}:</strong>
                </a>
                {{ $comment->content }}
            </p>
        @endforeach
    </div>

    <form class="comment-form mt-2 flex items-center space-x-2" data-url="{{ route('posts.comment', $post->id) }}">
        @csrf
        <input type="text" name="content" placeholder="Add a comment..." class="border rounded p-2 flex-1" required>
        <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded">
            Comment
        </button>
    </form>
</div>
