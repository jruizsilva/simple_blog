<x-app-layout>
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
    <div class="container py-8">
        <h1 class="text-4xl font-bold text-gray-600">{{ $post->name }}</h1>
        <div class="mb-2 text-lg text-gray-500">
            {{ $post->extract }}
        </div>
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <figure>
                    <img class="object-cover object-center w-full h-80" src="{{ $url }}" alt="">
                </figure>
                <div class="mt-4 text-base text-gray-500">
                    {{ $post->body }}
                </div>
            </div>
            <aside>
                <h1 class="mb-4 text-2xl font-bold text-gray-600">Más en {{ $post->category->name }}</h1>

                <ul>
                    @foreach ($similar_posts as $post)
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
                        <li class="mb-4">
                            <a class="flex" href="{{ route('posts.show', $post) }}">
                                <img class="object-cover object-center h-20 w-36" src="{{ $url }}"
                                    alt="{{ $post->name }}">
                                <span class="ml-2 text-gray-600">{{ $post->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>
        </div>
    </div>
</x-app-layout>
