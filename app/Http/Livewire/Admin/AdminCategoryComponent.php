<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    use WithPagination;
    
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        session()->flash('success', 'Category has been deleted successfully.');
    }

    public function render()
    {
        $categories = Category::paginate(5);
        
        return view('livewire.admin.admin-category-component', compact('categories'))->layout('layouts.base');
    }
}
