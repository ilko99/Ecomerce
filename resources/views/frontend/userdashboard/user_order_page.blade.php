@extends('dashboard')

@section('user')

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> My Account
        </div>
    </div>
</div>
<div class="page-content pt-50 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="row">
                    {{-- Col md 3 start --}}
                    @include('frontend.body.dashboard_sidebar_menu')
                    {{-- End col md 3 menu --}}


                    <div class="col-md-9">
                        <div class="tab-content account dashboard-content pl-50">
                            <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="mb-0">Your Orders</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" style="background: #ddd;font-weight: 600;">
                                                <thead>
                                                    <tr>
                                                        <th>sl</th>
                                                        <th>Date</th>
                                                        <th>Total amount</th>
                                                        <th>Payment</th>
                                                        <th>Invoice</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orders as $key => $order)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$order->order_date}}</td>
                                                        <td>${{$order->ammount}}</td>
                                                        <td>{{$order->payment_method}}</td>
                                                        <td>{{$order->invoice_no}}</td>
                                                        <td>
                                                            @if($order->status == 'pending')
                                                            <span class="badge rounded-pill bg-warning">Pending</span>
                                                            @elseif($order->status == 'processing')
                                                            <span class="badge rounded-pill bg-info">Processing</span>
                                                            @elseif($order->status == 'confirmed')
                                                            <span class="badge rounded-pill bg-danger">Confirmed</span>
                                                            @elseif($order->status == 'delivered')
                                                            <span class="badge rounded-pill bg-success">Delivered</span>
                                                            @endif
                                                        </td>
                                                        <td><a href="{{ url('/user/order/details/'.$order->id) }}" class="btn-sm btn-success">View</a></td>
                                                        <td><a href="#" class="btn-sm btn-danger">Download Invoice</a></td>    
                                                    </tr>
                                                    @endforeach 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            
                           
                      
                             
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
