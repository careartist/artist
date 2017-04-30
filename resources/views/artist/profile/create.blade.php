@extends('layout.master')

@section('head')
@endsection

@section('breadcrumbs')

        <div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>{{ Sentinel::getUser()->profile->screen_name }}</h1>
                    </div>
                    <div class="col-md-5">
                        <ul class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('user.profile') }}">{{ Sentinel::getUser()->profile->screen_name }}</a></li>
                            <li><a href="{{ route('artist.profile') }}">{{ Sentinel::getUser()->profile->artist_profile->legal_name }}</a></li>
                            <li>Add Artist Bio</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('content')
        <div class="box">
            <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>

            <hr>

            <form action="{{ route('artist.profile.store') }}" method="post">
            	{{ csrf_field() }}

                <div class="col-md-12">
                    <label for="bio" class="col-md-3 control-label">Bio</label>

                    <div class="col-md-9 form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
                        <textarea id="bio" rows="5" class="form-control" name="bio" required autofocus>{{ old('bio') }}</textarea>

                        @if ($errors->has('bio'))
                            <span class="help-block">
                                <strong>{{ $errors->first('bio') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="tags" class="col-md-3 control-label">Tags</label>

                    <div class="col-md-9 form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" name="tags" id="tags" placeholder="Tags" value="{{ old('tags') }}" required>

                        @if ($errors->has('tags'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tags') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="subdomain" class="col-md-3 control-label">Subdomain Name</label>

                    <div class="col-md-9 form-group{{ $errors->has('subdomain') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" name="subdomain" id="subdomain" placeholder="Your Subdomein Name" value="{{ old('subdomain') }}" required>

                        @if ($errors->has('subdomain'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subdomain') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i> Add Bio</button>
                </div>
            </form>
        </div>
@endsection

@section('scripts')
@endsection