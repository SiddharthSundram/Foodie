@extends('home.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5 mt-5 mx-auto ">
                <form action="{{ route('search') }}" method="GET" class="d-flex">
                    @method('GET')
                    <input type="search" name="search" value="@if (isset($search)) {{ $search }} @endif"
                        placeholder="Search sweets,snacks & more" class="rounded-0 border border-danger form-control">
                    <input type="submit" value="Search" class="btn btn-danger rounded-0 w-100">
                </form>
            </div>
        </div>
    </div>

    <div class="container">
            @foreach ($categories as $cat)
                <div class="container my-5">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-capitalise h4">{{ $cat->cat_title }}</h2>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($cat->products as $item)
                            <div class="col-3 mb-3 ">
                                <div class="card wow">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="" class="w-100"
                                                style="height:80px;object-fit:cover;">
                                        </div>
                                        <div class="col ">
                                            <div class="card-body p-1">
                                                <h5 class="fs-6 fw-bold mb-0">{{ $item->title }}
                                                    <span href="" class=" float-end">
                                                        @if ($item->isVeg)
                                                            <img src="{{ asset('icons/v.png') }}" width="30px"
                                                                alt="">
                                                        @else
                                                            <img src="{{ asset('icons/nv.png') }}" width="30px"
                                                                alt="">
                                                        @endif
                                                    </span>
                                                </h5>
                                                <div class="row">
                                                    <div class="col p-0 m-0 ">
                                                        <span
                                                            class="fw-bold  text-success fs-5">Rs.{{ $item->discount_price }}/-
                                                        </span>
                                                        <del class="small text-danger ">Rs.{{ $item->price }}/-</del>
                                                    </div>
                                                </div>
                                                <a href="{{ route('addToCart', $item->id) }}"
                                                    class="btn btn-success rounded-0 small btn-sm float-end">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <hr>
            @endforeach
       
    </div>
@endsection
