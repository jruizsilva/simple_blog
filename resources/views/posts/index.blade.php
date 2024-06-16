<x-app-layout>

    <div class="container py-8">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
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
                <article class="w-full bg-center bg-cover h-80 @if ($loop->first) lg:col-span-2 @endif"
                    style="background-image: url({{ $url }})">
                    <div class="flex flex-col justify-center w-full h-full px-8">
                        <div>
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('posts.tag', $tag) }}"
                                    class="inline-block h-6 px-3 text-white rounded-full"
                                    style="background-color: {{ $tag->color }}">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        <h1 class="mt-2 text-4xl font-bold leading-8 text-white">
                            <a href="{{ route('posts.show', $post) }}">
                                {{ $post->name }}
                            </a>
                        </h1>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
