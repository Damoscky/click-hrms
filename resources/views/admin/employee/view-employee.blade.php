@extends('layouts.admin.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Employee Details</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="admin-dashboard.html">Employee</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $employee->employeeRecord->employee_id }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        @if (isset($employee->employeeRecord->image))
                                            <img src="{{ $employee->employeeRecord->image }}"
                                                alt="{{ $employee->employeeRecord->employee_id }}" />
                                        @else
                                            <img src="{{ asset('assets') }}/img/user.png"
                                                alt="{{ $employee->employeeRecord->employee_id }}" />
                                        @endif
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ $employee->first_name }}
                                                    {{ $employee->last_name }}</h3>
                                                {{-- <h6 class="text-muted">UI/UX Design Team</h6> --}}
                                                <small
                                                    class="text-muted">{{ $employee->employeeRecord->department->name }}</small>
                                                <div class="staff-id">Employee ID :
                                                    {{ $employee->employeeRecord->employee_id }}</div>
                                                <div class="small doj text-muted">
                                                    Resumption Date :
                                                    {{ \Carbon\Carbon::parse($employee->employeeRecord->resumption_date)->format('j F, Y') }}
                                                </div>
                                                <div class="staff-msg">
                                                    @if ($employee->sent_for_approval && $employee->status == 'Review')
                                                        <a class="btn btn-success" data-bs-toggle="modal"
                                                            data-bs-target="#approve_modal">Approve</a>
                                                        <a class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#disapprove_modal">Disapprove</a>
                                                    @else
                                                        <a class="btn btn-custom" href="chat.html">Send Message</a>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Phone:</div>
                                                    <div class="text"><a
                                                            href="tel:{{ $employee->employeeRecord->phoneno }}">{{ $employee->employeeRecord->phoneno }}</a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text">
                                                        <a href="mailto:{{ $employee->email }}"><span class="__cf_email__"
                                                                data-cfemail="c9a3a6a1a7ada6ac89acb1a8a4b9a5ace7aaa6a4">{{ $employee->email }}</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Birthday:</div>
                                                    <div class="text">
                                                        {{ \Carbon\Carbon::parse($employee->employeeRecord->date_of_birth)->format('F j') }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Address:</div>
                                                    <div class="text">
                                                        {{ $employee->employeeRecord->address }},
                                                        {{ $employee->employeeRecord->city }}.
                                                        {{ $employee->employeeRecord->post_code }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Gender:</div>
                                                    <div class="text">{{ $employee->employeeRecord->gender }}</div>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit">
                                    {{-- <a data-bs-target="#profile_info" data-bs-toggle="modal" class="edit-icon"
                                        href="#"><i class="fa-solid fa-pencil"></i></a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item">
                                <a href="#emp_profile" data-bs-toggle="tab" class="nav-link active">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="#emp_assets" data-bs-toggle="tab" class="nav-link">Shifts</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div id="emp_profile" class="pro-overview tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        Personal Informations
                                        {{-- <a href="#" class="edit-icon" data-bs-toggle="modal"
                                            data-bs-target="#personal_info_modal"><i class="fa-solid fa-pencil"></i></a> --}}
                                    </h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">NI Number</div>
                                            <div class="text">{{ $employee->employeeRecord->national_insurance }}</div>
                                        </li>

                                        <li>
                                            <div class="title">Nationality</div>
                                            <div class="text">{{ $employee->employeeRecord->nationality }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Religion</div>
                                            <div class="text">{{ $employee->employeeRecord->religion }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Marital status</div>
                                            <div class="text">{{ $employee->employeeRecord->marital_status }}</div>
                                        </li>
                                    </ul>
                                    <hr />
                                    <h3 class="card-title">Bank information</h3>
                                    @if (isset($employee->bankInformation))
                                        <ul class="personal-info">
                                            <li>
                                                <div class="title">Bank Name</div>
                                                <div class="text">{{ $employee->bankInformation->bank_name }}</div>
                                            </li>
                                            <li>
                                                <div class="title">Bank Account No.</div>
                                                <div class="text">{{ $employee->bankInformation->account_number }}</div>
                                            </li>
                                            <li>
                                                <div class="title">Sort Code</div>
                                                <div class="text">{{ $employee->bankInformation->sort_code }}</div>
                                            </li>
                                            <li>
                                                <div class="title">Account Name </div>
                                                <div class="text">{{ $employee->bankInformation->account_name }}</div>
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
                                        {{-- <a href="#" class="edit-icon" data-bs-toggle="modal"
                                            data-bs-target="#emergency_contact_modal"><i
                                                class="fa-solid fa-pencil"></i></a> --}}
                                    </h3>
                                    @if (isset($employee->nextofkin))
                                        <ul class="personal-info">
                                            <li>
                                                <div class="title">Name</div>
                                                <div class="text">{{ $employee->nextofkin->first_name }}
                                                    {{ $employee->nextofkin->last_name }}</div>
                                            </li>
                                            <li>
                                                <div class="title">Relationship</div>
                                                <div class="text">{{ $employee->nextofkin->relationship }}</div>
                                            </li>
                                            <li>
                                                <div class="title">Phone</div>
                                                <div class="text">{{ $employee->nextofkin->phoneno }}</div>
                                            </li>
                                            <li>
                                                <div class="title">Date of Birth</div>
                                                <div class="text">{{ $employee->nextofkin->date_of_birth }}</div>
                                            </li>
                                        </ul>
                                    @endif

                                    <hr />
                                    <h3 class="card-title">Emergency Contact</h3>
                                    @if (isset($employee->nextofkin))
                                        <ul class="personal-info">
                                            <li>
                                                <div class="title">Name</div>
                                                <div class="text">{{ $employee->nextofkin->first_name }}
                                                    {{ $employee->nextofkin->last_name }}</div>
                                            </li>
                                            <li>
                                                <div class="title">Relationship</div>
                                                <div class="text">{{ $employee->nextofkin->relationship }}</div>
                                            </li>
                                            <li>
                                                <div class="title">Phone</div>
                                                <div class="text">{{ $employee->nextofkin->phoneno }}</div>
                                            </li>
                                            <li>
                                                <div class="title">Date of Birth</div>
                                                <div class="text">{{ $employee->nextofkin->date_of_birth }}</div>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        Experience
                                        {{-- <a href="#" class="edit-icon" data-bs-toggle="modal"
                                            data-bs-target="#education_info"><i class="fa-solid fa-pencil"></i></a> --}}
                                    </h3>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            @foreach ($employee->experience as $experience)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#" class="name">{{ $experience->job_title }}
                                                                at
                                                                {{ $experience->company_name }}</a>

                                                            <span
                                                                class="time">{{ \Carbon\Carbon::parse($experience->start_date)->format('F, Y') }}
                                                                -
                                                                {{ \Carbon\Carbon::parse($experience->end_date)->format('F, Y') }}
                                                                ({{ Carbon\Carbon::parse($experience->start_date)->diffForHumans() }})
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
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        References
                                    </h3>
                                    <div class="table-responsive">
                                        @if (count($employee->employeeReference) > 0)
                                            <table class="table table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Contact Name</th>
                                                        <th>Company Name</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Email</th>
                                                        <th>Phone No</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($employee->employeeReference as $reference)
                                                        <tr>
                                                            <td>{{ $reference->contact_name }}</td>
                                                            <td>{{ $reference->company_name }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($reference->start_date)->format('j F, Y') }}
                                                            </td>
                                                            <td>{{ \Carbon\Carbon::parse($reference->end_date)->format('j F, Y') }}
                                                            </td>
                                                            <td>{{ $reference->email }}</td>
                                                            <td>{{ $reference->phoneno }}</td>
                                                            <td>
                                                                <a class="delete-table me-2" href="#">
                                                                    <img src="{{ asset('assets') }}/img/icons/eye.svg"
                                                                        alt="Eye Icon" />
                                                                </a>
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
                        <div class="col-md-12">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <div class="file-cont-inner">
                                        <div class="file-content">
                                            <div class="file-body">
                                                <div class="file-scroll">
                                                    <div class="file-content-inner">
                                                        <h4>Recents Documents
                                                        </h4>
                                                        <div class="row row-sm">
                                                            @if (count($employee->document))
                                                                @foreach ($employee->document as $document)
                                                                    <div class="col-12 col-sm-4 col-md-3 col-lg-4 col-xl-3">
                                                                        <div class="card card-file">
                                                                            <div class="dropdown-file">
                                                                                <a href="#" class="dropdown-link"
                                                                                    data-bs-toggle="dropdown"><i
                                                                                        class="fa-solid fa-ellipsis-vertical"></i></a>
                                                                                <div class="dropdown-menu dropdown-menu-right">
        
                                                                                    <a href="{{ $document->file_path }}"
                                                                                        target="_blank"
                                                                                        class="dropdown-item">Download</a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-file-thumb">
                                                                                @if ($document->document_extension == 'pdf')
                                                                                    <a href="{{ $document->file_path }}"
                                                                                        target="_blank"><i
                                                                                            class="fa-regular fa-file-pdf"></i></a>
                                                                                @elseif($document->document_extension == 'docx')
                                                                                    <a href="{{ $document->file_path }}"
                                                                                        target="_blank"><i
                                                                                            class="fa-regular fa-file-word"></i></a>
                                                                                @else
                                                                                    <a href="{{ $document->file_path }}"
                                                                                        target="_blank"><i
                                                                                            class="fa-regular fa-file-image"></i></a>
                                                                                @endif
        
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <h6><a
                                                                                        href="#">{{ $document->document_type }}.{{ $document->document_extension }}</a>
                                                                                </h6>
                                                                                <span>12mb</span>
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                Issued: {{ \Carbon\Carbon::parse($document->issued_date)->format('j F, Y') }},
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                Expire: {{ \Carbon\Carbon::parse($document->expiry_date)->format('j F, Y') }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="approve_modal" tabindex="-1" aria-labelledby="approveModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Approve Employee
                                    Record</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Hey! are you sure you want to approve employee? This action cannot
                                be undone.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <a href="#" type="button" class="btn btn-primary">Confirm</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="disapprove_modal" tabindex="-1" aria-labelledby="disapproveModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Disapprove Employee
                                    Record</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form action="#">
                                <div class="modal-body">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Reason
                                            <span class="text-danger">*</span></label>
                                        <textarea name="reason" required class="form-control" id="reason" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <a href="#" type="button" class="btn btn-primary">Confirm</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="emp_assets">
                    <div class="table-responsive table-newdatatable">
                        <table class="table table-new custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Asset ID</th>
                                    <th>Assigned Date</th>
                                    <th>Assignee</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <a href="assets-details.html" class="table-imgname">
                                            <img src="{{ asset('assets') }}/img/laptop.png" class="me-2"
                                                alt="Laptop Image" />
                                            <span>Laptop</span>
                                        </a>
                                    </td>
                                    <td>AST - 001</td>
                                    <td>22 Nov, 2022 10:32AM</td>
                                    <td class="table-namesplit">
                                        <a href="javascript:void(0);" class="table-profileimage">
                                            <img src="{{ asset('assets') }}/img/profiles/avatar-02.jpg" class="me-2"
                                                alt="User Image" />
                                        </a>
                                        <a href="javascript:void(0);" class="table-name">
                                            <span>John Paul Raj</span>
                                            <p>
                                                <span class="__cf_email__"
                                                    data-cfemail="dab0b5b2b49abea8bfbbb7bdafa3a9aebfb9b2f4b9b5b7">[email&#160;protected]</span>
                                            </p>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="table-actions d-flex">
                                            <a class="delete-table me-2" href="user-asset-details.html">
                                                <img src="{{ asset('assets') }}/img/icons/eye.svg" alt="Eye Icon" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <a href="assets-details.html" class="table-imgname">
                                            <img src="{{ asset('assets') }}/img/laptop.png" class="me-2"
                                                alt="Laptop Image" />
                                            <span>Laptop</span>
                                        </a>
                                    </td>
                                    <td>AST - 002</td>
                                    <td>22 Nov, 2022 10:32AM</td>
                                    <td class="table-namesplit">
                                        <a href="javascript:void(0);" class="table-profileimage" data-bs-toggle="modal"
                                            data-bs-target="#edit-asset">
                                            <img src="{{ asset('assets') }}/img/profiles/avatar-05.jpg" class="me-2"
                                                alt="User Image" />
                                        </a>
                                        <a href="javascript:void(0);" class="table-name">
                                            <span>Vinod Selvaraj</span>
                                            <p>
                                                <span class="__cf_email__"
                                                    data-cfemail="06706f686962287546627463676b61737f757263656e2865696b">[email&#160;protected]</span>
                                            </p>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="table-actions d-flex">
                                            <a class="delete-table me-2" href="user-asset-details.html">
                                                <img src="{{ asset('assets') }}/img/icons/eye.svg" alt="Eye Icon" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <a href="assets-details.html" class="table-imgname">
                                            <img src="{{ asset('assets') }}/img/keyboard.png" class="me-2"
                                                alt="Keyboard Image" />
                                            <span>Dell Keyboard</span>
                                        </a>
                                    </td>
                                    <td>AST - 003</td>
                                    <td>22 Nov, 2022 10:32AM</td>
                                    <td class="table-namesplit">
                                        <a href="javascript:void(0);" class="table-profileimage" data-bs-toggle="modal"
                                            data-bs-target="#edit-asset">
                                            <img src="{{ asset('assets') }}/img/profiles/avatar-03.jpg" class="me-2"
                                                alt="User Image" />
                                        </a>
                                        <a href="javascript:void(0);" class="table-name">
                                            <span>Harika </span>
                                            <p>
                                                <span class="__cf_email__"
                                                    data-cfemail="aac2cbd8c3c1cb84dceaced8cfcbc7cddfd3d9decfc9c284c9c5c7">[email&#160;protected]</span>
                                            </p>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="table-actions d-flex">
                                            <a class="delete-table me-2" href="user-asset-details.html">
                                                <img src="{{ asset('assets') }}/img/icons/eye.svg" alt="Eye Icon" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>
                                        <a href="#" class="table-imgname">
                                            <img src="{{ asset('assets') }}/img/mouse.png" class="me-2"
                                                alt="Mouse Image" />
                                            <span>Logitech Mouse</span>
                                        </a>
                                    </td>
                                    <td>AST - 0024</td>
                                    <td>22 Nov, 2022 10:32AM</td>
                                    <td class="table-namesplit">
                                        <a href="assets-details.html" class="table-profileimage">
                                            <img src="{{ asset('assets') }}/img/profiles/avatar-02.jpg" class="me-2"
                                                alt="User Image" />
                                        </a>
                                        <a href="assets-details.html" class="table-name">
                                            <span>Mythili</span>
                                            <p>
                                                <span class="__cf_email__"
                                                    data-cfemail="7c110508141510153c180e191d111b09050f08191f14521f1311">[email&#160;protected]</span>
                                            </p>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="table-actions d-flex">
                                            <a class="delete-table me-2" href="user-asset-details.html">
                                                <img src="{{ asset('assets') }}/img/icons/eye.svg" alt="Eye Icon" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>
                                        <a href="#" class="table-imgname">
                                            <img src="{{ asset('assets') }}/img/laptop.png" class="me-2"
                                                alt="Laptop Image" />
                                            <span>Laptop</span>
                                        </a>
                                    </td>
                                    <td>AST - 005</td>
                                    <td>22 Nov, 2022 10:32AM</td>
                                    <td class="table-namesplit">
                                        <a href="assets-details.html" class="table-profileimage">
                                            <img src="{{ asset('assets') }}/img/profiles/avatar-02.jpg" class="me-2"
                                                alt="User Image" />
                                        </a>
                                        <a href="assets-details.html" class="table-name">
                                            <span>John Paul Raj</span>
                                            <p>
                                                <span class="__cf_email__"
                                                    data-cfemail="7a101512143a1e081f1b171d0f03090e1f191254191517">[email&#160;protected]</span>
                                            </p>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="table-actions d-flex">
                                            <a class="delete-table me-2" href="user-asset-details.html">
                                                <img src="{{ asset('assets') }}/img/icons/eye.svg" alt="Eye Icon" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>
                                        <a href="#" class="table-imgname">
                                            <img src="{{ asset('assets') }}/img/laptop.png" class="me-2"
                                                alt="Laptop Image" />
                                            <span>Laptop</span>
                                        </a>
                                    </td>
                                    <td>AST - 006</td>
                                    <td>22 Nov, 2022 10:32AM</td>
                                    <td class="table-namesplit">
                                        <a href="javascript:void(0);" class="table-profileimage">
                                            <img src="{{ asset('assets') }}/img/profiles/avatar-05.jpg" class="me-2"
                                                alt="User Image" />
                                        </a>
                                        <a href="javascript:void(0);" class="table-name">
                                            <span>Vinod Selvaraj</span>
                                            <p>
                                                <span class="__cf_email__"
                                                    data-cfemail="5a2c3334353e74291a3e283f3b373d2f23292e3f393274393537">[email&#160;protected]</span>
                                            </p>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="table-actions d-flex">
                                            <a class="delete-table me-2" href="user-asset-details.html">
                                                <img src="{{ asset('assets') }}/img/icons/eye.svg" alt="Eye Icon" />
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
@endsection
