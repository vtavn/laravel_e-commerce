<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class AdminAddCategoryComponent extends Component
{
    public $name;
    public $parent_id;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:categories',
        ]);
    }

    public function storeCategory()
    {
        $this->validate(
            [
                'name' => 'required|unique:categories',
            ]
        );

        if($this->parent_id)
        {
            $s_category = new SubCategory();
            $s_category->name = $this->name;
            $s_category->slug = Str::slug($s_category->name);
            $s_category->category_id = $this->parent_id;
            $s_category->save();
        } else {
            $category = new Category();
            $category->name = $this->name;
            $category->slug = Str::slug($category->name);
            $category->save();
        }
        session()->flash('message', 'Category has been created successfully.');
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.admin.admin-add-category-component', compact('categories'))->layout('layouts.base');
    }

}
