@extends('backend.master')
@section('maincontent')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5">
            <div class="card w-100">
                <h5 class="card-header">{{isset($type)? 'Edit':'Add'}} Type</h5>    
                    @if ($message = Session::get('success'))
                        <span class="text-sucess">{{ $message }}</span>
                    @elseif ($message = Session::get('danger'))
                        <span class="text-danger">{{ $message }}</span>
                    @endif
                <form action="{{url(isset($type)? 'update-type':'store-type')}}" method="post">
                    <input type="hidden" name="id" value="{{isset($type)? $type->id:''}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputText3" class="col-form-label">Type Name</label>
                            <input id="inputText3" name="name" type="text" class="form-control" value="{{isset($type)? $type->name:''}}">
                            @error('name')
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
        <div class="col-lg-7">
            <div class="card">
                    <h5 class="card-header">Manage Type</h5>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Type Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($types as $key=> $type)
                                    <tr>
                                        <th scope="row">{{++$key}}</th>
                                        <td>{{$type->name}}</td>
                                        <td>
                                            <a href="{{route('edit-type',[$type->id])}}" class="btn btn-info">Edit</a>
                                            <a onclick="return confirm('are you sure?')" href="{{route('delete-type',[$type->id])}}" 
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection