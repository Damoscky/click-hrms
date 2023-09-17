@extends('layouts.client.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Timesheet</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('client.timesheet.all') }}">All Timesheet</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row filter-row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search by Type">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <select id="statusFilter" class="form-control">
                            <option value="">Filter by Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Declined">Declined</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="d-grid">
                        <button id="clearFilterBtn" class="btn btn-secondary">Clear Filter</button>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Shift</th>
                                    <th>Clock In</th>
                                    <th>Clock Out</th>
                                    <th>Total Hours</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($timesheets) > 0)
                                    @foreach ($timesheets as $timesheet)
                                        @php
                                            if (isset($timesheet->time_in) && isset($timesheet->time_out)) {
                                                $time1 = Carbon\Carbon::parse($timesheet->time_in);
                                                $time2 = Carbon\Carbon::parse($timesheet->time_out);
                                            
                                                // Check if the end time is earlier (spanning midnight)
                                                if ($time2->lessThan($time1)) {
                                                    $time2->addDay(); // Add 1 day to the end time
                                                }
                                            
                                                // Calculate the time difference in hours, minutes, and seconds
                                                $timeDifference = $time1->diff($time2);
                                                $hours = $timeDifference->h;
                                                $minutes = $timeDifference->i;
                                                $seconds = $timeDifference->s;
                                            }
                                        @endphp

                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    @if ($timesheet->employee->employeeRecord->image)
                                                        <a href="client-profile.html" class="avatar"><img
                                                                src="{{ $timesheet->employee->employeeRecord->image }}"
                                                                alt="User Image" /></a>
                                                    @else
                                                        <a href="client-profile.html" class="avatar"><img
                                                                src="{{ asset('assets') }}/img/user.jpg"
                                                                alt="User Image" /></a>
                                                    @endif
                                                    <a href="client-profile.html">{{ $timesheet->employee->first_name }}
                                                        {{ $timesheet->employee->last_name }}</a>
                                                </h2>
                                            </td>
                                            <td>{{ $timesheet->employee->email }}</td>
                                            <td>{{ Carbon\Carbon::parse($timesheet->clock_in_date)->format('j F, Y') }}</td>
                                            <td>{{ $timesheet->shift->period }}</td>
                                            <td>{{ $timesheet->time_in }}</td>
                                            <td>{{ isset($timesheet->time_out) ? $timesheet->time_out : 'N/A' }}</td>
                                            <td>{{ isset($timesheet->time_in) && isset($timesheet->time_out) ? "{$hours}hours, {$minutes}mins" : 'N/A' }}
                                            </td>
                                            <td>
                                                @if ($timesheet->status == 'Pending')
                                                    <a href="#" class="btn btn-outline-secondary btn-sm"> Pending </a>
                                                @elseif($timesheet->status == 'Approved')
                                                    <a href="#" class="btn btn-outline-success btn-sm"> Approved </a>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#view_timesheet"
                                                    class="btn btn-outline-success btn-sm"> View </a>
                                                <a href="#" class="btn btn-outline-primary btn-sm"> Approve </a>
                                                <a href="#" class="btn btn-outline-danger btn-sm"> Decline </a>
                                            </td>
                                        </tr>

                                        <div class="modal custom-modal fade" id="view_timesheet" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Timesheet Info</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="card punch-status">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">
                                                                            Timesheet
                                                                            <small class="text-muted">{{Carbon\Carbon::parse($timesheet->clock_in_date)->format('j F, Y')}}</small>
                                                                        </h5>
                                                                        <div class="punch-det">
                                                                            <h6>Clock In at</h6>
                                                                            <p>{{Carbon\Carbon::parse($timesheet->clock_in_date)->format('l, j F, Y')}} <br> {{Carbon\Carbon::parse($timesheet->time_in)->format('h:i:s A')}}</p>
                                                                        </div>
                                                                        <div class="punch-info">
                                                                            <div class="punch-hours">
                                                                                <span>{{ isset($timesheet->time_in) && isset($timesheet->time_out) ? "{$hours}hours," : 'N/A'}} <br> {{ isset($timesheet->time_in) && isset($timesheet->time_out) ? "{$minutes}mins" : 'N/A' }}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="punch-det">
                                                                            <h6>Clock Out at</h6>
                                                                            @if (isset($timesheet->clock_out_date) && isset($timesheet->time_out))
                                                                                <p>{{Carbon\Carbon::parse($timesheet->clock_out_date)->format('l, j F, Y')}} <br> {{Carbon\Carbon::parse($timesheet->time_out)->format('h:i:s A')}}</p>
                                                                            @else
                                                                                <p>N/A</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="card recent-activity">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Activity</h5>
                                                                        <ul class="res-activity-list">
                                                                            <li>
                                                                                <p class="mb-0">Clock In at</p>
                                                                                <p class="res-activity-time">
                                                                                    <i class="fa-regular fa-clock"></i>
                                                                                    {{Carbon\Carbon::parse($timesheet->time_in)->format('h:i:s A')}}
                                                                                </p>
                                                                            </li>
                                                                            <li>
                                                                                <p class="mb-0">Clock Out at</p>
                                                                                <p class="res-activity-time">
                                                                                    <i class="fa-regular fa-clock"></i>
                                                                                    {{isset($timesheet->time_out) ? Carbon\Carbon::parse($timesheet->time_out)->format('h:i:s A') : 'N/A'}}
                                                                                </p>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal custom-modal fade" id="view_timesheet" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Timesheet Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card punch-status">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Timesheet
                                            <small class="text-muted">11 Mar 2019</small>
                                        </h5>
                                        <div class="punch-det">
                                            <h6>Clock In at</h6>
                                            <p>Wed, 11th Mar 2019 10.00 AM</p>
                                        </div>
                                        <div class="punch-info">
                                            <div class="punch-hours">
                                                <span>3.45 hrs</span>
                                            </div>
                                        </div>
                                        <div class="punch-det">
                                            <h6>Clock Out at</h6>
                                            <p>Wed, 20th Feb 2019 9.00 PM</p>
                                        </div>
                                        <div class="statistics">
                                            <div class="row">
                                                <div class="col-md-6 col-6 text-center">
                                                    <div class="stats-box">
                                                        <p>Break</p>
                                                        <h6>1.21 hrs</h6>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 text-center">
                                                    <div class="stats-box">
                                                        <p>Overtime</p>
                                                        <h6>3 hrs</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card recent-activity">
                                    <div class="card-body">
                                        <h5 class="card-title">Activity</h5>
                                        <ul class="res-activity-list">
                                            <li>
                                                <p class="mb-0">Clock In at</p>
                                                <p class="res-activity-time">
                                                    <i class="fa-regular fa-clock"></i>
                                                    10.00 AM.
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0">Clock Out at</p>
                                                <p class="res-activity-time">
                                                    <i class="fa-regular fa-clock"></i>
                                                    11.00 AM.
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0">Punch In at</p>
                                                <p class="res-activity-time">
                                                    <i class="fa-regular fa-clock"></i>
                                                    11.15 AM.
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0">Punch Out at</p>
                                                <p class="res-activity-time">
                                                    <i class="fa-regular fa-clock"></i>
                                                    1.30 PM.
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0">Punch In at</p>
                                                <p class="res-activity-time">
                                                    <i class="fa-regular fa-clock"></i>
                                                    2.00 PM.
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0">Punch Out at</p>
                                                <p class="res-activity-time">
                                                    <i class="fa-regular fa-clock"></i>
                                                    7.30 PM.
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal custom-modal fade" id="delete_client" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Client</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-bs-dismiss="modal"
                                        class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
