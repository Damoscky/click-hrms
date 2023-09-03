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
                                <a href="{{route('admin.dashboard')}}">Dashboard</a>
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
                                            <a href="#"><img src="{{ $client->image }}"
                                                    alt="Profile Picture" /></a>
                                        @else
                                            <a href="#"><img
                                                    src="{{ asset('assets') }}/img/user.png" alt="Client Logo" /></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{$client->company_name}}</h3>
                                                <div class="staff-id">Client ID : {{$client->client_id}}</div>
                                                <div class="small doj text-muted">
                                                    Date Created : {{ \Carbon\Carbon::parse($client->created_at)->format('j F, Y') }}
                                                </div>
                                                <div class="staff-msg">
                                                    @if ($client->user->sent_for_approval && $client->status == 'Review')
                                                        <a class="btn btn-success" data-bs-toggle="modal"
                                                            data-bs-target="#approve_modal">Accept</a>
                                                        <a class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#disapprove_modal">Decline</a>
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
                                                            href="tel:{{ $client->phoneno }}">{{ $client->phoneno }}</a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text">
                                                        <a href="mailto:{{ $client->user->email }}"><span class="__cf_email__"
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
                                            <div class="text">{{$companySetting->currency}}{{$companySetting->standard_hca}}/h</div>
                                        </li>

                                        <li>
                                            <div class="title">Senior HCA</div>
                                            <div class="text">{{$companySetting->currency}}{{$companySetting->senior_hca}}/h</div>
                                        </li>
                                        <li>
                                            <div class="title">RGN</div>
                                            <div class="text">{{$companySetting->currency}}{{$companySetting->rgn}}/h</div>
                                        </li>
                                        <li>
                                            <div class="title">Kitchen Assistant / Chef</div>
                                            <div class="text">{{$companySetting->currency}}{{$companySetting->standard_hca}}/h</div>
                                        </li>
                                        <li>
                                            <div class="title">Laundry / Domestic</div>
                                            <div class="text">{{$companySetting->currency}}{{$companySetting->laundry}}/h</div>
                                        </li>
                                    </ul>
                                    <hr />
                                    <h3 class="card-title">Client Rate</h3>
                                    
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">HCA</div>
                                            <div class="text">{{$companySetting->currency}}{{$client->standard_hca}}/h</div>
                                        </li>
                                        <li>
                                            <div class="title">Senior HCA</div>
                                            <div class="text">{{$companySetting->currency}}{{$client->senior_hca}}/h</div>
                                        </li>
                                        <li>
                                            <div class="title">RGN</div>
                                            <div class="text">{{$companySetting->currency}}{{$client->rgn}}/h</div>
                                        </li>
                                        <li>
                                            <div class="title">Kitchen Assistant / Chef</div>
                                            <div class="text">{{$companySetting->currency}}{{$client->kitchen_assistant}}/h</div>
                                        </li>
                                        <li>
                                            <div class="title">Laundry / Domestic</div>
                                            <div class="text">{{$companySetting->currency}}{{$client->laundry}}/h</div>
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
                                    <iframe
                                        width="100%"     
                                        height="400" 
                                        frameborder="0" 
                                        style="border:0"
                                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyApcI-eCy2vhDU9Fx4GmhKsysL8xoZ69oU&q={{$client->location}}">
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <div class="file-cont-inner">
                                <div class="file-content">
                                    <div class="file-body">
                                        <div class="file-scroll">
                                            <div class="file-content-inner">
                                                <h4>Contract Document - {{$client->company_name}}
                                                </h4>
                                                <object data="{{$client->contract_document}}" 
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
                            <form action="{{route('admin.client.disapprove', base64_encode($client->user->id))}}" method="POST">
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
