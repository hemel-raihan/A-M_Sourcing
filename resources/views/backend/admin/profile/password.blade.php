@extends('layouts.app')

@section('styles')

@endsection

@section('content')


<div class="row">
    <div class="col-md-6" id="password_settings" style="margin-left: 20%;">

        <form enctype="multipart/form-data" method="POST" action="{{route('admin.password.update')}}">
            @csrf
            @method('PUT')
        <div class="row">

            <div class="col-md-12">

                <div class="main-card mb-3 card">

                    <div class="card-body">

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    <h5 class="card-title">Update Profile</h5>

                    <div class="form-group">
                        <label for="name">Old Password</label>
                        <input id="old_password" type="password" class="form-control @error('oldpass') is-invalid @enderror" name="old_password" autofocus>

                                   @error('oldpass')
                                       <span class="invalid-feedback" user="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                            </div>


                    <div class="form-group">
                        <label for="name">New Password</label>
                        <input id="password" type="password" class="form-control @error('newpass') is-invalid @enderror" name="password" >

                                   @error('newpass')
                                       <span class="invalid-feedback" user="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                    </div>

                    <div class="form-group">
                    <label for="name">Confirm Password</label>
                    <input id="password_confirmation" type="password" class="form-control @error('newpass') is-invalid @enderror" name="password_confirmation" >

                                @error('newpass')
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
