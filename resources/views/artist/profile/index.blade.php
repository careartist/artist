@extends('layout.account')

@section('head')
@endsection

@section('content')
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
                            <div class="card-profile">
                                <div class="card-avatar">
                                    <img id="img-avatar" src="@if($user->profile->avatar) {{route('home')}}/{{ $user->profile->avatar }} @else https://placeholdit.imgix.net/~text?txtsize=33&txt=150%C3%97150&w=150&h=150 @endif" class="img">
                                </div>
                                <p>
                                    <form id="user-avatar" action="{{route('user.avatar', ['profile' => $user->profile->id])}}">
                                        <input type="hidden" name="avatar" id="avatar" role="uploadcare-uploader" data-image-shrink="800x800 60%" data-crop="1:1" data-file-types="jpg jpeg JPG JPEG" />
                                        {{ csrf_field() }}
                                        <div id="upload-image-btn" class="hide">
                                            <input type="submit" class="btn btn-primary" value="Save!" />
                                        </div>
                                    </form>
                                </p>
                            </div>
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
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('events.create') }}" class="btn btn-success btn-block">
                                    Add Artist Event
                                </a>
                            </div>
                            @if(count($user->profile->artist_profile->artist_events) > 0)
                            <div class="col-md-6">
                                <a href="{{ route('events.index') }}" class="btn btn-warning btn-block">
                                    Events
                                </a>
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="col-md-12">
                            <a href="{{ route('artist.profile.create') }}" class="btn btn-primary btn-block">
                                Add Artist Bio
                            </a>
                        </div>
                        @endif
                    </div>
                    @if(count($user->profile->artist_profile->artist_events) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                                <h3>Artist Events</h3>
                            <hr>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                        @foreach($user->profile->artist_profile->artist_events as $event)
                            <div class="col-md-12">
                                <hr>
                                <div class="col-md-12">
                                <h3>
                                    <a href="{{ route('events.show', ['event' => $event->id]) }}">
                                        {{ $event->title }}
                                    </a>
                                </h3>
                                </div>
                                <div class="col-md-12">
                                    From: {{ Carbon\Carbon::parse($event->start_at)->format('d M Y h:i A') }}
                                    <div class="row">
                                        <div class="col-md-12">
                                        @if($event->end_at)
                                        Until: {{ Carbon\Carbon::parse($event->end_at)->format('d M Y h:i A') }}
                                        @endif
                                        </div>
                                    </div>
                                <hr>
                                </div>
                                @if($event->cover)
                                <div class="col-md-12">
                                    <a href="{{ route('events.show', ['event' => $event->id]) }}">
                                        <img src="{{ asset($event->cover) }}" class="img-responsive thumbnail">
                                    </a>
                                </div>
                                @endif
                                <div class="col-md-12">
                                    {{ $event->description }}
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    @foreach($event->tags as $tag)
                                        <a href="{{ route('public.events.tag', ['tag' => $tag->name]) }}">
                                            <span class="label label-info">{{ $tag->name }}</span>
                                        </a>
                                    @endforeach
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('public.events.type', ['type' => $event->type]) }}">
                                        <span class="label label-warning">{{ $event->type }}</span>
                                    </a>
                                    <hr>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    @endif
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
@endsection

@section('script')
@endsection