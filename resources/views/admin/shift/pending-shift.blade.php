@extends('layouts.admin.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Pending Shifts</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.shift.all') }}">Shifts</a>
                            </li>
                            <li class="breadcrumb-item">
                                Pending Shifts
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
                                    <th>Total Staff</th>
                                    <th>Total Staff Assigned</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($totalShifts) > 0)
                                    
                                    @foreach ($totalShifts as $shift)
                                        <tr>
                                            <td>{{$shift->type}}</td>
                                            <td>{{$shift->period}}</td>
                                            <td>{{ \Carbon\Carbon::parse($shift->date)->format('j F, Y') }}</td>
                                            <td>{{$shift->start_time}}</td>
                                            <td>{{$shift->end_time}}</td>
                                            <td>{{($shift->bank_holiday == 1) ? 'Yes' : 'No'}}</td>
                                            <td>{{$shift->total_staff}}</td>
                                            <td>{{$shift->total_staff_assigned}}</td>
                                            @if ($shift->status == "Pending")
                                                <td>
                                                    <a href="#" class="btn btn-outline-secondary btn-sm"> Pending </a>
                                                </td>
                                            @elseif($shift->status == "Completed")
                                                <td>
                                                    <a href="#" class="btn btn-outline-success btn-sm"> Completed </a>
                                                </td>
                                            @elseif($shift->status == "In Progress")
                                                <td>
                                                    <a href="#" class="btn btn-outline-primary btn-sm"> In Progress </a>
                                                </td>
                                            @elseif($shift->status == "Cancelled")
                                                <td>
                                                    <a href="#" class="btn btn-outline-danger btn-sm"> Cancelled </a>
                                                </td>
                                            @endif
                                            <td>
                                                <a href="#" class="btn btn-outline-warning" data-bs-toggle="modal"
                                                data-bs-target="#edit_shift-{{$shift->id}}"> Edit </a>
                                                <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#assign_shift-{{$shift->id}}"> Assign </a>
                                            </td>
                                        </tr>
                                        <div class="modal custom-modal fade" id="cancel_shift-{{$shift->id}}" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="form-header">
                                                            <h3>Cancel Shift?</h3>
                                                            <p>Are you sure you want to cancel this shift?</p>
                                                        </div>
                                                        <div class="modal-btn delete-action">
                                                            <div class="row">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <a href="javascript:void(0);" data-bs-dismiss="modal"
                                                                            class="btn btn-secondary cancel-btn">Cancel</a>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <a href="{{route('admin.shift.cancel', base64_encode($shift->id))}}" class="btn btn-primary submit-btn continue-btn">Confirm</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="assign_shift-{{$shift->id}}" class="modal custom-modal fade" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Assign Shift</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    @php
                                                        $employeeAvailability = \App\Models\EmployeeAvailability::with('employee')->whereDate('date', \Carbon\Carbon::parse($shift->date))->get();
                                                    @endphp
                                                    <div class="modal-body">
                                                        <form method="post" action="{{route('admin.shift.assign', base64_encode($shift->id))}}" id="myForm">
                                                            {{ csrf_field() }}
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">Employee Name <span
                                                                                class="text-danger">*</span></label>
                                                                        @if($shift->total_staff > 1)
                                                                            <select class="select" name="employee_ids[]" required multiple>
                                                                        @else
                                                                            <select class="select" name="employee_ids[]" required>
                                                                        @endif
                                                                            @if(count($employeeAvailability) > 0)
                                                                                @foreach ($employeeAvailability as $availability)
                                                                                    <option value="{{$availability->employee->id}} ">{{$availability->employee->first_name}} {{$availability->employee->last_name}} </option>
                                                                                @endforeach
                                                                            @endif
                                                                            
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">Rules & Regulations </label>
                                                                        <textarea cols="30" rows="10" required name="rules_regulations" class="form-control">{{isset($companySettings) ? $companySettings->rules_regulations : ''}}</textarea>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-sm-12">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">Notify Client </label>
                                                                        <div class="form-switch">
                                                                            <input type="checkbox" name="notify_client" class="form-check-input"
                                                                                checked="" />
                                                                            <label class="form-check-label" for="customSwitch1"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="submit-section">
                                                                <button class="btn btn-primary submit-btn">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="edit_shift-{{$shift->id}}" class="modal custom-modal fade" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Shift</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('admin.shift.update', base64_encode($shift->id))}}" method="post">
                                                            {{ csrf_field() }}
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">Type <span class="text-danger">*</span></label>
                                                                        <select required class="form-control" name="type">
                                                                            <option value="{{$shift->type}}">{{$shift->type}}</option>
                                                                            <option value="HCA">HCA</option>
                                                                            <option value="Senior HCA">Senior HCA</option>
                                                                            <option value="RGN">RGN</option>
                                                                            <option value="Kitchen Assistant">Kitchen Assistant</option>
                                                                            <option value="Laundry">Laundry/Domestic</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">Period <span class="text-danger">*</span></label>
                                                                        <select required class="form-control" name="period">
                                                                            <option value="{{$shift->period}}">{{$shift->period}}</option>
                                                                            <option value="Full Day">Full Day</option>
                                                                            <option value="Full Night">Full Night</option>
                                                                            <option value="Half Day">Half Day</option>
                                                                            <option value="Half Night">Half Night</option>
                                                                            <option value="Twilight">Twilight</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">Total Staff <span
                                                                            class="text-danger">*</span></label>
                                                                        <div>
                                                                            <input required name="total_staff" value="{{$shift->total_staff}}" class="form-control" type="number" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">Date <span class="text-danger">*</span></label>
                                                                        <div>
                                                                            <input required name="shift_date" value="{{$shift->date}}" class="form-control"
                                                                                type="date" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">Start Time
                                                                            <span class="text-danger">*</span></label>
                                                                        <div class="input-group time">
                                                                            <input required name="start_time" value="{{$shift->start_time}}" type="time" class="form-control" /><span
                                                                                class="input-group-text"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">End Time <span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="input-group time">
                                                                            <input required name="end_time" value="{{$shift->end_time}}" type="time" class="form-control" /><span
                                                                                class="input-group-text"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">Bank holiday</label>
                                                                        <div class="form-switch">
                                                                            @if ($shift->bank_holiday == 1)
                                                                                <input name="bank_holiday" checked type="checkbox" class="form-check-input" id="customSwitch1"/>
                                                                                <label class="form-check-label" for="customSwitch1"></label>
                                                                            @else
                                                                                <input name="bank_holiday" type="checkbox" class="form-check-input" id="customSwitch1"/>
                                                                                <label class="form-check-label" for="customSwitch1"></label>
                                                                            @endif
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="submit-section">
                                                                <button class="btn btn-primary submit-btn">Save</button>
                                                            </div>
                                                        </form>
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