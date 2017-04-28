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
                            <li><a href="{{ route('home') }}">Home</a>
                            </li>
                            <li>Manage Users</li>
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
                                @foreach($users as $user)
                                <div class="col-md-12">
                                    <a href="{{ route('users.show', ['user' => $user->id]) }}">
                                        <h4>{{ $user->profile->screen_name }}</h4>
                                    </a>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">{{ $user->profile->first_name }} {{ $user->profile->last_name }}
                                            <span class="pull-right">
                                                <a href="{{ route('users.edit', ['user' => $user->id]) }}">
                                                    Edit User
                                                </a>
                                            </span>
                                        </div>
                                        <div class="col-md-12">{{ $user->email }}</div>
                                        <div class="col-md-12">
                                            {{ $user->profile->phone_number }}
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            {{ $user->profile->account_type }}
                                            <span class="pull-right">
                                                <a href="{{ route('user.roles', ['user' => $user->id]) }}">
                                                    Manage Roles
                                                </a>
                                            </span>
                                        </div>
                                        <div class="col-md-12">
                                        @if(count($user->roles) > 0)
                                            <ul>
                                            @foreach($user->roles as $role)
                                                <li>{{ $role->name }}</li>
                                            @endforeach
                                            </ul>
                                        @endif
                                        <hr>
                                        </div>
                                        @if($user->profile->address)

                                        <div class="col-md-12">{{ $user->profile->address->region->place }}</div>
                                        <div class="col-md-12">{{ $user->profile->address->place->place }}</div>
                                        <div class="col-md-12">
                                            {{ $user->profile->address->address }}
                                            <span class="pull-right">
                                                <a href="{{ route('address.edit', ['address' => $user->profile->address_id]) }}">
                                                    Edit Address
                                                </a>
                                            </span>
                                        </div>
                                        @endif
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
@endsection

@section('scripts')
@endsection