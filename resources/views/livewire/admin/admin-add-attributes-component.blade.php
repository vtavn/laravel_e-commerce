@section('title')
    {{ __('Add Attributes') }}
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Add Attributes') }}</h3>

                        <div class="card-tools">
                            <a href="{{ route('admin.attributes') }}"
                                class="btn btn-success btn-sm pull-right">{{ __('All Attributes') }}</a>
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
                    <form action="" class="form-horizontal" method="post" wire:submit.prevent="storeAttributes">
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Attribute Name') }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-md" placeholder="Attribute Name" wire:model="name">
                                @error('name') <span class="error">{{ $message }}</span> @enderror
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
