@extends('layout.master')

@section('head')
@endsection

@section('breadcrumbs')

        <div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>{{ $event->title }}</h1>
                    </div>
                    <div class="col-md-5">
                        <ul class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('events.index') }}">Events</a></li>
                            <li>{{ $event->title }}</li>
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
                    {{ $event->title }}
                    <span class="pull-right">
                        <a href="{{ route('events.edit', ['event' => $event->id]) }}" class="btn btn-xs btn-primary">
                        Edit Event
                        </a>
                    </span>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <img id="img-cover" src="@if($event->cover) {{route('home')}}/{{ $event->cover }} @else https://placeholdit.imgix.net/~text?txtsize=33&txt=900%C3%97300&w=900&h=300 @endif" class="thumbnail img-responsive">
                    <p>
                        <form id="event-cover" action="{{route('event.cover', ['event' => $event->id])}}">
                            <input type="hidden" name="cover" id="cover" role="uploadcare-uploader" data-image-shrink="1200x1200 60%" data-crop="3:1" data-file-types="jpg JPG" />
                            {{ csrf_field() }}
                            <div id="upload-image-btn" class="hide">
                                <input type="submit" class="btn btn-primary" value="Save!" />
                            </div>
                        </form>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr>
                    <h4>{{ $event->title }}</h4>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        From: {{ Carbon\Carbon::parse($event->start_at)->format('d M Y h:i A') }}
                    </div>
                    <div class="col-md-6">
                        @if($event->end_at)
                        Until: {{ Carbon\Carbon::parse($event->end_at)->format('d M Y h:i A') }}
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                    {{ $event->description }}
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        {{ $event->type }}
                    </div>
                    <div class="col-md-6">
                        {{ $event->price }}
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
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
                </div>
                <div class="col-md-12">
                @foreach($event->tags as $tag)
                    <span class="label label-default">{{ $tag->name }}</span>
                @endforeach
                </div>
            </div>
        </div>
@endsection

@section('script')

    <script charset="utf-8" src="https://ucarecdn.com/libs/widget/2.10.3/uploadcare.full.min.js"></script>

    <script>
        UPLOADCARE_PUBLIC_KEY = '{{$ucare->public_key}}';
        UPLOADCARE_TABS = 'file';
        UPLOADCARE_INPUT_ACCEPT_TYPES = '.jpg, .jpeg'
        UPLOADCARE_IMAGES_ONLY = true;
        UPLOADCARE_LOCALE_TRANSLATIONS = {
            errors: {
            'fileType': 'This type of files is not allowed.'
            },
            dialog: {
                tabs: {
                    preview: {
                        error: {
                            'fileType': {
                                title: 'File error.',
                                text: 'Only .jpg files.',
                                back: 'Back'
                            }
                        }
                    }
                }
            }
        };
    </script>

    <script>

        var widget = uploadcare.Widget('[role=uploadcare-uploader]');

        function fileTypeLimit(types) {
            types = types.split(' ');
            return function(fileInfo) {
                if (fileInfo.name === null) {
                    return;
                }
                var extension = fileInfo.name.split('.').pop();
                if (types.indexOf(extension) == -1) {
                    throw new Error("fileType");
                }
            };
        }

        $(function() {
            $('[role=uploadcare-uploader][data-file-types]').each(function() {
                var input = $(this);
                var widget = uploadcare.Widget(input);
                widget.validators.push(fileTypeLimit(input.data('file-types')));
            });
        });

        widget.onUploadComplete(function(fileInfo) {
            incrementUploads();

            $.ajax({
                url: $('#event-cover').attr('action'),
                type: 'POST',
                data: { cover: $('#cover').val() },
                success: function success(response) {
                    if(response !== 'error')
                    {
                        widget.value(null);
                        $('#upload-image-btn').addClass('hide');
                        $('#img-cover').attr("src",'{{route('home')}}/' + response + "?no-cache=" + $.now());
                    }
                },
                error: function error(response) {
                    console.log(response);
                }
            });
        });

        $(document).on('click', '.uploadcare-panel-footer .uploadcare-dialog-preview-back, .uploadcare-dialog-close', function () {
            incrementUploads();
        });

        function incrementUploads() {
            $.ajax({
                url: '{{route('ucare.increment')}}',
                type: 'POST',
                data: { avatar: $('#avatar').val() },
                success: function success(response) {
                    //
                },
            });
        }
</script>

@endsection