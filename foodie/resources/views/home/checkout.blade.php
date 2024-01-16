@extends('home.base')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h2>CheckOut</h2>
            </div>


            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <div>Enter Address details </div>
                        {{-- <div class="text-danger">(* required field)</div> --}}
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf

                            <div class="mb-3 d-flex">
                                <div class="text-danger">Note :- ( * is required field that is must be filled. )</div>

                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label for="">FullName</label>
                                        <input type="text" name="fullname" value="{{ old('fullname') }}"
                                            class="form-control">
                                        @error('fullname')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="">alt_conact</label>
                                        <input type="text" name="alt_conact" value="{{ old('alt_conact') }}"
                                            class="form-control">
                                        @error('alt_conact')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="">landmark
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="landmark" value="{{ old('landmark') }}"
                                            class="form-control">
                                        @error('landmark')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label for="">street_name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="street_name" value="{{ old('street_name') }}"
                                            class="form-control">
                                        @error('street_name')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="">area
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="area" value="{{ old('area') }}"
                                            class="form-control">
                                        @error('area')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="">pincode
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="pincode" value="{{ old('pincode') }}"
                                            class="form-control">
                                        @error('pincode')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label for="">city
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select type="text" name="city" value="{{ old('city') }}"
                                            class="form-control">
                                            <option value="">Select City</option>
                                            <option value="purnea">purnea</option>
                                            <option value="patna">patna</option>
                                            <option value="bhagalpur">bhagalpur</option>

                                        </select>
                                        @error('city')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="">state
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select type="text" name="state" value="{{ old('state') }}"
                                            class="form-control">
                                            <option value="">Select state</option>
                                            <option value="Bihar">Bihar</option>

                                        </select>
                                        @error('state')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="">Type</label> <br>
                                        <input type="radio" name="type" value="o">Office
                                        <input type="radio" name="type" checked value="h">home
                                    </div>

                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <input type="submit" value="Save Address" class="btn btn-success">
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <form action="{{ route('pay.now') }}" method="POST">
                    @csrf
                    <input type="text" value="{{ session('amount') }}" name="amount">

                    <select name="address_id" id="" class="form-select form-select-lg">
                        <option value="">Select Saved Address</option>
                        @foreach ($addresses as $add)
                            <option value="{{ $add->id }}">
                                {{ $add->street_name }},{{ $add->landmark }},{{ $add->area }},{{ $add->city }},{{ $add->state }},{{ $add->pincode }}
                            </option>
                        @endforeach
                    </select>

                    {{-- @foreach ($addresses as $add)
                        <div class="card mt-1" >
                            <div class="card-body" >
                               <table >
                                <tr>
                                    <th>Street Name :</th>
                                    <td>{{ $add->street_name }}</td>
                                </tr>
                                <tr>
                                    <th>Landmark :</th>
                                    <td>{{ $add->landmark }}</td>
                                </tr>
                                <tr>
                                    <th>Area :</th>
                                    <td>{{ $add->area }}</td>
                                </tr>
                                <tr>
                                    <th>City :</th>
                                    <td>{{ $add->city }}</td>
                                </tr>
                                <tr>
                                    <th>State :</th>
                                    <td>{{ $add->state }}</td>
                                </tr>
                                <tr>
                                    <th>Pincode :</th>
                                    <td>{{ $add->pincode }}</td>
                                </tr>
                               </table>
                            </div>
                        </div>
                    @endforeach --}}

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary mt-3 w-100 " value="Make Payment ">
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
