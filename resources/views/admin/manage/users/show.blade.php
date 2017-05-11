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
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                                Profile {{ $user->profile->screen_name}}

                            <span class="pull-right">
                                <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-xs btn-primary">
                                Edit User
                                </a>
                            </span>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <img id="img-avatar" src="@if($user->profile->avatar) {{route('home')}}/{{ $user->profile->avatar }} @else https://placeholdit.imgix.net/~text?txtsize=33&txt=150%C3%97150&w=150&h=150 @endif" class="thumbnail img-responsive">
                            <p>
                                <form id="user-avatar" action="{{route('user.avatar', ['profile' => $user->profile->id])}}">
                                    <input type="hidden" name="avatar" id="avatar" role="uploadcare-uploader" data-image-shrink="800x800 60%" data-crop="1:1" data-file-types="jpg JPG" />
                                    {{ csrf_field() }}
                                    <div id="upload-image-btn" class="hide">
                                        <input type="submit" class="btn btn-primary" value="Save!" />
                                    </div>
                                </form>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    {{ $user->profile->screen_name }}
                                </div>
                                <div class="col-md-12">
                                    {{ $user->profile->first_name }} {{ $user->profile->last_name }} 
                                </div>
                                <div class="col-md-12">
                                    {{ $user->profile->phone_number }}
                                </div>
                                <div class="col-md-12">
                                    {{ $user->email }}
                                </div>
                                <div class="col-md-12">
                                    {{ $user->profile->account_type }}
                                </div>
                                <div class="col-md-12">
                                @if(count($user->roles) > 0)
                                    <ul>
                                    @foreach($user->roles as $role)
                                        <li>{{ $role->name }}</li>
                                    @endforeach
                                    </ul>
                                    <a href="{{ route('user.roles', ['user' => $user->id]) }}" class="btn btn-xs btn-primary">
                                        Manage Roles
                                    </a>

                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                                Address
                            <span class="pull-right">
                                <a href="{{ route('address.edit', ['address' => $user->profile->address_id]) }}" class="btn btn-xs btn-primary">
                                    Edit Address
                                </a>
                            </span>
                            <hr>
                        </div>
                    </div>
                    @if($user->profile->address)
                    <div class="row">
                        <div class="col-md-12">
                            {{ $user->profile->address->region->place }}
                        </div>
                        <div class="col-md-12">
                            {{ $user->profile->address->place }}
                        </div>
                        <div class="col-md-12">
                            {{ $user->profile->address->address }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection