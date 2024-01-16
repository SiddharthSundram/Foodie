@extends('home.base')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-4 mx-auto mt-5">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center text-danger">Login</h2>
                </div>
                <div class="card-body">
                   
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" value="{{old('email')}}" class="form-control">
                            @error('email')
                                <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                              <label for="">Password</label>
                            <input type="password" name="password" value="{{old('password')}}" class="form-control">
                            @error('password')
                                <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="submit"  value="Login" class="w-100 btn btn-success">
                        </div>
                    </form>
                    <div class="row">
                        <a href="{{route('signup')}}">Don't have an account?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection