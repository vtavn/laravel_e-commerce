<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;

    public $name, $slug, $description, $content, $price, $sale_price, $sku, $stock_status, $featured, $quantity, $image, $category_id;

    public function mount()
    {
        $this->stock_status = 'instock';
        $this->featured = 0;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function addProduct()
    {
        $product = new Product();
        $product->name = $this->name;
        $product->description = $this->description;
        $product->content = $this->content;
        $product->price = $this->price;
        $product->sale_price = $this->sale_price;
        $product->sku = $this->sku;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        $product->category_id = $this->category_id;
        $product->slug = $this->slug;
        $imageName = Carbon::now()->timestamp. '.' . $this->image->extension();
        $this->image->storeAs('products', $imageName);
        $product->image = $imageName;
        $product->save();
        session()->flash('message', 'Product has been created successfully.');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-add-product-component', compact('categories'))->layout('layouts.base');
    }
}
