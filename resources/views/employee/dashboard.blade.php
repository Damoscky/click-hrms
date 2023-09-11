@extends('layouts.employee.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="welcome-box">
                        <div class="welcome-img">
                            @if (isset(auth()->user()->employeeRecord->image))
                                <img src="{{ auth()->user()->employeeRecord->image }}"
                                    alt="{{ auth()->user()->first_name }}" />
                            @else
                                <img src="{{ asset('assets') }}/img/user.jpg" alt="{{ auth()->user()->first_name }}" />
                            @endif
                        </div>
                        <div class="welcome-det">
                            <h3>Welcome, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h3>
                            <p> {{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('l, j F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <section class="dash-section">
                        <h1 class="dash-sec-title">Upcoming Shifts</h1>
                        <div class="dash-sec-content">
                            @if (count($upcomingShifts) > 0 )
                                @foreach($upcomingShifts as $upcomingShift)
                                    <div class="dash-info-list">
                                        <a href="#" class="dash-card">
                                            <div class="dash-card-container">
                                                <div class="dash-card-icon">
                                                    <i class="fa-regular fa-building"></i>
                                                </div>
                                                <div class="dash-card-content">
                                                    <p>{{$upcomingShift->shift->period}} Shift at {{$upcomingShift->shift->clients->clientRecord->company_name}}</p>
                                                </div>
                                                <div class="dash-card-avatars">
                                                    <span>{{Carbon\Carbon::parse($upcomingShift->date)->format('j F, Y')}}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="dash-info-list">
                                    <a href="#" class="dash-card">
                                        <div class="dash-card-container">
                                            <p>No Upcoming Shift </p>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            
                        </div>
                    </section>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="dash-sidebar">
                        <section>
                            {{-- <h5 class="dash-title">Shifts</h5> --}}
                            <div class="card">
                                <div class="card-body">
                                    <div class="time-list">
                                        <div class="dash-stats-list">
                                            <h4>{{isset($pendingShifts) ? count($pendingShifts) : 0}}</h4>
                                            <p>Upcoming Shifts</p>
                                        </div>
                                        <div class="dash-stats-list">
                                            <h4>{{isset($completedShifts) ? count($completedShifts) : 0}}</h4>
                                            <p>Completed Shifts</p>
                                        </div>
                                    </div>
                                    <div class="request-btn">
                                        <div class="dash-stats-list">
                                            <span class="dash-widget-icon"><i class="fa-solid fa-cubes"></i></span>
                                            <h4>{{isset($totalShifts) ? count($totalShifts) : 0 }}</h4>
                                            <p>Total Shifts</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="card">
                                <div class="card-body">
                                    <div class="time-list">
                                        <div class="dash-stats-list">
                                            <span class="dash-widget-icon"><i class="fa-solid fa-user"></i></span>
                                            <h4>0</h4>
                                            <p>Total Strike</p>
                                        </div>
                                        <div class="dash-stats-list">
                                            <span class="dash-widget-icon"><i class="fa-solid fa-gem"></i></span>
                                            <h4>0</h4>
                                            <p>ClickHRM Token</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <h5 class="dash-title">Upcoming Bank Holiday</h5>
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="holiday-title mb-0">
                                        {{ \Carbon\Carbon::parse('2023-12-25')->format('l, j F Y') }} - Christmas Day
                                    </h4>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <h4 class="card-title">Shift Statistics</h4>
                            <div class="statistics">
                                <div class="row">
                                    <div class="col-md-6 col-6 text-center">
                                        <div class="stats-box mb-4">
                                            <p>Pending Shifts</p>
                                            <h3>{{isset($pendingShifts) ? count($pendingShifts) : 0}}</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6 text-center">
                                        <div class="stats-box mb-4">
                                            <p>Completed Shifts</p>
                                            <h3>{{isset($completedShifts) ? count($completedShifts) : 0}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ count($pendingShifts) > 0  || count($completedShifts) > 0 ? number_format(($pendingShifts->count() / ($completedShifts->count() + $pendingShifts->count())) * 100, 2) : 0 }}%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    {{ count($pendingShifts) > 0  || count($completedShifts) > 0 ? number_format(($pendingShifts->count() / ($completedShifts->count() + $pendingShifts->count())) * 100, 2) : 0 }}%
                                </div>
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ count($pendingShifts) > 0  || count($completedShifts) > 0 ? number_format(($completedShifts->count() / ($completedShifts->count() + $pendingShifts->count())) * 100, 2) : 0}}%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    {{ count($pendingShifts) > 0  || count($completedShifts) > 0 ? number_format(($completedShifts->count() / ($completedShifts->count() + $pendingShifts->count())) * 100, 2) : 0 }}%
                                </div>
                            </div>
                            <div>
                                <p>
                                    <i class="fa-regular fa-circle-dot text-success me-2"></i>Completed Shifts <span
                                        class="float-end">{{count($completedShifts)}}</span>
                                </p>
                                <p>
                                    <i class="fa-regular fa-circle-dot text-warning me-2"></i>Pending Shifts <span
                                        class="float-end">{{count($pendingShifts)}}</span>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <h4 class="card-title">
                                Recent Timesheet
                                {{-- <span class="badge bg-inverse-danger ms-2">5</span> --}}
                            </h4>
                            <div class="leave-info-box">
                                <div class="media d-flex align-items-center">
                                    <a href="profile.html" class="avatar"><img src="{{ asset('assets') }}/img/user.jpg"
                                            alt="User Image" /></a>
                                    <div class="media-body flex-grow-1">
                                        <div class="text-sm my-0">FirstHealth Care</div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-3">
                                    <div class="col-6">
                                        <h6 class="mb-0">4 Sep 2023</h6>
                                        <span class="text-sm text-muted">Leave Date</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="badge bg-inverse-danger">Pending</span>
                                    </div>
                                </div>
                            </div>
                            <div class="leave-info-box">
                                <div class="media d-flex align-items-center">
                                    <a href="profile.html" class="avatar"><img src="{{ asset('assets') }}/img/user.jpg"
                                            alt="User Image" /></a>
                                    <div class="media-body flex-grow-1">
                                        <div class="text-sm my-0">Martin Lewis</div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-3">
                                    <div class="col-6">
                                        <h6 class="mb-0">4 Sep 2019</h6>
                                        <span class="text-sm text-muted">Leave Date</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="badge bg-inverse-success">Approved</span>
                                    </div>
                                </div>
                            </div>
                            <div class="load-more text-center">
                                <a class="text-dark" href="javascript:void(0);">Load More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
