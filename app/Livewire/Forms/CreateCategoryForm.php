<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateCategoryForm extends Form
{
    public $open = false;
    public $name;
    public $slug;
}
