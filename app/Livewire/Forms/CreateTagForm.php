<?php

namespace App\Livewire\Forms;

use App\Models\Tag;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;

class CreateTagForm extends Form
{
    public $open = false;
    #[Validate('required|min:3|unique:tags')]
    public $name;
    public $slug;
    public $color;

    public function save()
    {
        $this->slug = Str::slug($this->name);
        $this->color =  fake()->hexColor();
        Tag::create(
            $this->only(['name', 'slug', 'color'])
        );
        $this->reset();
    }
}
