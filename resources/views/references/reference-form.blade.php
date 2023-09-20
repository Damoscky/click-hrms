<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
    <title>References || {{ env('APP_NAME') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets') }}/img/favicon.png" />

    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome/css/all.min.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/css/line-awesome.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/material.css" />


    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/css/dataTables.bootstrap4.min.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/css/select2.min.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/morris/morris.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css" />
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApcI-eCy2vhDU9Fx4GmhKsysL8xoZ69oU&libraries=places">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Reference Form</h3>
                            </div>
                            <p class="mt-2">
                                The person named below has applied for the stated post within Click Operations (UK)
                                Limited and has given your name as a referee.
                                Please answer all relevant questions,
                                sign and date the form, and return it to compliance@clickoperationshealthcare.com.
                            </p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('employee.reference.submit') }}">
                        {{ csrf_field() }}
                        <div class="row mt-2">
                            <h4>Candidate Information</h4>
                            <div class="col-sm-4">
                                <div class="input-block mb-4">
                                    <label class="col-form-label">Name</label>
                                    <input class="form-control" type="hidden" name="token"
                                        value="{{ $data->token }}">
                                    <input class="form-control" type="hidden" name="email"
                                        value="{{ $data->email }}">
                                    <input class="form-control" type="text" disabled name="fullname"
                                        value="{{ $data->user->first_name }} {{ $data->user->last_name }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-4">
                                    <label class="col-form-label">Date of Birth</label>
                                    <input class="form-control" type="text" disabled name="date_of_birth"
                                        value="{{ \Carbon\Carbon::parse($data->user->employeeRecord->date_of_birth)->format('j F, Y') }} ">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-4">
                                    <label class="col-form-label">Position</label>
                                    <input class="form-control" type="text" disabled name="position"
                                        value="{{ $data->user->employeeRecord->department->name }} ">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <h4>Previous Employment</h4>
                            <div class="col-sm-3">
                                <div class="input-block mb-4">
                                    <label class="col-form-label">Date of Employment</label>
                                    <input class="form-control" required type="date" name="date_of_employment"
                                        value="">
                                </div>

                            </div>
                            <div class="col-sm-3">
                                <div class="input-block mb-4">
                                    <label class="col-form-label">Position Employed</label>
                                    <input class="form-control" required type="text" name="position_employed"
                                        value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-block mb-4">
                                    <label class="col-form-label">Annual Income</label>
                                    <input class="form-control" required type="text" name="annual_income"
                                        value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-block mb-4">
                                    <label class="col-form-label">Reason for leaving</label>
                                    <input class="form-control" required type="text" name="reason_for_leaving"
                                        value="">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <h4>Referee's Information</h4>
                            <div class="col-sm-6">
                                <div class="input-block mb-4">
                                    <label class="col-form-label">Name of Referee</label>
                                    <input class="form-control" required type="text" name="name_of_referee"
                                        value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-4">
                                    <label class="col-form-label">Name of Organization</label>
                                    <input class="form-control" required type="text" name="name_of_organization"
                                        value="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-4">
                                    <label class="col-form-label">Position</label>
                                    <input class="form-control" required type="text" name="referee_position"
                                        value="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-4">
                                    <label class="col-form-label">Email</label>
                                    <input class="form-control" required type="email" name="referee_email"
                                        value="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-4">
                                    <label class="col-form-label">Telephone Number</label>
                                    <input class="form-control" required type="text" name="telephone_number"
                                        value="">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <h4>Candidate Assessment Chart</h4>
                                <div class="input-block mb-4">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table">
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
                                                    <td><input type="radio" value="average" name="observation">
                                                    </td>
                                                    <td><input type="radio" value="good" name="observation"></td>
                                                    <td><input type="radio" value="excellent" name="observation">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Appearance</td>
                                                    <td><input type="radio" value="poor" name="appearance"></td>
                                                    <td><input type="radio" value="average" name="appearance"></td>
                                                    <td><input type="radio" value="good" name="appearance"></td>
                                                    <td><input type="radio" value="excellent" name="appearance">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Communication</td>
                                                    <td><input type="radio" value="poor" name="communication">
                                                    </td>
                                                    <td><input type="radio" value="average" name="communication">
                                                    </td>
                                                    <td><input type="radio" value="good" name="communication">
                                                    </td>
                                                    <td><input type="radio" value="excellent" name="communication">
                                                    </td>
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
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">General Feedback about Candidate</label>
                                    <textarea class="form-control" name="feedback" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <p>This information is being collected by Seva Care Group Ltd. for the purpose of recruitment and selection.  
                                    If you are giving a reference on behalf of a present or previous employer, the subject will be entitled to see it.
                                </p>
                                <p>
                                    If the applicant is successful, the information will be held on file for the duration of their employment.  
                                </p>
                            </div>

                            <div class="col-sm-6">
                                <div class="input-block mb-4">
                                    <label class="col-form-label">Signed (Full Name)</label>
                                    <input class="form-control" required type="text" name="signed_name" value="">
                                </div>
                            </div>
                            @php
                                $currentDate = date('Y-m-d');
                            @endphp
                            <div class="col-sm-6">
                                <div class="input-block mb-4">
                                    <label class="col-form-label">Date</label>
                                    <input class="form-control" disabled type="date" value="{{$currentDate}}" name="employee_signed_date">
                                    <input class="form-control" type="hidden" value="{{$currentDate}}" name="signed_date">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <p>
                                    This reference is given on the understanding that any legal responsibility or liability for accuracy or otherwise of any 
                                    statement herein is hereby excluded in respect of the author of the reference, his/her employer, the recipient of the reference and the subject of it.
                                </p>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets') }}/js/multipleselect-max.js"></script>
    <script src="{{ asset('assets') }}/js/filter_by_status.js"></script>
    <script src="{{ asset('assets') }}/js/add-more-shift.js"></script>
    <script src="{{ asset('assets') }}/js/total-revenue-bar.js"></script>
    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('assets') }}/js/jquery-3.7.0.min.js"></script>

    <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets') }}/js/jquery.slimscroll.min.js"></script>

    <script src="{{ asset('assets') }}/plugins/morris/morris.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('assets') }}/js/chart.js"></script>

    <script src="{{ asset('assets') }}/js/select2.min.js"></script>

    <script src="{{ asset('assets') }}/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/dataTables.bootstrap4.min.js"></script>

    <script src="{{ asset('assets') }}/js/moment.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap-datetimepicker.min.js"></script>

    <script src="{{ asset('assets') }}/js/layout.js"></script>
    <script src="{{ asset('assets') }}/js/theme-settings.js"></script>
    <script src="{{ asset('assets') }}/js/greedynav.js"></script>

    <script src="{{ asset('assets') }}/js/app.js"></script>

</body>

</html>
