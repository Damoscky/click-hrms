@extends('layouts.admin.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Timesheet</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.client.all')}}">All Timesheet</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row filter-row">
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
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Email</th>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Shift</th>
                                    <th>Clock In</th>
                                    <th>Clock Out</th>
                                    <th>Total Hours</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="client-profile.html" class="avatar"><img
                                                    src="{{asset('assets')}}/img/profiles/avatar-28.jpg" alt="User Image" /></a>
                                            <a href="client-profile.html">Matt Joe</a>
                                        </h2>
                                    </td>
                                    <td>segun@yahoo.com</td>
                                    <td>First Health Home</td>
                                    <td>7 July 2023</td>
                                    <td>Night Shift</td>
                                    <td>20:00</td>
                                    <td>08:30</td>
                                    <td>12hours 30mins</td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-outline-primary btn-sm"> Approved </a>
                                         <a href="#" data-bs-toggle="modal" data-bs-target="#view_timesheet" class="btn btn-outline-primary btn-sm"> View </a>
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

         <div class="modal custom-modal fade" id="view_timesheet" role="dialog">
          <div
            class="modal-dialog modal-dialog-centered modal-lg"
            role="document"
          >
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Timesheet Info</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                >
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
                          <h6>Punch In at</h6>
                          <p>Wed, 11th Mar 2019 10.00 AM</p>
                        </div>
                        <div class="punch-info">
                          <div class="punch-hours">
                            <span>3.45 hrs</span>
                          </div>
                        </div>
                        <div class="punch-det">
                          <h6>Punch Out at</h6>
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
                            <p class="mb-0">Punch In at</p>
                            <p class="res-activity-time">
                              <i class="fa-regular fa-clock"></i>
                              10.00 AM.
                            </p>
                          </li>
                          <li>
                            <p class="mb-0">Punch Out at</p>
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

        <div id="add_client" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Client</h5>
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
                                        <label class="col-form-label">Confirm Email <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="email" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Contact Number <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Contact First Name <span class="text-danger">*</span><span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Contact Last Name <span class="text-danger">*</span></label>
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
                                        <label class="col-form-label">Confirm Email <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="email" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Contact Number <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Contact First Name <span class="text-danger">*</span><span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Contact Last Name <span class="text-danger">*</span></label>
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
