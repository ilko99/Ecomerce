@extends('dashboard')

@section('user')

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Track your Order
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
                                        <h5>Check your order</h5>
                                    </div>
                                    <div class="card-body">

                                        <form action="{{route('order.tracking')}}" method="POST">
                                            @csrf

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <h6 class="mb-0">Invoice code</h6>
                                                    <input type="text" name="code" class="form-control" placeholder="Order invoice No." required/>
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Track Order</button>
                                                </div>
                                            </div>
                                        </form>

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
