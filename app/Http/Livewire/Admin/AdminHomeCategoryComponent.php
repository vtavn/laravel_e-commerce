<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\HomeCategory;

class AdminHomeCategoryComponent extends Component
{

    public $selectCategories, $numberOfProducts;

    public function mount()
    {
        $category = HomeCategory::find(1);
        $this->selectCategories = explode(',', $category->categories);
        $this->numberOfProducts = $category->products;
    }

    public function updateHomeCategory()
    {
        $category = HomeCategory::find(1);
        $category->categories = implode(',', $this->selectCategories);
        $category->products = $this->numberOfProducts;
        $category->save();
        session()->flash('message', 'Home Category updated successfully.');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-home-category-component', compact('categories'))->layout('layouts.base');
    }
}
