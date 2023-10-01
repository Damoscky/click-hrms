<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="keywords"
        content="" />
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApcI-eCy2vhDU9Fx4GmhKsysL8xoZ69oU&libraries=places"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

                {{-- <li class="nav-item dropdown">
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
                </li> --}}

                

                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            @if (isset(auth()->user()->image))
                                <img src="{{ auth()->user()->image }}"
                                alt="Profile Picture" />
                            @else
                                <img src="{{ asset('assets') }}/img/user.png"
                                alt="Profile Picture" />
                            @endif
                            <span class="status online"></span></span>
                        <span>{{auth()->user()->first_name}}</span>
                    </a>
                    <div class="dropdown-menu">
                        {{-- <a class="dropdown-item" href="profile.html">My Profile</a>
                        <a class="dropdown-item" href="settings.html">Settings</a> --}}
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
                       
                        @role(['admin', 'superadmin', 'businessdevelopment', 'workforce', 'recruitment'])  
                            <li class="menu-title">
                                <span>Main</span>
                            </li>
                            <li class="@if(request()->is('admin/dashboard')) active @endif">
                                <a href="{{ route('admin.dashboard') }}"><i class="la la-dashboard"></i> <span>
                                    Dashboard</span>
                                </a>
                            </li>
                        @endrole
                        


                        <li class="menu-title">
                            <span>Management</span>
                        </li>
                        @role(['admin', 'recruitment', 'superadmin']) 
                            <li class="submenu @if(request()->is('admin/employee')) active @endif">
                                <a href="#"><i class="la la-users"></i> <span> Employees</span>
                                    <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="{{ route('admin.employee.all') }}" class="@if(request()->is('admin/employee')) active @endif">All Employees</a></li>
                                    <li><a href="{{ route('admin.employee.pending') }}" class="@if(request()->is('admin/employee/pending')) active @endif">Pending Approval</a></li>
                                    <li><a href="{{ route('admin.employee.pending.registration') }}" class="@if(request()->is('admin/employee/pending/registration')) active @endif">Pending Registration</a></li>
                                </ul>
                            </li>
                        @endrole
                        @role(['admin', 'businessdevelopment', 'superadmin']) 
                            <li class="submenu @if(request()->is('admin/clients')) active @endif">
                                <a href="#" class="@if(request()->is('admin/clients')) active @endif"><i class="la la-user-circle-o"></i> <span> Clients</span>
                                    <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="{{ route('admin.client.all') }}" class="@if(request()->is('admin/clients')) active @endif">All Clients</a></li>
                                    
                                </ul>
                            </li>
                        @endrole
                            {{-- <li class="submenu">
                                <a href="#"><i class="la la-user"></i> <span> Staff</span>
                                    <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="{{ route('admin.staff.all') }}">All Staffs</a></li>
                                    
                                </ul>
                            </li> --}}
                        @role(['admin', 'workforce', 'superadmin']) 
                            <li class="@if(request()->is('admin/timesheet')) active @endif">
                                <a href="{{ route('admin.timesheet.all') }}" class="@if(request()->is('admin/timesheet')) active @endif"><i class="la la-clock-o"></i> <span> Timesheet</span></a>
                            </li>
                            <li class="submenu @if(request()->is('admin/shifts')) active @endif">
                                <a href="#"><i class="la la-calendar"></i> <span> Shifts & Schedule</span>
                                    <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="{{ route('admin.shift.all') }}" class="@if(request()->is('admin/shifts')) active @endif">All Shifts</a></li>
                                    <li><a href="{{ route('admin.shift.pending') }}" class="@if(request()->is('admin/shifts/pending')) active @endif">Pending Shifts</a></li>
                                    {{-- <li><a href="{{ route('admin.employee.availability') }}" class="@if(request()->is('admin/employee/availability')) active @endif">Employee Availablility</a></li> --}}
                                </ul>
                            </li>
                        @endrole
                        @role(['admin', 'superadmin']) 
                            <li>
                                <a href="#"><i class="la la-briefcase"></i> <span> Leave</span></a>
                            </li>
                            <li class="menu-title">
                                <span>Reports</span>
                            </li>
                            <li class="submenu @if(request()->is('admin/reports/employee')) active @endif">
                                <a href="#"><i class="la la-address-card"></i> <span> Reports</span>
                                    <span class="menu-arrow"></span></a>
                                <ul>
                                    {{-- <li><a href="{{route('admin.department.create')}}">Create Department</a></li> --}}
                                    <li><a href="{{ route('admin.reports.employee') }}" class="@if(request()->is('admin/reports/employee')) active @endif">Employee Reports </a></li>

                                </ul>
                            </li>
                            <li class="menu-title">
                                <span>Settings</span>
                            </li>
                            <li class="submenu @if(request()->is('admin/department')) active @endif">
                                <a href="#" class="@if(request()->is('admin/department')) active @endif"><i class="la la-address-card"></i> <span> Departments</span>
                                    <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="{{ route('admin.department.all') }}" class="@if(request()->is('admin/department')) active @endif">All Departments</a></li>
                                </ul>
                            </li>
                            <li class="submenu @if(request()->is('admin/settings/company')) active @endif">
                                <a href="#" class="@if(request()->is('admin/settings/company')) active @endif"><i class="la la-asl-interpreting"></i> <span> Company</span>
                                    <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="{{ route('admin.settings.company') }}" class="@if(request()->is('admin/settings/company')) active @endif">Company Setup</a></li>
                                </ul>
                            </li>

                        @endrole
                    </ul>
                </div>
            </div>
        </div>



        @yield('content')


    </div>


    <script>
        function getAddress(){
            const apiKey = 'AIzaSyApcI-eCy2vhDU9Fx4GmhKsysL8xoZ69oU';
            const postcode = document.getElementById("postcode").value; // Replace with the desired postcode
            
            console.log(postcode.value);

            const apiUrl = `https://maps.googleapis.com/maps/api/geocode/json?address=${postcode}&key=${apiKey}`;

            // Make a GET request to the API
            fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'OK' && data.results.length > 0) {
                const formattedAddress = data.results[0].formatted_address;
                address.value = formattedAddress;
                console.log(`Address for ${postcode}: ${formattedAddress}`);
                } else {
                console.log('Unable to retrieve address information.');
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        }
    </script>

    <script src="{{ asset('assets') }}/js/multipleselect-max.js"></script>
    <script src="{{ asset('assets') }}/js/filter_by_status.js"></script>
    <script src="{{ asset('assets') }}/js/add-more-shift.js"></script>
    <script src="{{asset('assets')}}/js/total-revenue-bar.js"></script>
    {{-- <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}
    <script src="{{ asset('assets') }}/js/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('assets') }}/js/search-filter-employee.js"></script>

    <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets') }}/js/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('assets') }}/js/upload-employee-certificate-admin.js"></script>

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
