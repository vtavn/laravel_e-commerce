<?php

namespace App\Http\Livewire;

use Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ShopComponent extends Component
{
    use WithPagination;
    public $sorting, $pageSize;

    public function render()
    {
        $witems = Cart::instance('wishlist')->content()->pluck('id');

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

        if(Auth::check())
        {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        return view('livewire.shop-component', compact('products', 'categories', 'witems'))->layout('layouts.base');
    }

    public function store($product_id, $product_name, $product_price)
    {
        
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item added in Cart');
        return redirect()->route('product.cart');
    }

    public function addTopWishList($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('wish-list-count-component', 'refreshComponent');
    }

    public function removeWishList($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $wItem)
        {
            if ($wItem->id == $product_id) {
                Cart::instance('wishlist')->remove($wItem->rowId);
                $this->emitTo('wish-list-count-component', 'refreshComponent');
                return;
            }
        }
    }

    public function mount()
    {
        $this->sorting = "default";
        $this->pageSize = 12;
    }

}
