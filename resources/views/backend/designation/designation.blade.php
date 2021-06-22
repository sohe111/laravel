@extends('backend/master');
@section('maincontent')
<div class="container-fluid row">
    <div class="col-md-5">
        <div class="card">
            <h5 class="card-header">{{isset($designation)? 'Edit':'Add'}} Designation</h5>
            @if ($message = Session::get('success'))
                <span class="text-sucess">{{ $message }}</span>
            @elseif ($message = Session::get('danger'))
                <span class="text-danger">{{ $message }}</span>
            @endif
            <form action="{{url(isset($designation)? 'update-designation':'store-designation')}}" method="post">
                <input type="hidden" name="id" value="{{isset($designation)? $designation->id:''}}">
                  @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Title</label>
                        <input id="inputText3" name="title" type="text" class="form-control" value="{{isset($designation)? $designation->title:''}}">
                        @error('title')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                       
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Save
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm">
                        <i class="fa fa-ban"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card manage-card">
            @if ($message = Session::get('success'))
            <h3 class="mt-2 ml-2"> <span class="text-sucess">{{ $message }}</span></h3>
            @elseif ($message = Session::get('danger'))
                <h3 class="mt-2 ml-2"> <span class="text-danger">{{ $message }}</span></h3>
            @endif
            <form action="store-designation" method="post">
             @csrf
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      
                            <h3 class="card-header">Manage Designation </h3>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($designations as $key => $designation)
                                            <tr>
                                                <th>{{++$key}}</th>
                                                <td>{{$designation->title}}</td>
                                                <td>
                                                    <a href="{{route('edit-designation',[$designation->id])}}" class="btn btn-info">Edit</a>
                                                    <a onclick="return confirm('are you sure?')" href="{{route('delete-designation',[$designation->id])}}"
                                                    class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                       
                                    </tbody>
                                </table>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection