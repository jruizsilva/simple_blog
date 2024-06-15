<?php

namespace App\Livewire\Forms;

use App\Models\Tag;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;

class EditTagForm extends Form
{
    public $open = false;
    #[Validate('required|min:3|unique:tags')]
    public $name;
    public $slug;
    public $tagId;

    public function edit($tagId)
    {
        $this->resetValidation();
        $this->open = true;
        $this->tagId = $tagId;
        $tag = Tag::find($tagId);
        $this->name = $tag->name;
    }

    public function update()
    {
        $this->validate();
        $tag = Tag::find($this->tagId);
        $this->slug = Str::slug($this->name);
        $tag->update($this->only(['name', 'slug']));
        $this->reset();
    }
}
