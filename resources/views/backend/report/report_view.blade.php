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
            <form action="{{route('search-by-date')}}" method="POST">
                @csrf
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search by date</h5>
                        <label class="form-label">Date: </label>
                        <input type="date" name="date" class="form-control">
                        <br>
                        <input type="submit" class="btn btn-rounded btn-primary" value="searh">
                    </div>
                </div>
            </div>
            </form>

            <form action="{{route('search-by-month')}}" method="POST">
                @csrf
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Search by Month</h5>
                            <label class="form-label">Select month: </label>
                            <select name="month" id="">
                                <option value="">Select a month</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>

                            <h5 class="card-title">Search by Year</h5>
                            <label class="form-label">Select year: </label>
                            <select name="year_name" id="">
                                <option value="">Select a year</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                            </select>
                            <br>
                            <input type="submit" class="btn btn-rounded btn-primary" value="searh">
                        </div>
                    </div>
                </div>
            </form>


            <form action="{{route('search-by-year')}}" method="POST">
                @csrf
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Search by Year</h5>
                            <label class="form-label">Select year: </label>
                            <select name="year" id="" class="form-control mb-3">
                                <option value="">Select a year</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
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