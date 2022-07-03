<?php

namespace App\Http\Livewire;

use Cart;
use App\Models\Product;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\WithPagination;


class CategoryComponent extends Component
{
    use WithPagination;
    public $sorting, $pageSize, $category_slug, $scategory_slug;

    public function mount($category_slug, $scategory_slug=null)
    {
        $this->sorting = "default";
        $this->pageSize = 12;
        $this->category_slug = $category_slug;
        $this->scategory_slug = $scategory_slug;
    }

    public function store($product_id, $product_name, $product_price)
    {
        
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item added in Cart');
        return redirect()->route('product.cart');
    }

    public function render()
    {
        $category_id = null;
        $category_name = "";
        $filter = "";

        if($this->scategory_slug)
        {
            $scategory = SubCategory::where('slug', $this->scategory_slug)->first();
            $category_id = $scategory->id;
            $category_name = $scategory->name;
            $filter = "sub";
        } else {
            $category = Category::where('slug', $this->category_slug)->first();
            $category_id = $category->id;
            $category_name = $category->name;
            $filter = "";
        }

        if($this->sorting == 'date')
        {
            $products = Product::where($filter.'category_id', $category_id)->orderBy('created_at', 'desc')->paginate($this->pageSize);
        } else if($this->sorting == 'price') {
            $products = Product::where($filter.'category_id', $category_id)->orderBy('price', 'asc')->paginate($this->pageSize);
        } else if($this->sorting == 'price-desc') {
            $products = Product::where($filter.'category_id', $category_id)->orderBy('price', 'desc')->paginate($this->pageSize);
        } else {
            $products = Product::where($filter.'category_id', $category_id)->paginate($this->pageSize);
        }

        $categories = Category::all();
        $setting = Setting::find(1);
        return view('livewire.category-component', compact('products', 'categories', 'category_name', 'setting'))->layout('layouts.base');
    }
}
