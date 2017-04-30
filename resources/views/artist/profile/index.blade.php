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
                            Artist Profile
                            <hr>
                        </div>
                        <div class="col-md-4">
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
                        <div class="col-md-4">
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
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    {{ $user->profile->address->region->place }}
                                </div>
                                <div class="col-md-12">
                                    {{ $user->profile->address->place->place }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    {{ $user->profile->artist_profile->uap_number }}
                                </div>
                                <div class="col-md-12">
                                    {{ $user->profile->artist_profile->legal_name }}
                                </div>
                                <div class="col-md-12">
                                    {{ $user->profile->artist_profile->authority }}
                                </div>
                                <div class="col-md-12">
                                    <a href="http://{{ $user->profile->artist_profile->artist_bio->subdomain }}.{{ config('app.domain_name') }}" target="_blank">{{ $user->profile->artist_profile->artist_bio->subdomain }}.{{ config('app.domain_name') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                                Artist Bio
                                <span class="pull-right">
                                    <a href="{{ route('artist.profile.edit') }}" class="btn btn-xs btn-primary">
                                        Edit Bio
                                    </a>
                                </span>
                            <hr>
                        </div>
                        <div class="col-md-12">
                        	{{ $user->profile->artist_profile->artist_bio->bio }}
                        </div>
                    </div>

                    @if(count($user->profile->artist_profile->artist_events) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            Artist Events
                            <span class="pull-right">
                                <a href="{{ route('events.create') }}" class="btn btn-xs btn-primary">Add Event</a>
                            </span>
                        </div>
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
                                <hr>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
@endsection

@section('script')
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

    <script charset="utf-8" src="https://ucarecdn.com/libs/widget/2.10.3/uploadcare.full.min.js"></script>

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
                url: $('#user-avatar').attr('action'),
                type: 'POST',
                data: { avatar: $('#avatar').val() },
                success: function success(response) {
                    if(response !== 'error')
                    {
                        widget.value(null);
                        $('#upload-image-btn').addClass('hide');
                        $('#img-avatar').attr("src",'{{route('home')}}/' + response + "?no-cache=" + $.now());
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