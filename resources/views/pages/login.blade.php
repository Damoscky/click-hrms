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
                        <h3 class="account-title">Login</h3>
                        <p class="account-subtitle">Login to your dashboard</p>

                        <form action="{{('admin/dashboard')}}">
                            <div class="input-block mb-4">
                                <label class="col-form-label">Email Address</label>
                                <input class="form-control" type="email" name="email" value="">
                            </div>
                            <div class="input-block mb-4">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <label class="col-form-label">Password</label>
                                    </div>
                                    <div class="col-auto">
                                        <a class="text-muted" href="{{('auth/forget-password')}}">
                                            Forgot password?
                                        </a>
                                    </div>
                                </div>
                                <div class="position-relative">
                                    <input class="form-control" type="password" value="" name="password" id="password">
                                    <span class="fa-solid fa-eye-slash" id="toggle-password"></span>
                                </div>
                            </div>
                            <div class="input-block mb-4 text-center">
                                <button class="btn btn-primary account-btn" type="submit">Login</button>
                            </div>
                            {{-- <div class="account-footer">
                                <p>Don't have an account yet? <a href="register.html">Register</a></p>
                            </div> --}}
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
