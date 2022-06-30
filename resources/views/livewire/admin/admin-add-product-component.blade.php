<div>
    <div class="container pt-30">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add Product
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.products')}}" class="btn btn-success pull-right">All Products</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <form class="form-horizontal" encrypted="multipart/form-data" action="" wire:submit.prevent="addProduct">

                            <div class="form-group">
                                <label class="control-label col-md-4">Product Name</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Product Name" class="form-control input-md" wire:model="name" wire:keyup="generateSlug"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Product Slug</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Product Slug" class="form-control input-md" wire:model="slug" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Description</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" placeholder="Description" wire:model="description" wire:ignore></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Content</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" placeholder="Content" wire:model="content" wire:ignore></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Price</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Product Price" class="form-control input-md" wire:model="price" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Sale Price</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Product Sale Price" class="form-control input-md" wire:model="sale_price" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Stock</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model="category_id">
                                        <option value="instock">In Stock</option>
                                        <option value="outofstock">Out Of Stock</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Featured</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model="featured">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Quantity</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Product Quantity" class="form-control input-md" wire:model="quantity" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">SKU</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="SKU" class="form-control input-md" wire:model="sku" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Product Image</label>
                                <div class="col-md-4">
                                    <input type="file" class="input-file" wire:model="image" />
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" width="120" />
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Product Gallery</label>
                                <div class="col-md-4">
                                    <input type="file" multiple class="input-file" wire:model="images" />
                                    @if ($images)
                                        @foreach ($images as $image)
                                            <img src="{{ $image->temporaryUrl() }}" width="120" />
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Category</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model="category_id" wire:change="changeSubcategory">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Sub Category</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model="scategory_id">
                                        <option value="0">Select Sub Category</option>
                                        @foreach ($scategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Product Attributes</label>
                                <div class="col-md-3">
                                    <select class="form-control" wire:model="attr">
                                        <option value="0">Select Attribute</option>
                                        @foreach ($pattributes as $pattribute)
                                            <option value="{{ $pattribute->id }}">{{ $pattribute->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-info" wire:click.prevent="add">Add</button>
                                </div>
                            </div>

                            @foreach ($inputs as $key => $value)
                                <div class="form-group">
                                    <label class="control-label col-md-4">{{$pattributes->where('id', $attribute_arr[$key])->first()->name}}</label>
                                    <div class="col-md-3">
                                        <input type="text" placeholder="{{$pattributes->where('id', $attribute_arr[$key])->first()->name}}" class="form-control input-md" wire:model="attribute_values.{{$value}}" />
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})">Remove</button>
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label class="control-label col-md-4"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Add Product</button>
                                </div>
                                
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
