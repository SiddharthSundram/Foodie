@extends('home.base')

@section('content')
    <div class="container mt-5">
        @if ($order)
            <div class="row">
                <div class="col-12">
                    <h2>My Cart ({{ $count = count($order->orderItem) }})</h2>
                </div>

                @if ($count)
                    <div class="col-7">
                        {{-- product here --}}
                        @php
                            $total_price = $total_discount_price = $net_payable = 0;
                            $delivery_charge = 50;
                        @endphp
                        @foreach ($order->orderItem as $item)
                            <div class="card mt-1">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="{{ asset('storage/' . $item->product->image) }}" alt=""
                                                class="w-100">
                                        </div>
                                        <div class="col-10">
                                            <h2 class="h5">{{ $item->product->title }}</h2>
                                            <div class="container">

                                                <h6 class="text-success">
                                                    Rs.{{ $item->product->discount_price * $item->qty }}/-
                                                    <del
                                                        class="text-danger small">Rs.{{ $item->product->price * $item->qty }}/-</del>
                                                </h6>
                                            </div>
                                            <div class="row ">
                                                <div class="col-3 ">
                                                    <a href="{{ route('removeFromCart', $item->product->id) }}"
                                                        class="btn btn-danger">-</a>
                                                    <span>{{ $item->qty }}</span>
                                                    <a href="{{ route('addToCart', $item->product->id) }}"
                                                        class="btn btn-success">+</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @php
                                $total_price += $item->product->price * $item->qty;
                                $total_discount_price += $item->product->discount_price * $item->qty;
                            @endphp
                        @endforeach

                    </div>
                    <div class="col-5">
                        <div class="list-group">
                            <span class="list-group-item list-group-item-action">Total Price
                                <span class="float-end">Rs. {{ $total_price }}</span>
                            </span>
                            <span class="list-group-item bg-success text-white list-group-item-action">Discount
                                <span class="float-end ">Rs. {{ $total_discount_price }}</span>

                            </span>
                            <span class="list-group-item list-group-item-action">Tax (GST 18%)
                                <span class="float-end ">Rs. {{ $gst = $total_discount_price * 0.18 }}</span>

                            </span>
                            @php
                                $net_payable = $total_discount_price + $gst;
                                $delivery_charge = $net_payable <= 500 ? 50 : 0;
                            @endphp

                            <span class="list-group-item list-group-item-action">Delivery Charge
                                <span class="float-end ">
                                    @if ($delivery_charge)
                                        {{ $delivery_charge }}
                                    @else
                                        <h6 class="text-success fw-bold">Free</h6>
                                    @endif
                                </span>

                            </span>
                            <span class="list-group-item list-group-item-action display-6 fw-bold text-success">Net Payable
                                <span class="float-end">
                                    Rs.{{ $total_payable_amount = $net_payable + $delivery_charge }}

                                    @php
                                        session()->flash('amount', $total_payable_amount);
                                    @endphp
                                </span>
                            </span>
                        </div>

                        <div class="d-flex mt-5 gap-3">
                            <div class="col">
                                <a href="{{ route('home') }}" class="btn btn-dark w-100">Add more</a>
                            </div>
                            <div class="col">
                                <a href="{{ route('checkout') }}" class="btn btn-success w-100">Check Out</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="container">
                        <div class="row">
                            <div class="col-4 mx-auto mt-5">
                                <div class="card border-0">
                                    <div class="card-body ">
                                        <h1 class="display-4 text-secondary fw-bold ">Cart is empty</h1>
                                        <a href="{{ route('home') }}" class="btn btn-dark mt-4 w-100">Shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


            </div>
        @else
            <div class="container">
                <div class="row">
                    <div class="col-4 mx-auto mt-5">
                        <div class="card border-0">
                            <div class="card-body ">
                                <h1 class="display-4 text-secondary fw-bold ">Cart is empty</h1>
                                <a href="{{ route('home') }}" class="btn btn-dark mt-4 w-100">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
