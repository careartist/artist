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
                            <li>Artist Request</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('content')
        <div class="box">
            <p class="text-muted">If you have any questions, please feel free to contact us, our customer service center is working for you 24/7.</p>

            <hr>

            {{ Form::open(['route' => 'user.request.role.store']) }}

                {{ Form::bsText('cui_number', null, ['placeholder' => 'CUI Number', 'required' => 'required', 'autofocus' => 'autofocus']) }}

                {{ Form::bsText('legal_name', null, ['placeholder' => 'Legal Name', 'required' => 'required']) }}
                    
                {{ Form::bsText('authority', null, ['placeholder' => 'Authority', 'required' => 'required']) }}

                <hr>
                <div class="text-center">
                    <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i> Request Artist Role</button>
                </div>

            {{ Form::close() }}
        </div>
@endsection

@section('scripts')
@endsection