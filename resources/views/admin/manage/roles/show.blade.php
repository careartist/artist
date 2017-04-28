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
                                <a href="{{ route('roles.index') }}">Manage Roles</a>
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
                                <h4>Role: {{ ucfirst(trans($role)) }}</h4>
                                <hr>
                                    <div class="row">
                                    @foreach($users as $user)
                                        <div class="col-md-12">
                                            <span>
                                                <a href="{{ route('users.show', ['user' => $user->id]) }}"> {{ $user->profile->screen_name }}</a>
                                            </span>
                                            <span class="pull-right">
                                                <a href="{{ route('user.roles', ['user' => $user->id]) }}" class="btn btn-xs btn-primary">All roles</a>
                                            </span>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@section('scripts')
@endsection