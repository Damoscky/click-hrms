@extends('layouts.admin.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Client Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            @php
                $companySetting = App\Models\CompanySetting::first();
            @endphp

            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        @if (isset($client->image))
                                            <a href="#"><img src="{{ $client->image }}" alt="Profile Picture" /></a>
                                        @else
                                            <a href="#"><img src="{{ asset('assets') }}/img/user.png"
                                                    alt="Client Logo" /></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ $client->company_name }}</h3>
                                                <div class="staff-id">Client ID : {{ $client->client_id }}</div>
                                                <div class="small doj text-muted">
                                                    Date Created :
                                                    {{ \Carbon\Carbon::parse($client->created_at)->format('j F, Y') }}
                                                </div>
                                                <div class="staff-msg">
                                                    @if ($client->user->sent_for_approval && $client->user->status == 'Review')
                                                        <a class="btn btn-success" data-bs-toggle="modal"
                                                            data-bs-target="#approve_modal">Accept</a>
                                                        <a class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#disapprove_modal">Decline</a>
                                                    @else
                                                        <a class="btn btn-custom"
                                                            href="{{ route('admin.chat', base64_encode($client->user->id)) }}">Send
                                                            Message</a>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Phone:</div>
                                                    <div class="text"><a
                                                            href="tel:{{ $client->phoneno }}">{{ $client->phoneno }}</a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text">
                                                        <a href="mailto:{{ $client->user->email }}"><span
                                                                class="__cf_email__"
                                                                data-cfemail="c9a3a6a1a7ada6ac89acb1a8a4b9a5ace7aaa6a4">{{ $client->user->email }}</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Address:</div>
                                                    <div class="text">
                                                        {{ $client->address }},
                                                        {{ $client->city }}.
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Postcode:</div>
                                                    <div class="text">{{ $client->post_code }}</div>
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
            <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item">
                                <a href="#client_profile" data-bs-toggle="tab" class="nav-link active">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="#shift_tab" data-bs-toggle="tab" class="nav-link">Shifts</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div id="client_profile" class="pro-overview tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        Company Rate
                                        {{-- <a href="#" class="edit-icon" data-bs-toggle="modal"
                                            data-bs-target="#personal_info_modal"><i class="fa-solid fa-pencil"></i></a> --}}
                                    </h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">HCA</div>
                                            <div class="text">
                                                {{ $companySetting->currency }}{{ $companySetting->standard_hca }}/h</div>
                                        </li>

                                        <li>
                                            <div class="title">Senior HCA</div>
                                            <div class="text">
                                                {{ $companySetting->currency }}{{ $companySetting->senior_hca }}/h</div>
                                        </li>
                                        <li>
                                            <div class="title">RGN</div>
                                            <div class="text">
                                                {{ $companySetting->currency }}{{ $companySetting->rgn }}/h</div>
                                        </li>
                                        <li>
                                            <div class="title">Kitchen Assistant / Chef</div>
                                            <div class="text">
                                                {{ $companySetting->currency }}{{ $companySetting->standard_hca }}/h</div>
                                        </li>
                                        <li>
                                            <div class="title">Laundry / Domestic</div>
                                            <div class="text">
                                                {{ $companySetting->currency }}{{ $companySetting->laundry }}/h</div>
                                        </li>
                                    </ul>
                                    <hr />
                                    <h3 class="card-title">Client Rate</h3>

                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">HCA</div>
                                            <div class="text">
                                                {{ $companySetting->currency }}{{ $client->standard_hca }}/h</div>
                                        </li>
                                        <li>
                                            <div class="title">Senior HCA</div>
                                            <div class="text">{{ $companySetting->currency }}{{ $client->senior_hca }}/h
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">RGN</div>
                                            <div class="text">{{ $companySetting->currency }}{{ $client->rgn }}/h</div>
                                        </li>
                                        <li>
                                            <div class="title">Kitchen Assistant / Chef</div>
                                            <div class="text">
                                                {{ $companySetting->currency }}{{ $client->kitchen_assistant }}/h</div>
                                        </li>
                                        <li>
                                            <div class="title">Laundry / Domestic</div>
                                            <div class="text">{{ $companySetting->currency }}{{ $client->laundry }}/h
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        Client Location
                                    </h3>
                                    <iframe width="100%" height="400" frameborder="0" style="border:0"
                                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyApcI-eCy2vhDU9Fx4GmhKsysL8xoZ69oU&q={{ $client->location }}">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="shift_tab">
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
                                    <th>Total Staff Needed</th>
                                    <th>Total Staff Assigned</th>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <div class="file-cont-inner">
                                <div class="file-content">
                                    <div class="file-body">
                                        <div class="file-scroll">
                                            <div class="file-content-inner">
                                                <h4>Contract Document - {{ $client->company_name }}
                                                </h4>
                                                <object data="{{ $client->contract_document }}" width="100%"
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
        </div>
        <div class="modal custom-modal fade" id="disapprove_modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Disapprove Request?</h3>
                            <p>This action cannot be undone.</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('admin.client.disapprove', base64_encode($client->user->id)) }}"
                                method="POST">
                                {{ csrf_field() }}
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
        <div class="modal custom-modal fade" id="approve_modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Approve Client</h3>
                            <p>Are you sure you want to approve client? This action cannot
                                be undone.</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">

                                <div class="col-6">
                                    <a href="javascript:void(0);" data-bs-dismiss="modal"
                                        class="btn btn-secondary cancel-btn">Cancel</a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('admin.client.approve', base64_encode($client->user->id)) }}"
                                        class="btn btn-success continue-btn">Confirm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
