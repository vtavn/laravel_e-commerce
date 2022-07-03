@section('title')
    {{ __('All Products') }}
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Products') }}</h3>

                        <div class="card-tools">
                            <a href="{{ route('admin.products.add') }}"
                                class="btn btn-success btn-sm pull-right">{{ __('Add Product') }}</a>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        @if (Session::has('message'))
                            <div class="alert alert-success"> {{ Session::get('message') }} </div>
                        @endif
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('Id') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Stock') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Sale Price') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td><img src="{{ asset('assets/images/products') }}/{{ $product->image }}"
                                            alt="" width=60></td>
                                    <td>{{ $product->stock_status }}</td>
                                    <td>{{ number_format($product->price) }}</td>
                                    <td>{{ number_format($product->sale_price) }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.products.edit', ['product_slug' => $product->slug]) }}"><i
                                                class="fa fa-edit fa-2x text-info"></i></a>
                                        <a href="#"
                                            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                            style="margin-left: 10px;"
                                            wire:click.prevent="deleteProduct({{ $product->id }})"><i
                                                class="fa fa-times fa-2x text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
