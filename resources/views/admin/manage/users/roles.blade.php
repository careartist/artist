@extends('layout.account')

@section('head')
@endsection

@section('content')
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Profile</h4>
            </div>
            <div class="card-content">
                <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-md-12">
                            {{ $user->profile->screen_name }} 
                            <span class="pull-right">
                                <a href="{{ route('users.edit', ['role' => $user->id]) }}" class="btn btn-xs btn-primary">
                                Edit User
                                </a>
                            </span>
                        </div>
                        <div class="col-md-12">
                            {{ $user->email }}
                        </div>
                        <div class="col-md-12">
                            {{ $user->profile->first_name }} {{ $user->profile->last_name }}
                            <hr>
                        </div>
                        <div class="col-md-12">
                        <h4>Roles</h4>
                        <hr>
                            <ul>
                            @foreach($user->roles as $role)
                                <li>{{ $role->name }} 
                                <span class="pull-right">
                                    <a href="{{ route('remove.role', ['user' => $user->id, 'role' => $role->id]) }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('remove-{{ $role->slug }}-role').submit();">
                                        Remove role
                                    </a>
                                    <form id="remove-{{ $role->slug }}-role" action="{{ route('remove.role', ['user' => $user->id, 'role' => $role->id]) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </span></li>
                            @endforeach
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <ul>
                            @foreach($roles->diff($user->roles) as $role)
                                <li>{{ $role->name }} 
                                    <span class="pull-right">
                                        <a href="{{ route('assign.role', ['user' => $user->id, 'role' => $role->id]) }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('assign-{{$role->slug}}-role').submit();">
                                            Add role 
                                        </a>
                                        <form id="assign-{{$role->slug}}-role" action="{{ route('assign.role', ['user' => $user->id, 'role' => $role->id]) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </span>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection