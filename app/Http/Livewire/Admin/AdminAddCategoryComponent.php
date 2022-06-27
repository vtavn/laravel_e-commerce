<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminAddCategoryComponent extends Component
{
    public $name;

    public function storeCategory()
    {
        $this->validate(
            [
                'name' => 'required|unique:categories,name',
            ],
            [
                'email.required' => 'The Name Address cannot be empty.',
                'email.unique' => 'The Name has already been taken.',
            ]
        );

        $category = new Category();
        $category->name = $this->name;
        $category->slug = Str::slug($category->name);
        $category->save();
        session()->flash('message','Category has been created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->layout('layouts.base');
    }
}
