<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateCategoryForm;
use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{
    public $categories;
    public CreateCategoryForm $createCategory;

    public function mount()
    {
        $this->categories = Category::orderBy('id', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.categories');
    }
}
