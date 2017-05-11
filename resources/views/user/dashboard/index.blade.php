@extends('layout.account')

@section('head')
@endsection

@section('content')
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Profile</h4>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-profile">
                            <div class="card-avatar">
                                <img id="img-avatar" src="@if($user->profile->avatar) {{route('home')}}/{{ $user->profile->avatar }} @else https://placeholdit.imgix.net/~text?txtsize=33&txt=150%C3%97150&w=150&h=150 @endif" class="img">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <h4>{{ $user->profile->screen_name }} Profile</h4>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    {{ $user->profile->screen_name }}
                                </div>
                                <div class="col-md-12">
                                    {{ $user->profile->first_name }} {{ $user->profile->last_name }}
                                </div>
                                <div class="col-md-12">
                                    {{ $user->profile->account_type }}
                                </div>
                                <div class="col-md-12">
                                    {{ $user->profile->phone_number }}
                                </div>
                                <div class="col-md-12">
                                    {{ $user->email }}
                                </div>
                            </div>
                            <div class="col-md-6">
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
                        </div>
                    </div>                    
                </div>
                <hr>
            </div>
        </div>

        @if($user->profile->account_type == 'uap' || $user->profile->account_type == 'artist')
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Artist Profile</h4>
            </div>
            <div class="card-content">
                @if($user->profile->artist_profile)
                    @if($user->profile->artist_profile->approved == 0 && $user->profile->artist_profile->rejected == 0)
                    <div class="row">
                        <div class="col-md-12">
                        {{ $user->profile->account_type }} request pending
                        </div>
                    </div>
                    @elseif($user->profile->artist_profile->rejected == 1)
                    <div class="row">
                        <div class="col-md-12">
                        <!-- add reason for rejection -->
                        {{ $user->profile->account_type }} request rejected
                        </div>
                    </div>
                    @elseif($user->profile->artist_profile->approved == 1)

                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                            <div class="col-md-12">
                                <hr>
                                    <h4>{{strtoupper(trans($user->profile->account_type))}} Registration</h4>
                                <hr>
                            </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        Legal Name:
                                    </div>
                                    <div class="col-md-6">
                                        {{ $user->profile->artist_profile->legal_name }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        CUI Number:
                                    </div>
                                    <div class="col-md-6">
                                        {{ $user->profile->artist_profile->cui_number }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        Authority:
                                    </div>
                                    <div class="col-md-6">
                                        {{ $user->profile->artist_profile->authority }}
                                    </div>
                                </div>
                                @if($user->profile->artist_profile->artist_bio)
                                <div class="col-md-12">
                                    <hr>
                                    Subdomain:
                                </div>
                                <div class="col-md-12">
                                    <a href="http://{{ $user->profile->artist_profile->artist_bio->subdomain }}.{{ config('app.domain_name') }}" target="_blank">{{ $user->profile->artist_profile->artist_bio->subdomain }}.{{ config('app.domain_name') }}</a>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('events.create') }}" class="btn btn-primary btn-block">
                                        Add Artist Event
                                    </a>
                                    <hr>
                                </div>
                                    @if(count($user->profile->artist_profile->artist_events) > 0)
                                    <div class="col-md-12">
                                        <a href="{{ route('events.index') }}" class="btn btn-warning btn-block">
                                            Events
                                        </a>
                                    </div>
                                    @endif
                                @else
                                <div class="col-md-12">
                                    <a href="{{ route('artist.profile.create') }}" class="btn btn-primary btn-block">
                                        Add Artist Bio
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            @if($user->profile->artist_profile->artist_bio)
                            <div class="col-md-12">
                                <hr>
                                <h4>
                                    <a href="{{ route('artist.profile') }}">
                                        {{ $user->profile->artist_profile->legal_name }}
                                    </a>
                                </h4>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('artist.profile.edit') }}" class="btn btn-primary btn-block">
                                    Edit Artist Bio
                                </a>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                {{ $user->profile->artist_profile->artist_bio->bio }}
                            </div>
                            @else
                            <div class="col-md-12">
                                <a href="{{ route('artist.profile.create') }}" class="btn btn-primary btn-block">
                                    Add Artist Bio
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                @else
                <div class="row">
                    @if($user->profile->account_type == 'uap' || $user->profile->account_type == 'artist')
                    <div class="col-md-12">
                        Request Artist Role
                        <span class="pull-right">
                            <a href="{{ route('user.request.role.create') }}" class="btn btn-primary">Request Artist Role</a>
                        </span>
                    </div>
                    @endif
                </div>
                @endif
                <hr>
            </div>
        </div>
        @endif
@endsection

@section('script')
@endsection