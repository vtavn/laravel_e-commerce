<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\AttributeValue;
use Illuminate\Support\Carbon;
use App\Models\ProductAttribute;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;

    public $name, $slug, $description, $content, $price, $sale_price, $sku, $stock_status, $featured, $quantity, $image, $category_id, $images, $scategory_id, $attr, $inputs = [], $attribute_arr = [], $attribute_values;

    public function mount()
    {
        $this->stock_status = 'instock';
        $this->featured = 0;
    }

    public function add()
    {
        if (!in_array($this->attr, $this->attribute_arr)) {
            array_push($this->inputs, $this->attr);
            array_push($this->attribute_arr, $this->attr);
        }
    }

    public function remove($attr)
    {
        unset($this->inputs[$attr]);
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
        if($this->images)
        {
            $imagesImage = '';
            foreach($this->images as $key => $image)
            {
                $imgName = Carbon::now()->timestamp. $key . '.' . $image->extension();
                $image->storeAs('products', $imgName);
                $imagesImage = $imagesImage . ',' . $imgName;
            }
            $product->images = $imagesImage;
        }
        if($this->scategory_id)
        {
            // $product->subcategory_id = $this->scategory_id;
            $product->subcategory_id = implode(',', $this->scategory_id);
        }
        $product->save();
        if($this->attribute_values !== null) {
            foreach($this->attribute_values as $key =>$attribute_value)
            {
                $avalues = explode(',', $attribute_value);
                foreach ($avalues as $avalue) {
                    $attr_value = new AttributeValue();
                    $attr_value->product_attribute_id = $key;
                    $attr_value->value = $avalue;
                    $attr_value->product_id = $product->id;
                    $attr_value->save();
                }
            }
        }
        

        session()->flash('message', 'Product has been created successfully.');
    }

    public function changeSubcategory() {
        $this->scategory_id = 0;
    }
    
    public function render()
    {
        $categories = Category::all();
        $scategories = SubCategory::all();
        $pattributes = ProductAttribute::all();

        return view('livewire.admin.admin-add-product-component', compact('categories', 'scategories', 'pattributes'))->layout('layouts.admin');
    }
}
