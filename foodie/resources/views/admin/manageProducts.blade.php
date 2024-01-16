@extends('admin.adminBase')

@section('content')

    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <div class="container">
                            <h2 class="display-6 float-start">Manage Category({{count($products)}})</h2>
                            <a href="{{route('admin.product.insert')}}" class="btn btn-success float-end ">Insert Product</a>
                </div>
                    <table class="table table-dark table-bordered table-hover mt-4">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Veg/Non-Veg</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td class="fw-bold">{{$item->id}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>
                                        @if ($item->isVeg )
                                            <img src="{{asset('icons/v.png')}}" width="30px" alt="">
                                        @else
                                            <img src="{{asset('icons/nv.png')}}" width="30px" alt="">
                                        @endif
                                    </td>
                                    <td>Rs.{{$item->discount_price}} <del class="text-danger small">Rs.{{$item->price}}</del></td>
                                    <td>
                                        <img src="{{asset("storage/" . $item->image)}}" width="50px" alt="">
                                    </td>
                                    <td class="text-truncate">{{$item->description}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>{{$item->category->cat_title}}</td>
                                    <td>
                                        <a href="{{route("admin.product.remove",$item->id)}}" class="btn btn-danger">X</a>
                                        <a href="" class="btn btn-info">Edit</a>
                                    </td>

                                </tr>
                            @endforeach
                           
                        </tbody>
                    </table>

                    {{$products->links()}}
            </div>
        </div>
    </div>
    
@endsection