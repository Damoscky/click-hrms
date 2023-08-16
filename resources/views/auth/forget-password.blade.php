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
                        <h3 class="account-title">Forget Password</h3>
                        <p class="account-subtitle">Please enter your email address</p>

                        <form action="{{route('auth.reset-password')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="input-block mb-4">
                                <label class="col-form-label">Email Address</label>
                                <input class="form-control" type="email" name="email" value="">
                            </div>
                           
                            <div class="input-block mb-4 text-center">
                                <button class="btn btn-primary account-btn" type="submit">Reset Password</button>
                            </div>
                            <div class="account-footer">
                                <p>Remember your password? <a href="{{route('index')}}">Login</a></p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
