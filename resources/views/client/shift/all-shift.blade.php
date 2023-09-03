@extends('layouts.client.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Shifts</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.shift.all') }}">All Shifts</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_shift">
                            <i class="fa-solid fa-plus"></i> Request Shift</a>
                    </div>
                </div>
            </div>

            <div class="row filter-row">
                <div class="col-sm-6 col-md-4">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating" />
                        <label class="focus-label">Type</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="input-block mb-3 form-focus select-focus">
                        <select class="select floating">
                            <option>-- Select Status --</option>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                            <option value="In Progress">In Progress</option>
                        </select>
                        <label class="focus-label">Status</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="d-grid">
                        <a href="#" class="btn btn-success"> Search </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Period</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Bank holiday</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($clientShifts) > 0)
                                    
                                    @foreach ($clientShifts as $shift)
                                        <tr>
                                            <td>{{$shift->type}}</td>
                                            <td>{{$shift->period}}</td>
                                            <td>{{ \Carbon\Carbon::parse($shift->date)->format('j F, Y') }}</td>
                                            <td>{{$shift->start_time}}</td>
                                            <td>{{$shift->end_time}}</td>
                                            <td>{{($shift->bank_holiday == 1) ? 'Yes' : 'No'}}</td>
                                            @if ($shift->status == "Pending")
                                                <td>
                                                    <a href="#" class="btn btn-outline-secondary btn-sm"> Pending </a>
                                                </td>
                                            @elseif($shift->status == "Completed")
                                                <td>
                                                    <a href="#" class="btn btn-outline-success btn-sm"> Completed </a>
                                                </td>
                                            @elseif($shift->status == "In Progress")
                                                <td>
                                                    <a href="#" class="btn btn-outline-primary btn-sm"> In Progress </a>
                                                </td>
                                            @endif
                                            <td>
                                                <a href="#" class="btn btn-outline-secondary"> View </a>
                                                @if ($shift->status == "Pending")
                                                    <a href="#" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#edit_shift-{{$shift->id}}"> Edit </a> 
                                                @endif
                                                @if ($shift->status == "Pending" || $shift->status == 'Assigned')
                                                    <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal"
                                                    data-bs-target="#cancel_shift-{{$shift->id}}"> Cancel </a> 
                                                @endif
                                            </td>
                                        </tr>
                                        <div id="edit_shift-{{$shift->id}}" class="modal custom-modal fade" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Shift</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('client.shift.update', base64_encode($shift->id))}}" method="post">
                                                            {{ csrf_field() }}
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">Type <span class="text-danger">*</span></label>
                                                                        <select required class="form-control" name="type">
                                                                            <option value="{{$shift->type}}">{{$shift->type}}</option>
                                                                            <option value="HCA">HCA</option>
                                                                            <option value="Senior HCA">Senior HCA</option>
                                                                            <option value="RGN">RGN</option>
                                                                            <option value="Kitchen Assistant">Kitchen Assistant</option>
                                                                            <option value="Laundry">Laundry/Domestic</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">Period <span class="text-danger">*</span></label>
                                                                        <select required class="form-control" name="period">
                                                                            <option value="{{$shift->period}}">{{$shift->period}}</option>
                                                                            <option value="Full Day">Full Day</option>
                                                                            <option value="Full Night">Full Night</option>
                                                                            <option value="Half Day">Half Day</option>
                                                                            <option value="Half Night">Half Night</option>
                                                                            <option value="Twilight">Twilight</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">Total Staff <span
                                                                            class="text-danger">*</span></label>
                                                                        <div>
                                                                            <input required name="total_staff" value="{{$shift->total_staff}}" class="form-control" type="number" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">Date <span class="text-danger">*</span></label>
                                                                        <div>
                                                                            <input required name="shift_date" value="{{$shift->date}}" class="form-control"
                                                                                type="date" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">Start Time
                                                                            <span class="text-danger">*</span></label>
                                                                        <div class="input-group time">
                                                                            <input required name="start_time" value="{{$shift->start_time}}" type="time" class="form-control" /><span
                                                                                class="input-group-text"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">End Time <span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="input-group time">
                                                                            <input required name="end_time" value="{{$shift->end_time}}" type="time" class="form-control" /><span
                                                                                class="input-group-text"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="input-block mb-3">
                                                                        <label class="col-form-label">Bank holiday</label>
                                                                        <div class="form-switch">
                                                                            @if ($shift->bank_holiday == 1)
                                                                                <input name="bank_holiday" checked type="checkbox" class="form-check-input" id="customSwitch1"/>
                                                                                <label class="form-check-label" for="customSwitch1"></label>
                                                                            @else
                                                                                <input name="bank_holiday" type="checkbox" class="form-check-input" id="customSwitch1"/>
                                                                                <label class="form-check-label" for="customSwitch1"></label>
                                                                            @endif
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="submit-section">
                                                                <button class="btn btn-primary submit-btn">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="add_shift" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Request Shift</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('client.shift.request')}}" method="post">
                            {{ csrf_field()}}
                            <div class="dynamic-inputs mb-2">
                                <div class="record-set row mb-3">
                                    {{-- <label class="record-label">Record #1</label> --}}
                                    <div class="col-sm-4">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Type <span class="text-danger">*</span></label>
                                            <select required class="form-control" name="type[]">
                                                <option value="">-- Select Type --</option>
                                                <option value="HCA">HCA</option>
                                                <option value="Senior HCA">Senior HCA</option>
                                                <option value="RGN">RGN</option>
                                                <option value="Kitchen Assistant">Kitchen Assistant</option>
                                                <option value="Laundry">Laundry/Domestic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Period <span class="text-danger">*</span></label>
                                            <select required class="form-control" name="period[]">
                                                <option value="">-- Select Period --</option>
                                                <option value="Full Day">Full Day</option>
                                                <option value="Full Night">Full Night</option>
                                                <option value="Half Day">Half Day</option>
                                                <option value="Half Night">Half Night</option>
                                                <option value="Twilight">Twilight</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Total Staff <span
                                                class="text-danger">*</span></label>
                                            <div>
                                                <input required name="total_staff[]" class="form-control" type="number" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Date <span class="text-danger">*</span></label>
                                            <div>
                                                <input required name="shift_date[]" class="form-control"
                                                    type="date" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Start Time
                                                <span class="text-danger">*</span></label>
                                            <div class="input-group time">
                                                <input required name="start_time[]" type="time" class="form-control" /><span
                                                    class="input-group-text"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">End Time <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group time">
                                                <input required name="end_time[]" type="time" class="form-control" /><span
                                                    class="input-group-text"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Bank holiday</label>
                                            <div class="form-switch">
                                                <input name="bank_holiday[]" type="checkbox" class="form-check-input" id="customSwitch1"/>
                                                <label class="form-check-label" for="customSwitch1"></label>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="col-sm-2 mt-2">
                                        <a href="javascript:void(0);" style="display: none;" class="remove-record" data-index="1"> <i class="fa-solid fa-times"></i> Remove</button>
                                    </div>
                                    <br>
                                </div>
                                <br>
                            </div>
                            <div class="add-more mt-4">
                                <a href="#" class="add-more-button"><i class="fa-solid fa-plus-circle"></i> Add More</a>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="edit_shift" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Shift</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Shift Title <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group time">
                                            <input class="form-control" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Client Name <span
                                                class="text-danger">*</span></label>
                                        <select class="select">
                                            <option value="">-- Select Client --</option>
                                            <option value="1">First Health Care</option>
                                            <option value="1">Tempcare Ltd</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Period <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option value="">-- Select Period --</option>
                                            <option value="1">Full Day</option>
                                            <option value="1">Full Night</option>
                                            <option value="1">Half Day</option>
                                            <option value="1">Half Night</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Date <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Start Time
                                            <span class="text-danger">*</span></label>
                                        <div class="input-group time">
                                            <input class="form-control timepicker" /><span class="input-group-text"><i
                                                    class="fa-regular fa-clock"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">End Time <span class="text-danger">*</span></label>
                                        <div class="input-group time">
                                            <input class="form-control timepicker" /><span class="input-group-text"><i
                                                    class="fa-regular fa-clock"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Add Note </label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal custom-modal fade" id="delete_client" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Client</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
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
    </div>
@endsection
