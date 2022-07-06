@section('title')
    {{ __('Edit Product') }}
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Edit Product') }}</h3>

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
                            wire:submit.prevent="updateProduct">

                            <div class="form-group">
                                <label class="control-label ">{{ __('Product Name') }}</label>
                                <div class="">
                                    <input type="text" placeholder="Product Name" class="form-control input-md"
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
                                    <textarea class="form-control" placeholder="Description" wire:model="description"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Content') }}</label>
                                <div class="">
                                    <textarea class="form-control" placeholder="Content" wire:model="content"></textarea>
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
                                        wire:model="SKU" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Product Image') }}</label>
                                <div class="">
                                    <input type="file" class="input-file" wire:model="newImage" />
                                    @if ($newImage)
                                        <img src="{{ $newImage->temporaryUrl() }}" width="120" />
                                    @else
                                        <img src="{{ asset('assets/images/products') }}/{{ $image }}"
                                            width="120" />
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Product Gallery') }}</label>
                                <div class="">
                                    <input type="file" multiple class="input-file" wire:model="newImages" />
                                    @if ($newImages)
                                        @foreach ($newImages as $image)
                                            <img src="{{ $image->temporaryUrl() }}" width="120" />
                                        @endforeach
                                    @else
                                        @php
                                            $imgs = explode(',', $images);
                                        @endphp

                                        @foreach ($imgs as $img)
                                            @if ($img)
                                                <img src="{{ asset('assets/images/products') }}/{{ $img }}"
                                                    width="120" />
                                            @endif
                                        @endforeach
                                    @endif


                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Category') }}</label>
                                <div class="">
                                    <select class="form-control" wire:model="category_id"
                                        wire:change="changeSubcategory">
                                        <option value="0">{{ __('Select Category') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="form-group">
                                <label class="control-label ">{{ __('Sub Category') }}</label>
                                <div class="">
                                    <select class="form-control" wire:model="scategory_id">
                                        <option value="0">{{ __('Select Sub Category') }}</option>
                                        @foreach ($scategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                            <div class="form-group">
                                <label class="col-md-4 control-label">{{ __('Choose Categories') }}</label>
                                <div class="col-md-4" wire:ignore>
                                    <select name="categories[]" multiple="multiple" class="select_categories form-control" wire:model="scategory_id">
                                        @foreach ($scategories as $category)
                                            <option
                                            @if ($scategory_id != null)
                                                @if (in_array($category->id, $scategory_id))
                                                    selected
                                                @endif
                                            @endif
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label ">{{ __('Product Attributes') }}</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <select class="form-control" wire:model="attr">
                                            <option value="0">{{ __('Select Attribute') }}</option>
                                            @foreach ($pattributes as $pattribute)
                                                <option value="{{ $pattribute->id }}">{{ $pattribute->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info"
                                            wire:click.prevent="add">{{ __('Add') }}</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @foreach ($inputs as $key => $value)
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label
                                                class="control-label ">{{ $pattributes->where('id', $attribute_arr[$key])->first()->name }}</label>
                                            <div class="row">
                                                <div class="col-md-6">
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
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label class="control-label "></label>
                                <div class="">
                                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
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

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.select_categories').select2({
                theme: 'bootstrap4'
            });
            $('.select_categories').on('change', function(e){
                var data = $('.select_categories').select2("val");
                @this.set('scategory_id', data);
            });
            
        });
    </script>
@endpush
