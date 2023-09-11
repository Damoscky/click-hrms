@extends('layouts.employee.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Shifts</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('employee.shift.all') }}">All Shifts</a>
                            </li>
                        </ul>
                    </div>
                    {{-- <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_shift">
                            <i class="fa-solid fa-plus"></i> Add Shift</a>
                    </div> --}}
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
                            <option value="Completed">Completed</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Cancelled">Cancelled</option>
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
                                    <th>Type</th>
                                    <th>Period</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Bank holiday</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($totalShifts) > 0)
                                    
                                    @foreach ($totalShifts as $shift)
                                        <tr>
                                            <td>{{$shift->shift->type}}</td>
                                            <td>{{$shift->shift->period}}</td>
                                            <td>{{ \Carbon\Carbon::parse($shift->date)->format('j F, Y') }}</td>
                                            <td>{{$shift->shift->start_time}}</td>
                                            <td>{{$shift->shift->end_time}}</td>
                                            <td>{{($shift->shift->bank_holiday == 1) ? 'Yes' : 'No'}}</td>
                                            </td>
                                            @if ($shift->status == "Pending")
                                                <td>
                                                    <a href="#" class="btn btn-outline-secondary btn-sm"> Pending </a>
                                                </td>
                                            @elseif($shift->status == "Accepted")
                                                <td>
                                                    <a href="#" class="btn btn-outline-success btn-sm"> Accepted </a>
                                                </td>
                                            @endif
                                            <td>
                                                @if ($shift->status == "Pending")
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#accept_shift-{{$shift->id}}" 
                                                        class="btn btn-outline-warning"> Accept </a>
                                                @endif
                                                @if (Carbon\Carbon::parse($shift->date)->diffInHours(Carbon\Carbon::now()) > 24)
                                                    <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal"
                                                    data-bs-target="#cancel_shift-{{$shift->id}}"> Cancel </a> 
                                                @endif
                                            </td>
                                        </tr>
                                        <div class="modal custom-modal fade" id="cancel_shift-{{$shift->id}}" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="form-header">
                                                            <h3>Cancel Shift?</h3>
                                                            <p>Are you sure you want to cancel this shift? T&C may applies.</p>
                                                        </div>
                                                        <div class="modal-btn delete-action">
                                                            <div class="row">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <a href="javascript:void(0);" data-bs-dismiss="modal"
                                                                            class="btn btn-secondary cancel-btn">Cancel</a>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <a href="{{route('employee.shift.cancel', base64_encode($shift->id))}}" class="btn btn-primary submit-btn continue-btn">Confirm</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal custom-modal fade" id="accept_shift-{{$shift->id}}" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="form-header">
                                                            <h3>Accept this Shift?</h3>
                                                            <p>Are you sure you want to accept this shift?</p>
                                                        </div>
                                                        <div class="modal-btn delete-action">
                                                            <div class="row">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <a href="javascript:void(0);" data-bs-dismiss="modal"
                                                                            class="btn btn-secondary cancel-btn">Cancel</a>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <a href="{{route('employee.shift.accept', base64_encode($shift->id))}}" class="btn btn-primary submit-btn continue-btn">Confirm</a>
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
    </div>
@endsection
