<div>
    <div class="container pt-30">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Update Profile
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent="updateProfile">
                        <div class="col-md-4">
                            @if ($newimage)
                                <img src="{{ $newimage->temporaryUrl() }}" width="100%" alt="">
                            @elseif($image)
                                <img src="{{ asset('assets/images/profile') }}/{{ $image }}" width="100%" alt="">
                            @else
                                <img src="{{ asset('assets/images/profile/profile.png') }}" width="100%" alt="">
                            @endif    
                            <input type="file" class="form-control" wire:model="newimage"/>
                        </div>
                        <div class="col-md-8">
                            <p><b>Name:</b> <input type="text" class="form-control" wire:model="name"/></p>
                            <p><b>Email:</b> {{ $email }}</p>
                            <p><b>Phone:</b> <input type="text" class="form-control" wire:model="phone"/></p>
                            <hr>
                            <p><b>Address:</b> <input type="text" class="form-control" wire:model="address"/></p>
                            <p><b>Address 2:</b> <input type="text" class="form-control" wire:model="address_2"/></p>
                            <p><b>City:</b> <input type="text" class="form-control" wire:model="city"/></p>
                            <p><b>Province:</b> <input type="text" class="form-control" wire:model="province"/></p>
                            <p><b>Country:</b> <input type="text" class="form-control" wire:model="country"/></p>
                            <p><b>Zipcode:</b> <input type="text" class="form-control" wire:model="zipcode"/></p>
                            <button type="submit" class="btn btn-info pull-right">Update</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
