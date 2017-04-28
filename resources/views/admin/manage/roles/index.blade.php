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
                            <li>User Roles</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

@endsection

@section('content')

                    <div class="col-md-6 col-md-offset-3">
                        <div class="box">
                            @if(count($admins) >0)
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <h3>
                                        <a href="{{ route('roles.show', ['role' => 'admin']) }}">
                                            <span class="text-danger">Admin roles</span>
                                        </a>
                                    </h3>
                                </div>
                                <div class="col-md-12">
                                    <ul>
                                    @foreach($admins as $admin)
                                        <li>
                                            <a href="{{ route('users.show', ['user' => $admin->id]) }}">
                                                {{ $admin->profile->screen_name }}
                                            </a>
                                            <span class="pull-right">
                                                <a href="{{ route('user.roles', ['user' => $admin->id]) }}">
                                                    Manage Roles
                                                </a>
                                            </span>
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @if(count($artists) >0)
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <h3>
                                        <a href="{{ route('roles.show', ['role' => 'artist']) }}">
                                            <span class="text-primary">Artist roles</span>
                                        </a>
                                    </h3>
                                </div>
                                <div class="col-md-12">
                                    <ul>
                                    @foreach($artists as $artist)
                                        <li>
                                            <a href="{{ route('users.show', ['user' => $artist->id]) }}">
                                                {{ $artist->profile->screen_name }}
                                            </a>
                                            <span class="pull-right">
                                                <a href="{{ route('user.roles', ['user' => $artist->id]) }}">
                                                    Manage Roles
                                                </a>
                                            </span>
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @if(count($sellers) >0)
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <h3>
                                        <a href="{{ route('roles.show', ['role' => 'seller']) }}">
                                            <span class="text-warning">Seller roles</span>
                                        </a>
                                    </h3>
                                </div>
                                <div class="col-md-12">
                                    <ul>
                                    @foreach($sellers as $seller)
                                        <li>
                                            <a href="{{ route('users.show', ['user' => $seller->id]) }}">
                                                {{ $seller->profile->screen_name }}
                                            </a>
                                            <span class="pull-right">
                                                <a href="{{ route('user.roles', ['user' => $seller->id]) }}">
                                                    Manage Roles
                                                </a>
                                            </span>
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @if(count($buyers) >0)
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <h3>Buyer roles</h3>
                                </div>
                                <div class="col-md-12">
                                    <ul>
                                    @foreach($buyers as $buyer)
                                        <li>
                                            <a href="{{ route('users.show', ['user' => $buyer->id]) }}">
                                                {{ $buyer->profile->screen_name }}
                                            </a>
                                            <span class="pull-right">
                                                <a href="{{ route('user.roles', ['user' => $buyer->id]) }}">
                                                    Manage Roles
                                                </a>
                                            </span>
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @if(count($bidders) >0)
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <h3>Bidder roles</h3>
                                </div>
                                <div class="col-md-12">
                                    <ul>
                                    @foreach($bidders as $bidder)
                                        <li>
                                            <a href="{{ route('users.show', ['user' => $bidder->id]) }}">
                                                {{ $bidder->profile->screen_name }}
                                            </a>
                                            <span class="pull-right">
                                                <a href="{{ route('user.roles', ['user' => $bidder->id]) }}">
                                                    Manage Roles
                                                </a>
                                            </span>
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
@endsection

@section('scripts')
@endsection