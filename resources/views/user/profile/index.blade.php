@extends('layout.master')

@section('head')
@endsection

@section('breadcrumbs')
        <div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>User Profile</h1>
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
        <div class="col-md-8 col-md-offset-2">
            <div class="box">
                <div class="row">
                    <div class="col-md-4">
                        <img id="img-avatar" src="@if($user->profile->avatar) {{route('home')}}/{{ $user->profile->avatar }} @else https://placeholdit.imgix.net/~text?txtsize=33&txt=150%C3%97150&w=150&h=150 @endif" class="thumbnail img-responsive">
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
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                Profile
                                <span class="pull-right">
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
                                    @else
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{ $user->profile->artist_profile->cui_number }}
                                        </div>
                                        <div class="col-md-12">
                                            {{ $user->profile->artist_profile->legal_name }}
                                        </div>
                                        <div class="col-md-12">
                                            {{ $user->profile->artist_profile->authority }}
                                        </div>
                                        @if($user->profile->artist_profile->artist_bio)
                                            <div class="col-md-12">
                                                <a href="http://{{ $user->profile->artist_profile->artist_bio->subdomain }}.{{ config('app.domain_name') }}" target="_blank">{{ $user->profile->artist_profile->artist_bio->subdomain }}.{{ config('app.domain_name') }}</a>
                                            </div>
                                        @else
                                            <div class="col-md-12">
                                                <a href="{{ route('artist.index') }}" class="btn btn-xs btn-primary">
                                                    Add Artist Bio
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    @endif
                                @else
                                    @if($user->profile->account_type == 'uap' || $user->profile->account_type == 'artist')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="pull-right">
                                                <a href="{{ route('user.request.role.create') }}" class="btn btn-xs btn-primary">Request Artist Role</a>
                                            </span>
                                        </div>
                                    </div>
                                    @else
                                    <div class="row">
                                        <div class="col-md-12">
                                            request buyer/bidder role
                                        </div>
                                    </div>
                                    @endif
                                @endif
                                </span>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <a href="{{ route('user.profile.edit') }}" class="btn btn-xs btn-primary btn-block">
                                        Edit profile
                                    </a>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    {{ $user->profile->screen_name }}
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
                                <div class="col-md-12">
                                    {{ $user->profile->first_name }} {{ $user->profile->last_name }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <a href="{{ route('user.address.edit') }}" class="btn btn-xs btn-primary btn-block">
                                        Edit address
                                    </a>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    {{ $user->profile->address->region->place }}
                                </div>
                                <div class="col-md-12">
                                    {{ $user->profile->address->place->place }}
                                </div>
                                <div class="col-md-12">
                                    {{ $user->profile->address->address }}
                                </div>
                            </div>
                        </div>
                    </div>                    
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

        $(document).on('click', '.uploadcare-panel-footer .uploadcare-dialog-preview-back, .uploadcare-dialog-close', function () {
            incrementUploads();
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