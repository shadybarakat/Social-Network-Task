<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <p>{{ $post->content }}</p>
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
    </div>
</x-app-layout>
