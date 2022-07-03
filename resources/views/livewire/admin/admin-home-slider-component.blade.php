@section('title')
    {{ __('All Slider') }}
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Slider') }}</h3>

                        <div class="card-tools">
                            <a href="{{ route('admin.homeslider.add') }}"
                                class="btn btn-success btn-sm pull-right">{{ __('Add New Slider') }}</a>
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
                        <table class="table table-striped table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Sub Title</th>
                                    <th>Price</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <td>{{ $slider->id }}</td>
                                        <td><img src="{{ asset('assets/images/sliders')}}/{{ $slider->image }}" width="120" alt="#"></td>
                                        <td>{{ $slider->title }}</td>
                                        <td>{{ $slider->subtitle }}</td>
                                        <td>{{ $slider->price }}</td>
                                        <td>{{ $slider->link }}</td>
                                        <td>{{ $slider->status == 1 ? 'Active' : 'In Active' }}</td>
                                        <td>{{ $slider->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.homeslider.edit', ['slider_id'=>$slider->id]) }}"><i class="fa fa-edit fa-2x text-info"></i></a>
                                            <a href="#" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" style="margin-left: 10px;" wire:click.prevent="deleteSlider({{$slider->id}})"><i class="fa fa-times fa-2x text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
