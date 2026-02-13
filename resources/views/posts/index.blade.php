<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Posts') }}
            </h2>
            <x-primary-button href="{{ route('posts.create') }}">Add Post</x-primary-button>
        </div>
    </x-slot>
    @if ($posts)
        @if ($posts->isEmpty())
            <p class="text-center py-6 text-gray-500">No Posts Yet</p>
        @else
            @foreach ($posts as $post)
                <div class="py-3">
                    <x-post-card :post="$post"></x-post-card>
                </div>
            @endforeach
            <!-- Pagination -->
            <div class="my-4 flex justify-center align-middle pb-10">
                {{ $posts->links() }}
            </div>
        @endif
    @endif
</x-app-layout>
