@extends('dashboard')

@section('user')

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span>Account Details
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
                                        <h5>Account Details</h5>
                                    </div>
                                    <div class="card-body">

                                        <form action="{{route('user.profile.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>User Name <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="username" type="text" value="{{$userData->username}}"/>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Full Name <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="name" value="{{$userData->name}}"/>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Email <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="email" type="email" value="{{$userData->email}}"/>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Phone <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="phone" type="text" value="{{$userData->phone}}"/>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>User Address <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="address" type="text" value="{{$userData->address}}"/>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>User Photo <span class="required">*</span></label>
                                                    <input class="form-control" name="photo" type="file" id="image" />
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
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

{{-- <div class="form-group col-md-12">
    <label>New Password <span class="required">*</span></label>
    <input required="" class="form-control" name="npassword" type="password" />
</div>
<div class="form-group col-md-12">
    <label>Confirm Password <span class="required">*</span></label>
    <input required="" class="form-control" name="cpassword" type="password" />
</div> --}}