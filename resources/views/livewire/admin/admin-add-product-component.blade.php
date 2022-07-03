@section('title')
    {{ __('Add Product') }}
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Add Product') }}</h3>

                        <div class="card-tools">
                            <a href="{{ route('admin.products') }}"
                                class="btn btn-success btn-sm pull-right">{{ __('All Products') }}</a>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <form class="form-horizontal" encrypted="multipart/form-data" action=""
                            wire:submit.prevent="addProduct">

                            <div class="form-group">
                                <label class="control-label ">{{ __('Product Name') }}</label>
                                <div class="">
                                    <input type="text" placeholder="{{ __('Product Name') }}" class="form-control input-md"
                                        wire:model="name" wire:keyup="generateSlug" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Product Slug') }}</label>
                                <div class="">
                                    <input type="text" placeholder="Product Slug" class="form-control input-md"
                                        wire:model="slug" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Description') }}</label>
                                <div class="">
                                    <textarea class="form-control" placeholder="Description" wire:model="description" wire:ignore></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Content') }}</label>
                                <div class="">
                                    <textarea class="form-control" placeholder="Content" wire:model="content" wire:ignore></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Price') }}</label>
                                <div class="">
                                    <input type="text" placeholder="Product Price" class="form-control input-md"
                                        wire:model="price" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Sale Price') }}</label>
                                <div class="">
                                    <input type="text" placeholder="Product Sale Price" class="form-control input-md"
                                        wire:model="sale_price" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Stock') }}</label>
                                <div class="">
                                    <select class="form-control" wire:model="category_id">
                                        <option value="instock">{{ __('In Stock') }}</option>
                                        <option value="outofstock">{{ __('Out Of Stock') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Featured') }}</label>
                                <div class="">
                                    <select class="form-control" wire:model="featured">
                                        <option value="0">{{ __('No') }}</option>
                                        <option value="1">{{ __('Yes') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Quantity') }}</label>
                                <div class="">
                                    <input type="text" placeholder="Product Quantity" class="form-control input-md"
                                        wire:model="quantity" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('SKU') }}</label>
                                <div class="">
                                    <input type="text" placeholder="SKU" class="form-control input-md"
                                        wire:model="sku" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Product Image') }}</label>
                                <div class="">
                                    <input type="file" class="input-file" wire:model="image" />
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" width="120" />
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Product Gallery') }}</label>
                                <div class="">
                                    <input type="file" multiple class="input-file" wire:model="images" />
                                    @if ($images)
                                        @foreach ($images as $image)
                                            <img src="{{ $image->temporaryUrl() }}" width="120" />
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Category') }}</label>
                                <div class="">
                                    <select class="form-control" wire:model="category_id"
                                        wire:change="changeSubcategory">
                                        <option value="">{{ __('Select Category') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Sub Category') }}</label>
                                <div class="">
                                    <select class="form-control" wire:model="scategory_id">
                                        <option value="0">{{ __('Select Sub Category') }}</option>
                                        @foreach ($scategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Product Attributes') }}</label>
                                <div class="col-lg-3">
                                    <select class="form-control" wire:model="attr">
                                        <option value="0">{{ __('Select Attribute') }}</option>
                                        @foreach ($pattributes as $pattribute)
                                            <option value="{{ $pattribute->id }}">{{ $pattribute->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-1">
                                    <button type="button" class="btn btn-info"
                                        wire:click.prevent="add">{{ __('Add') }}</button>
                                </div>
                            </div>

                            @foreach ($inputs as $key => $value)
                                <div class="form-group">
                                    <label class="control-label ">{{ $pattributes->where('id', $attribute_arr[$key])->first()->name }}</label>
                                    <div class="col-md-3">
                                        <input type="text"
                                            placeholder="{{ $pattributes->where('id', $attribute_arr[$key])->first()->name }}"
                                            class="form-control input-md"
                                            wire:model="attribute_values.{{ $value }}" />
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            wire:click.prevent="remove({{ $key }})">{{ __('Remove') }}</button>
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label class="control-label "></label>
                                <div class="">
                                    <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
