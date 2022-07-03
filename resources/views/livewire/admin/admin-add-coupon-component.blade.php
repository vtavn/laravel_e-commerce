@section('title')
    {{ __('Add New Coupon') }}
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Add New Coupon') }}</h3>

                        <div class="card-tools">
                            <a href="{{ route('admin.coupons') }}"
                                class="btn btn-success btn-sm pull-right">{{ __('All Coupon') }}</a>
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
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <form action="" class="form-horizontal" method="post" wire:submit.prevent="storeCoupon">
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Code') }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-md" placeholder="Code" wire:model="code">
                                @error('code') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Value') }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-md" placeholder="Value" wire:model="value">
                                @error('value') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Type') }}</label>
                            <div class="col-md-4">
                                <select class="form-control" wire:model="type">
                                    <option value="">{{ __('Select') }}</option>
                                    <option value="fixed">{{ __('Fixed') }}</option>
                                    <option value="percent">{{ __('Percent') }} (%)</option>
                                </select>
                                @error('type') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Cart Value') }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-md" placeholder="Cart Value" wire:model="cart_value">
                                @error('cart_value') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Expiry Date') }}</label>
                            <div class="col-md-4">
                                <div class="input-group date" id="expiry_date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#expiry_date" placeholder="Y-MM-DD" wire:model="expiry_date"/>
                                    <div class="input-group-append" data-target="#expiry_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @error('expiry_date') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
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
@push('scripts')
    <script>
        $(function () {
            $('#expiry_date').datetimepicker({
                format: 'Y-MM-DD',
                icons: { time: 'far fa-clock' }
            })
            .on('dp.change', function(ev){
                var data = $('#expiry_date').val();
                @this.set('expiry_date', data);
            });
        });
    </script>
@endpush
