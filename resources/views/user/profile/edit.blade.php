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
                            <li>Edit Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('content')
        <div class="col-md-6 col-md-offset-3">
            <div class="box">
                {{ Form::model($profile, ['route' => ['user.profile.update']]) }}
                
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    {{ Form::bsText('screen_name', null, ['placeholder' => 'Screen Name', 'disabled' => 'disabled']) }}

                    {{ Form::bsText('first_name', null, ['placeholder' => 'First Name', 'disabled' => 'disabled']) }}
                        
                    {{ Form::bsText('last_name', null, ['placeholder' => 'Last Name', 'disabled' => 'disabled']) }}

                    {{ Form::bsText('phone_number', null, ['placeholder' => 'Phone Number']) }}

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Update Profile
                        </button>
                    </div>
                {{ Form::close() }}

            </div>
        </div>
@endsection

@section('scripts')
@endsection