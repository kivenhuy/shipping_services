@extends('seller.layouts.app')
@section('panel_content')
    <!-- Order id -->
    <div class="aiz-titlebar mb-4">
        <div class="row align-items-center">
            <div class="col-md-6" style="display: flex">
                <a style="display: flex;align-items: center;margin-right: 10px;margin-bottom: 0.5rem" href="{{route('shipper.orders.index')}}" ><i style="color:black;font-size: 1.73em;" class="fa fa-long-arrow-alt-left"></i></a>
                <h1 class="fs-20 fw-700 text-dark">{{ translate('Order id') }}: {{ $order_details->order->code }}</h1>
            </div>
        </div>
    </div>

    <!-- Order Summary -->
    <div class="card rounded-0 shadow-none border mb-4">
        <div class="card-header border-bottom-0">
            <h5 class="fs-16 fw-700 text-dark mb-0">{{ translate('Order Summary') }}</h5>
        </div>
        @if($is_active == 0 && $order_details->delivery_status != 'delivered')
            <div style="padding-left: 30px">
                <div class="row notfiy">
                    <i class="fa fa-info-circle" aria-hidden="true"><span style="padding-left: 6px">Delivery time does not meet standards.Order status failed </span></i>
                </div>
            </div>
        
        @else
            @if($can_ship == 0)
            <div style="padding-left: 30px">
                <div class="row notfiy">
                    <i class="fa fa-info-circle" aria-hidden="true"><span style="padding-left: 6px">Delivery date is scheduled for {{ date('d-m-Y H:i A', ($order_details->time_remaining)) }}. Please come back on that date so it can be done </span></i>
                </div>
            </div>
            @endif
        @endif
        <div class="card-body">
            <div class="row">
                
                <div class="col-lg-6">
                    <table class="table-borderless table">
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Order Code') }}:</td>
                            <td>{{ $order_details->order->code }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Customer') }}:</td>
                            <td>{{ json_decode($order_details->order->shipping_address)->name }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Email') }}:</td>
                           
                            <td>{{ $order_details->cus_email }}</td>
                            
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Shipping address') }}:</td>
                            <td>{{ json_decode($order_details->order->shipping_address)->address }},
                                {{ json_decode($order_details->order->shipping_address)->city }},
                                {{ json_decode($order_details->order->shipping_address)->postal_code }},
                                {{ json_decode($order_details->order->shipping_address)->country }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Shop address') }}:</td>
                            <td>{{ $order_details->shop_address}}

                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="table-borderless table">
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Order date') }}:</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($order_details->order->order_date)) }}</td>
                        </tr>
                        @if($order_details->time_remaining != "")
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Shipping date') }}:</td>
                            <td>{{ date('d-m-Y H:i A', ($order_details->time_remaining)) }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Order status') }}:</td>
                            <td>Success</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Total order amount') }}:</td>
                            <td>{{ single_price($order_details->price + $order_details->shipping_cost) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Shipping method') }}:</td>
                            <td> {{ $order_details->shipping_type }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Payment method') }}:</td>
                            <td>{{ translate(ucfirst(str_replace('_', ' ', $order_details->order->payment_type))) }}</td>
                        </tr>
                       
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Payment Status') }}:</td>
                            <td> 
                                @if($order_details->payment_status != 'paid' )
                                    <span class='badge badge-inline badge-warning'>{{ ucfirst($order_details->payment_status) }}</span> 
                                @else
                                    <span class='badge badge-inline badge-success'>{{ ucfirst($order_details->payment_status) }}</span> 
                                @endif
                            </td>
                        </tr>
                        @if($order_details->shipping_type != "Normal Shipping")
                            @if ($order_details->delivery_status != 'delivered' && $order_details->delivery_status != 'fail')
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Time remaining For Shipping') }}:</td>
                                    {{-- @if(Auth::user()->carrie_id == 2) --}}
                                        <td><div class="aiz-count-down align-items-center" data-date="{{ date('Y/m/d H:i:s', ($order_details->time_remaining)) }}"></div></td>
                                    {{-- @endif --}}
                                    
                                    {{-- <td><div class="aiz-count-down align-items-center" data-date="{{ date('Y/m/d H:i:s', strtotime($order_details->shipping_date)) }}"></div></td> --}}
                                </tr>
                            @endif
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Details -->
    <div class="card rounded-0 shadow-none border mb-4">
        <div class="row" >
            <div class="col-lg-12 table-responsive">
                <table class="table-bordered aiz-table invoice-summary table" style="background-color: white">
                    <thead>
                        <tr class="bg-trans-dark">
                            <th data-breakpoints="lg" class="min-col">#</th>
                            <th width="10%">{{ translate('Photo') }}</th>
                            <th class="text-uppercase">{{ translate('Description') }}</th>
                            <th data-breakpoints="lg" class="min-col text-uppercase text-center">
                                {{ translate('Qty') }}
                            </th>
                            <th data-breakpoints="lg" class="min-col text-uppercase text-center">
                                {{ translate('Price') }}</th>
                            <th data-breakpoints="lg" class="min-col text-uppercase text-center">
                                {{ translate('Payment Status') }}</th>
                            <th data-breakpoints="lg" class="min-col text-uppercase text-center">
                                {{ translate('Shipping Status') }}</th>
                            <th data-breakpoints="lg" class="min-col text-uppercase text-center">
                                {{ translate('Total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <img height="50" src="{{$order_details->image_product}}">
                                    
                                </td>
                                <td>
                                    
                                    <strong>
                                        <a href="" target="_blank"
                                            class="text-muted">
                                            {{ $order_details->product_name }}
                                        </a>
                                    </strong>
                                    
                                </td>
                                <td class="text-center">
                                    {{ $order_details->quantity }}
                                </td>
                                <td class="text-center">
                                    {{ single_price($order_details->price / $order_details->quantity) }}
                                </td>
                                <td class="text-center">
                                    @if ($order_details->payment_status == 'paid')
                                    <span class="badge badge-inline badge-success">{{ translate('Paid') }}</span>
                                    @else
                                        <span class="badge badge-inline badge-danger">{{ translate('Unpaid') }}</span>
                                    @endif
                                </td>
                                @if ($order_details->delivery_status == 'delivered')
                                <td class="text-center"> 
                                        <span class="badge badge-inline badge-success">{{ucfirst(str_replace('_', ' ', $order_details->delivery_status))}}</span>
                                </td>
                                @elseif ($order_details->delivery_status == 'fail')
                                <td class="text-center"> 
                                        <span class="badge badge-inline badge-danger">{{ucfirst(str_replace('_', ' ', $order_details->delivery_status))}}</span>
                                </td>
                                @else
                                <td class="text-center">
                                    <span class="badge badge-inline badge-warning">
                                        {{ ucfirst(str_replace('_', ' ', $order_details->delivery_status)) }}
                                    </span>
                                </td>
                                @endif
                                <td class="text-center">
                                    {{ single_price($order_details->price) }}
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    <div class="clearfix float-right">
        <div>
            <table class="table">
                <tbody>
                    <tr>
                        <td>
                            <strong class="text-muted">{{ translate('Sub Total') }} :</strong>
                        </td>
                        <td>
                            {{ single_price($order_details->price) }}
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <strong class="text-muted">{{ translate('Shipping') }} :</strong>
                        </td>
                        <td>
                            {{ single_price($order_details->shipping_cost) }}
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <strong class="text-muted">{{ translate('TOTAL') }} :</strong>
                        </td>
                        <td class="text-muted h5">
                            {{ single_price($order_details->shipping_cost + $order_details->price) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        @if($is_active == 1 && $can_ship == 1)
            <div style="margin-top: 4rem">
                <form action="{{ route('shipper.update_status_shipping') }}" method="POST" enctype="multipart/form-data" id="final_checkout_form">
                    @csrf
                    <input name="id_order_detail" type="hidden" value="{{$order_details->id}}">
                    @if($order_details->delivery_status == "shipping")
                        <div class="col-12">
                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">{{ translate('Deliverd Proof Image') }}</label>
                                <div class="col-md-10">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="proof_image" value="" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-12">
                        @if($order_details->delivery_status == "waiting")
                            <input name="shipping_status" type="hidden" value="receive_order">
                            <button  type="submit" class="btn btn-primary btn-block fw-700 fs-14 rounded-4 EdApprove">Revice Shipping Order</button>
                        @elseif($order_details->delivery_status == "receive_order")
                            <input name="shipping_status" type="hidden" value="order_picking">
                            <button  type="submit" class="btn btn-primary btn-block fw-700 fs-14 rounded-4 EdApprove">Order Picking</button>
                        @elseif($order_details->delivery_status == "order_picking")
                            <input name="shipping_status" type="hidden" value="shipping">
                            <button  type="submit" class="btn btn-primary btn-block fw-700 fs-14 rounded-4 EdApprove">Shipping</button>
                        @elseif($order_details->delivery_status == "shipping")
                            <input name="shipping_status" type="hidden" value="delivered">
                            <button  type="button" class="btn btn-success btn-block fw-700 fs-14 rounded-4 EdApprove" onclick="submitOrder(this)">Deliverd</button>
                        @else
                        @endif
                    </div>
                </form>
            </div>
        @endif
    </div>

    

    <style>
        #modal-size {
            position:fixed !important;
            left:0 !important;
            right:0 !important;
            bottom:0 !important;
            top:0 !important;
            display:block !important; 
        }
        .notfiy
        {
            color: red;
            font-weight: 700;
            font-size: 16px;
            font-family: 'Roboto', sans-serif;
        }
    </style>
@endsection

@section('modal')
    <!-- Product Review Modal -->
    <div class="modal fade" id="product-review-modal">
        <div class="modal-dialog">
            <div class="modal-content" id="product-review-modal-content">

            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div id="payment_modal_body">

                </div>
            </div>
        </div>
    </div>


    
@endsection


@section('script')
    <script type="text/javascript">
        function submitOrder(el) {
            $(el).prop('disabled', true);
            var image = $('.selected-files').val();
            if(image.length != 0)
            {
                $('#final_checkout_form').submit();
            }
            else
            {
                AIZ.plugins.notify('danger', '{{ translate('You need to upload image proof for order delivered') }}');
                $(el).prop('disabled', false);
            }
        }
    </script>
@endsection