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
                                            <img class="img-fluid object-cover" src="{{ $employee->employeeRecord->image }}"
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
                                                        {{-- <a class="btn btn-custom" href="#">Send Message</a> --}}
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
                                                        {{ \Carbon\Carbon::parse($employee->employeeRecord->date_of_birth)->format('F j, Y') }}
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
                                <a href="#emp_shift" data-bs-toggle="tab" class="nav-link">Shifts</a>
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
                                                        <th>Send Reminder</th>
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
                                                                <a class="delete-table me-2" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#view_reference-{{$reference->id}}">
                                                                    <img src="{{ asset('assets') }}/img/icons/eye.svg"
                                                                        alt="Eye Icon" />
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-success" href="{{route('admin.employee.reference.notify', base64_encode($employee->id))}}">
                                                                    Send
                                                                </a>
                                                            </td>
                                                        </tr>

                                                        <div class="modal custom-modal fade" id="view_reference-{{$reference->id}}" role="dialog">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">{{$reference->user->first_name}} {{$reference->reference_type}} Reference</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="card punch-status">
                                                                                    <div class="card-body">
                                                                                        <h5 class="card-title">
                                                                                            {{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->name_of_organization : 'N/A'}}
                                                                                            
                                                                                        </h5>
                                                                                        <div class="punch-det">
                                                                                            <h6>Referee Name</h6>
                                                                                            <p>{{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->name_of_referee : 'N/A'}}</p>
                                                                                        </div>
                                                                                        <div class="punch-det">
                                                                                            <h6>Referee Phone</h6>
                                                                                            <p>{{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->telephone_number : 'N/A'}}</p>
                                                                                        </div>
                                                                                        <div class="punch-det">
                                                                                            <h6>Referee Email</h6>
                                                                                            <p>{{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->referee_email : 'N/A'}}</p>
                                                                                        </div>
                                                                                        <div class="punch-det">
                                                                                            <h6>Referee Position</h6>
                                                                                            <p>{{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->referee_position : 'N/A'}}</p>
                                                                                        </div>
                                                                                        <div class="punch-det">
                                                                                            <h6>Date of Employement</h6>
                                                                                            <p>{{isset($reference->employeeReferenceResponse) ? Carbon\Carbon::parse($reference->employeeReferenceResponse->date_of_employment)->format('l, j F, Y') : 'N/A'}}</p>
                                                                                        </div>
                                                                                        <div class="punch-det">
                                                                                            <h6>Employee Position</h6>
                                                                                            <p>{{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->position : 'N/A'}}</p>
                                                                                        </div>
                                                                                        <div class="punch-det">
                                                                                            <h6>Annual Income</h6>
                                                                                            <p>{{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->annual_income : 'N/A'}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="card punch-status">
                                                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="punch-det">
                                                                                                    <h6>Teamwork</h6>
                                                                                                    <p>{{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->teamwork : 'N/A'}}</p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <div class="punch-det">
                                                                                                    <h6>Honesty</h6>
                                                                                                    <p>{{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->honesty : 'N/A'}}</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="punch-det">
                                                                                                    <h6>Observation</h6>
                                                                                                    <p>{{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->observation : 'N/A'}}</p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <div class="punch-det">
                                                                                                    <h6>Appearance</h6>
                                                                                                    <p>{{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->appearance : 'N/A'}}</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="punch-det">
                                                                                                    <h6>Communication</h6>
                                                                                                    <p>{{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->communication : 'N/A'}}</p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <div class="punch-det">
                                                                                                    <h6>Altitude</h6>
                                                                                                    <p>{{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->altitude : 'N/A'}}</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card recent-activity">
                                                                                    <div class="card-body">
                                                                                        <h5 class="card-title">Reason for Leaving</h5>
                                                                                        <div class="punch-det">
                                                                                            <h6>{{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->reason_for_leaving : 'N/A'}}</h6>
                                                                                        </div>
                                                                                        <h5 class="card-title">Feedback</h5>
                                                                                        <div class="punch-det">
                                                                                            <h6>{{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->feedback : 'N/A'}}</h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card recent-activity">
                                                                                    <div class="card-body">
                                                                                        <div class="punch-det">
                                                                                            <h6>Date Submitted</h6>
                                                                                            <p>{{isset($reference->employeeReferenceResponse) ? Carbon\Carbon::parse($reference->employeeReferenceResponse->signed_date)->format('l, j F, Y') : 'N/A'}}</p>
                                                                                        </div>
                                                                                        <div class="punch-det">
                                                                                            <h6>Signed By</h6>
                                                                                            <p>{{isset($reference->employeeReferenceResponse) ? $reference->employeeReferenceResponse->signed_name : 'N/A'}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                        <div class="col-md-6">
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
                                                                    <div
                                                                        class="col-12 col-sm-4 col-md-3 col-lg-4 col-xl-3">
                                                                        <div class="card card-file">
                                                                            <div class="dropdown-file">
                                                                                <a href="#" class="dropdown-link"
                                                                                    data-bs-toggle="dropdown"><i
                                                                                        class="fa-solid fa-ellipsis-vertical"></i></a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right">

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
                                                                                <span>{{$document->size}}mb</span>
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                Issued:
                                                                                {{ \Carbon\Carbon::parse($document->issued_date)->format('j F, Y') }},
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                Expire:
                                                                                {{ \Carbon\Carbon::parse($document->expiry_date)->format('j F, Y') }}
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
                        <div class="col-md-6">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <div class="file-cont-inner">
                                        <div class="file-content">
                                            <div class="file-body">
                                                <div class="file-scroll">
                                                    <div class="file-content-inner">
                                                        <h4>Recents Certificates 
                                                            <a href="#" class="edit-icon" data-bs-toggle="modal"
                                                                data-bs-target="#certification_info"><i
                                                                class="fa-solid fa-plus"></i></a>
                                                        </h4>
                                                        <div class="row row-sm">
                                                            @if (count($employee->certificate))
                                                                @foreach ($employee->certificate as $document)
                                                                    <div
                                                                        class="col-12 col-sm-4 col-md-3 col-lg-4 col-xl-3">
                                                                        <div class="card card-file">
                                                                            <div class="dropdown-file">
                                                                                <a href="#" class="dropdown-link"
                                                                                    data-bs-toggle="dropdown"><i
                                                                                        class="fa-solid fa-ellipsis-vertical"></i></a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right">

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
                                                                                <span>{{$document->size}}mb</span>
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                Issued:
                                                                                {{ \Carbon\Carbon::parse($document->issued_date)->format('j F, Y') }},
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                Expire:
                                                                                {{ \Carbon\Carbon::parse($document->expiry_date)->format('j F, Y') }}
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
                @php
                    $currentDate = date('Y-m-d');
                @endphp
                <div id="certification_info" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Upload Certificate</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="admincertificateUploadForm" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="hidden" name="viewed_employee_id" value="{{$employee->id}}">
                                    <div class="form-scroll">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-block mb-3">
                                                            <select class="select" required name="document_type">
                                                                <option value="">Select Document Type</option>
                                                                <option value="Information Governance">Information Governance</option>
                                                                <option value="GDPR">GDPR</option>
                                                                <option value="Food Safety Level 2">Food Safety Level 2</option>
                                                                <option value="Medication Management">Medication Management Practical</option>
                                                                <option value="Basic Life Support">Basic Life Support</option>
                                                                <option value="Equality and Diversity">Equality and Diversity</option>
                                                                <option value="Fire Safety">Fire Safety</option>
                                                                <option value="Health and Safety">Health and Safety</option>
                                                                <option value="Infection Prevention and Control">Infection Prevention and Control</option>
                                                                <option value="First Aid">First Aid</option>
                                                                <option value="Person Centred Awareness and Communication">Person Centred Awareness and Communication</option>
                                                                <option value="Learning Disability Awareness">Learning Disability Awareness</option>
                                                                <option value="Epilepsy Awareness">Epilepsy Awareness</option>
                                                                <option value="Dementia Awareness">Dementia Awareness</option>
                                                                <option value="Autism Awareness">Autism Awareness</option>
                                                                <option value="Safeguarding Children">Safeguarding Children</option>
                                                                <option value="Medication Training (Practical)">Medication Training (Practical)</option>
                                                                <option value="Medication Training (Theory)">Medication Training (Theory)</option>
                                                                <option value="Moving & Handling (Practical)">Moving & Handling (Practical) </option>
                                                                <option value="Moving & Handling(Theory)">Moving & Handling (Theory) </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="input-block mb-3">
                                                            <input type="file" required name="document_file"
                                                                value="" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-block mb-3 form-focus focused">
                                                            <div>
                                                                <input type="date" required value="" name="issued_date"
                                                                    class="form-control" />
                                                            </div>
                                                            <label class="focus-label">Issued Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-block mb-3 form-focus focused">
                                                            <div>
                                                                <input type="date" value="" name="expiry_date"
                                                                    class="form-control" min="{{$currentDate}}" />
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
                                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal custom-modal fade" id="approve_modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Approve Employee</h3>
                                    <p>Are you sure you want to approve this employee? This action cannot
                                        be undone.</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">

                                        <div class="col-6">
                                            <a href="javascript:void(0);" data-bs-dismiss="modal"
                                                class="btn btn-secondary cancel-btn">Cancel</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('admin.employee.approve', base64_encode($employee->id)) }}"
                                                class="btn btn-success continue-btn">Confirm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal custom-modal fade" id="disapprove_modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Disapprove Employee</h3>
                                    <p>Are you sure you want to disapprove this employee? This action cannot
                                        be undone.</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <form action="{{route('admin.employee.disapprove', base64_encode($employee->id))}}" method="POST">
                                        {{csrf_field()}}
                                        <div class="row">
                                            <div class="input-block mb-3">
                                                <label class="col-form-label">Reason
                                                    <span class="text-danger">*</span></label>
                                                <textarea name="reason" required class="form-control" id="reason" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="col-6">
                                                <a href="javascript:void(0);" data-bs-dismiss="modal"
                                                    class="btn btn-secondary cancel-btn">Cancel</a>
                                            </div>
                                            <div class="col-6">
                                                <button class="btn btn-primary submit-btn continue-btn">Confirm</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                



                <div class="tab-pane fade" id="emp_shift">
                    <div class="table-responsive table-newdatatable">
                        <table class="table table-new custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Period</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Bank holiday</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($shifts) > 0)
                                    @foreach ($shifts as $shift)
                                    <tr>
                                        <td>{{ $shift->type }}</td>
                                        <td>{{ $shift->period }}</td>
                                        <td>{{ \Carbon\Carbon::parse($shift->date)->format('j F, Y') }}</td>
                                        <td>{{ $shift->start_time }}</td>
                                        <td>{{ $shift->end_time }}</td>
                                        <td>{{ $shift->bank_holiday == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $shift->total_staff }}</td>
                                        <td>{{ $shift->total_staff_assigned }}</td>
                                        @if ($shift->status == 'Pending')
                                            <td>
                                                <a href="#" class="btn btn-outline-secondary btn-sm"> Pending </a>
                                            </td>
                                        @elseif($shift->status == 'Completed')
                                            <td>
                                                <a href="#" class="btn btn-outline-success btn-sm"> Completed </a>
                                            </td>
                                        @elseif($shift->status == 'In Progress')
                                            <td>
                                                <a href="#" class="btn btn-outline-primary btn-sm"> In Progress
                                                </a>
                                            </td>
                                        @elseif($shift->status == 'Assigned')
                                            <td>
                                                <a href="#" class="btn btn-outline-primary btn-sm"> Assigned </a>
                                            </td>
                                        @elseif($shift->status == 'Cancelled')
                                            <td>
                                                <a href="#" class="btn btn-outline-danger btn-sm"> Cancelled </a>
                                            </td>
                                        @endif
                                        
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
