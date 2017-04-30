@extends('layout.master')

@section('head')
@endsection

@section('breadcrumbs')
        <div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>Events</h1>
                    </div>
                    <div class="col-md-5">
                        <ul class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li>Artist Events</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('content')
        <div class="box">
            @if(count($results) > 0)
            <div class="row">

                @foreach($results as $event)
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
                    <div class="col-md-12">
                    	<span class="pull-right">
	                    	posted by:
	                        <a href="{{ route('events.show', ['event' => $event->id]) }}">
	                            {{ $event->artist->user->profile->screen_name }}
	                        </a>
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="row">
                <div class="col-md-12">
                    No Events
                </div>
            </div>
            @endif
        </div>
@endsection

@section('script')
@endsection