@extends('layout.master')

@section('head')
@endsection

@section('breadcrumbs')

        <div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>{{ $user->profile->screen_name }}</h1>
                    </div>
                    <div class="col-md-5">
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{ route('home') }}">Home</a>
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
                <form action="{{ route('admin.profile.update') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('screen_name') ? ' has-error' : '' }}">
                        <label for="screen_name">Screen Name</label>
                        <input type="text" class="form-control" name="screen_name" id="screen_name" placeholder="Public Screen Name" value="@if(old('screen_name')){{ old('screen_name') }}@else{{ $user->profile->screen_name }}@endif" required>

                        @if ($errors->has('screen_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('screen_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="first_name">First name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Your First name" value="@if(old('first_name')){{ old('first_name') }}@else{{ $user->profile->first_name }}@endif" required>
                        
                        @if ($errors->has('first_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name">Last name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Your Last name" value="@if(old('last_name')){{ old('last_name') }}@else{{ $user->profile->last_name }}@endif" required>
                        
                        @if ($errors->has('last_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
@endsection

@section('scripts')
@endsection