@extends('admin.adminBase')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <h2 class="display-6 float-start">Manage Carts ({{count($totalCarts)}})</h2>
            </div>

                   
            <div class="row">
                <div class="col-12">
                    @foreach ($carts as $item)
                        <div class="card bg-dark mt-3">
                            <div class="card-header bg-warning p-1">
                                <table class="table table-warning   bordered border-0  table-sm table-hover">
                                    <tr class="bg-dark">
                                        <th>Order Id</th>
                                        <td>{{$item->id}}</td>

                                        <th>Order By</th>
                                        <td class="text-capitalize">{{$item->users->name}}</td>
                                        
                                        <th>Contact</th>
                                        <td >{{$item->users->email}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-body">
                                <table class="table table-dark table-sm table-hover ">
                                    <tr >
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Product Image</th>
                                    </tr>
                                    @foreach ($item->orderItem as $i)
                                        <tr>
                                            <td>{{$i->id}}</td>
                                            <td>{{$i->product->title}}</td>
                                            <td>{{$i->qty}}</td>
                                            <td>
                                                <img src="{{asset('storage/'.$i->product->image)}}" width="50px" alt="">
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    @endforeach

                    {{$carts->links()}}
                </div>
            </div>

        </div>
    </div>
    
@endsection