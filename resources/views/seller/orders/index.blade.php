@extends('seller.layouts.app')
@section('panel_content')

    <div class="card">
        <form id="sort_orders" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col text-center text-md-left">
                    <h5 class="mb-md-0 h6">{{ translate('Orders') }}</h5>
                </div>
            </div>
        </form>

        @if (count($orders) > 0)
            <div class="card-body p-3">
                {{-- <div class="aiz-count-down align-items-center" data-date="{{ date('Y/m/d H:i:s', strtotime($orders[0]->shipping_date)) }}"></div> --}}
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ translate('Order Code') }}</th>
                            <th data-breakpoints="lg">{{ translate('Product Name') }}</th>
                            <th data-breakpoints="lg">{{ translate('Customer Name') }}</th>
                            <th data-breakpoints="lg">{{ translate('Shop Name') }}</th>
                            <th data-breakpoints="md">{{ translate('Amount') }}</th>
                            @if(Auth::user()->shipper_detail->vehicle != "motorbike")
                            <th data-breakpoints="lg">{{ translate('Shipping Date') }}</th>
                            @endif
                            <th data-breakpoints="lg">{{ translate('Delivery Status') }}</th>
                            <th data-breakpoints="lg">{{ translate('Payment Type') }}</th>
                            <th data-breakpoints="lg">{{ translate('Payment Status') }}</th>
                            <th class="text-right">{{ translate('Options') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order_details)
                            @if ($order_details != null)
                                <tr>
                                    <td>
                                        {{ $key + 1 }}
                                    </td>
                                    <td>
                                        <a href="}"
                                            onclick="show_order_details()">{{ $order_details->order->code }}</a>
                                    </td>
                                    <td>
                                        {{ $order_details->product_name }}
                                    </td>
                                    <td>
                                        {{ json_decode($order_details->order->shipping_address)->name }}
                                    </td>
                                    <td>
                                        {{ $order_details->shop_name }}
                                    </td>
                                    <td>
                                        {{ single_price($order_details->price) }}
                                    </td>
                                    @if(Auth::user()->shipper_detail->vehicle != "motorbike")
                                    <td>
                                        {{ ($order_details->shipping_date) }}
                                    </td>
                                    
                                    @endif
                                    <td>
                                        @if ($order_details->delivery_status == 'delivered')
                                            <span class="badge badge-inline badge-success">{{ ucfirst(str_replace('_', ' ', $order_details->delivery_status)) }}</span>
                                        @elseif($order_details->delivery_status == 'fail')
                                            <span class="badge badge-inline badge-danger">{{ ucfirst(str_replace('_', ' ', $order_details->delivery_status)) }}</span>
                                        @else
                                        <span class="badge badge-inline badge-warning">{{ ucfirst(str_replace('_', ' ', $order_details->delivery_status)) }}</span>
                                        @endif
                                        
                                    </td>
                                    <td>
                                        {{ ucfirst(str_replace('_', ' ', $order_details->order->payment_type)) }}
                                    </td>
                                    <td>
                                        @if ($order_details->payment_status == 'paid')
                                            <span class="badge badge-inline badge-success">{{ translate('Paid') }}</span>
                                        @else
                                            <span class="badge badge-inline badge-danger">{{ translate('Unpaid') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                       
                                        <a href="{{ route('shipper.orders.show',$order_details->id) }}"
                                            class="btn btn-soft-info btn-icon btn-circle btn-sm"
                                            title="{{ translate('Order Details') }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                       
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    {{ $orders->links() }}
                </div>
            </div>
        @endif
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function sort_orders(el) {
            $('#sort_orders').submit();
        }
    </script>
@endsection