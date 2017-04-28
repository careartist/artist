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
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('user.profile') }}">{{ $user->profile->screen_name }}</a></li>
                            <li>Artist Events</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('content')
        <div class="col-md-8 col-md-offset-2">
            <div class="box">
                <div class="row">
                    <div class="col-md-12">
                        Artist Events
                        <span class="pull-right">
                            <a href="{{ route('events.create') }}" class="btn btn-xs btn-primary">Add Event</a>
                        </span>
                        <hr>
                    </div>
                </div>
                @if($user->profile->artist_profile && count($user->profile->artist_profile->artist_events) > 0)
                <div class="row">

                    @foreach($user->profile->artist_profile->artist_events as $event)
                    <div class="col-md-12">
                        <hr>
                        <a href="{{ route('events.show', ['event' => $event->id]) }}">
                            {{ $event->title }}
                        </a>
                        <span class="pull-right">
                            From: {{ Carbon\Carbon::parse($event->start_at)->format('d M Y h:i A') }}
                        </span>
                        <hr>
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
                            <span class="label label-default">{{ $tag->name }}</span>
                        @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="row">
                    <div class="col-md-12">
                        No Events
                        <span class="pull-right">
                            <a href="{{ route('events.create') }}" class="btn btn-xs btn-primary">Add Event</a>
                        </span>
                    </div>
                </div>
                @endif
            </div>
        </div>
@endsection

@section('script')

@endsection