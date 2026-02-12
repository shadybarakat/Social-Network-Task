<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>
                    @if ($posts)
                        @foreach ($posts as $post)
                        <div class="py-6">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                    <p>{{ $post->content }}</p>
                       <div class="sm:flex sm:items-center gap-5 my-5 pt-6">
            <a class="mx-5 text-sm/6 font-semibold" href="/posts/{{ $post->id }}/edit">Edit post</a>
            <form method="POST" action="/posts/{{ $post->id }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="mx-5 text-sm/6 font-semibold text-red-700">Delete</button>
            </form>
    </div>
                            </div>
                        </div>
                        </div>
                            </div>
                        @endforeach
                    @endif

</x-app-layout>
