@extends('vendor.vendor_dashboard')


@section('vendor')

@php
  $id = Auth::user()->id;
  $vendorId = App\Models\User::find($id);
  $status = $vendorId->status;   
@endphp


<div class="page-content">

  @if ($status == 'active')
      <h4>Vendor Account is <span class="text-success">Active</span></h4>
    @else  
    <h4>Vendor Account is <span class="text-danger">Inactive</span></h4>
    <p class="text-danger"><b>Please wait for an admin to check and approve your account</b></p>
  @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 bg-gradient-deepblue">
             <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">${{$today}}</h5>
                    <div class="ms-auto">
                        <i class='bx bx-cart fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Total Orders</p>
                    <p class="mb-0 ms-auto">+4.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
          </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-orange">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">$8323</h5>
                    <div class="ms-auto">
                        <i class='bx bx-dollar fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Total Revenue</p>
                    <p class="mb-0 ms-auto">+1.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
          </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ohhappiness">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">6200</h5>
                    <div class="ms-auto">
                        <i class='bx bx-group fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Visitors</p>
                    <p class="mb-0 ms-auto">+5.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
        </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ibiza">
             <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">5630</h5>
                    <div class="ms-auto">
                        <i class='bx bx-envelope fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Messages</p>
                    <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
         </div>
        </div>
    </div><!--end row-->





      <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Orders Summary</h5>
                </div>
                <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                          <th>Sl</th>
                          <th>Date</th>
                          <th>Invoice</th>
                          <th>Amount</th>
                          <th>Payment</th>
                          <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($orderItem as $key => $order)
                      <tr>
                       <td>{{$key+1}}</td>
                       <td>{{$order->order->order_date}}</td>
                       <td>{{$order->order->invoice_no}}</td>
                       <td>${{$order->order->ammount}}</td>
                       <td>{{$order->order->payment_method}}</td>
                       <td>
                        <div class="badge rounded-pill bg-light-info text-info w-100">{{$order->order->status}}</div>
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection