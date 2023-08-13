@extends('layouts.admin.app')

@section('content')
   
    <div class="page-wrapper">
        <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Employees</h3>
                    <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.employee.all')}}">All Employees</a>
                    </li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a
                    href="#"
                    class="btn add-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#add_employee"
                    ><i class="fa-solid fa-plus"></i> Add Employee</a
                    >
                </div>
            </div>
        </div>

        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
            <div class="input-block mb-3 form-focus">
                <input type="text" class="form-control floating" />
                <label class="focus-label">Employee ID</label>
            </div>
            </div>
            <div class="col-sm-6 col-md-3">
            <div class="input-block mb-3 form-focus">
                <input type="text" class="form-control floating" />
                <label class="focus-label">Employee Name</label>
            </div>
            </div>
            <div class="col-sm-6 col-md-3">
            <div class="input-block mb-3 form-focus select-focus">
                <select class="select floating">
                <option>Select Department</option>
                <option>Web Developer</option>
                <option>Web Designer</option>
                <option>Android Developer</option>
                <option>Ios Developer</option>
                </select>
                <label class="focus-label">Designation</label>
            </div>
            </div>
            <div class="col-sm-6 col-md-3">
            <div class="d-grid">
                <a href="#" class="btn btn-success w-100"> Search </a>
            </div>
            </div>
        </div>

        <div class="row staff-grid-row">
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                    <a href="{{route('admin.employee.show')}}" class="avatar"
                        ><img
                        src="{{asset('assets')}}/img/profiles/avatar-02.jpg"
                        alt="User Image"
                    /></a>
                </div>
                <div class="dropdown profile-action">
                    <a
                        href="#"
                        class="action-icon dropdown-toggle"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        ><i class="material-icons">more_vert</i></a
                    >
                    <div class="dropdown-menu dropdown-menu-right">
                        <a
                        class="dropdown-item"
                        href="#"
                        data-bs-toggle="modal"
                        data-bs-target="#edit_employee"
                        ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                        >
                        <a
                        class="dropdown-item"
                        href="#"
                        data-bs-toggle="modal"
                        data-bs-target="#delete_employee"
                        ><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a
                        >
                    </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                    <a href="profile.html">John Doe</a>
                </h4>
                <div class="small text-muted">Web Designer</div>
            </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                <a href="profile.html" class="avatar"
                    ><img
                    src="{{asset('assets')}}/img/profiles/avatar-09.jpg"
                    alt="User Image"
                /></a>
                </div>
                <div class="dropdown profile-action">
                <a
                    href="#"
                    class="action-icon dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    ><i class="material-icons">more_vert</i></a
                >
                <div class="dropdown-menu dropdown-menu-right">
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#edit_employee"
                    ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                    >
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#delete_employee"
                    ><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a
                    >
                </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                <a href="profile.html">Richard Miles</a>
                </h4>
                <div class="small text-muted">Support Worker</div>
            </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                <a href="profile.html" class="avatar"
                    ><img
                    src="{{asset('assets')}}/img/profiles/avatar-10.jpg"
                    alt="User Image"
                /></a>
                </div>
                <div class="dropdown profile-action">
                <a
                    href="#"
                    class="action-icon dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    ><i class="material-icons">more_vert</i></a
                >
                <div class="dropdown-menu dropdown-menu-right">
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#edit_employee"
                    ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                    >
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#delete_employee"
                    ><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a
                    >
                </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                <a href="profile.html">John Smith</a>
                </h4>
                <div class="small text-muted">Android Developer</div>
            </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                <a href="profile.html" class="avatar"
                    ><img
                    src="{{asset('assets')}}/img/profiles/avatar-05.jpg"
                    alt="User Image"
                /></a>
                </div>
                <div class="dropdown profile-action">
                <a
                    href="#"
                    class="action-icon dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    ><i class="material-icons">more_vert</i></a
                >
                <div class="dropdown-menu dropdown-menu-right">
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#edit_employee"
                    ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                    >
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#delete_employee"
                    ><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a
                    >
                </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                <a href="profile.html">Mike Litorus</a>
                </h4>
                <div class="small text-muted">IOS Developer</div>
            </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                <a href="profile.html" class="avatar"
                    ><img
                    src="{{asset('assets')}}/img/profiles/avatar-11.jpg"
                    alt="User Image"
                /></a>
                </div>
                <div class="dropdown profile-action">
                <a
                    href="#"
                    class="action-icon dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    ><i class="material-icons">more_vert</i></a
                >
                <div class="dropdown-menu dropdown-menu-right">
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#edit_employee"
                    ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                    >
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#delete_employee"
                    ><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a
                    >
                </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                <a href="profile.html">Wilmer Deluna</a>
                </h4>
                <div class="small text-muted">Team Leader</div>
            </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                <a href="profile.html" class="avatar"
                    ><img
                    src="{{asset('assets')}}/img/profiles/avatar-12.jpg"
                    alt="User Image"
                /></a>
                </div>
                <div class="dropdown profile-action">
                <a
                    href="#"
                    class="action-icon dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    ><i class="material-icons">more_vert</i></a
                >
                <div class="dropdown-menu dropdown-menu-right">
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#edit_employee"
                    ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                    >
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#delete_employee"
                    ><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a
                    >
                </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                <a href="profile.html">Jeffrey Warden</a>
                </h4>
                <div class="small text-muted">Support Worker</div>
            </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                <a href="profile.html" class="avatar"
                    ><img
                    src="{{asset('assets')}}/img/profiles/avatar-13.jpg"
                    alt="User Image"
                /></a>
                </div>
                <div class="dropdown profile-action">
                <a
                    href="#"
                    class="action-icon dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    ><i class="material-icons">more_vert</i></a
                >
                <div class="dropdown-menu dropdown-menu-right">
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#edit_employee"
                    ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                    >
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#delete_employee"
                    ><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a
                    >
                </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                <a href="profile.html">Bernardo Galaviz</a>
                </h4>
                <div class="small text-muted">Support Worker</div>
            </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                <a href="profile.html" class="avatar"
                    ><img
                    src="{{asset('assets')}}/img/profiles/avatar-01.jpg"
                    alt="User Image"
                /></a>
                </div>
                <div class="dropdown profile-action">
                <a
                    href="#"
                    class="action-icon dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    ><i class="material-icons">more_vert</i></a
                >
                <div class="dropdown-menu dropdown-menu-right">
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#edit_employee"
                    ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                    >
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#delete_employee"
                    ><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a
                    >
                </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                <a href="profile.html">Lesley Grauer</a>
                </h4>
                <div class="small text-muted">Team Leader</div>
            </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                <a href="profile.html" class="avatar"
                    ><img
                    src="{{asset('assets')}}/img/profiles/avatar-16.jpg"
                    alt="User Image"
                /></a>
                </div>
                <div class="dropdown profile-action">
                <a
                    href="#"
                    class="action-icon dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    ><i class="material-icons">more_vert</i></a
                >
                <div class="dropdown-menu dropdown-menu-right">
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#edit_employee"
                    ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                    >
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#delete_employee"
                    ><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a
                    >
                </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                <a href="profile.html">Jeffery Lalor</a>
                </h4>
                <div class="small text-muted">Team Leader</div>
            </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                <a href="profile.html" class="avatar"
                    ><img
                    src="{{asset('assets')}}/img/profiles/avatar-04.jpg"
                    alt="User Image"
                /></a>
                </div>
                <div class="dropdown profile-action">
                <a
                    href="#"
                    class="action-icon dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    ><i class="material-icons">more_vert</i></a
                >
                <div class="dropdown-menu dropdown-menu-right">
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#edit_employee"
                    ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                    >
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#delete_employee"
                    ><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a
                    >
                </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                <a href="profile.html">Loren Gatlin</a>
                </h4>
                <div class="small text-muted">Android Developer</div>
            </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                <a href="profile.html" class="avatar"
                    ><img
                    src="{{asset('assets')}}/img/profiles/avatar-03.jpg"
                    alt="User Image"
                /></a>
                </div>
                <div class="dropdown profile-action">
                <a
                    href="#"
                    class="action-icon dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    ><i class="material-icons">more_vert</i></a
                >
                <div class="dropdown-menu dropdown-menu-right">
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#edit_employee"
                    ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                    >
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#delete_employee"
                    ><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a
                    >
                </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                <a href="profile.html">Tarah Shropshire</a>
                </h4>
                <div class="small text-muted">Android Developer</div>
            </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                <a href="profile.html" class="avatar"
                    ><img
                    src="{{asset('assets')}}/img/profiles/avatar-08.jpg"
                    alt="User Image"
                /></a>
                </div>
                <div class="dropdown profile-action">
                <a
                    href="#"
                    class="action-icon dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    ><i class="material-icons">more_vert</i></a
                >
                <div class="dropdown-menu dropdown-menu-right">
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#edit_employee"
                    ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                    >
                    <a
                    class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#delete_employee"
                    ><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a
                    >
                </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                <a href="profile.html">Catherine Manseau</a>
                </h4>
                <div class="small text-muted">Android Developer</div>
            </div>
            </div>
        </div>
        </div>

        <div id="add_employee" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Employee</h5>
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
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="input-block mb-3">
                            <label class="col-form-label"
                            >First Name <span class="text-danger">*</span></label
                            >
                            <input class="form-control" name="first_name" type="text" />
                        </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Last Name</label>
                                <input class="form-control" name="last_name" type="text" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label"
                                >Email <span class="text-danger">*</span></label
                                >
                                <input class="form-control" name="" type="email" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label"
                                >Confirm Email <span class="text-danger">*</span></label
                                >
                                <input class="form-control" name="confirm_email" type="email" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label"
                                >Resumption Date
                                <span class="text-danger">*</span></label
                                >
                                <div class="cal-icon">
                                <input
                                    class="form-control datetimepicker"
                                    type="text"
                                />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Phone Number</label>
                                <input class="form-control" name="phone_number" type="text" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Gender</label>
                                <select class="select">
                                    <option value="Male">Male </option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label"
                                >Department <span class="text-danger">*</span></label
                                >
                                <select class="select">
                                    <option>Select Department</option>
                                    <option>Web Development</option>
                                    <option>IT Management</option>
                                    <option>Marketing</option>
                                </select>
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

        <div id="edit_employee" class="modal custom-modal fade" role="dialog">
        <div
            class="modal-dialog modal-dialog-centered modal-lg"
            role="document"
        >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee</h5>
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
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="input-block mb-3">
                            <label class="col-form-label"
                            >First Name <span class="text-danger">*</span></label
                            >
                            <input class="form-control" name="first_name" type="text" />
                        </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Last Name</label>
                                <input class="form-control" name="last_name" type="text" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label"
                                >Email <span class="text-danger">*</span></label
                                >
                                <input class="form-control" name="" type="email" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label"
                                >Confirm Email <span class="text-danger">*</span></label
                                >
                                <input class="form-control" name="confirm_email" type="email" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label"
                                >Resumption Date
                                <span class="text-danger">*</span></label
                                >
                                <div class="cal-icon">
                                <input
                                    class="form-control datetimepicker"
                                    type="text"
                                />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Phone Number</label>
                                <input class="form-control" name="phone_number" type="text" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Gender</label>
                                <select class="select">
                                    <option value="Male">Male </option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label"
                                >Department <span class="text-danger">*</span></label
                                >
                                <select class="select">
                                    <option>Select Department</option>
                                    <option>Web Development</option>
                                    <option>IT Management</option>
                                    <option>Marketing</option>
                                </select>
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

        <div class="modal custom-modal fade" id="delete_employee" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                <h3>Delete Employee</h3>
                <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                <div class="row">
                    <div class="col-6">
                    <a
                        href="javascript:void(0);"
                        class="btn btn-primary continue-btn"
                        >Delete</a
                    >
                    </div>
                    <div class="col-6">
                    <a
                        href="javascript:void(0);"
                        data-bs-dismiss="modal"
                        class="btn btn-primary cancel-btn"
                        >Cancel</a
                    >
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection