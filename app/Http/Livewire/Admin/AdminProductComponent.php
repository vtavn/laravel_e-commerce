<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchItem;
    
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        
        if($product->image)
        {
            unlink('assets/images/products/'.$product->image);
        }
        if($product->images)
        {

            $images = explode(',', $product->images);
            foreach($images as $image)
            {
                if($image)
                {
                    unlink('assets/images/products/'.$image);
                }
            }
        }

        $product->delete();
        session()->flash('message', 'Product has been deleted successfully.');
    }

    public function render()
    {
        $search = '%'.$this->searchItem.'%';

        $products = Product::where('name', 'LIKE', $search)
                            ->orWhere('stock_status', 'LIKE', $search)
                            ->orWhere('price', 'LIKE', $search)
                            ->orWhere('sale_price', 'LIKE', $search)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        return view('livewire.admin.admin-product-component', compact('products'))->layout('layouts.admin');
    }
}
