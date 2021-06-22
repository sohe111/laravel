@extends('backend/master');
@section('maincontent')
  <div class="row">
        <div class="col-12">
            <!-- page info start-->

            <div class="admin-section">
                <div class="row clearfix m-t-30">
                    <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                        <div class="row">
                                            <div class=" col-6">
                                                <h2 class="card-title " >{{ __('Users') }}</h2>
                                            </div>
                                                <!-- one -->
                                                    <div class="col-6 text-right">
                                                        <a href="{{Route('user-create')}}" class="btn btn-info btn-sm"><i
                                                                class="m-r-10 fa fa-account-plus"></i>{{__('Add User')}}</a>
                                                    </div>
                                                <!-- one -->
                                              </div>
                                          </div>

                                    <div class=" card-body">
                                    <table class="table   table-striped">
                                        <thead>
                                            <tr role="row">
                                                <th>ID</th>
                                                <th>{{ __('name') }}</th>
                                                <th>{{ __('email') }}</th>
                                                <th>{{ __('role') }}</th>
                                                <th>{{ __('status') }}</th>
                                                <th>{{ __('join_date') }}</th>
                                            @if(Sentinel::getUser()->hasAccess(['users_write']) || Sentinel::getUser()->hasAccess(['users_delete']))
                                                <th>{{ __('options') }}</th>
                                            @endif 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)

                                        @if($user->withActivation != null)

                                            <tr role="row" id="row_{{ $user->id }}" class="odd">
                                                <td class="sorting_1">{{ $user->id}}</td>
                                                
                                                <td>{{ $user->first_name}} {{$user->last_name}}</td>
                                                <td>
                                                    {{$user->email}}
                                                    @if($user->withActivation->completed==0)
                                                        <small class="text-warning">({{ __('unconfirmed') }})</small>
                                                    @else
                                                        <small class="text-success">({{ __('confirmed') }})</small>
                                                    @endif

                                                </td>
                                                <td>
                                                    @foreach ($user->withRoles as $role)
                                                        <label class="label label-default">{{$role->name}}</label>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if($user->withActivation->completed==0)
                                                        <label class="label btn-warning">{{ __('inactive') }}</label>
                                                    @else
                                                        @if($user->is_user_banned == 0)
                                                            <label class="label label-danger">{{ __('banned') }}</label>
                                                        @else
                                                            <label class="label label-success">{{ __('active') }}</label>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>{{$user->created_at->toDayDateTimeString()}}</td>
                                                @if(Sentinel::getUser()->hasAccess(['users_write']) || Sentinel::getUser()->hasAccess(['users_delete'])) 
                                                    <td>
                                                        @if($user->id != 1)
                                        <div class="dropdown">
                                            <button
                                                class="btn bg-info text-white dropdown-toggle btn-select-option"
                                                type="button" data-toggle="dropdown">... <span
                                                    class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu options-dropdown">
                                                 @if(Sentinel::getUser()->hasAccess(['users_write'])) 
                                                     @if(Sentinel::getUser()->id != $user->id) 
                                                        <li>
                                                           <a href="javascript:void(0)"
                                                               class="btn-list-button modal-menu"
                                                               data-title="Change User Role"
                                                               data-url="{{route('edit-info',['page_name'=>'role-change','param1'=>$user->id,'param2'=> $user->withRoles[0]->id])}}"
                                                               data-toggle="modal"
                                                               data-target="#common-modal">
                                                                <i class="fa fa-user option-icon"></i>
                                                                {{ __('change_role') }}
                                                            </a> 
                                                        </li>
                                                        <li>

                                                            @if($user->withActivation->completed==1)

                                                                @if($user->is_user_banned == 1)
                                                                  <a href="{{ route('ban-user',['user_id'=> $user->id]) }}"><i
                                                                            class="fa fa-stop-circle option-icon"></i>{{ __('ban_user') }}
                                                                    </a>
                                                                @else
                                                                    <a href="{{ route('unban-user',['user_id'=> $user->id]) }}"><i
                                                                            class="fa fa-stop-circle option-icon"></i>{{ __('unban_user') }}
                                                                    </a>
                                                                @endif

                                                            @endif

                                                        </li>
                                                     @endif 
                                                    <li>
                                                        <a href="javascript:void(0)" class="modal-menu"
                                                           data-title="Edit User Info"
                                                           data-url="{{route('edit-info',['page_name'=>'edit-user','param1'=>$user->id,'param2'=> $user->withRoles[0]->id])}}"
                                                           data-toggle="modal"
                                                           data-target="#common-modal"><i
                                                                class="fa fa-edit option-icon"></i>{{ __('edit') }}
                                                        </a>
                                                    </li>
                                                @endif 
                                               @if(Sentinel::getUser()->hasAccess(['users_delete']))
                                                    <li>
                                                        <a href="javascript:void(0)"
                                                           onclick="delete_item('users','{{ $user->id }}')"><i
                                                                class="fa fa-trash option-icon"></i>{{ __('delete') }}
                                                        </a>
                                                    </li>
                                                @endif 
                                            </ul>
                                        </div>
                                    @endif
                                </td>
                            @endif
                        </tr>
                        @endif
                    @endforeach
                                           
                    </tbody>
                </table>
            
                <div class="row">
                    <div class="col-12 col-sm-6">
                            <strong>showing 1 to 10 of 100 items</strong>
                        
                    </div>
                    <div class="col-12 col-sm-6 text-right">
                        <div class="table-info-pagination float-right">
                            <!-- render silo -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</div>
<!-- page info end-->
</div>
</div>
@endsection