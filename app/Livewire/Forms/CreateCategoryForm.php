<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;

class CreateCategoryForm extends Form
{
    public $open = false;
    #[Validate('required|min:3|unique:categories')]
    public $name;
    public $slug;

    public function save()
    {
        $this->slug = Str::slug($this->name);
        Category::create(
            $this->only(['name', 'slug'])
        );
    }
}
