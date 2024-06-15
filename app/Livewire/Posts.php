<?php

namespace App\Livewire;

use App\Livewire\Forms\CreatePostForm;
use App\Livewire\Forms\EditPostForm;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    public $search;
    public $categories;
    public $tags;
    public CreatePostForm $createPost;
    public EditPostForm $editPost;

    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function save()
    {
        $this->createPost->save();
    }

    public function render()
    {
        $posts = Post::orderBy('id', 'desc')
            ->where('user_id', auth()->user()->id)
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate(5);
        $data = [
            'posts' => $posts
        ];

        return view('livewire.posts', $data);
    }
}
