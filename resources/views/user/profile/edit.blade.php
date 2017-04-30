@extends('layout.account')

@section('head')
@endsection

@section('content')
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Profile</h4>
            </div>
            <div class="card-content">
                <div class="col-md-10 col-md-offset-1">
                    {{ Form::model($profile, ['route' => ['user.profile.update']]) }}
                    
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        {{ Form::bsText('screen_name', null, ['placeholder' => 'Screen Name', 'disabled' => 'disabled']) }}

                        {{ Form::bsText('first_name', null, ['placeholder' => 'First Name', 'disabled' => 'disabled']) }}
                            
                        {{ Form::bsText('last_name', null, ['placeholder' => 'Last Name', 'disabled' => 'disabled']) }}

                        {{ Form::bsText('phone_number', null, ['placeholder' => 'Phone Number']) }}

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Update Profile
                            </button>
                        </div>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection