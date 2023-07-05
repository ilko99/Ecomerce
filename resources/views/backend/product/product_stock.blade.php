@extends('admin.admin_dashboard')

@section('admin')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Product Stock</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Product Stock: <span class="badge rounded-pill bg-danger">{{count($products)}}</span></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Product image</th>
                                <th>Product name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Discount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><img src="{{asset($item->product_thumbnail)}}" style="width: 70px; height: 40px;"></td>
                                <td>{{$item->product_name}}</td>
                                <td>{{$item->selling_price}}</td>
                                <td>{{$item->product_quantity}}</td>
                                <td>
                                    @if($item->discount_price == null)
                                    <span class="badge rounded-pill bg-info">No Discount</span>
                                    @else
                                    @php
                                        $discount = (($item->selling_price - $item->discount_price)/$item->selling_price)*100;
                                    @endphp
                                    <span class="badge rounded-pill bg-danger">{{round($discount)}}%</span>
                                    {{-- {{$item->discount_price}} --}}
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == 1)
                                        <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                        <span class="badge rounded-pill bg-danger">InActive</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <tr>
                                    <th>Sl</th>
                                    <th>Product image</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                </tr>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection