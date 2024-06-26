<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateCategoryForm;
use App\Livewire\Forms\EditCategoryForm;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    public CreateCategoryForm $createCategory;
    public EditCategoryForm $editCategory;
    public $open;
    public $categoryId;

    public function mount()
    {
    }

    public function save()
    {
        $this->createCategory->save();
        $this->dispatch('categoryCreated');
    }

    public function edit($categoryId)
    {
        $this->editCategory->edit($categoryId);
    }
    public function update()
    {
        $this->editCategory->update();
        $this->dispatch('categoryUpdated');
    }
    public function confirmDelete($categoryId)
    {
        $this->open = true;
        $this->categoryId = $categoryId;
    }

    public function destroy()
    {
        Category::destroy($this->categoryId);
        $this->reset(['open', 'categoryId']);
        $this->dispatch('categoryDeleted');
    }

    public function render()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(3);
        $data = [
            'categories' => $categories,
        ];
        return view('livewire.categories', $data);
    }
}
