@extends('layouts.client.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome, {{ auth()->user()->clientRecord->company_name }}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa-solid fa-dollar-sign"></i></span>
                            <div class="dash-widget-info">
                                <h3>0</h3>
                                <span>Pending Invoice</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa-solid fa-cubes"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $completedShifts->count() }}</h3>
                                <span>Completed Shifts</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $pendingShifts->count() }}</h3>
                                <span>Upcoming Shifts</span>
                            </div>
                        </div>
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
                                            <h3>{{ $pendingShifts->count() }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6 text-center">
                                        <div class="stats-box mb-4">
                                            <p>Completed Shifts</p>
                                            <h3>{{ $completedShifts->count() }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    style="width: {{ count($pendingShifts) > 0 || count($completedShifts) > 0 ? number_format(($pendingShifts->count() / ($completedShifts->count() + $pendingShifts->count())) * 100, 2) : 0 }}%;"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    {{ count($pendingShifts) > 0 || count($completedShifts) > 0 ? number_format(($pendingShifts->count() / ($completedShifts->count() + $pendingShifts->count())) * 100, 2) : 0 }}%
                                </div>
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ count($pendingShifts) > 0 || count($completedShifts) > 0 ? number_format(($completedShifts->count() / ($completedShifts->count() + $pendingShifts->count())) * 100, 2) : 0 }}%;"
                                    aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    {{ count($pendingShifts) > 0 || count($completedShifts) > 0 ? number_format(($completedShifts->count() / ($completedShifts->count() + $pendingShifts->count())) * 100, 2) : 0 }}%
                                </div>
                            </div>
                            <div>
                                <p>
                                    <i class="fa-regular fa-circle-dot text-success me-2"></i>Completed Shifts <span
                                        class="float-end">{{ $completedShifts->count() }}</span>
                                </p>
                                <p>
                                    <i class="fa-regular fa-circle-dot text-warning me-2"></i>Pending Shifts <span
                                        class="float-end">{{ $pendingShifts->count() }}</span>
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
                            @if (count($recentTimesheet) > 0)
                                @foreach ($recentTimesheet as $timesheet)
                                    <div class="leave-info-box">
                                        <div class="media d-flex align-items-center">
                                            <a href="profile.html" class="avatar">
                                                @if ($timesheet->employee->employeeRecord->image)
                                                    <img src="{{$timesheet->employee->employeeRecord->image}}" alt="User Image" />
                                                @else
                                                    <img src="{{ asset('assets') }}/img/user.jpg" alt="User Image" />
                                                @endif
                                            </a>
                                            <div class="media-body flex-grow-1">
                                                <div class="text-sm my-0">{{$timesheet->employee->first_name}} {{$timesheet->employee->last_name}}</div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center mt-3">
                                            <div class="col-6">
                                                <h6 class="mb-0">{{Carbon\Carbon::parse($timesheet->date)->format('j F, Y')}}</h6>
                                                <span class="text-sm text-muted">{{$timesheet->shift->type}} Shift</span>
                                            </div>
                                            <div class="col-6 text-end">
                                                @if ($timesheet->status == "Pending")
                                                    <span class="badge bg-inverse-danger">{{$timesheet->status}}</span>
                                                @else
                                                    <span class="badge bg-inverse-success">{{$timesheet->status}}</span>
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="load-more text-center">
                                    <a class="text-dark" href="{{route('client.timesheet.all')}}">Load More</a>
                                </div>
                            @else
                                <img style="width: 200px; height:200px; display:block; margin:0 auto;" class="mb-3" src="{{asset('assets')}}/img/no-data.jpeg" alt="">
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
