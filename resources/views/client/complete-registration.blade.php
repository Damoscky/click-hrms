@extends('layouts.client.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Hello {{ auth()->user()->first_name }}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                @if(!auth()->user()->sent_for_approval && auth()->user()->status == "Pending")
                                    <a href="#">Please fill the form below to complete your registration</a>
                                @elseif(auth()->user()->sent_for_approval && auth()->user()->status == "Review")
                                    <a href="#" class="btn btn-warning">Your application is currently under review.</a>
                                @elseif(!auth()->user()->sent_for_approval && auth()->user()->status == "Declined")
                                    <a href="#" class="btn btn-danger">Your application has been declined</a>
                                    <a href="#"  data-bs-toggle="modal" data-bs-target="#reason_modal" class="btn btn-danger">View Reasons</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Basic Information</h4>
                        </div>
                        <form action="{{ route('employee.record.update') }}" enctype="multipart/form-data" method="POST">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Client ID</label>
                                            <input type="text" name="client_id" readonly
                                                value="{{ auth()->user()->clientRecord->client_id }}"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Email Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" readonly
                                                value="{{ auth()->user()->email }}" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Contact First Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="first_name" required
                                                value="{{ auth()->user()->first_name }}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Contact Last Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="last_name" required
                                                value="{{ auth()->user()->last_name }}" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    @if (isset(auth()->user()->clientRecord->image))
                                        <div class="col-md-6">
                                            <div class="profile-img-wrap">
                                                <div class="profile-img">
                                                    <a href="#"><img
                                                            src="{{ auth()->user()->clientRecord->image }}"
                                                            alt="{{ auth()->user()->first_name }}" /></a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                            <div class="input-block mb-3">
                                                <label class="col-form-label">Company Logo <span
                                                        class="text-danger">*</span></label>
                                                <input type="file" required name="logo" required
                                                    value="{{ auth()->user()->clientRecord->image }}"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Company Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" required name="company_name" required
                                                value="{{ auth()->user()->clientRecord->company_name }}"
                                                class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    @if (!auth()->user()->sent_for_approval)
                                        <button type="submit" class="btn btn-primary">
                                            Save
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Address Form</h4>
                        </div>
                        <form action="{{ route('employee.address.update') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="address" required
                                                value="{{ auth()->user()->clientRecord->address }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">City <span class="text-danger">*</span></label>
                                            <input type="text" required value="{{ auth()->user()->clientRecord->city }}"
                                                name="city" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Postcode <span class="text-danger">*</span></label>
                                            <input type="text" required
                                                value="{{ auth()->user()->clientRecord->post_code }}" name="post_code"
                                                class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">County</label>
                                            <input type="text" value="{{ auth()->user()->clientRecord->county }}"
                                                name="county" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Country <span class="text-danger">*</span></label>
                                    <input type="text" required value="{{ auth()->user()->clientRecord->country }}"
                                        name="country" class="form-control" />
                                </div>
                                <div class="text-end">
                                    @if (!auth()->user()->sent_for_approval)
                                        <button type="submit" class="btn btn-primary">
                                            Save
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <div class="file-cont-inner">
                                <div class="file-content">
                                    <div class="file-body">
                                        <div class="file-scroll">
                                            <div class="file-content-inner">
                                                <h4>Contract Document
                                                </h4>
                                                <object data="https://media.geeksforgeeks.org/wp-content/cdn-uploads/20210101201653/PDF.pdf" 
                                                    width="100%"
                                                    height="1000">
                                                </object>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (!auth()->user()->sent_for_approval)
                <a href="{{ route('employee.application.sendforapproval') }}" class="btn btn-success"
                    data-bs-toggle="modal" data-bs-target="#confirm_approval_modal">Submit for
                    Approval</a>
            @endif
            <!--Submit for Approval Modal -->
            <div class="modal custom-modal fade" id="confirm_approval_modal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Submit Record for Approval</h3>
                                <p> Are you sure you want to submit this application for approval? This action cannot be undone.</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">

                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-bs-dismiss="modal"
                                            class="btn btn-secondary cancel-btn">Cancel</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('employee.application.sendforapproval') }}"
                                            class="btn btn-success continue-btn">Confirm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
