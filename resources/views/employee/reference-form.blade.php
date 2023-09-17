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
                        <h3 class="account-title">Reference Form</h3>
                        <p class="account-subtitle">Please fill the form below</p>

                        <form action="{{route('auth.create-new-password')}}" method="POST">
                            {{ csrf_field() }}
                        <h4>Candidate Information</h4>
                            <div class="input-block mb-4">
                                <label class="col-form-label">Name</label>
                                <input class="form-control" type="hidden" name="token" value="{{ $data->token }}">
                                <input class="form-control" type="text" disabled name="email" value="{{ $data->user->first_name }} {{ $data->user->last_name }}">
                            </div>
                            
                            <div class="input-block mb-4">
                                <label class="col-form-label">Date of Birth</label>
                                <input class="form-control" type="text" disabled name="date_of_birth" value="{{ \Carbon\Carbon::parse($data->user->employeeRecord->date_of_birth)->format('j F, Y') }} ">
                            </div>

                            <div class="input-block mb-4">
                                <label class="col-form-label">Position</label>
                                <input class="form-control" type="text" disabled name="position" value="{{ $data->user->employeeRecord->department->name }} ">
                            </div>

                            <h4>Previous Employment</h4>

                            <div class="input-block mb-4">
                                <label class="col-form-label">Date of Employment</label>
                                <input class="form-control" required type="text" name="date_of_employment" value="">
                            </div>
                            
                           
                            <div class="input-block mb-4 text-center">
                                <button id="reset-submit-button" class="btn btn-primary account-btn" type="submit">Submit Reference</button>
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
