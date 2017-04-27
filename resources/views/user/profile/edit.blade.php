@extends('layout.master')

@section('head')
@endsection

@section('breadcrumbs')

        <div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>Edit Profile</h1>
                    </div>
                    <div class="col-md-5">
                        <ul class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
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
                <!-- <form class="form-horizontal" role="form" method="post" action="{{ route('user.address.update') }}"> -->
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    {{ Form::bsText('screen_name', null, ['placeholder' => 'Screen Name']) }}

                    {{ Form::bsText('first_name', null, ['placeholder' => 'First Name']) }}
                        
                    {{ Form::bsText('last_name', null, ['placeholder' => 'Last Name']) }}

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