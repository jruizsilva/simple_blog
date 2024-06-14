<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Navigation extends Component
{
    public function render()
    {
        $categories = Category::all();
        $data = [
            'categories' => $categories
        ];
        return view('livewire.navigation', $data);
    }
}
