@section('title')
{{__('Dashboard')}} - {{ config('app.name', 'Laravel') }}
@endsection
<div>
    <div class="content">
        <style>
            .content {
                padding-top: 40px;
                padding-bottom: 40px;
            }

            .icon-stat {
                display: block;
                overflow: hidden;
                position: relative;
                padding: 15px;
                margin-bottom: 1em;
                background-color: #fff;
                border-radius: 4px;
                border: 1px solid #ddd;
            }

            .icon-stat-label {
                display: block;
                color: #999;
                font-size: 13px;
            }

            .icon-stat-value {
                display: block;
                font-size: 28px;
                font-weight: 600;
            }

            .icon-stat-visual {
                position: relative;
                top: 22px;
                display: inline-block;
                width: 32px;
                height: 32px;
                border-radius: 4px;
                text-align: center;
                font-size: 16px;
                line-height: 30px;
            }

            .bg-primary {
                color: #fff;
                background: #d74b4b;
            }

            .bg-secondary {
                color: #fff;
                background: #6685a4;
            }

            .icon-stat-footer {
                padding: 10px 0 0;
                margin-top: 10px;
                color: #aaa;
                font-size: 12px;
                border-top: 1px solid #eee;
            }
        </style>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="icon-stat">
                        <div class="row">
                            <div class="col-xs-8 text-left">
                                <span class="icon-stat-label">{{ __('Total Cost') }}</span>
                                <span class="icon-stat-value">{{ number_format($totalCost) }}$</span>
                            </div>
                            <div class="col-xs-4 text-center">
                                <i class="fa fa-dollar icon-stat-visual bg-primary"></i>
                            </div>
                        </div>
                        <div class="icon-stat-footer">
                            <i class="fa fa-clock-o"></i> {{ __('Updated Now') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="icon-stat">
                        <div class="row">
                            <div class="col-xs-8 text-left">
                                <span class="icon-stat-label">{{ __('Total Purchase') }}</span>
                                <span class="icon-stat-value">{{ number_format($totalPurchase) }}</span>
                            </div>
                            <div class="col-xs-4 text-center">
                                <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
                            </div>
                        </div>
                        <div class="icon-stat-footer">
                            <i class="fa fa-clock-o"></i> {{ __('Updated Now') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="icon-stat">
                        <div class="row">
                            <div class="col-xs-8 text-left">
                                <span class="icon-stat-label">{{ __('Today Delivery') }}</span>
                                <span class="icon-stat-value">{{ number_format($totalDeliverd) }}</span>
                            </div>
                            <div class="col-xs-4 text-center">
                                <i class="fa fa-dollar icon-stat-visual bg-primary"></i>
                            </div>
                        </div>
                        <div class="icon-stat-footer">
                            <i class="fa fa-clock-o"></i> {{ __('Updated Now') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="icon-stat">
                        <div class="row">
                            <div class="col-xs-8 text-left">
                                <span class="icon-stat-label">{{ __('Today Cancel') }}</span>
                                <span class="icon-stat-value">{{ number_format($totalCanceled) }}</span>
                            </div>
                            <div class="col-xs-4 text-center">
                                <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
                            </div>
                        </div>
                        <div class="icon-stat-footer">
                            <i class="fa fa-clock-o"></i> {{ __('Updated Now') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ __('Latest Orders') }}
                        </div>
                        <div class="panel-body">
                            @if (Session::has('order_message'))
                                <div class="alert alert-success">{{ Session::get('order_message') }}</div>
                            @endif
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Order Id') }}</th>
                                        <th>{{ __('Subtotal') }}</th>
                                        <th>{{ __('Discount') }}</th>
                                        <th>{{ __('Tax') }}</th>
                                        <th>{{ __('Total') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('ZipCode') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Order Date') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->subtotal }}$</td>
                                            <td>{{ $order->discount }}$</td>
                                            <td>{{ $order->tax }}$</td>
                                            <td>{{ $order->total }}$</td>
                                            <td>{{ $order->firstname }} {{ $order->lastname }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->zipcode }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td><a href="{{ route('user.orders.details', ['order_id' => $order->id]) }}"
                                                    class="btn btn-info btn-sm">{{ __('Detail') }}</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
