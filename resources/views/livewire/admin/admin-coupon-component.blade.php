<div>
    <div class="container" style="padding:30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add Coupon
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.coupons.add') }}" class="btn btn-success pull-right">Add Coupon</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>Id</td>
                                    <td>Code</td>
                                    <td>Type</td>
                                    <td>Value</td>
                                    <td>Cart Value</td>
                                    <td>Expiry Date</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <th>{{ $coupon->id }}</th>
                                        <th>{{ $coupon->code }}</th>
                                        <th>{{ $coupon->type }}</th>
                                        @if ($coupon->type == 'fixed')
                                            <th>{{ $coupon->value }} $</th>
                                        @else
                                            <th>{{ $coupon->cart_value }} %</th>
                                        @endif
                                        <th>{{ $coupon->cart_value }}</th>
                                        <th>{{ $coupon->expiry_date }}</th>
                                        <th>
                                            <a href="{{route('admin.coupons.edit', ['coupon_id' => $coupon->id])}}"><i class="fa fa-edit fa-2x"></i></a>
                                            <a href="#" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click.prevent="deleteCoupon({{$coupon->id}})" style="margin-left:10px;"><i class="fa fa-times fa-2x text-danger"></i></a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $coupons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
