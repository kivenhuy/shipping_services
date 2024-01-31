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
            <div class="card shadow-none bg-soft-primary">
                <div class="card-body">
                    <div class="card-title text-primary fs-16 fw-600">
                        {{ translate('Shipping Amount') }}
                    </div>
                    <p class="mt-4">
                        {{ single_price(Session::get('total_shipping_cost')) }}
                    </p>
                </div>
            </div>
            
        </div>
        <div class="col-sm-6 col-md-6 col-xxl-3">
            <div class="card shadow-none mb-4 bg-primary py-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="small text-muted mb-0">
                                <span class="fe fe-arrow-down fe-12"></span>
                                <span class="fs-14 text-light">{{ translate('Total Order') }}</span>
                            </p>
                            <h3 class="mb-0 text-white fs-30">
                                {{  Session::get('total_order') }}
                            </h3>

                        </div>
                        <div class="col-auto text-right">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64.001" height="64" viewBox="0 0 64.001 64">
                                <path id="Path_66" data-name="Path 66"
                                    d="M146.431,117.56l-26.514-10.606a8.014,8.014,0,0,0-5.944,0L87.458,117.56a4,4,0,0,0-2.514,3.714v34.217a4,4,0,0,0,2.514,3.714l26.514,10.606a8.013,8.013,0,0,0,5.944,0L146.431,159.2a4,4,0,0,0,2.514-3.714V121.274a4,4,0,0,0-2.514-3.714m-31.714-8.748a5.981,5.981,0,0,1,4.456,0l26.1,10.44a1,1,0,0,1,0,1.858l-12.332,4.932-30.654-12.26Zm1.228,59.633L88.2,157.347a2,2,0,0,1-1.258-1.856V122.6l29,11.6Zm1-36L88.612,121.11a1,1,0,0,1,0-1.858L99.6,114.858l30.654,12.262Zm30,23.048a2,2,0,0,1-1.258,1.856l-27.742,11.1V134.2l13-5.2V146.61a1.035,1.035,0,0,0,2-.466V128.2l14-5.6Z"
                                    transform="translate(-84.944 -106.382)" fill="#FFFFFF" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-xxl-3">
            <div class="card shadow-none mb-4 bg-primary py-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="small text-muted mb-0">
                                <span class="fe fe-arrow-down fe-12"></span>
                                <span class="fs-14 text-light">{{ translate('Delivered Order') }}</span>
                            </p>
                            <h3 class="mb-0 text-white fs-30">
                                {{  Session::get('total_deliverd')}}
                            </h3>

                        </div>
                        <div class="col-auto text-right">
                            <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.69506 16.961C8.70931 17.8033 8.22553 18.5709 7.47078 18.9035C6.71603 19.236 5.84015 19.0675 5.25424 18.477C4.66833 17.8865 4.48871 16.9912 4.79969 16.2114C5.11066 15.4316 5.85049 14.9221 6.67193 14.922C7.20385 14.9172 7.71584 15.1293 8.09525 15.5117C8.47466 15.8941 8.69042 16.4154 8.69506 16.961Z" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.33 16.961C18.3443 17.8033 17.8605 18.5709 17.1057 18.9035C16.351 19.236 15.4751 19.0675 14.8892 18.477C14.3033 17.8865 14.1237 16.9912 14.4346 16.2114C14.7456 15.4316 15.4854 14.9221 16.3069 14.922C16.8388 14.9172 17.3508 15.1293 17.7302 15.5117C18.1096 15.8941 18.3254 16.4154 18.33 16.961V16.961Z" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.92499 8.75195V13.372H8.92904V8.75195H2.92499Z" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path fill="#FFFFFF" d="M14.0497 17.711C14.464 17.711 14.7997 17.3752 14.7997 16.961C14.7997 16.5468 14.464 16.211 14.0497 16.211V17.711ZM8.69504 16.211C8.28082 16.211 7.94504 16.5468 7.94504 16.961C7.94504 17.3752 8.28082 17.711 8.69504 17.711V16.211ZM14.0497 16.211C13.6355 16.211 13.2997 16.5468 13.2997 16.961C13.2997 17.3752 13.6355 17.711 14.0497 17.711V16.211ZM14.2876 17.711C14.7019 17.711 15.0376 17.3752 15.0376 16.961C15.0376 16.5468 14.7019 16.211 14.2876 16.211V17.711ZM13.2997 16.961C13.2997 17.3752 13.6355 17.711 14.0497 17.711C14.464 17.711 14.7997 17.3752 14.7997 16.961H13.2997ZM14.7997 13.372C14.7997 12.9578 14.464 12.622 14.0497 12.622C13.6355 12.622 13.2997 12.9578 13.2997 13.372H14.7997ZM18.33 16.211C17.9158 16.211 17.58 16.5468 17.58 16.961C17.58 17.3752 17.9158 17.711 18.33 17.711V16.211ZM20.475 14.761H21.225C21.225 14.7163 21.221 14.6716 21.213 14.6276L20.475 14.761ZM20.7177 11.8866C20.6441 11.479 20.2539 11.2083 19.8463 11.282C19.4387 11.3556 19.168 11.7458 19.2416 12.1534L20.7177 11.8866ZM14.0497 6.878C13.6355 6.878 13.2997 7.21379 13.2997 7.628C13.2997 8.04221 13.6355 8.378 14.0497 8.378V6.878ZM17.4408 7.628V8.378C17.4519 8.378 17.463 8.37775 17.474 8.37726L17.4408 7.628ZM19.4785 9.221L18.7465 9.38436C18.7488 9.39445 18.7513 9.4045 18.7539 9.41448L19.4785 9.221ZM19.5819 9.821L18.8343 9.88121C18.8363 9.90566 18.8394 9.92999 18.8438 9.95413L19.5819 9.821ZM19.2406 12.1541C19.3142 12.5618 19.7042 12.8326 20.1118 12.7591C20.5195 12.6856 20.7903 12.2955 20.7168 11.8879L19.2406 12.1541ZM14.7997 7.628C14.7997 7.21379 14.464 6.878 14.0497 6.878C13.6355 6.878 13.2997 7.21379 13.2997 7.628H14.7997ZM13.2997 12.02C13.2997 12.4342 13.6355 12.77 14.0497 12.77C14.464 12.77 14.7997 12.4342 14.7997 12.02H13.2997ZM13.2997 7.628C13.2997 8.04221 13.6355 8.378 14.0497 8.378C14.464 8.378 14.7997 8.04221 14.7997 7.628H13.2997ZM14.0497 5H14.7997C14.7997 4.58579 14.464 4.25 14.0497 4.25V5ZM6.61926 5V4.25C6.20505 4.25 5.86926 4.58579 5.86926 5H6.61926ZM5.86926 8.752C5.86926 9.16621 6.20505 9.502 6.61926 9.502C7.03348 9.502 7.36926 9.16621 7.36926 8.752H5.86926ZM14.7997 12.02C14.7997 11.6058 14.464 11.27 14.0497 11.27C13.6355 11.27 13.2997 11.6058 13.2997 12.02H14.7997ZM13.2997 13.372C13.2997 13.7862 13.6355 14.122 14.0497 14.122C14.464 14.122 14.7997 13.7862 14.7997 13.372H13.2997ZM14.0497 11.27C13.6355 11.27 13.2997 11.6058 13.2997 12.02C13.2997 12.4342 13.6355 12.77 14.0497 12.77V11.27ZM19.9797 12.77C20.3939 12.77 20.7297 12.4342 20.7297 12.02C20.7297 11.6058 20.3939 11.27 19.9797 11.27V12.77ZM4.64976 17.711C5.06398 17.711 5.39976 17.3752 5.39976 16.961C5.39976 16.5468 5.06398 16.211 4.64976 16.211V17.711ZM3.93606 16.961L3.93606 16.2109L3.92548 16.2111L3.93606 16.961ZM3.22641 16.6709L3.75646 16.1403L3.75646 16.1403L3.22641 16.6709ZM2.92499 15.951L2.17493 15.951L2.17504 15.9602L2.92499 15.951ZM2.92499 13.372V12.622C2.51077 12.622 2.17499 12.9578 2.17499 13.372H2.92499ZM14.0497 14.122C14.464 14.122 14.7997 13.7862 14.7997 13.372C14.7997 12.9578 14.464 12.622 14.0497 12.622V14.122ZM14.0497 16.211H8.69504V17.711H14.0497V16.211ZM14.0497 17.711H14.2876V16.211H14.0497V17.711ZM14.7997 16.961V13.372H13.2997V16.961H14.7997ZM18.33 17.711C19.9466 17.711 21.225 16.3722 21.225 14.761H19.725C19.725 15.5798 19.0826 16.211 18.33 16.211V17.711ZM21.213 14.6276L20.7177 11.8866L19.2416 12.1534L19.7369 14.8944L21.213 14.6276ZM14.0497 8.378H17.4408V6.878H14.0497V8.378ZM17.474 8.37726C18.0626 8.35114 18.6074 8.76077 18.7465 9.38436L20.2105 9.05764C19.9186 7.74979 18.749 6.8192 17.4075 6.87874L17.474 8.37726ZM18.7539 9.41448C18.7947 9.56708 18.8216 9.72332 18.8343 9.88121L20.3295 9.76079C20.3095 9.51299 20.2672 9.26753 20.2032 9.02752L18.7539 9.41448ZM18.8438 9.95413L19.2406 12.1541L20.7168 11.8879L20.32 9.68787L18.8438 9.95413ZM13.2997 7.628V12.02H14.7997V7.628H13.2997ZM14.7997 7.628V5H13.2997V7.628H14.7997ZM14.0497 4.25H6.61926V5.75H14.0497V4.25ZM5.86926 5V8.752H7.36926V5H5.86926ZM13.2997 12.02V13.372H14.7997V12.02H13.2997ZM14.0497 12.77H19.9797V11.27H14.0497V12.77ZM4.64976 16.211H3.93606V17.711H4.64976V16.211ZM3.92548 16.2111C3.86604 16.2119 3.80491 16.1887 3.75646 16.1403L2.69636 17.2016C3.02721 17.532 3.47667 17.7176 3.94665 17.7109L3.92548 16.2111ZM3.75646 16.1403C3.70737 16.0913 3.6759 16.0203 3.67493 15.9418L2.17504 15.9602C2.18076 16.4247 2.36616 16.8717 2.69636 17.2016L3.75646 16.1403ZM3.67499 15.951V13.372H2.17499V15.951H3.67499ZM2.92499 14.122H14.0497V12.622H2.92499V14.122Z" fill="#000000"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-md-6 col-xxl-3">
            <div class="card shadow-none mb-4 bg-primary py-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="small text-muted mb-0">
                                <span class="fe fe-arrow-down fe-12"></span>
                                <span class="fs-14 text-light">{{ translate('Fail Delivery Order') }}</span>
                            </p>
                            <h3 class="mb-0 text-white fs-30">
                                {{  Session::get('total_fail_deliverd')}}
                            </h3>
                        </div>
                        <div class="col-auto text-right">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64">
                                <g id="Group_25" data-name="Group 25" transform="translate(-1561.844 1020.618)">
                                    <path id="Path_58" data-name="Path 58"
                                        d="M229.23,106.382h-12a6,6,0,0,0,0,12h12a6,6,0,0,0,0-12m0,10h-12a4,4,0,0,1,0-8h12a4,4,0,0,1,0,8"
                                        transform="translate(1370.615 -1127)" fill="#FFFFFF" />
                                    <path id="Path_59" data-name="Path 59"
                                        d="M213.73,117.882h24a1,1,0,0,1,0,2h-24a1,1,0,0,1,0-2"
                                        transform="translate(1372.115 -1115.5)" fill="#FFFFFF" />
                                    <path id="Path_60" data-name="Path 60" d="M210.23,117.382a2,2,0,1,0,2,2,2,2,0,0,0-2-2"
                                        transform="translate(1367.615 -1116)" fill="#FFFFFF" />
                                    <line id="Line_1" data-name="Line 1" transform="translate(1578.047 -1014.618)"
                                        fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="0.142" />
                                    <line id="Line_2" data-name="Line 2" transform="translate(1609.643 -1014.618)"
                                        fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="0.142" />
                                    <path id="Path_61" data-name="Path 61"
                                        d="M213.73,123.882h24a1,1,0,0,1,0,2h-24a1,1,0,0,1,0-2"
                                        transform="translate(1372.115 -1109.5)" fill="#FFFFFF" />
                                    <path id="Path_62" data-name="Path 62" d="M210.23,123.382a2,2,0,1,0,2,2,2,2,0,0,0-2-2"
                                        transform="translate(1367.615 -1110)" fill="#FFFFFF" />
                                    <path id="Path_63" data-name="Path 63"
                                        d="M213.73,129.882h24a1,1,0,0,1,0,2h-24a1,1,0,1,1,0-2"
                                        transform="translate(1372.115 -1103.5)" fill="#FFFFFF" />
                                    <path id="Path_64" data-name="Path 64" d="M210.23,129.382a2,2,0,1,0,2,2,2,2,0,0,0-2-2"
                                        transform="translate(1367.615 -1104)" fill="#FFFFFF" />
                                    <line id="Line_3" data-name="Line 3" transform="translate(1609.643 -1015.618)"
                                        fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="0.142" />
                                    <line id="Line_4" data-name="Line 4" transform="translate(1578.047 -1015.618)"
                                        fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="0.142" />
                                    <path id="Path_65" data-name="Path 65"
                                        d="M265.23,116.382a8,8,0,0,0-8-8h-7.2a1,1,0,0,0,0,2h7.2a6,6,0,0,1,6,6v44a6,6,0,0,1-6,6h-48a6,6,0,0,1-6-6v-44a6,6,0,0,1,6-6h7.2a1,1,0,0,0,0-2h-7.2a8,8,0,0,0-8,8v44a8,8,0,0,0,8,8h48a8,8,0,0,0,8-8Z"
                                        transform="translate(1360.615 -1125)" fill="#FFFFFF" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       

    </div>

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
