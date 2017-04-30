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
                            <li><a href="{{ route('artist.profile') }}">{{ Sentinel::getUser()->profile->artist_profile->legal_name }}</a></li>
                            <li>Edit Artist Bio</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('content')
        <div class="box">
            <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>

            <hr>


            {{ Form::model($profile, ['route' => ['artist.profile.update']]) }}

            	{{ csrf_field() }}
                {{ method_field('PUT') }}

                {{ Form::bsTextarea('bio', null, ['placeholder' => 'Artist Bio']) }}

                <div class="text-center">
                    <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i> Add Bio</button>
                </div>

            {{ Form::close() }}
        </div>
@endsection

@section('scripts')
@endsection