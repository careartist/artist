@extends('layout.master')

@section('head')
@endsection

@section('breadcrumbs')

        <div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>Admin</h1>
                    </div>
                    <div class="col-md-5">
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('users.index') }}">Manage Users</a> - 
                                <a href="{{ route('users.show', ['user' => $user->id]) }}">{{ $user->profile->screen_name }}</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

@endsection

@section('content')

                    <div class="col-md-6 col-md-offset-3">
                        <div class="box">
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
@endsection

@section('scripts')
@endsection