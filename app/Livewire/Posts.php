<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
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
