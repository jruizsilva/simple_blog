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
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('admin.categories');
    }
}
