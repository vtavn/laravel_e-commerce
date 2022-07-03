<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        session()->flash('message', 'Category has been deleted successfully.');
    }

    public function deleteSubCategory($id)
    {
        $scategory = SubCategory::find($id);
        $scategory->delete();
        session()->flash('message', 'SubCategory has been deleted successfully.');
    }

    public function render()
    {
        $categories = Category::paginate(5);
        
        return view('livewire.admin.admin-category-component', compact('categories'))->layout('layouts.admin');
    }
}
