<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateTagForm;
use App\Livewire\Forms\EditTagForm;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Tags extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    public CreateTagForm $createTag;
    public EditTagForm $editTag;
    public $open;
    public $categoryId;

    public function save()
    {
        $this->createTag->save();
        $this->dispatch('tagCreated');
    }

    public function edit($categoryId)
    {
        $this->editTag->edit($categoryId);
    }

    public function update()
    {
        $this->editTag->update();
        $this->dispatch('tagUpdated');
    }

    public function confirmDelete($categoryId)
    {
        $this->open = true;
        $this->categoryId = $categoryId;
    }

    public function destroy()
    {
        Tag::destroy($this->categoryId);
        $this->reset(['open', 'categoryId']);
        $this->dispatch('tagDeleted');
    }

    public function render()
    {
        $tags = Tag::orderBy('id', 'desc')->paginate(3);
        $data = [
            'tags' => $tags
        ];

        return view('livewire.tags', $data);
    }
}
