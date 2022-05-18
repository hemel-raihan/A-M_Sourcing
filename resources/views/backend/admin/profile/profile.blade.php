@extends('layouts.app')

@section('styles')

@endsection

@section('content')


<div class="row">
    <div class="col-md-6" id="profile_settings" style="margin-left: 20%;">

        <form enctype="multipart/form-data" method="POST" action="{{route('admin.profile.update')}}">
            @csrf
            @method('PUT')
        <div class="row">

            <div class="col-md-12">

                <div class="main-card mb-3 card">

                    <div class="card-body">
                    <h5 class="card-title">Update Profile</h5>

                    <div class="form-group">
                        <label for="name">Old Password</label>
                        <input id="old_password" type="password" class="form-control " placeholder="please enter your old password" name="old_password" autofocus>

                                   @error('oldpass')
                                       <span class="invalid-feedback" user="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                    </div>
                </div>

                     <div class="card-body">

                     <div class="form-group">
                        <label for="name">User Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}"  autofocus>
                            @error('name')
                                <span class="invalid-feedback" user="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}"  autofocus>

                                   @error('email')
                                       <span class="invalid-feedback" user="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">

                        <i class="fas fa-arrow-circle-up"></i>
                        Update

                    </button>

                </div>
                </div>

            </div>

        </div>

</div>
</div>
@endsection

@section('scripts')

        <!-- Select2 js-->
		<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

        <script>
            $('#select-all').click(function(event){
                if(this.checked)
                {
                    $(':checkbox').each(function(){
                        this.checked = true;
                    });
                }
                else
                {
                    $(':checkbox').each(function(){
                        this.checked = false;
                    });
                }
            });
         </script>

@endsection
