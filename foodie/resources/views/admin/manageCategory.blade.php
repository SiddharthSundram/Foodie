@extends('admin.adminBase')

@section('content')
    <div class="container">
            <div class="row mt-4">
                <div class="col-9">
                    <h2 class="display-6">Manage Category({{count($categories)}})</h2>

                    <table class="table table-dark table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->cat_title}}</td>
                                    <td>
                                    
                                       <div class="d-flex gap-2">
                                            <form method="POST" action="{{route("admin.category.delete",$item->id)}}" >
                                                @csrf
                                                @method("delete")
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <input type="submit" class="btn btn-danger" value="X">
                                            </form>
                                            <a href="#rock{{$loop->index}}" class="btn btn-info" data-bs-toggle="modal" >Edit</a>

                                            {{-- modal --}}
                                            <div class="modal fade" id="rock{{$loop->index}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">Edit {{$item->cat_title}} Category</div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-body"> 
                                                                    <form action="{{route('admin.category.update',$item->id)}}" method="POST">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <label for="">Title</label>
                                                                            <input type="text" name="cat_title" class="form-control" value="{{$item->cat_title}}">
                                                                            @error('cat_title')
                                                                                <p class="text-danger small">{{$message}}</p>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <input type="submit" class="btn btn-success"  value="Update Category">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body  text-light"> 
                            <form action="" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="">Title</label>
                                    <input type="text" name="cat_title" placeholder="Enter category" class="form-control " value="{{old("cat_title")}}">
                                    @error('cat_title')
                                        <p class="text-danger small">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-success"  value="Create New Category">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    
@endsection