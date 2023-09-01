@extends('layouts.admin.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome {{auth()->user()->first_name}}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa-solid fa-user"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{$totalClient->count()}}</h3>
                                <span>Total Clients</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa-regular fa-gem"></i></span>
                            <div class="dash-widget-info">
                                <h3>0</h3>
                                <span>Total Shifts</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa-solid fa-users"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{$totalEmployee->count()}}</h3>
                                <span>Total Employees</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Shift Overview</h3>
                                    <canvas id="barChart" width="400" height="300"></canvas>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Monthly Revenue</h3>
                                    <canvas id="lineChart" width="400" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <h4 class="card-title">Shift Statistics</h4>
                            <div class="statistics">
                                <div class="row">
                                    <div class="col-md-6 col-6 text-center">
                                        <div class="stats-box mb-4">
                                            <p>Pending Shifts</p>
                                            <h3>0</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6 text-center">
                                        <div class="stats-box mb-4">
                                            <p>Completed Shifts</p>
                                            <h3>0</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mb-4">
                               
                                <div class="progress-bar bg-warning w-50" role="progressbar" aria-valuenow="1850"
                                    aria-valuemin="0" aria-valuemax="100">
                                    50%
                                </div>
                                <div class="progress-bar bg-success w-50" role="progressbar" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100">
                                    50%
                                </div>
                                
                            </div>
                            <div>
                                <p>
                                    <i class="fa-regular fa-circle-dot text-success me-2"></i>Completed Shifts <span
                                        class="float-end">0</span>
                                </p>
                                <p>
                                    <i class="fa-regular fa-circle-dot text-warning me-2"></i>Pending Shifts <span
                                        class="float-end">0</span>
                                </p>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <h4 class="card-title">
                                Recent Timesheet
                                {{-- <span class="badge bg-inverse-danger ms-2">5</span> --}}
                            </h4>
                            <div class="leave-info-box">
                                <div class="media d-flex align-items-center">
                                    <a href="profile.html" class="avatar"><img src="{{asset('assets')}}/img/user.jpg"
                                            alt="User Image" /></a>
                                    <div class="media-body flex-grow-1">
                                        <div class="text-sm my-0">FirstHealth Care</div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-3">
                                    <div class="col-6">
                                        <h6 class="mb-0">4 Sep 2023</h6>
                                        <span class="text-sm text-muted">Leave Date</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="badge bg-inverse-danger">Pending</span>
                                    </div>
                                </div>
                            </div>
                            <div class="leave-info-box">
                                <div class="media d-flex align-items-center">
                                    <a href="profile.html" class="avatar"><img src="{{asset('assets')}}/img/user.jpg"
                                            alt="User Image" /></a>
                                    <div class="media-body flex-grow-1">
                                        <div class="text-sm my-0">Martin Lewis</div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-3">
                                    <div class="col-6">
                                        <h6 class="mb-0">4 Sep 2019</h6>
                                        <span class="text-sm text-muted">Leave Date</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="badge bg-inverse-success">Approved</span>
                                    </div>
                                </div>
                            </div>
                            <div class="load-more text-center">
                                <a class="text-dark" href="javascript:void(0);">Load More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Top Performing Clients</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar"><img
                                                            src="assets/img/profiles/avatar-19.jpg"
                                                            alt="User Image" /></a>
                                                    <a href="client-profile.html">Barry Cuda <span>CEO</span></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <a href="https://smarthr.dreamguystech.com/cdn-cgi/l/email-protection"
                                                    class="__cf_email__"
                                                    data-cfemail="1e7c7f6c6c677d6b7a7f5e7b667f736e727b307d7173">[email&#160;protected]</a>
                                            </td>
                                            <td>
                                                <div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                        href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-regular fa-circle-dot text-success"></i>
                                                        Active
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fa-regular fa-circle-dot text-success"></i>
                                                            Active</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fa-regular fa-circle-dot text-danger"></i>
                                                            Inactive</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-solid fa-pencil m-r-5"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-regular fa-trash-can m-r-5"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar"><img
                                                            src="assets/img/profiles/avatar-19.jpg"
                                                            alt="User Image" /></a>
                                                    <a href="client-profile.html">Tressa Wexler <span>Manager</span></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <a href="https://smarthr.dreamguystech.com/cdn-cgi/l/email-protection"
                                                    class="__cf_email__"
                                                    data-cfemail="1460667167677563716c78716654716c75796478713a777b79">[email&#160;protected]</a>
                                            </td>
                                            <td>
                                                <div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                        href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-regular fa-circle-dot text-danger"></i>
                                                        Inactive
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fa-regular fa-circle-dot text-success"></i>
                                                            Active</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fa-regular fa-circle-dot text-danger"></i>
                                                            Inactive</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-solid fa-pencil m-r-5"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-regular fa-trash-can m-r-5"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="client-profile.html" class="avatar"><img
                                                            src="assets/img/profiles/avatar-07.jpg"
                                                            alt="User Image" /></a>
                                                    <a href="client-profile.html">Ruby Bartlett <span>CEO</span></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <a href="https://smarthr.dreamguystech.com/cdn-cgi/l/email-protection"
                                                    class="__cf_email__"
                                                    data-cfemail="067473647f646774726a63727246637e676b766a632865696b">[email&#160;protected]</a>
                                            </td>
                                            <td>
                                                <div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                        href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-regular fa-circle-dot text-danger"></i>
                                                        Inactive
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fa-regular fa-circle-dot text-success"></i>
                                                            Active</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fa-regular fa-circle-dot text-danger"></i>
                                                            Inactive</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-solid fa-pencil m-r-5"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-regular fa-trash-can m-r-5"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="client-profile.html" class="avatar"><img
                                                            src="assets/img/profiles/avatar-06.jpg"
                                                            alt="User Image" /></a>
                                                    <a href="client-profile.html">
                                                        Misty Tison <span>CEO</span></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <a href="https://smarthr.dreamguystech.com/cdn-cgi/l/email-protection"
                                                    class="__cf_email__"
                                                    data-cfemail="7815110b0c010c110b1716381d00191508141d561b1715">[email&#160;protected]</a>
                                            </td>
                                            <td>
                                                <div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                        href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-regular fa-circle-dot text-success"></i>
                                                        Active
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fa-regular fa-circle-dot text-success"></i>
                                                            Active</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fa-regular fa-circle-dot text-danger"></i>
                                                            Inactive</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-solid fa-pencil m-r-5"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-regular fa-trash-can m-r-5"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="client-profile.html" class="avatar"><img
                                                            src="assets/img/profiles/avatar-14.jpg"
                                                            alt="User Image" /></a>
                                                    <a href="client-profile.html">
                                                        Daniel Deacon <span>CEO</span></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <a href="https://smarthr.dreamguystech.com/cdn-cgi/l/email-protection"
                                                    class="__cf_email__"
                                                    data-cfemail="2e4a4f40474b424a4b4f4d41406e4b564f435e424b004d4143">[email&#160;protected]</a>
                                            </td>
                                            <td>
                                                <div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                        href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-regular fa-circle-dot text-danger"></i>
                                                        Inactive
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fa-regular fa-circle-dot text-success"></i>
                                                            Active</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fa-regular fa-circle-dot text-danger"></i>
                                                            Inactive</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-solid fa-pencil m-r-5"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-regular fa-trash-can m-r-5"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="clients.html">View all clients</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Top Performing Employees</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Project Name</th>
                                            <th>Progress</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h2>
                                                    <a href="project-view.html">Office Management</a>
                                                </h2>
                                                <small class="block text-ellipsis">
                                                    <span>1</span>
                                                    <span class="text-muted">open tasks, </span>
                                                    <span>9</span>
                                                    <span class="text-muted">tasks completed</span>
                                                </small>
                                            </td>
                                            <td>
                                                <div class="progress progress-xs progress-striped">
                                                    <div class="progress-bar w-65" role="progressbar"
                                                        data-bs-toggle="tooltip" title="65%"></div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-solid fa-pencil m-r-5"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-regular fa-trash-can m-r-5"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h2>
                                                    <a href="project-view.html">Project Management</a>
                                                </h2>
                                                <small class="block text-ellipsis">
                                                    <span>2</span>
                                                    <span class="text-muted">open tasks, </span>
                                                    <span>5</span>
                                                    <span class="text-muted">tasks completed</span>
                                                </small>
                                            </td>
                                            <td>
                                                <div class="progress progress-xs progress-striped">
                                                    <div class="progress-bar w-15" role="progressbar"
                                                        data-bs-toggle="tooltip" title="15%"></div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-solid fa-pencil m-r-5"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-regular fa-trash-can m-r-5"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h2>
                                                    <a href="project-view.html">Video Calling App</a>
                                                </h2>
                                                <small class="block text-ellipsis">
                                                    <span>3</span>
                                                    <span class="text-muted">open tasks, </span>
                                                    <span>3</span>
                                                    <span class="text-muted">tasks completed</span>
                                                </small>
                                            </td>
                                            <td>
                                                <div class="progress progress-xs progress-striped">
                                                    <div class="progress-bar w-50" role="progressbar"
                                                        data-bs-toggle="tooltip" title="50%"></div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-solid fa-pencil m-r-5"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-regular fa-trash-can m-r-5"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h2>
                                                    <a href="project-view.html">Hospital Administration</a>
                                                </h2>
                                                <small class="block text-ellipsis">
                                                    <span>12</span>
                                                    <span class="text-muted">open tasks, </span>
                                                    <span>4</span>
                                                    <span class="text-muted">tasks completed</span>
                                                </small>
                                            </td>
                                            <td>
                                                <div class="progress progress-xs progress-striped">
                                                    <div class="progress-bar w-88" role="progressbar"
                                                        data-bs-toggle="tooltip" title="88%"></div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-solid fa-pencil m-r-5"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-regular fa-trash-can m-r-5"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h2>
                                                    <a href="project-view.html">Digital Marketplace</a>
                                                </h2>
                                                <small class="block text-ellipsis">
                                                    <span>7</span>
                                                    <span class="text-muted">open tasks, </span>
                                                    <span>14</span>
                                                    <span class="text-muted">tasks completed</span>
                                                </small>
                                            </td>
                                            <td>
                                                <div class="progress progress-xs progress-striped">
                                                    <div class="progress-bar w-100" role="progressbar"
                                                        data-bs-toggle="tooltip" title="100%"></div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-solid fa-pencil m-r-5"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                class="fa-regular fa-trash-can m-r-5"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="projects.html">View all projects</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
