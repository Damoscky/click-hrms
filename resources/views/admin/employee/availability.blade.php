@extends('layouts.admin.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Employee Availablility</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.employee.all')}}">Employee</a>
                            </li>
                            <li class="breadcrumb-item active">Availability</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="shift-list.html" class="btn add-btn m-r-5">Shifts</a>
                        <a href="#" class="btn add-btn m-r-5" data-bs-toggle="modal" data-bs-target="#add_schedule">
                            Assign Shifts</a>
                    </div>
                </div>
            </div>

            <div class="row filter-row">
                <div class="col-sm-6 col-md-4">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating" />
                        <label class="focus-label">Employee</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="input-block mb-3 form-focus select-focus">
                        <select class="select floating">
                            <option>All Department</option>
                            <option value="1">Finance</option>
                            <option value="2">Finance and Management</option>
                            <option value="3">Hr & Finance</option>
                            <option value="4">ITech</option>
                        </select>
                        <label class="focus-label">Department</label>
                    </div>
                </div>
                
                <div class="col-sm-6 col-md-4">
                    <a href="#" class="btn btn-success w-100"> Search </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable leave-employee-table">
                            <thead>
                                <tr>
                                    <th>Scheduled Shift</th>
                                    <th>Fri 21</th>
                                    <th>Sat 22</th>
                                    <th>Sun 23</th>
                                    <th>Mon 24</th>
                                    <th>Tue 25</th>
                                    <th>Wed 26</th>
                                    <th>Thu 27</th>
                                    <th>Fri 28</th>
                                    <th>Sat 29</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="profile.html" class="avatar"><img
                                                    src="{{asset('assets')}}/img/profiles/avatar-02.jpg" alt="User Image" /></a>
                                            <a href="profile.html">John Doe <span>Web Designer</span></a>
                                        </h2>
                                    </td>
                                    <td>
                                        <div class="user-add-shedule-list">
                                            <h2>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit_schedule"
                                                    class="green-border">
                                                    <span class="username-info m-b-10">6:30 am - 9:30 pm ( 14 hrs 15
                                                        mins)</span>
                                                    <span class="userrole-info">Web Designer - SMARTHR</span>
                                                </a>
                                            </h2>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-add-shedule-list">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_schedule">
                                                <span><i class="fa-solid fa-plus"></i></span>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-add-shedule-list">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_schedule">
                                                <span><i class="fa-solid fa-plus"></i></span>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-add-shedule-list">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_schedule">
                                                <span><i class="fa-solid fa-plus"></i></span>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-add-shedule-list">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_schedule">
                                                <span><i class="fa-solid fa-plus"></i></span>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-add-shedule-list">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_schedule">
                                                <span><i class="fa-solid fa-plus"></i></span>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-add-shedule-list">
                                            <h2>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit_schedule"
                                                    class="green-border">
                                                    <span class="username-info m-b-10">6:30 am - 9:30 pm ( 14 hrs 15
                                                        mins)</span>
                                                    <span class="userrole-info">Web Designer - SMARTHR</span>
                                                </a>
                                            </h2>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-add-shedule-list">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_schedule">
                                                <span><i class="fa-solid fa-plus"></i></span>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-add-shedule-list">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_schedule">
                                                <span><i class="fa-solid fa-plus"></i></span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="add_schedule" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Department <span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option value="">Select</option>
                                        <option value="">Development</option>
                                        <option value="1">Finance</option>
                                        <option value="2">Finance and Management</option>
                                        <option value="3">Hr & Finance</option>
                                        <option value="4">ITech</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Employee Name <span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option value="">Select</option>
                                        <option value="1">Richard Miles</option>
                                        <option value="2">John Smith</option>
                                        <option value="3">Mike Litorus</option>
                                        <option value="4">Wilmer Deluna</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Date</label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Shifts <span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option value="">Select</option>
                                        <option value="1">10'o clock Shift</option>
                                        <option value="2">10:30 shift</option>
                                        <option value="3">Daily Shift</option>
                                        <option value="4">New Shift</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Min Start Time
                                        <span class="text-danger">*</span></label>
                                    <div class="input-group time">
                                        <input class="form-control timepicker" /><span class="input-group-text"><i
                                                class="fa-regular fa-clock"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Start Time <span class="text-danger">*</span></label>
                                    <div class="input-group time">
                                        <input class="form-control timepicker" /><span class="input-group-text"><i
                                                class="fa-regular fa-clock"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Max Start Time
                                        <span class="text-danger">*</span></label>
                                    <div class="input-group time">
                                        <input class="form-control timepicker" /><span class="input-group-text"><i
                                                class="fa-regular fa-clock"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Min End Time <span class="text-danger">*</span></label>
                                    <div class="input-group time">
                                        <input class="form-control timepicker" /><span class="input-group-text"><i
                                                class="fa-regular fa-clock"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">End Time <span class="text-danger">*</span></label>
                                    <div class="input-group time">
                                        <input class="form-control timepicker" /><span class="input-group-text"><i
                                                class="fa-regular fa-clock"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Max End Time <span class="text-danger">*</span></label>
                                    <div class="input-group time">
                                        <input class="form-control timepicker" /><span class="input-group-text"><i
                                                class="fa-regular fa-clock"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Break Time <span class="text-danger">*</span></label>
                                    <input class="form-control timepicker" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Accept Extra Hours </label>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="customSwitch1"
                                            checked="" />
                                        <label class="form-check-label" for="customSwitch1"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Publish </label>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="customSwitch2"
                                            checked="" />
                                        <label class="form-check-label" for="customSwitch2"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
