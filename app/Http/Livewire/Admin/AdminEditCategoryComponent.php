<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminEditCategoryComponent extends Component
{
    public $category_slug, $category_id, $name, $slug;

    public function mount($category_slug)
    {
        $this->category_slug = $category_slug;
        $category = Category::where('slug', $category_slug)->first();
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
    }

    public function storeUpdateCategory()
    {
        $category = Category::find($this->category_id);

        $this->validate(
            [
                'name' => 'required|unique:categories,name,'.$category->id,
            ],
            [
                'email.required' => 'The Name Address cannot be empty.',
                'email.unique' => 'The Name has already been taken.',
            ]
        );

        $category->name = $this->name;
        $category->slug = Str::slug($this->name);
        $category->save();
        session()->flash('message', 'Category has been updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-category-component')->layout('layouts.base');
    }
}
