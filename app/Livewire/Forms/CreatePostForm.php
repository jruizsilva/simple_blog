<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;

class CreatePostForm extends Form
{
    public $open = false;
    // #[Validate('required|min:3|unique:posts')]
    public $name;
    public $slug;
    // #[Validate('required|exists:categories,id')]
    public $category_id = "";
    // #[Validate('required|in:1,2')]
    public $status;
    public $tags = [];
    public $extract;
    public $user_id;
    public $body;

    protected function rules()
    {
        $rules = [
            'name' => 'required|min:3|unique:posts',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:1,2',
        ];

        if ($this->status == 2) {
            $rules['tags'] = 'required';
            $rules['extract'] = 'required';
            $rules['body'] = 'required';
        }

        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();
        $this->user_id = auth()->user()->id;
        $this->slug = Str::slug($this->name);
        $post = Post::create(
            $this->only(['name', 'slug', 'category_id', 'status', 'extract', 'body', 'user_id'])
        );
        if ($this->tags) {
            $post->tags()->attach($this->tags);
        }
        $this->reset();
    }
}
