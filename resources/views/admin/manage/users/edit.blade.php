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
                    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
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
                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number" value="@if(old('phone_number')){{ old('phone_number') }}@else{{ $user->profile->phone_number }}@endif" required>
                            
                            @if ($errors->has('phone_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection