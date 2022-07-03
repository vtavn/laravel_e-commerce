@section('title')
{{__('Orderd Details')}} - {{ config('app.name', 'Laravel') }}
@endsection
<div>
    <div class="container pt-30">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('order_message'))
                    <div class="alert alert-success">{{ Session::get('order_message') }}</div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                {{ __('Orderd Details') }}
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('user.orders') }}" class="btn btn-success pull-right">{{ __('My Orders') }}</a>
                                @if ($order->status == 'orderd')
                                    <a href="#" class="btn btn-warning pull-right"
                                        wire:click.prevent="cancelOrder">{{ __('Cancel Order') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>{{ __('Order ID') }}</th>
                                <td>{{ $order->id }}</td>
                                <th>{{ __('Order Date') }}</th>
                                <td>{{ $order->created_at }}</td>
                                <th>{{ __('Status') }}</th>
                                <td>{{ $order->status }}</td>
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
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            {{ __('Orderd Items') }}
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="wrap-iten-in-cart">
                            <h3 class="box-title">{{ __('Products Name') }}</h3>
                            <ul class="products-cart">
                                @foreach ($order->orderItems as $item)
                                    <li class="pr-cart-item">
                                        <div class="product-image">
                                            <figure><img
                                                    src="{{ asset('assets/images/products') }}/{{ $item->product->image }}"
                                                    alt="{{ $item->product->name }}"></figure>
                                        </div>
                                        <div class="product-name">
                                            <a class="link-to-product"
                                                href="{{ route('product.details', ['slug' => $item->product->slug]) }}">{{ $item->product->name }}</a>
                                        </div>
                                        @if ($item->options)
                                            <div class="product-name">
                                                @foreach (unserialize($item->options) as $key => $value)
                                                    <p><b>{{$key}}: {{ $value}}</b></p>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="price-field product-price">
                                            <p class="price">{{ number_format($item->product->price) }}{{ __('$') }}</p>
                                        </div>
                                        <div class="price-field product-price">
                                            <p class="price">{{ number_format($item->quantity) }}</p>

                                        </div>
                                        <div class="price-field sub-total">
                                            <p class="price">{{ number_format($item->price * $item->quantity) }}{{ __('$') }}</p>
                                        </div>
                                        @if ($order->status == 'delivered' && $item->rstatus == false)
                                            <div class="price-field sub-total">
                                                <p class="price"><a href="{{route('user.review', ['order_item_id' => $order->id])}}">{{ __('Write Review') }}</a></p>
                                            </div>
                                        @endif

                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="summary">
                            <div class="order-summary">
                                <h4 class="title-box">{{ __('Order Summary') }}</h4>
                                <p class="summary-info"><span class="title">{{ __('Subtotal') }}</span><b
                                        class="index">{{ number_format($order->subtotal) }}{{ __('$') }}</b></p>
                                <p class="summary-info"><span class="title">{{ __('Tax') }}</span><b
                                        class="index">{{ number_format($order->tax) }}{{ __('$') }}</b></p>
                                <p class="summary-info"><span class="title">{{ __('Total') }}</span><b
                                        class="index">{{ number_format($order->total) }}{{ __('$') }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ __('Billing Details') }}
                    </div>
                    <div class="panel-body">
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
                                <th>{{ __('Address') }} 2</th>
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
        </div>

        @if ($order->is_shipping_different)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ __('Shipping Details') }}
                        </div>
                        <div class="panel-body">
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
                                    <th>{{ __('Address') }} 2</th>
                                    <td>{{ $order->shipping->address_2 }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('City') }}</th>
                                    <td>{{ $order->shipping->city }}</td>
                                    <th>{{ __('Province') }}</th>
                                    <td>{{ $order->shipping->province }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Country') }}</th>
                                    <td>{{ $order->shipping->country }}</td>
                                    <th>{{ __('ZipCode') }}</th>
                                    <td>{{ $order->shipping->zipcode }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ __('Transaction') }}
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>{{ __('Transaction Mode') }}</th>
                                <td>{{ $order->transaction->mode }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Status') }}</th>
                                <td>{{ $order->transaction->status }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Transaction Date') }}</th>
                                <td>{{ $order->transaction->created_at }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
