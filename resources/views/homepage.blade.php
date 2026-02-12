<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Homepage') }}
        </h2>
    </x-slot>
    @foreach ($posts as $post)
        <x-post-card 
            :post="$post"
        :connection="$connections[$post->user->id] ?? null"
        />
    @endforeach

<!-- Pagination -->
<div class="my-4 flex justify-center align-middle pb-10">
    {{ $posts->links() }}
</div>

</x-app-layout>
