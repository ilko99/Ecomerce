@extends('admin.admin_dashboard')

@section('admin')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Report</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Report</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <hr/>
        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3">

            <form action="{{route('search-by-user')}}" method="POST">
                @csrf
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Search a User</h5>
                            <label class="form-label">Select user: </label>
                            <select name="user" id="" class="form-control mb-3">
                                <option value="">Select a user</option>
                                @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                                
                            </select>
                            <br>
                            <input type="submit" class="btn btn-rounded btn-primary" value="searh">
                        </div>
                    </div>
                </div>
            </form>
            
        </div>        
    </div>
</div>
@endsection