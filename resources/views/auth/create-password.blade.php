@extends('layouts.pages.header')

@section('content')
    <div class="main-wrapper">
        <div class="account-content">
            <div class="container">

                <div class="account-logo">
                    <a href="admin-dashboard.html"><img src="{{asset('assets')}}/img/clickhrm-logo.png" alt="{{env('APP_NAME')}}"></a>
                </div>

                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">Reset Password</h3>
                        <p class="account-subtitle">Please enter your new password</p>

                        <form action="{{route('auth.create-new-password')}}" method="POST">
                            {{ csrf_field() }}
                        
                            <div class="input-block mb-4">
                                <label class="col-form-label">Email</label>
                                <input class="form-control" type="text" disabled name="user_email" value="{{ $data->email }}">
                                <input class="form-control" type="hidden" name="token" value="{{ $data->token }}">
                                <input class="form-control" type="hidden" name="email" value="{{ $data->email }}">
                            </div>
                            
                            <div class="input-block mb-4">
                                <label class="col-form-label">New Password</label>
                                <input class="form-control" type="password" name="password" value="">
                            </div>

                            <div class="input-block mb-4">
                                <label class="col-form-label">Confirm Password</label>
                                <input class="form-control" type="password" name="password_confirmation" value="">
                            </div>
                           
                            <div class="input-block mb-4 text-center">
                                <button class="btn btn-primary account-btn" type="submit">Reset Password</button>
                            </div>
                            {{-- <div class="account-footer">
                                <p>Remember your password? <a href="{{route('index')}}">Login</a></p>
                            </div> --}}
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
