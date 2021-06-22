@extends('backend/master');
@section('maincontent')
<div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <form action="{{route('user-store')}}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="row clearfix">
                <div class="col-12">
                    <div class="row">
                        <!-- Main Content section start -->
                        <div class="col-12 col-lg-12">
                            <div class="add-new-page">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="block-header">
                                            <strong>{{ __('add_users') }}</strong>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="first_name"
                                                           class="col-form-label">{{ __('first_name') }}</label>
                                                    <input id="first_name" name="first_name" value="{{ old('first_name') }}"
                                                           type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="last_name" class="col-form-label">{{ __('last_name') }}</label>
                                                    <input id="last_name" name="last_name" value="{{ old('last_name') }}"
                                                           type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="email" class="col-form-label">{{ __('email') }}</label>
                                                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                                                           class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="user_role">{{ __('role') }}</label>
                                                    <select class="form-control" id="user_role" name="user_role" required>
                                                        @foreach ($roles as $role)

                                                            <option value="{{ $role->slug }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="password" class="col-form-label">{{ __('password') }}</label>
                                                    <input id="password" name="password" value="{{ old('password') }}"
                                                           type="password" class="form-control"
                                                           data-parsley-minlength="6"
                                                           data-parsley-required
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="password_confirmation"
                                                           class="col-form-label">{{ __('password_confirmation') }}</label>
                                                    <input id="password_confirmation" name="password_confirmation"
                                                           value="{{ old('password_confirmation') }}" type="password"
                                                           class="form-control"
                                                           data-parsley-equalto="#password"
                                                           required>
                                                </div>
                                            </div>

                                            
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group pb-5">
                                            <button type="submit" name="status" value="1"
                                                    class="btn btn-info pull-right"><i
                                                    class="m-r-10 fa fa-user-plus pr-1"></i>{{ __('add_user') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Main Content section end -->
                    </div>
                </div>
            </div>
       </form>
        <!-- page info end-->
        </div>
    </div>
@endsection