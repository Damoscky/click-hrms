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

            {{-- <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating" />
                        <label class="focus-label">Employee Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating" />
                        <label class="focus-label">Client Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3 form-focus select-focus">
                        <select class="select floating">
                            <option>Please Select...</option>
                            <option>Pending</option>
                            <option>Approved</option>
                            <option>Declined</option>
                        </select>
                        <label class="focus-label">Status</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="d-grid">
                        <a href="#" class="btn btn-success"> Search </a>
                    </div>
                </div>
            </div> --}}

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
                                        <a href="#" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#assign_shift"> Assign Shift </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="assign_shift" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assign Shift</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Employee Name <span
                                                class="text-danger">*</span></label>
                                        <select class="select">
                                            <option value="">Select</option>
                                            <option value="1">Richard Miles</option>
                                            <option value="2">John Smith</option>
                                            <option value="4">Wilmer Deluna</option>
                                            <option value="3">Mike Litorus</option>
                                            <option value="4">Wilmer Deluna</option>
                                            <option value="4">Wilmer Deluna</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Contact Number <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group time">
                                            <input class="form-control" type="text" name="contact_number" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Rules & Regulations </label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Notify Client </label>
                                        <div class="form-switch">
                                            <input type="checkbox" class="form-check-input" id="customSwitch1"
                                                checked="" />
                                            <label class="form-check-label" for="customSwitch1"></label>
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

        <div id="edit_client" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Company Name <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="email" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Confirm Email <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control floating" type="email" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Contact Number <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Contact First Name <span
                                                class="text-danger">*</span><span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Contact Last Name <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Address <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Region <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Postcode <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" />
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
