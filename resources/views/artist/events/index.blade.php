@extends('layout.account')

@section('head')
@endsection

@section('content')
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">
                    All Events
                    <a href="{{ route('events.create') }}" class="pull-right btn btn-sm btn-success">
                        Add Event
                    </a>
                </h4>
            </div>
            <div class="card-content">
                <div class="col-md-10 col-md-offset-1">
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
        </div>
@endsection

@section('script')

@endsection