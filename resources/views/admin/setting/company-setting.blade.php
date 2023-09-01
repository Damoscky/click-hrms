@extends('layouts.admin.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Company Settings</h3>
                            </div>
                        </div>
                    </div>

                    <form action="{{route('admin.settings.company.update')}}" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Company Email <span class="text-danger">*</span></label>
                                    <input class="form-control" required name="company_email" type="text" value="{{isset($companySetting) ? $companySetting->email : ''}}" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Contact Number <span class="text-danger">*</span></label>
                                    <input class="form-control" required name="contact_number" value="{{isset($companySetting) ? $companySetting->phoneno : ''}}" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Address</label>
                                    <input class="form-control" name="address" value="{{isset($companySetting) ? $companySetting->address : ''}}" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Post Code</label>
                                    <input class="form-control" name="post_code" value="{{isset($companySetting) ? $companySetting->post_code : ''}}" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">City</label>
                                    <input class="form-control" name="city" value="{{isset($companySetting) ? $companySetting->city : ''}}" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">IBAN</label>
                                    <input class="form-control" name="iban" value="{{isset($companySetting) ? $companySetting->iban : ''}}" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">BIC (Swift)</label>
                                    <input class="form-control" name="bic" value="{{isset($companySetting) ? $companySetting->bic : ''}}" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Bank Name</label>
                                    <input class="form-control" name="bank_name" value="{{isset($companySetting) ? $companySetting->bank_name : ''}}" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Sort Code</label>
                                    <input class="form-control" name="sort_code" value="{{isset($companySetting) ? $companySetting->sort_code : ''}}" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Account Number</label>
                                    <input class="form-control" name="account_number" value="{{isset($companySetting) ? $companySetting->account_number : ''}}" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Account Name</label>
                                    <input class="form-control" name="account_name" value="{{isset($companySetting) ? $companySetting->account_name : ''}}" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Standard HCA Rate</label>
                                    <input class="form-control" name="standard_hca" value="{{isset($companySetting) ? $companySetting->standard_hca : ''}}" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Senior HCA Rate</label>
                                    <input class="form-control" name="senior_hca" value="{{isset($companySetting) ? $companySetting->senior_hca : ''}}" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">RGN Rate</label>
                                    <input class="form-control" name="rgn" value="{{isset($companySetting) ? $companySetting->rgn : ''}}" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Kitchen Assistant Rate</label>
                                    <input class="form-control" name="kitchen_assistant" value="{{isset($companySetting) ? $companySetting->kitchen_assistant : ''}}" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Laundry / Domestic Rate</label>
                                    <input class="form-control" name="laundry" value="{{isset($companySetting) ? $companySetting->laundry : ''}}" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Currency </label>
                                    <input class="form-control" name="currency" value="{{isset($companySetting) ? $companySetting->currency : ''}}" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                              <div class="input-block mb-3">
                                <label class="col-form-label">Rules & Regulations</label>
                                <textarea class="form-control" name="rules_regulations" id="" cols="30" rows="10">{{isset($companySetting) ? $companySetting->rules_regulations : ''}}</textarea>
                              </div>
                            </div>
                          </div>
                        
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
