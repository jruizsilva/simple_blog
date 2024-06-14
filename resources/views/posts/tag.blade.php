<x-app-layout>
    <div class="max-w-5xl px-2 py-8 mx-auto lg:px-8 sm:px-6">
        <h1 class="text-3xl font-bold text-center uppercase">Etiqueta: {{ $tag->name }}</h1>

        @foreach ($posts as $post)
            <x-card-post :post="$post"></x-card-post>
        @endforeach

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
