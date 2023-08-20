@extends('layouts.employee.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Hello {{ auth()->user()->first_name }}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Please fill the form below to complete your registration</a>
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
                                            <label class="col-form-label">Employee ID</label>
                                            <input type="text" name="employee_id" readonly
                                                value="{{ auth()->user()->employeeRecord->employee_id }}"
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
                                            <label class="col-form-label">First Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="first_name" required
                                                value="{{ auth()->user()->first_name }}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Last Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="last_name" required
                                                value="{{ auth()->user()->last_name }}" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Religion <span
                                                    class="text-danger">*</span></label>
                                            <select class="select" required name="religion">
                                                @if (isset(auth()->user()->employeeRecord->religion))
                                                    <option value="{{ auth()->user()->employeeRecord->religion }}">
                                                        {{ auth()->user()->employeeRecord->religion }}</option>
                                                @else
                                                    <option>Please Select...</option>
                                                @endif
                                                <option value="Christian">Christian</option>
                                                <option value="Muslim">Muslim</option>
                                                <option value="Others">Others</option>
                                                <option value="Prefer not to say">Prefer not to say</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Date of Birth <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" required name="date_of_birth"
                                                value="{{ auth()->user()->employeeRecord->date_of_birth }}"
                                                class="form-control datetimepicker" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Marital Status <span
                                                    class="text-danger">*</span></label>
                                            <select class="select" required name="marital_status">
                                                @if (isset(auth()->user()->employeeRecord->marital_status))
                                                    <option value="{{ auth()->user()->employeeRecord->marital_status }}">
                                                        {{ auth()->user()->employeeRecord->marital_status }}</option>
                                                @else
                                                    <option>Please Select...</option>
                                                @endif
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Widow">Widow</option>
                                                <option value="Widower">Widower</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Nationality <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" required name="nationality"
                                                value="{{ auth()->user()->employeeRecord->nationality }}"
                                                class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Profile Picture <span class="text-danger">*</span></label>
                                    <input type="file" required name="picture" required
                                        value="{{ auth()->user()->employeeRecord->image }}" class="form-control" />
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
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
                                            <label class="col-form-label">Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="address" required
                                                value="{{ auth()->user()->employeeRecord->address }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">City <span class="text-danger">*</span></label>
                                            <input type="text" required
                                                value="{{ auth()->user()->employeeRecord->city }}" name="city"
                                                class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="input-block mb-3">
                                    <label class="col-form-label">State <span class="text-danger">*</span></label>
                                    <input type="text" required value="{{ auth()->user()->employeeRecord->state }}"
                                        name="state" class="form-control" />
                                </div>
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Postcode <span class="text-danger">*</span></label>
                                    <input type="text" required
                                        value="{{ auth()->user()->employeeRecord->post_code }}" name="post_code"
                                        class="form-control" />
                                </div>
                                <div class="input-block mb-3">
                                    <label class="col-form-label">County</label>
                                    <input type="text" value="{{ auth()->user()->employeeRecord->county }}"
                                        name="county" class="form-control" />
                                </div>

                                <div class="input-block mb-3">
                                    <label class="col-form-label">Country <span class="text-danger">*</span></label>
                                    <input type="text" required value="{{ auth()->user()->employeeRecord->country }}"
                                        name="country" class="form-control" />
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Bank information
                                <a href="#" class="edit-icon" data-bs-toggle="modal"
                                    data-bs-target="#bank_info_modal"><i class="fa-solid fa-pencil"></i></a>
                            </h3>
                            @if (isset(auth()->user()->bankInformation))
                                <ul class="personal-info">
                                    <li>
                                        <div class="title">Bank Name</div>
                                        <div class="text">{{ auth()->user()->bankInformation->bank_name }}</div>
                                    </li>
                                    <li>
                                        <div class="title">Bank Account No.</div>
                                        <div class="text">{{ auth()->user()->bankInformation->account_number }}</div>
                                    </li>
                                    <li>
                                        <div class="title">Sort Code</div>
                                        <div class="text">{{ auth()->user()->bankInformation->sort_code }}</div>
                                    </li>
                                    <li>
                                        <div class="title">Account Name </div>
                                        <div class="text">{{ auth()->user()->bankInformation->account_name }}</div>
                                    </li>
                                </ul>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">
                                Next of Kin
                                <a href="#" class="edit-icon" data-bs-toggle="modal"
                                    data-bs-target="#family_info_modal"><i class="fa-solid fa-pencil"></i></a>
                            </h3>
                            <div class="table-responsive">
                                @if (count(auth()->user()->nextofkin) > 0)
                                    <table class="table table-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Relationship</th>
                                                <th>Date of Birth</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (auth()->user()->nextofkin as $nextofkin)
                                                <tr>
                                                    <td>{{ $nextofkin->first_name }} {{ $nextofkin->last_name }}</td>
                                                    <td>{{ $nextofkin->relationship }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($nextofkin->date_of_birth)->format('j F, Y') }}
                                                    </td>
                                                    <td>{{ $nextofkin->phoneno }}</td>
                                                    <td>{{ $nextofkin->email }}</td>
                                                    <td>
                                                        <a href="{{ route('employee.nextofkin.delete', base64_encode($nextofkin->id)) }}"
                                                            class="delete-icon"><i
                                                                class="fa-regular fa-trash-can"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">
                                Documents
                                <a href="#" class="edit-icon" data-bs-toggle="modal"
                                    data-bs-target="#document_info"><i class="fa-solid fa-pencil"></i></a>
                            </h3>
                            <div class="experience-box">
                                <ul class="experience-list">
                                    @if (count(auth()->user()->document) > 0)
                                        @foreach (auth()->user()->document as $document)
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">College of Arts and
                                                            Science
                                                            (UG)
                                                        </a>
                                                        <a href="" class="delete-icon"><i
                                                                class="fa-regular fa-trash-can"></i></a>
                                                        <span
                                                            class="time">{{ \Carbon\Carbon::parse($document->issued_date)->format('F, Y') }}
                                                            -
                                                            {{ \Carbon\Carbon::parse($document->expiry_date)->format('F, Y') }}
                                                            (5 years 2 months)</span>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">
                                Experience
                                <a href="#" class="edit-icon" data-bs-toggle="modal"
                                    data-bs-target="#experience_info"><i class="fa-solid fa-pencil"></i></a>
                            </h3>
                            <div class="experience-box">
                                <ul class="experience-list">
                                    @foreach (auth()->user()->experience as $experience)
                                        <li>
                                            <div class="experience-user">
                                                <div class="before-circle"></div>
                                            </div>
                                            <div class="experience-content">
                                                <div class="timeline-content">
                                                    <a href="#" class="name">{{ $experience->job_title }} at
                                                        {{ $experience->company_name }}</a>
                                                    <a href="{{ route('employee.experience.delete', base64_encode($experience->id)) }}"
                                                        class="delete-icon"><i class="fa-regular fa-trash-can"></i></a>
                                                    <span
                                                        class="time">{{ \Carbon\Carbon::parse($experience->start_date)->format('F, Y') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($experience->end_date)->format('F, Y') }}
                                                        (5 years 2 months)
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="bank_info_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Bank Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('employee.bankdetails.update') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-scroll">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3">
                                                        <label class="col-form-label">Bank Name <span
                                                                class="text-danger">*</span></label>
                                                        <input name="bank_name"
                                                            value="{{ isset(auth()->user()->bankInformation) ? auth()->user()->bankInformation->bank_name : '' }}"
                                                            required class="form-control" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3">
                                                        <label class="col-form-label">Sort Code
                                                            <span class="text-danger">*</span></label>
                                                        <input name="sort_code"
                                                            value="{{ isset(auth()->user()->bankInformation) ? auth()->user()->bankInformation->sort_code : '' }}"
                                                            required class="form-control" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3">
                                                        <label class="col-form-label">Account Number
                                                            <span class="text-danger">*</span></label>
                                                        <input name="account_number"
                                                            value="{{ isset(auth()->user()->bankInformation) ? auth()->user()->bankInformation->account_number : '' }}"
                                                            required class="form-control" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3">
                                                        <label class="col-form-label">Account Name <span
                                                                class="text-danger">*</span></label>
                                                        <input name="account_name"
                                                            value="{{ isset(auth()->user()->bankInformation) ? auth()->user()->bankInformation->account_name : '' }}"
                                                            required class="form-control" type="text" />
                                                    </div>
                                                </div>
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
            <div id="family_info_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Next of Kin Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('employee.nextofkin.update') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-scroll">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3">
                                                        <label class="col-form-label">Firstname <span
                                                                class="text-danger">*</span></label>
                                                        <input name="first_name" required class="form-control"
                                                            type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3">
                                                        <label class="col-form-label">Lastname <span
                                                                class="text-danger">*</span></label>
                                                        <input name="last_name" required class="form-control"
                                                            type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3">
                                                        <label class="col-form-label">Relationship <span
                                                                class="text-danger">*</span></label>
                                                        <select required class="select" required name="relationship">
                                                            <option value="">Select Relationship</option>
                                                            <option value="Partner">Partner</option>
                                                            <option value="Husband">Husband</option>
                                                            <option value="Brother">Brother</option>
                                                            <option value="Sister">Sister</option>
                                                            <option value="Father">Father</option>
                                                            <option value="Mother">Mother</option>
                                                            <option value="Uncle">Uncle</option>
                                                            <option value="Aunty">Aunty</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3">
                                                        <label class="col-form-label">Date of birth
                                                            <span class="text-danger">*</span></label>
                                                        <input name="date_of_birth" required
                                                            class="form-control datetimepicker" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3">
                                                        <label class="col-form-label">Phone <span
                                                                class="text-danger">*</span></label>
                                                        <input name="phoneno" required class="form-control"
                                                            type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3">
                                                        <label class="col-form-label">Email <span
                                                                class="text-danger">*</span></label>
                                                        <input name="email" required class="form-control"
                                                            type="text" />
                                                    </div>
                                                </div>
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
            <div id="document_info" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Upload Documents</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('employee.document.upload') }}">
                                {{ csrf_field() }}
                                <div class="form-scroll">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3">
                                                        <select required class="select" required name="document_type">
                                                            <option value="">Select Document Type</option>
                                                            <option value="BRP">BRP</option>
                                                            <option value="Passport">Passport</option>
                                                            <option value="Driving Licence">Driving Licence</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3 form-focus focused">
                                                        <input type="text" value="" name="document_number"
                                                            class="form-control floating" />
                                                        <label class="focus-label">Document Number</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="input-block mb-3">
                                                        <input type="file" required name="document_file" required
                                                            value="" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3 form-focus focused">
                                                        <div class="cal-icon">
                                                            <input type="text" value="" name="issued_date"
                                                                class="form-control floating datetimepicker" />
                                                        </div>
                                                        <label class="focus-label">Issued Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3 form-focus focused">
                                                        <div class="cal-icon">
                                                            <input type="text" value="" name="expiry_date"
                                                                class="form-control floating datetimepicker" />
                                                        </div>
                                                        <label class="focus-label">Expiry Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="add-more">
                                                <a href="javascript:void(0);"><i class="fa-solid fa-plus-circle"></i> Add
                                                    More</a>
                                            </div> --}}
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
            <div id="education_info" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Education Informations</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-scroll">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">
                                                Education Informations
                                                <a href="javascript:void(0);" class="delete-icon"><i
                                                        class="fa-regular fa-trash-can"></i></a>
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3 form-focus focused">
                                                        <input type="text" value="Oxford University"
                                                            class="form-control floating" />
                                                        <label class="focus-label">Institution</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3 form-focus focused">
                                                        <input type="text" value="Computer Science"
                                                            class="form-control floating" />
                                                        <label class="focus-label">Course</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3 form-focus focused">
                                                        <div class="cal-icon">
                                                            <input type="text" value="01/06/2002"
                                                                class="form-control floating datetimepicker" />
                                                        </div>
                                                        <label class="focus-label">Start Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3 form-focus focused">
                                                        <div class="cal-icon">
                                                            <input type="text" value="31/05/2006"
                                                                class="form-control floating datetimepicker" />
                                                        </div>
                                                        <label class="focus-label">End Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3 form-focus focused">
                                                        <input type="text" value="BE Computer Science"
                                                            class="form-control floating" />
                                                        <label class="focus-label">Degree</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3 form-focus focused">
                                                        <input type="text" value="Grade A"
                                                            class="form-control floating" />
                                                        <label class="focus-label">Grade</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-more">
                                                <a href="javascript:void(0);"><i class="fa-solid fa-plus-circle"></i> Add
                                                    More</a>
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

            <div id="experience_info" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Work Experience</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('employee.experience.update') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-scroll">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3 form-focus">
                                                        <input name="company_name" type="text"
                                                            class="form-control floating" value="" required
                                                            name="company_name" />
                                                        <label class="focus-label">Company Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3 form-focus">
                                                        <input name="location" required type="text"
                                                            class="form-control floating" value=""
                                                            name="location" />
                                                        <label class="focus-label">Location</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3">
                                                        <select class="select" required name="employment_type">
                                                            <option value="">Employment Type</option>
                                                            <option value="Remote">Remote</option>
                                                            <option value="Hybrid">Hybrid</option>
                                                            <option value="Onsite">Onsite</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3 form-focus">
                                                        <input type="text" required name="job_title"
                                                            class="form-control floating" value="" />
                                                        <label class="focus-label">Job Title</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3 form-focus">
                                                        <div class="cal-icon">
                                                            <input type="text" required name="start_date"
                                                                class="form-control floating datetimepicker"
                                                                value="" />
                                                        </div>
                                                        <label class="focus-label">Start Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-block mb-3 form-focus">
                                                        <div class="cal-icon">
                                                            <input type="text" required
                                                                class="form-control floating datetimepicker"
                                                                value="" name="end_date" />
                                                        </div>
                                                        <label class="focus-label">End Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="add-more">
                                                <a href="javascript:void(0);"><i class="fa-solid fa-plus-circle"></i> Add
                                                    More</a>
                                            </div> --}}
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
        </div>
    </div>
@endsection
