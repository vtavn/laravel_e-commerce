<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;

class ShopComponent extends Component
{
    use WithPagination;
    public $sorting, $pageSize;

    public function render()
    {
        if($this->sorting == 'date')
        {
            $products = Product::orderBy('created_at', 'desc')->paginate($this->pageSize);
        } else if($this->sorting == 'price') {
            $products = Product::orderBy('price', 'asc')->paginate($this->pageSize);
        } else if($this->sorting == 'price-desc') {
            $products = Product::orderBy('price', 'desc')->paginate($this->pageSize);
        } else {
            $products = Product::paginate($this->pageSize);
        }

        $categories = Category::all();

        return view('livewire.shop-component', compact('products', 'categories'))->layout('layouts.base');
    }

    public function store($product_id, $product_name, $product_price)
    {
        
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item added in Cart');
        return redirect()->route('product.cart');
    }

    public function mount()
    {
        $this->sorting = "default";
        $this->pageSize = 12;
    }

}
