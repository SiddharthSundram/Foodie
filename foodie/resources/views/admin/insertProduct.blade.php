@extends('admin.adminBase')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-6 mx-auto ">
                <div class="card">
                    <div class="card-header">
                        <h3>Insert Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="mb-3">
                                <label for="">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                @error('title')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 d-flex ">
                                <input type="radio" class="form-check" name="isVeg" value="1" checked> Veg
                                <input type="radio" class="form-check ms-3" name="isVeg" value="0" > Non-Veg
                                @error('isVeg')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Price</label>
                                <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                                @error('price')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Discount_price</label>
                                <input type="text" class="form-control" name="discount_price"
                                    value="{{ old('discount_price') }}">
                                @error('discount_price')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Description</label>
                                <input type="text" class="form-control" name="description"
                                    value="{{ old('description') }}">
                                @error('description')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                                @error('image')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Category</label>
                                <select class="form-control" name="category_id">
                                    <option value="">Select Category Here</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->cat_title }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Create Product" class="btn btn-success w-100">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
