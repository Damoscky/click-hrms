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
                       
                        <div class="col-12">
                            <img style="width: 200px; height:200px; display:block; margin:0 auto;" class="mb-3" src="{{asset('assets')}}/img/tumb-up.jpeg" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
