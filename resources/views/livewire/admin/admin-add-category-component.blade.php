@section('title')
    {{ __('Add Category') }}
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Add Category') }}</h3>

                        <div class="card-tools">
                            <a href="{{ route('admin.categories') }}"
                                class="btn btn-success btn-sm pull-right">{{ __('All Category') }}</a>
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
                            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form action="" class="form-horizontal" method="post" wire:submit.prevent="storeCategory">
                            <div class="form-group">
                                <label class="control-label">{{ __('Category Name') }}</label>
                                    <input type="text" class="form-control input-md" placeholder="{{ __('Category Name') }}"
                                        wire:model="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label">{{ __('Parent Category') }}</label>
                                    <select class="form-control input-md" wire:model="parent_id">
                                        <option value="">None</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label"></label>
                                    <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
