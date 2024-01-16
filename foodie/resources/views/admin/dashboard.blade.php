@extends('admin.adminBase')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="card bg-success text-center text-white">
                            <div class="display-3">{{$categories}}+</div>
                            <h5>Total categories</h5>
                        </div>
                    </div> 
                    <div class="col-6">
                        <div class="card bg-danger text-center text-white">
                            <div class="display-3">{{$products}}+</div>
                            <h5>Total Dishes</h5>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 g-3">
                    <div class="col-6">
                        <div class="card bg-warning text-center text-white">
                            <div class="display-3">40+</div>
                            <h5>Happy Customers</h5>
                        </div>
                    </div> 
                    <div class="col-6">
                        <div class="card bg-primary text-center text-white">
                            <div class="display-3">40+</div>
                            <h5>Total Orders</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection