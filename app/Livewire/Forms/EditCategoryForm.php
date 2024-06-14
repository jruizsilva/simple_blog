<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;

class EditCategoryForm extends Form
{
    public $open = false;
    #[Validate('required|min:3|unique:categories')]
    public $name;
    public $slug;
    public $categoryId;

    public function edit($categoryId)
    {
        $this->resetValidation();
        $this->open = true;
        $this->categoryId = $categoryId;
        $category = Category::find($categoryId);
        $this->name = $category->name;
    }

    public function update()
    {
        $this->validate();
        $category = Category::find($this->categoryId);
        $this->slug = Str::slug($this->name);
        $category->update($this->only(['name', 'slug']));
        $this->reset();
    }
}
