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
                    <form method="post" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="content" :value="__(key: 'Content')" />
                            <x-text-input id="content" name="content" type="text" class="mt-1 block w-full"
                                :value="old('content', $post->content)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="image" value="Post Image" />
                            <x-text-input id="image" name="image" type="file"
                                class="mt-1 block w-full" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
