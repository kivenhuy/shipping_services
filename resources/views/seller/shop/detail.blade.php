@extends('seller.layouts.app')

@section('panel_content')

    <div class="aiz-titlebar mt-2 mb-4">
      <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Personal Information')}}
            </h1>
        </div>
      </div>
    </div>

    <!-- Basic Info -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Basic Info') }}</h5>
        </div>
        <div class="card-body">
            <form class="" action="{{ route('shipper.update') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="shop_id" value="{{ $user->id }}">
                @csrf
                <div class="row">
                    <label class="col-md-2 col-form-label">{{ translate('Shipper Name') }}<span class="text-danger text-danger">*</span></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control mb-3" placeholder="{{ translate('Shipper Name')}}" name="name" value="{{ $user->name }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-2 col-form-label">{{ translate('Shipper Avatar') }}</label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="logo" value="{{ $user->avatar_original }}" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <label>{{ translate('Shipper Phone') }} <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control mb-3" placeholder="{{ translate('Phone')}}" name="phone" value="{{ $user->phone }}" required>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-2 col-form-label">{{ translate('Shipper Address') }} <span class="text-danger text-danger">*</span></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control mb-3" placeholder="{{ translate('Address')}}" name="address" value="{{ $user->address }}" required>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-2 col-form-label">{{ translate('National ID') }} <span class="text-danger text-danger">*</span></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control mb-3" placeholder="{{ translate('National ID')}}" name="address" value="{{ $user->national_id }}" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label class="col-md-2 col-form-label">{{ translate('Id Proof') }}</label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="id_proof" value="{{ $user->id_proof }}" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
                
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                </div>
            </form>


            
        </div>
    </div>

    <!-- Banner Settings -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Shipper Vehicle') }}</h5>
        </div>
        <div class="card-body">
            <form class="" action="{{ route('shipper.detail.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-md-2 col-form-label">{{ translate('Type Vehicle') }} <span class="text-danger text-danger">*</span></label>
                    <div class="col-md-10">
                        <select class="form-control aiz-selectpicker" name="vehicle" id="vehicle"
                                data-selected="{{ $user->shipper_detail->vehicle }}" data-live-search="true">
                                <option value="motorbike"  @if($user->shipper_detail->vehicle == "motorbike") selected @endif>Motorbike</option>
                                <option value="mini van" @if($user->shipper_detail->vehicle =="mini van") selected @endif>Mini Van</option>
                                <option value="truck" @if($user->shipper_detail->vehicle == "truck") selected @endif>Truck</option>
                                <option value="container truck" @if($user->shipper_detail->vehicle == "container truck") selected @endif>Container Truck</option>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label class="col-md-2 col-form-label">{{ translate('Vehicle Image') }}</label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="vehicle_image" value="{{ $user->shipper_detail->vehicle_image }}" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-2 col-form-label">{{ translate('License Plates') }} <span class="text-danger text-danger">*</span></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control mb-3" placeholder="{{ translate('License Plates')}}" name="license_plates" value="{{ $user->shipper_detail->license_plates }}" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label class="col-md-2 col-form-label">{{ translate('Driver Lincense') }}</label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="driver_license" value="{{ $user->shipper_detail->driver_license }}" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>

                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                </div>
                
            </form>

        </div>
    </div>
    

    

    

@endsection

@section('script')


@endsection