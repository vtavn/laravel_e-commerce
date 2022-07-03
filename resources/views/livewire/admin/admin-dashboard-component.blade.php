@section('title')
    {{ __('Dashboard') }}
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($totalRevenue) }}<sup style="font-size: 20px">{{ __('$') }}</sup></h3>

                        <p>{{ __('Total Revenue') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ number_format($totalSales) }}</h3>

                        <p>{{ __('Total Sales') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ number_format($todaytotalRevenue) }}<sup style="font-size: 20px">{{ __('$') }}</sup></h3>

                        <p>{{ __('Today Revenue') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ number_format($todaytotalSales) }}<sup style="font-size: 20px">{{ __('$') }}</sup></h3>

                        <p>{{ __('Today Sales') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                      <h3 class="card-title">{{ __('Latest Orders') }}</h3>
          
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
                    <div class="card-body table-responsive p-0">
                        @if (Session::has('order_message'))
                            <div class="alert alert-success">{{ Session::get('order_message') }}</div>
                        @endif
                        <table class="table table-hover text-nowrap">
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
                                        <td>{{ number_format($order->subtotal) }}{{ __('$') }}</td>
                                        <td>{{ number_format($order->discount) }}{{ __('$') }}</td>
                                        <td>{{ number_format($order->tax) }}{{ __('$') }}</td>
                                        <td>{{ number_format($order->total) }}{{ __('$') }}</td>
                                        <td>{{ $order->firstname }} {{ $order->lastname }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->phone }}</td>
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
                                        <td><a href="{{ route('admin.orders.details', ['order_id' => $order->id]) }}"
                                                class="btn btn-info btn-sm">Detail</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
