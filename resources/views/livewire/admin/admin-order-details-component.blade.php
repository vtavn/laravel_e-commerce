@section('title')
    {{ __('Orderd Details') }}
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Orderd Details') }}</h3>

                        <div class="card-tools">
                            <a href="{{ route('admin.orders') }}"
                                class="btn btn-success btn-sm pull-right">{{ __('All Orders') }}</a>
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
                        <table class="table table-hover text-nowrap">
                            <tr>
                                <th>{{ __('Order ID') }}</th>
                                <td>{{ $order->id }}</td>
                                <th>{{ __('Order Date') }}</th>
                                <td>{{ $order->created_at }}</td>
                                <th>{{ __('Status') }}</th>
                                <td>@if ($order->status=='ordered')
                                    <span class="badge bg-warning">{{ __('Ordered') }}</span>
                                @elseif ($order->status=='delivered')
                                    <span class="badge bg-success">{{ __('Delivered') }}</span>
                                @elseif ($order->status=='canceled')
                                    <span class="badge bg-danger">{{ __('Canceled') }}</span>
                                @endif</td>
                                @if ($order->status == 'delivered')
                                    <th>{{ __('Delivery Date') }}</th>
                                    <td>{{ $order->delivered_date }}</td>
                                @elseif ($order->status == 'canceled')
                                    <th>{{ __('Cancellation Date') }}</th>
                                    <td>{{ $order->canceled_date }}</td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Orderd Items') }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                    <th>{{ __('Total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td><img
                                            src="{{ asset('assets/images/products') }}/{{ $item->product->image }}"
                                            alt="{{ $item->product->name }}" width="100">
                                        </td>
                                        <td><a class="link-to-product"
                                                href="{{ route('product.details', ['slug' => $item->product->slug]) }}">{{ $item->product->name }}</a>
                                        </td>
                                        <td>{{ number_format($item->product->price) }}{{ __('$') }}</td>
                                        <td>{{ number_format($item->quantity) }}</td>
                                        <td>{{ number_format($item->price * $item->quantity) }}{{ __('$') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-lg-6 col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>{{ __('Order Summary') }}</td>
                                        <th>{{ number_format($order->subtotal) }}{{ __('$') }}</th>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Tax') }}</td>
                                        <th>{{ number_format($order->tax) }}{{ __('$') }}</th>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Total') }}</td>
                                        <th>{{ number_format($order->total) }}{{ __('$') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Billing Details') }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table">
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <td>{{ $order->firstname }} {{ $order->lastname }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Phone') }}</th>
                                <td>{{ $order->phone }}</td>
                                <th>{{ __('Email') }}</th>
                                <td>{{ $order->email }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Address') }}</th>
                                <td>{{ $order->address }}</td>
                                <th>{{ __('Address 2') }}</th>
                                <td>{{ $order->address_2 }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('City') }}</th>
                                <td>{{ $order->city }}</td>
                                <th>{{ __('Province') }}</th>
                                <td>{{ $order->province }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('example') }}</th>
                                <td>{{ $order->country }}</td>
                                <th>{{ __('ZipCode') }}</th>
                                <td>{{ $order->zipcode }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            @if ($order->is_shipping_different)
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Shipping Details') }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table">
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <td>{{ $order->shipping->firstname }} {{ $order->shipping->lastname }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Phone') }}</th>
                                <td>{{ $order->shipping->phone }}</td>
                                <th>{{ __('Email') }}</th>
                                <td>{{ $order->shipping->email }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Address') }}</th>
                                <td>{{ $order->shipping->address }}</td>
                                <th>{{ __('Address 2') }}</th>
                                <td>{{ $order->shipping->address_2 }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('City') }}</th>
                                <td>{{ $order->shipping->city }}</td>
                                <th>{{ __('Province') }}</th>
                                <td>{{ $order->shipping->province }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('example') }}</th>
                                <td>{{ $order->shipping->country }}</td>
                                <th>{{ __('ZipCode') }}</th>
                                <td>{{ $order->shipping->zipcode }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
