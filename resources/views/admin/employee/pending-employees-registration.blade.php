@extends('layouts.admin.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employees Pending Registration</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.employee.all') }}">List of Employees Pending Registration </a>
                            </li>
                        </ul>
                    </div>
                    {{-- <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_employee"><i
                                class="fa-solid fa-plus"></i> Add Employee</a>
                    </div> --}}
                </div>
            </div>

            <div class="row filter-row">
                <div class="col-sm-6 col-md-4">
                    <div class="input-block mb-3 form-focus">
                        <input id="employee_name_filter" name="employee_name" type="text" class="form-control floating" />
                        <label class="focus-label">Employee Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="input-block mb-3 form-focus select-focus">
                        <select id="department_filter" name="department" class="select floating">
                            <option>Select Department</option>
                            @if (count($departments) > 0)
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <label class="focus-label">Designation</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="d-grid">
                        <button id="search_button" class="btn btn-secondary w-100">Clear</button>
                    </div>
                </div>
            </div>

            <div class="row staff-grid-row">
                @if (count($totalEmployees) > 0)
                    @foreach ($totalEmployees as $employee)
                        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                            <div class="profile-widget" data-employeeId="{{ $employee->employeeRecord->employee_id }}" data-employeeDepartment="{{ $employee->employeeRecord->department->name }}">
                                <div class="profile-img" >
                                    @if (isset($employee->employeeRecord->image))
                                        <a href="{{ route('admin.employee.show', base64_encode($employee->id)) }}" class="avatar"><img
                                            src="{{ $employee->employeeRecord->image }}" alt="Profile Picture" /></a>
                                    @else
                                        <a href="{{ route('admin.employee.show', base64_encode($employee->id)) }}" class="avatar"><img
                                            src="{{ asset('assets') }}/img/user.png" alt="User Image" /></a>
                                    @endif
                                </div>
                                {{-- <div class="dropdown profile-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#edit_employee"><i class="fa-solid fa-pencil m-r-5"></i>
                                            Edit</a>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#delete_employee"><i class="fa-regular fa-trash-can m-r-5"></i>
                                            Delete</a>
                                    </div>
                                </div> --}}
                                <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                                    <a href="{{ route('admin.employee.show', base64_encode($employee->id)) }}">{{$employee->first_name}} {{$employee->last_name}}</a>
                                </h4>
                                <div class="small text-muted">{{$employee->employeeRecord->employee_id}}</div>
                                <div class="small text-muted">{{$employee->employeeRecord->department->name}}</div>
                            </div>
                        </div>
                    @endforeach
                    {{$totalEmployees->links()}}
                @else
                        <h4>No Record Found</h4>
                @endif
                

            </div>
        </div>
    </div>
@endsection
