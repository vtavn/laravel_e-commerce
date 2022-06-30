<div>
    <div class="container pt-30">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Profile
                    </div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            @if ($user->profile->image)
                                <img src="{{ asset('assets/images/profile') }}/{{ $user->profile->image }}" width="100%" alt="">
                            @else
                                <img src="{{ asset('assets/images/profile/profile.png') }}" width="100%" alt="">
                            @endif    
                        </div>
                        <div class="col-md-8">
                            <p><b>Name:</b> {{ $user->name }}</p>
                            <p><b>Email:</b> {{ $user->email }}</p>
                            <p><b>Phone:</b> {{ $user->profile->phone }}</p>
                            <hr>
                            <p><b>Address:</b> {{ $user->profile->address }}</p>
                            <p><b>Address 2:</b> {{ $user->profile->address_2 }}</p>
                            <p><b>City:</b> {{ $user->profile->city }}</p>
                            <p><b>Province:</b> {{ $user->profile->province }}</p>
                            <p><b>Country:</b> {{ $user->profile->country }}</p>
                            <p><b>Zipcode:</b> {{ $user->profile->zipcode }}</p>
                            <a href="{{route('user.profile.edit')}}" class="btn btn-info pull-right">Update Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
