@extends('seller.layouts.app')

@section('panel_content')
    <div class="aiz-titlebar mt-2 mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3 text-primary">{{ translate('Dashboard') }}</h1>
            </div>
        </div>
    </div>

    @if ((Auth::user()->approved) == 0)
    <div class="row notfiy">
        <span>Please Update Your Personal Information and Image ID, Vehicle and Driver License to get approve by Administrator</span>
    </div>
    @endif

    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-3 mb-4">
            <div
                class="card mb-0  p-5 h-100  d-flex align-items-center justify-content-center">
                @if ((Auth::user()->approved) == 0)
                    <div class="my-n4 py-1 text-center">
                        <img src="{{ static_asset('assets/img/non_verified.png') }}" alt=""
                            class="w-xxl-130px w-90px d-block">
                        <a href="{{ route('shipper.shop.index') }}"
                            class="btn btn-sm btn-primary">{{ translate('Verify Now') }}</a>
                    </div>
                @else
                    <div class="my-2 py-1">
                        <img src="{{ static_asset('assets/img/verified.png') }}" alt="" width="">
                    </div>
                @endif
            </div>
        </div>

    </div>



    <style>
        .notfiy
        {
            justify-content: center;
            margin-bottom: 6px;
            font-size: 14px;
            color: red;
        }
    </style>
@endsection

@section('script')
   
@endsection
