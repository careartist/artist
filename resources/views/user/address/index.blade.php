@extends('layout.master')

@section('head')
@endsection

@section('breadcrumbs')

        <div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>{{ Sentinel::getUser()->profile->screen_name }}</h1>
                    </div>
                    <div class="col-md-5">
                        <ul class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('user.profile') }}">{{ Sentinel::getUser()->profile->screen_name }}</a></li>
                            <li>User Address</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('content')
        <div class="box">
            <div class="row">
                <div class="col-md-12">
                    Address
                    <span class="pull-right">
                        <a href="{{ route('user.address.edit') }}" class="btn btn-xs btn-primary">
                            Edit address
                        </a>
                    </span>
                    <hr>
                </div>
                <div class="col-md-12">
                    {{ $address->region->place }}
                </div>
                <div class="col-md-12">
                    {{ $address->place->place }}
                </div>
                <div class="col-md-12">
                    {{ $address->address }}
                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection