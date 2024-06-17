<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class EditPostForm extends Form
{
    public $open = false;
    public $name;
    public $slug;
    public $category_id = "";
    public $status;
    public $tags = [];
    public $extract;
    public $user_id;
    public $body;
    public $image;
    public $image_preview;
    public $postId;

    protected function rules()
    {
        $rules = [
            'name' => [
                'required',
                'min:3',
                Rule::unique('posts', 'name')->ignore($this->postId),
            ],
            'category_id' => [
                'required',
                Rule::exists('categories', 'id'),
            ],
            'status' => [
                'required',
                Rule::in([1, 2]),
            ],
            'image' => [
                'nullable',
                'image',
                'max:2048', // 2MB
                'mimes:jpeg,jpg,png'
            ]
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

    public function edit(Post $post)
    {
        $this->resetValidation();
        $this->open = true;
        $this->postId = $post->id;
        $this->name = $post->name;
        $this->category_id = $post->category_id;
        $this->status = $post->status;
        $this->tags = $post->tags->pluck('id')->toArray();
        $this->extract = $post->extract;
        $this->body = $post->body;
        $this->image_preview = $post->image;
    }

    public function update()
    {
        $this->validate();
        $post = Post::find($this->postId);
        $this->slug = Str::slug($this->name);
        $post->update($this->only(['name', 'slug', 'category_id', 'status', 'extract', 'body']));
        $post->tags()->sync($this->tags);
        if ($this->image) {
            Storage::delete($post->image->url);

            $url = $this->image->store('posts');
            $post->image()->update([
                'url' => $url
            ]);
        }
        $this->reset();
    }
}
