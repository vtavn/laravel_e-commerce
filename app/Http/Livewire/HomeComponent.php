<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\HomeCategory;

class HomeComponent extends Component
{
    public function render()
    {
        $sliders = HomeSlider::where('status', '1')->orderBy('created_at', 'DESC')->get();
        $lastProducts = Product::orderBy('created_at', 'DESC')->get()->take(8);
        $category = HomeCategory::find(1);
        $cats = explode(',', $category->categories);
        $categories = Category::whereIn('id', $cats)->get();
        $numberOfProducts = $category->products;
        $saleProducts = Product::where('sale_price', '>', 0)->inRandomOrder()->get()->take(8);
        $sale = Sale::find(1);
        return view('livewire.home-component', compact('sliders', 'lastProducts', 'categories', 'numberOfProducts', 'saleProducts', 'sale'))->layout('layouts.base');
    }
}
