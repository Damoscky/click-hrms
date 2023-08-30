@extends('layouts.admin.app')

@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Departments</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.department.all') }}">All Departments</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_department"><i
                                class="fa-solid fa-plus"></i> Add Department</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 d-flex">
                    <div class="stats-info w-100">
                        <h6>Total Departments</h6>
                        <h4>{{$departments->count()}} </h4>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="stats-info w-100">
                        <h6>Active Department</h6>
                        <h4>{{$activeDepartments}} </h4>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="stats-info w-100">
                        <h6>Inactive Department</h6>
                        <h4>{{$inactiveDepartments}} </h4>
                    </div>
                </div>

            </div>

            {{-- <div class="row filter-row">
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-12">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" name="department_name" class="form-control floating" />
                        <label class="focus-label">Department Name</label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-12">
                    <div class="input-block mb-3 form-focus select-focus">
                        <select class="select floating">
                            <option>Please Select...</option>
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                        <label class="focus-label">Status</label>
                    </div>
                </div>


                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 col-12">
                    <a href="#" class="btn btn-success w-100"> Search </a>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                    <th class="text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($departments) > 0)
                                    @foreach ($departments as $department)
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#">{{$department->name}}</a>
                                                </h2>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($department->created_at)->format('j F, Y') }}</td>
                                            @if ($department->is_active)
                                            <td> 
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#deactivate_department"
                                                    class="btn btn-success mt-2 mb-2">Active
                                                </a>
                                                
                                            </td>
                                            @else
                                            <td> 
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#activate_department"
                                                    class="btn btn-warning mt-2 mb-2">Inactive
                                                </a>
                                            
                                            </td>
                                            @endif
                                            <td class="text-center">
                                                <a class="btn btn-danger" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete_department{{$department->id}}"><i
                                                    class="fa-regular fa-trash-can m-r-5"></i>Delete</a>
                                            </td>
                                            <div class="modal custom-modal fade" tabindex="-1" id="delete_department{{$department->id}}" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="form-header">
                                                                <h3>Delete {{$department->name}}</h3>
                                                                <p>Are you sure want to delete this department?</p>
                                                            </div>
                                                            <div class="modal-btn delete-action">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <a href="{{route('admin.department.delete', base64_encode($department->id))}}" class="btn btn-primary continue-btn" id="modal-item-id" >Delete </a>
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
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="add_department" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.department.create')}}" method="post">
                            {{ csrf_field() }}
                            <div class="input-block mb-3">
                                <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                <div>
                                    <input class="form-control" required name="department_name" type="text" />
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

        <div id="edit_department" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="input-block mb-3">
                                <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                <div>
                                    <input class="form-control" type="text" />
                                </div>
                            </div>


                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal custom-modal fade" id="approve_leave" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Leave Approve</h3>
                            <p>Are you sure want to approve for this leave?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">Approve</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-bs-dismiss="modal"
                                        class="btn btn-primary cancel-btn">Decline</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
    </div>

@endsection
