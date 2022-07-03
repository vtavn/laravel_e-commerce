<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class AdminEditCategoryComponent extends Component
{
    public $category_slug, $category_id, $name, $slug, $scategory_id, $scategory_slug;

    public function mount($category_slug,$scategory_slug=null)
    {
        if($scategory_slug)
        {
            $this->scategory_slug = $scategory_slug;
            $scategory = SubCategory::where('slug', $scategory_slug)->first();
            $this->scategory_id = $scategory->id;
            $this->category_id = $scategory->category_id;
            $this->name = $scategory->name;
            $this->slug = $scategory->slug;
        } else {
            $this->category_slug = $category_slug;
            $category = Category::where('slug', $category_slug)->first();
            $this->category_id = $category->id;
            $this->name = $category->name;
            $this->slug = $category->slug;
        }
        
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
        if($this->scategory_id)
        {
            $scategory = SubCategory::find($this->scategory_id);
            $scategory->name = $this->name;
            $scategory->slug = $this->slug;
            $scategory->category_id = $this->category_id;
            $scategory->save();
        } else {
            $category->name = $this->name;
            $category->slug = Str::slug($this->name);
            $category->save();
        }
        
        session()->flash('message', 'Category has been updated successfully.');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-edit-category-component', compact('categories'))->layout('layouts.admin');
    }
}
