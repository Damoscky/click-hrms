@extends('layouts.admin.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Shifts</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.shift.all') }}">All Shifts</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_shift">
                            <i class="fa-solid fa-plus"></i> Add Shift</a>
                    </div>
                </div>
            </div>

            <div class="row filter-row">
                <div class="col-sm-6 col-md-4">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating" />
                        <label class="focus-label">Client Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="input-block mb-3 form-focus select-focus">
                        <select class="select floating">
                            <option>-- Select Status --</option>
                            <option>Pending</option>
                            <option>Completed</option>
                            <option>Assigned</option>
                        </select>
                        <label class="focus-label">Status</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="d-grid">
                        <a href="#" class="btn btn-success"> Search </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Shift Title</th>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Period</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Break</th>
                                    <th>Rate</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>One on One</td>
                                    <td>First Health Home</td>
                                    <td>7 July 2023</td>
                                    <td>Night Shift</td>
                                    <td>20:00</td>
                                    <td>08:30</td>
                                    <td>1 hour </td>
                                    <td>£12 </td>
                                    <td>
                                        <a href="#" class="btn btn-warning"> Pending </a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-secondary"> View </a>
                                        <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit_shift"> Edit </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>One on One</td>
                                    <td>First Health Home</td>
                                    <td>7 July 2023</td>
                                    <td>Night Shift</td>
                                    <td>20:00</td>
                                    <td>08:30</td>
                                    <td>1 hour </td>
                                    <td>£12 </td>
                                    <td>
                                        <a href="#" class="btn btn-success"> Completed </a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-secondary"> View </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>One on One</td>
                                    <td>First Health Home</td>
                                    <td>7 July 2023</td>
                                    <td>Night Shift</td>
                                    <td>20:00</td>
                                    <td>08:30</td>
                                    <td>1 hour </td>
                                    <td>£12 </td>
                                    <td>
                                        <a href="#" class="btn btn-primary"> Assigned </a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-secondary"> View </a>
                                        <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit_shift"> Edit </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>One on One</td>
                                    <td>First Health Home</td>
                                    <td>7 July 2023</td>
                                    <td>Night Shift</td>
                                    <td>20:00</td>
                                    <td>08:30</td>
                                    <td>1 hour </td>
                                    <td>£12 </td>
                                    <td>
                                        <a href="#" class="btn btn-warning"> Pending </a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-secondary"> View </a>
                                        <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit_shift"> Edit </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="add_shift" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Shift</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Shift Title <span class="text-danger">*</span></label>
                                        <div class="input-group time">
                                            <input class="form-control" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Client Name <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option value="">-- Select Client --</option>
                                            <option value="1">First Health Care</option>
                                            <option value="1">Tempcare Ltd</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Period <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option value="">-- Select Period --</option>
                                            <option value="1">Full Day</option>
                                            <option value="1">Full Night</option>
                                            <option value="1">Half Day</option>
                                            <option value="1">Half Night</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Date <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Start Time
                                            <span class="text-danger">*</span></label>
                                        <div class="input-group time">
                                            <input class="form-control timepicker" /><span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">End Time <span class="text-danger">*</span></label>
                                        <div class="input-group time">
                                            <input class="form-control timepicker" /><span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Rules & Regulation </label>
                                        <textarea class="form-control"></textarea>
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

        <div id="edit_shift" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Shift</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Shift Title <span class="text-danger">*</span></label>
                                        <div class="input-group time">
                                            <input class="form-control" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Client Name <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option value="">-- Select Client --</option>
                                            <option value="1">First Health Care</option>
                                            <option value="1">Tempcare Ltd</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Period <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option value="">-- Select Period --</option>
                                            <option value="1">Full Day</option>
                                            <option value="1">Full Night</option>
                                            <option value="1">Half Day</option>
                                            <option value="1">Half Night</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Date <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Start Time
                                            <span class="text-danger">*</span></label>
                                        <div class="input-group time">
                                            <input class="form-control timepicker" /><span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">End Time <span class="text-danger">*</span></label>
                                        <div class="input-group time">
                                            <input class="form-control timepicker" /><span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Add Note </label>
                                        <textarea class="form-control"></textarea>
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
