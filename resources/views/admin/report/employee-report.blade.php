@extends('layouts.admin.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Employee Report</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Employee Report</li>
                        </ul>
                    </div>

                    <div class="col-auto">
                        @php
                            $queryParam = http_build_query(['records' => $records]);

                            $url = route('admin.reports.export.employee') . '?' . $queryParam;
                        @endphp
                        <a href="{{$url}}" class="btn btn-primary">Export</a>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.reports.generate.employee') }}" method="POST">
                {{ csrf_field() }}
                <div class="row filter-row mb-4">
                    <div class="col-sm-6 col-md-3">
                        <div class="input-block mb-3 form-focus select-focus">
                            <select name="department" class="select floating">
                                <option value="All">All Department</option>
                                @if (count($departments) > 0)
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <label class="focus-label">Department</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="input-block mb-3 form-focus">
                            <div class="cal-icon">
                                <input name="start_date" class="form-control floating datetimepicker" type="text" />
                            </div>
                            <label class="focus-label">From</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="input-block mb-3 form-focus">
                            <div class="cal-icon">
                                <input name="end_date" class="form-control floating datetimepicker" type="text" />
                            </div>
                            <label class="focus-label">To</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success"> Generate </button>
                        </div>
                    </div>
                </div>
            </form>

            @if (count($records) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Employee ID</th>
                                        <th>Email</th>
                                        <th>Department</th>
                                        <th>Resumption Date</th>
                                        <th>DOB</th>
                                        <th>Martial Status</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>State</th>
                                        <th>Post Code</th>
                                        <th>Nationality</th>
                                        <th>Religion</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $record)
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    @if(isset($record->employeeRecord->image))
                                                        <a href="#" class="avatar"><img
                                                            src="{{$record->employeeRecord->image}}" alt="{{$record->first_name}}" /></a>

                                                    @else
                                                        <a href="#" class="avatar"><img
                                                            src="{{ asset('assets') }}/img/user.png"
                                                            alt="User Image" /></a>
                                                    @endif
                                                    <a href="#" class="text-primary">
                                                        {{$record->first_name}} {{$record->last_name}}
                                                        </a>
                                                </h2>
                                            </td>
                                            <td><span>{{isset($record->employeeRecord) ? $record->employeeRecord->employee_id : ''}}</span></td>
                                            <td class="text-info">
                                                <a href="mailto:{{$record->email}}"
                                                    class="__cf_email__"
                                                    data-cfemail="d6bcb9beb8a5bbbfa2be96b3aeb7bba6bab3f8b5b9bb">{{$record->email}}</a>
                                            </td>
                                            <td>{{isset($record->employeeRecord->department) ? $record->employeeRecord->department->name : ''}}</td>
                                            <td>{{ isset($record->employeeRecord->resumption_date) ? \Carbon\Carbon::parse($record->employeeRecord->resumption_date)->format('j F, Y') : '' }}</td>
                                            <td>{{ isset($record->employeeRecord->date_of_birth) ? \Carbon\Carbon::parse($record->employeeRecord->date_of_birth)->format('j F, Y') : '' }}</td>
                                            <td>{{isset($record->employeeRecord) ? $record->employeeRecord->marital_status : ''}}</td>
                                            <td>{{isset($record->employeeRecord) ? $record->employeeRecord->gender : ''}}</td>
                                            <td>{{isset($record->employeeRecord) ? $record->employeeRecord->address : ''}}</td>
                                            <td>{{isset($record->employeeRecord) ? $record->employeeRecord->state : ''}}</td>
                                            <td>{{isset($record->employeeRecord) ? $record->employeeRecord->post_code : ''}}</td>
                                            <td>{{isset($record->employeeRecord) ? $record->employeeRecord->nationality : ''}}</td>
                                            <td>{{isset($record->employeeRecord) ? $record->employeeRecord->religion : ''}}</td>
                                            @if ($record->status == "Approved")
                                                <td>
                                                    <button class="btn btn-outline-success btn-sm">
                                                        {{$record->status}}
                                                    </button>
                                                </td>

                                            @elseif($record->status == "Pending")
                                                <td>
                                                    <button class="btn btn-outline-warning btn-sm">
                                                        {{$record->status}}
                                                    </button>
                                                </td>

                                            @elseif($record->status == "Declined")
                                                <td>
                                                    <button class="btn btn-outline-danger btn-sm">
                                                        {{$record->status}}
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
