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
                        </ul>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('content')
        <div class="box">
            @foreach($events as $event)
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('public.events.show', ['id' => $event->id, 'title' => strtolower(str_replace(' ', '-', $event->title))]) }}">
                        {{ $event->title }}
                    </a>
                    <span class="pull-right">
                        From: {{ Carbon\Carbon::parse($event->start_at)->format('d M Y h:i A') }}
                    </span>
                    <hr>
                    <div class="col-md-12">
                        <a href="{{ route('public.events.show', ['id' => $event->id, 'title' => strtolower(str_replace(' ', '-', $event->title))]) }}">
                    		@if($event->cover)
                            <img src="{{ asset($event->cover) }}" class="img-responsive thumbnail">
                    		@else
                            <img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=900%C3%97300&w=900&h=300" class="img-responsive thumbnail">
                    		@endif
                        </a>
                    </div>
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
            </div>
            @endforeach
        </div>
@endsection

@section('right-side')

    @include('components.public.rightsidebar.alltags')

@endsection


@section('script')
@endsection
