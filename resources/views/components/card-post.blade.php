@props(['post'])
@php
    $url;
    if ($post->image) {
        if (str_contains($post->image->url, 'http')) {
            $url = $post->image->url;
        } else {
            $url = Storage::url($post->image->url);
        }
    } else {
        $url = Storage::url('full-moon.jpg');
    }
@endphp
<article class="mb-8 overflow-hidden bg-white rounded-lg shadow-lg">
    <img class="object-cover object-center w-full h-72" src="{{ $url }}" alt="{{ $post->name }}">
    <div class="px-6 py-4">
        <h1 class="mb-2 text-xl font-bold">
            <a href="{{ route('posts.show', $post) }}">{{ $post->name }}</a>
        </h1>
        <div class="text-base text-gray-700">
            {{ $post->extract }}
        </div>
    </div>
    <div class="px-6 pt-4 pb-2">
        @foreach ($post->tags as $tag)
            <a href="{{ route('posts.tag', $tag) }}"
                class="inline-block px-3 py-1 mr-2 text-sm text-gray-700 bg-gray-200 rounded-full">{{ $tag->name }}</a>
        @endforeach
    </div>
</article>
