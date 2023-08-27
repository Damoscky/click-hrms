@extends('layouts.employee.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Availability</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('employee.dashboard')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Availability</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_event"><i
                                class="fa-solid fa-plus"></i> Add Availability</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="add_event" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="input-block mb-3">
                                <label class="col-form-label">Event Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" />
                            </div>
                            <div class="input-block mb-3">
                                <label class="col-form-label">Event Date <span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input class="form-control datetimepicker" type="text" />
                                </div>
                            </div>
                            <div class="input-block mb-3">
                                <label class="control-label col-form-label">Category</label>
                                <select class="select form-control">
                                    <option>Danger</option>
                                    <option>Success</option>
                                    <option>Purple</option>
                                    <option>Primary</option>
                                    <option>Pink</option>
                                    <option>Info</option>
                                    <option>Inverse</option>
                                    <option>Orange</option>
                                    <option>Brown</option>
                                    <option>Teal</option>
                                    <option>Warning</option>
                                </select>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal custom-modal fade" id="event-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-success submit-btn save-event">
                            Create event
                        </button>
                        <button type="button" class="btn btn-danger submit-btn delete-event" data-bs-dismiss="modal">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
