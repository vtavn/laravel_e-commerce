@section('title')
    {{ __('All Coupon') }}
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Coupon') }}</h3>

                        <div class="card-tools">
                            <a href="{{ route('admin.coupons.add') }}"
                                class="btn btn-success btn-sm pull-right">{{ __('Add Coupon') }}</a>
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
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table table-hover text-nowrap table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('Id') }}</th>
                                    <th>{{ __('Code') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Value') }}</th>
                                    <th>{{ __('Cart Value') }}</th>
                                    <th>{{ __('Expiry Date') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->id }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{{ $coupon->type }}</td>
                                        @if ($coupon->type == 'fixed')
                                            <td>{{ $coupon->value }}{{ __('$') }}</td>
                                        @else
                                            <td>{{ $coupon->cart_value }}{{ __('%') }}</td>
                                        @endif
                                        <td>{{ $coupon->cart_value }}</td>
                                        <td>{{ $coupon->expiry_date }}</td>
                                        <td>
                                            <a href="{{ route('admin.coupons.edit', ['coupon_id' => $coupon->id]) }}"><i
                                                    class="fa fa-edit fa-2x"></i></a>
                                            <a href="#"
                                                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                                wire:click.prevent="deleteCoupon({{ $coupon->id }})"
                                                style="margin-left:10px;"><i
                                                    class="fa fa-times fa-2x text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $coupons->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
