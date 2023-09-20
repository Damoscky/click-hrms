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

                        <form method="POST" action="{{route('employee.reference.submit')}}">
                            {{ csrf_field() }}
                        <h4>Candidate Information</h4>
                            <div class="input-block mb-4">
                                <label class="col-form-label">Name</label>
                                <input class="form-control" type="hidden" name="token" value="{{ $data->token }}">
                                <input class="form-control" type="hidden" name="email" value="{{ $data->email }}">
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
                                <input class="form-control" required type="date" name="date_of_employment" value="">
                            </div>
                            <div class="input-block mb-4">
                                <label class="col-form-label">Position Employed</label>
                                <input class="form-control" required type="text" name="position_employed" value="">
                            </div>

                            <div class="input-block mb-4">
                                <label class="col-form-label">Annual Income</label>
                                <input class="form-control" required type="text" name="annual_income" value="">
                            </div>

                            <div class="input-block mb-4">
                                <label class="col-form-label">Reason for leaving</label>
                                <input class="form-control" required type="text" name="reason_for_leaving" value="">
                            </div>

                            <h4>Referee's Information</h4>
                            <div class="input-block mb-4">
                                <label class="col-form-label">Name of Referee</label>
                                <input class="form-control" required type="text" name="name_of_referee" value="">
                            </div>
                            <div class="input-block mb-4">
                                <label class="col-form-label">Name of Organization</label>
                                <input class="form-control" required type="text" name="name_of_organization" value="">
                            </div>
                            <div class="input-block mb-4">
                                <label class="col-form-label">Position</label>
                                <input class="form-control" required type="text" name="position" value="">
                            </div>
                            <div class="input-block mb-4">
                                <label class="col-form-label">Email</label>
                                <input class="form-control" required type="email" name="referee_email" value="">
                            </div>
                            <div class="input-block mb-4">
                                <label class="col-form-label">Telephone Number</label>
                                <input class="form-control" required type="text" name="telephone_number" value="">
                            </div>

                            <h4>Candidate Assessment Chart</h4>
                            <div class="input-block mb-4">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="mt-3 mb-3">Category</th>
                                            <th>Poor</th>
                                            <th>Average</th>
                                            <th>Good</th>
                                            <th>Excellent</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Teamwork</td>
                                            <td><input type="radio" value="poor" name="teamwork"></td>
                                            <td><input type="radio" value="average" name="teamwork"></td>
                                            <td><input type="radio" value="good" name="teamwork"></td>
                                            <td><input type="radio" value="excellent" name="teamwork"></td>
                                        </tr>
                                        <tr>
                                            <td>Honesty</td>
                                            <td><input type="radio" value="poor" name="honesty"></td>
                                            <td><input type="radio" value="average" name="honesty"></td>
                                            <td><input type="radio" value="good" name="honesty"></td>
                                            <td><input type="radio" value="excellent" name="honesty"></td>
                                        </tr>
                                        <tr>
                                            <td>Observation</td>
                                            <td><input type="radio" value="poor" name="observation"></td>
                                            <td><input type="radio" value="average" name="observation"></td>
                                            <td><input type="radio" value="good" name="observation"></td>
                                            <td><input type="radio" value="excellent" name="observation"></td>
                                        </tr>
                                        <tr>
                                            <td>Appearance</td>
                                            <td><input type="radio" value="poor" name="appearance"></td>
                                            <td><input type="radio" value="average" name="appearance"></td>
                                            <td><input type="radio" value="good" name="appearance"></td>
                                            <td><input type="radio" value="excellent" name="appearance"></td>
                                        </tr>
                                        <tr>
                                            <td>Communication</td>
                                            <td><input type="radio" value="poor" name="communication"></td>
                                            <td><input type="radio" value="average" name="communication"></td>
                                            <td><input type="radio" value="good" name="communication"></td>
                                            <td><input type="radio" value="excellent" name="communication"></td>
                                        </tr>
                                        <tr>
                                            <td>Altitude</td>
                                            <td><input type="radio" value="poor" name="altitude"></td>
                                            <td><input type="radio" value="average" name="altitude"></td>
                                            <td><input type="radio" value="good" name="altitude"></td>
                                            <td><input type="radio" value="excellent" name="altitude"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h4 class="mt-3">General Feedback</h4>
                            <div class="input-block mb-4">
                                <label class="col-form-label">General Feedback about Candidate</label>
                                <textarea class="form-control" name="feedback" id="feedback" cols="40" rows="10"></textarea>
                            </div>

                            
                           
                            <div class="input-block mb-4 text-center">
                                <button id="reset-submit-button" type="submit" class="btn btn-primary account-btn">Submit Reference</button>
                            </div>
                            <div class="modal custom-modal fade" id="submit_reference" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-header">
                                                <h3>Submit Reference</h3>
                                                <p> Are you sure you want to submit employee reference</p>
                                            </div>
                                            <div class="modal-btn delete-action">
                                                <div class="row">

                                                    <div class="col-6">
                                                        <a href="javascript:void(0);" data-bs-dismiss="modal"
                                                            class="btn btn-secondary cancel-btn">Cancel</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="{{ route('employee.reference.submit') }}"
                                                            class="btn btn-success continue-btn">Confirm</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
