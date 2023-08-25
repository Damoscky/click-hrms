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

    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css" />

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />

</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="{{ route('admin.dashboard') }}" class="logo">
                    <img src="{{ asset('assets') }}/img/clickhrm-logo.png" width="40" height="40"
                        alt="Logo" />
                </a>
                <a href="admin-dashboard.html" class="logo2">
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

                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge rounded-pill">3</span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="chat-block d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img src="{{ asset('assets') }}/img/profiles/avatar-02.jpg"
                                                    alt="User Image" />
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details">
                                                    <span class="noti-title">John Doe</span> added new
                                                    task
                                                    <span class="noti-title">Patient appointment booking</span>
                                                </p>
                                                <p class="noti-time">
                                                    <span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="chat-block d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img src="{{ asset('assets') }}/img/profiles/avatar-03.jpg"
                                                    alt="User Image" />
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details">
                                                    <span class="noti-title">Tarah Shropshire</span>
                                                    changed the task name
                                                    <span class="noti-title">Appointment booking with payment
                                                        gateway</span>
                                                </p>
                                                <p class="noti-time">
                                                    <span class="notification-time">6 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities.html">View all Notifications</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <i class="fa-regular fa-comment"></i><span class="badge rounded-pill">8</span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Messages</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="chat.html">
                                        <div class="list-item">
                                            <div class="list-left">
                                                <span class="avatar">
                                                    <img src="{{ asset('assets') }}/img/profiles/avatar-09.jpg"
                                                        alt="User Image" />
                                                </span>
                                            </div>
                                            <div class="list-body">
                                                <span class="message-author">Richard Miles </span>
                                                <span class="message-time">12:28 AM</span>
                                                <div class="clearfix"></div>
                                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="chat.html">
                                        <div class="list-item">
                                            <div class="list-left">
                                                <span class="avatar">
                                                    <img src="{{ asset('assets') }}/img/profiles/avatar-02.jpg"
                                                        alt="User Image" />
                                                </span>
                                            </div>
                                            <div class="list-body">
                                                <span class="message-author">John Doe</span>
                                                <span class="message-time">6 Mar</span>
                                                <div class="clearfix"></div>
                                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="chat.html">View all Messages</a>
                        </div>
                    </div>
                </li>

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
                        <a class="dropdown-item" href="profile.html">My Profile</a>
                        <a class="dropdown-item" href="settings.html">Settings</a>
                        <a class="dropdown-item" href="{{route('auth.logout')}}">Logout</a>
                    </div>
                </li>
            </ul>

            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="{{route('auth.logout')}}">Logout</a>
                </div>
            </div>
        </div>

        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">

                    <ul class="sidebar-vertical">
                       
                        @role(['employee'])  
                            <li class="menu-title">
                                <span>Main</span>
                            </li>
                            <li>
                                <a href="{{ route('employee.dashboard') }}"><i class="la la-dashboard"></i> <span>
                                    Dashboard</span>
                                </a>
                            </li>
                        @endrole
                        


                        <li class="menu-title">
                            <span>Menus</span>
                        </li>
                        @role(['employee']) 
                            <li class="active">
                                <a href="{{ route('admin.timesheet.all') }}"><i class="la la-clock-o"></i> <span> Timesheet</span></a>
                            </li>
                            <li class="submenu active">
                                <a href="#"><i class="la la-calendar"></i> <span> Shifts & Schedule</span>
                                    <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="{{ route('admin.shift.all') }}">All Shifts</a></li>
                                    <li><a href="{{ route('admin.shift.pending') }}">Pending Shifts</a></li>
                                    <li><a href="{{ route('admin.employee.availability') }}">Employee Availablility</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="la la-briefcase"></i> <span> Leave</span></a>
                            </li>
                        @endrole
                        
                        
                    </ul>
                </div>
            </div>
        </div>



        @yield('content')


    </div>



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
