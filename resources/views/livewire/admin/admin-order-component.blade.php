@section('title')
    {{ __('All Orders') }}
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Orders') }}</h3>

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
                    <div class="card-body table-responsive ">
                        @if (Session::has('order_message'))
                        <div class="alert alert-success">{{ Session::get('order_message') }}</div>
                    @endif
                    <table class="table table-hover text-nowrap table-striped">
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
                                <th colspan="2" class="text-center">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ number_format($order->subtotal) }}{{ __('$') }}</td>
                                    <td>{{ number_format($order->discount) }}{{ __('$') }}</td>
                                    <td>{{ number_format($order->tax) }}{{ __('$') }}</td>
                                    <td>{{ number_format($order->total) }}{{ __('$') }}</td>
                                    <td>{{ $order->firstname }} {{ $order->lastname }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->zipcode }}</td>
                                    <td>
                                        @if ($order->status=='ordered')
                                                <span class="badge bg-warning">{{ __('Ordered') }}</span>
                                            @elseif ($order->status=='delivered')
                                                <span class="badge bg-success">{{ __('Delivered') }}</span>
                                            @elseif ($order->status=='canceled')
                                                <span class="badge bg-danger">{{ __('Canceled') }}</span>
                                            @endif
                                    </td>
                                    <td>{{ $order->created_at }}</td>
                                    <td><a href="{{ route('admin.orders.details', ['order_id' => $order->id]) }}" class="btn btn-info btn-sm">Detail</a></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Status
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#" wire:click.prevent="updateOrderStatus({{$order->id}}, 'delivered')">Delivered</a></li>
                                                    <li><a class="dropdown-item"  href="#" wire:click.prevent="updateOrderStatus({{$order->id}}, 'canceled')">Canceled</a></li>
                                                </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
