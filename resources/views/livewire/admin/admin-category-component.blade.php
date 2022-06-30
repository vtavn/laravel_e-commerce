<div>
    <div class="container" style="padding:30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                All Category
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.categories.add') }}" class="btn btn-success pull-right">Add Category</a>
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
                                    <td>Category Name</td>
                                    <td>Slug</td>
                                    <th>Sub Category</th>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <th>{{ $category->id }}</th>
                                        <th>{{ $category->name }}</th>
                                        <th>{{ $category->slug }}</th>
                                        <th>
                                            <ul class="sclist">
                                                @foreach ($category->subCategories as $scategory)
                                                    <li><i class="fa fa-caret-right"></i> {{ $scategory->name }} <a href="{{route('admin.categories.edit',['category_slug'=>$category->slug,'scategory_slug'=>$scategory->slug])}}"><i class="fa fa-edit"></i></a>                                            
                                                        <a href="#" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click.prevent="deleteSubCategory({{$scategory->id}})" style="margin-left:10px;"><i class="fa fa-times text-danger"></i></a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </th>
                                        <th>
                                            <a href="{{route('admin.categories.edit', ['category_slug' => $category->slug])}}"><i class="fa fa-edit fa-2x"></i></a>
                                            <a href="#" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click.prevent="deleteCategory({{$category->id}})" style="margin-left:10px;"><i class="fa fa-times fa-2x text-danger"></i></a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
