@extends('frontend.main_master')
@section('content')

<!-- @php 
$user = DB::table('users')->where('id',Auth::user()->id)->first();
@endphp -->
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2"><br><br>
                <img src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}" class="card-img-top" style="border-radius: 50%" height="100%" width="100%" alt=""><br><br>
                <ul class="list-group list-group-flush">
                    <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{route('change.password')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>

                </ul>
            </div>
            <!-- end col-md-2 -->

            <div class="col-md-2">





            </div>
            <!-- end col-md-2 -->

            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger"></span><strong></strong>
                        Change Password
                    </h3>
                    <div class="card-body">
                        <form action="{{route('user.password.update')}}" method="POST" >
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="name">Current Password<span>*</span></label>
                                <input type="password" name="oldpassword" class="form-control unicase-form-control text-input" id="current_password" >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password">New Password<span>*</span></label>
                                <input type="password" name="password" class="form-control unicase-form-control text-input" id="password">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password_confirmation">Confirm Password<span>*</span></label>
                                <input type="password" name="password_confirmation" class="form-control unicase-form-control text-input" id="password_confirmation">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">Update </button>
                            </div>
                        </form>
                    </div>








                </div>
            </div>
            <!-- end col-md-6 -->
        </div>
        <!-- end row -->
    </div>

</div>



@endsection