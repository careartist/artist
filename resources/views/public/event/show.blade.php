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
            <div class="row">
                <div class="col-md-12">
                    <h3>{{ $event->title }}</h3>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <img id="img-cover" src="@if($event->cover) {{route('home')}}/{{ $event->cover }} @else https://placeholdit.imgix.net/~text?txtsize=33&txt=900%C3%97300&w=900&h=300 @endif" class="thumbnail img-responsive">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            From: {{ Carbon\Carbon::parse($event->start_at)->format('d M Y h:i A') }}
                        </div>
                        <div class="col-md-6">
                            @if($event->end_at)
                            Until: {{ Carbon\Carbon::parse($event->end_at)->format('d M Y h:i A') }}
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><hr></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ $event->region->place }}
                        </div>
                        <div class="col-md-6">
                            {{ $event->place }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><hr></div>
                    </div>
                </div>
                <div class="col-md-12">
                    {{ $event->description }}
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('public.events.type', ['type' => $event->type]) }}">
                                <span class="label label-warning">{{ $event->type }}</span>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <span class="label label-success">{{ $event->price }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><hr></div>
                    </div>
                </div>
                @if($event->contact_name)
                <div class="col-md-12">
                    <div class="col-md-6">
                        {{ $event->contact_name }}
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                {{ $event->contact_email }}
                            </div>
                            <div class="col-md-12">
                                {{ $event->contact_phone }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><hr></div>
                    </div>
                </div>
                @endif
                @if(count($event->tags) > 0)
                <div class="col-md-12">
                    @foreach($event->tags as $tag)
                        <a href="{{ route('public.events.tag', ['tag' => $tag->name]) }}">
                            <span class="label label-info">{{ $tag->name }}</span>
                        </a>
                    @endforeach
                    <div class="row">
                        <div class="col-md-12"><hr></div>
                    </div>
                </div>
                @endif
            </div>
        </div>
@endsection

@section('script')
@endsection
