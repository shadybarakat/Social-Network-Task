        @props(['post'])
        <div class="sm:flex sm:items-center gap-5 my-5 pt-6">
            <x-primary-button href="{{ route('posts.edit', $post->id) }}">Edit Post</x-primary-button>
            {{-- <a class="mx-5 text-sm/6 font-semibold" href="{{ route('posts.edit', $post->id) }}">Edit post</a> --}}
            <form method="POST" action="{{ route('posts.delete', $post->id) }}">
                @csrf
                @method('DELETE')
                <x-danger-button>Delete</x-danger-button>
            </form>
        </div>