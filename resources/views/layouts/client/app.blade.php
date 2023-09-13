<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Smarthr - Bootstrap Admin Template" />
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects" />
    <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
    <title>Dashboard || {{ env('APP_NAME') }}</title>

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

    <link rel="stylesheet" href="{{ asset('assets') }}/css/fullcalendar.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css" />


</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="{{ route('client.dashboard') }}" class="logo">
                    <img src="{{ asset('assets') }}/img/clickhrm-logo.png" width="40" height="40"
                        alt="Logo" />
                </a>
                <a href="{{ route('client.dashboard') }}" class="logo2">
                    <img src="{{ asset('assets') }}/img/clickhrm-logo.png" width="40" height="40"
                        alt="Logo" />
                </a>
            </div>

            <a id="toggle_btn" href="javascript:void(0);">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            {{-- <div class="page-title-box">
          <h3>Dreamguy's Technologies</h3>
        </div> --}}

            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa-solid fa-bars"></i></a>

            <ul class="nav user-menu">

                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            @if (isset(auth()->user()->employeeRecord->image))
                                <img src="{{ auth()->user()->employeeRecord->image }}"
                                alt="Profile Picture" />
                            @else
                                <img src="{{ asset('assets') }}/img/user.png"
                                alt="Profile Picture" />
                            @endif
                            
                            <span class="status online"></span></span>
                        <span>{{auth()->user()->first_name}}</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('auth.logout')}}">Logout</a>
                    </div>
                </li>
            </ul>

            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{route('auth.logout')}}">Logout</a>
                </div>
            </div>
        </div>

        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">

                    <ul class="sidebar-vertical">
                       
                        @role(['client'])  
                            <li class="menu-title">
                                <span>Main</span>
                            </li>
                            <li class="@if(request()->is('client/dashboard')) active @endif">
                                <a href="{{ route('client.dashboard') }}"><i class="la la-dashboard"></i> <span>
                                    Dashboard</span>
                                </a>
                            </li>
                        @endrole
                        


                        <li class="menu-title">
                            <span>Menus</span>
                        </li>
                        @role(['client']) 
                            <li class="active">
                                <a href="{{ route('employee.timesheet.all') }}"><i class="la la-clock-o"></i> <span> Timesheet</span></a>
                            </li>
                            <li class="submenu active">
                                <a href="#"><i class="la la-calendar"></i> <span> Shifts & Schedule</span>
                                    <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="{{ route('client.shift.all') }}">Shifts</a></li>
                                    {{-- <li><a href="{{ route('client.shift.pending') }}">Pending Shifts</a></li> --}}
                                </ul>
                            </li>
                            <li class="active">
                                <a href="#"><i class="la la-briefcase"></i> <span> Invoices</span></a>
                            </li>
                            <li class="active">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#logout_modal"><i class="la la-lock"></i> <span> Logout</span></a>
                            </li>
                        @endrole

                        
                        
                    </ul>
                </div>
            </div>
        </div>


        <div class="modal custom-modal fade" id="logout_modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Logout</h3>
                            <p>Are you sure you want to logout ?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-bs-dismiss="modal"
                                        class="btn btn-secondary cancel-btn">Cancel</a>
                                </div>
                                <div class="col-6">
                                    <a href="{{route('auth.logout')}}" class="btn btn-primary submit-btn continue-btn">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')


    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets') }}/js/client_filter_by_status.js"></script>
    <script src="{{ asset('assets') }}/js/add-more-shift.js"></script>
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

    <script src="{{ asset('assets') }}/js/jquery-ui.min.js"></script>
    <script src="{{ asset('assets') }}/js/fullcalendar.min.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.fullcalendar.js"></script>

    <script src="{{ asset('assets') }}/js/layout.js"></script>
    <script src="{{ asset('assets') }}/js/theme-settings.js"></script>
    <script src="{{ asset('assets') }}/js/greedynav.js"></script>

    <script src="{{ asset('assets') }}/js/app.js"></script>


</body>

</html>
