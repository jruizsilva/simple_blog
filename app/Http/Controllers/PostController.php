<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

use function Pest\Laravel\get;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 2)->latest('id')->paginate(8);

        $data = [
            'posts' => $posts
        ];

        return view('posts.index', $data);
    }

    public function show(Post $post)
    {
        $similar_posts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('status', 2)
            ->latest('id')
            ->limit(4)
            ->get();
        $data = [
            'post' => $post,
            'similar_posts' => $similar_posts
        ];
        return view('posts.show', $data);
    }

    public function category(Category $category)
    {
        $posts = Post::where('category_id', $category->id)
            ->where('status', 2)
            ->latest('id')
            ->paginate(2);
        $data = [
            'posts' => $posts,
            'category' => $category
        ];
        return view('posts.category', $data);
    }

    public function tag(Tag $tag)
    {
        $posts = $tag->posts()->where('status', 2)->latest()->paginate(2);

        $data = [
            'posts' => $posts,
            'tag' => $tag
        ];

        return view('posts.tag', $data);
    }
}
