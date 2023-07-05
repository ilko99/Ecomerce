@extends('admin.admin_dashboard')


@section('admin')

<div class="page-content">

  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    <div class="col">
        <div class="card radius-10 bg-gradient-deepblue">
          <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">${{$todayAmount}} USD</h5>
                    <div class="ms-auto">
                        <i class='bx bx-cart fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Today's Sales</p>
                    <p class="mb-0 ms-auto">+{{$formattedPercentage}}%<span>
                        @if($todayAmount > $yesterdayAmount)
                        <i class='bx bx-up-arrow-alt'></i>
                        @else
                        <i class='bx bx-down-arrow-alt'></i>
                        @endif
                    </span></p>
                </div>
            </div>
          </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-orange">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">${{$thisMonthAmount}} USD</h5>
                    <div class="ms-auto">
                        <i class='bx bx-dollar fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Monthly Sale</p>
                    <p class="mb-0 ms-auto">{{$formattedPercentageMonth}}%<span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
          </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ohhappiness">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">${{$thisYear}} USD</h5>
                    <div class="ms-auto">
                        <i class='bx bx-group fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Yearly sale</p>
                    <p class="mb-0 ms-auto">+5.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
        </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ibiza">
             <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">{{ count($pending) }}</h5>
                    <div class="ms-auto">
                        <i class='bx bx-envelope fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Pending orders</p>
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
                      @foreach($orders as $key => $order)
                      <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$order->order_date}}</td>
                        <td>{{$order->invoice_no}}</td>
                        <td>${{$order->ammount}}</td>
                        <td>{{$order->payment_method}}</td>
                        <td>
                          <div class="badge rounded-pill bg-light-info text-info w-100">{{$order->status}}</div>
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