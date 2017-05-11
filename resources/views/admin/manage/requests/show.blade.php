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
                            Role request from: 
                            <a href="{{ route('users.show', ['user' => $requests->user_id]) }}">
                                {{ $requests->user->profile->screen_name }}
                            </a>
                            <span class="pull-right">
                                <a href="{{ route('accept.request', ['request' => $requests->id]) }}" class="btn btn-xs btn-success"
                                    onclick="event.preventDefault();
                                             document.getElementById('accept-request-{{ $requests->id }}').submit();">
                                    Apply role
                                </a>
                                <form id="accept-request-{{ $requests->id }}" action="{{ route('accept.request', ['request' => $requests->id]) }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </span>
                            <hr>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{ $requests->user->profile->first_name }} {{ $requests->user->profile->last_name }}
                                        </div>
                                        <div class="col-md-12">
                                            {{ $requests->user->profile->address->region->place }}
                                        </div>
                                        <div class="col-md-12">
                                            {{ $requests->user->profile->address->place }}
                                        </div>
                                    </div>
                                    <hr>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        UAP Number: 
                                    </div>
                                    <div class="col-md-6">
                                        {{ $requests->artist_profile->uap_number }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        Legal Name:
                                    </div>
                                    <div class="col-md-6">
                                        {{ $requests->artist_profile->legal_name }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        Authority:
                                    </div>
                                    <div class="col-md-6">
                                        {{ $requests->artist_profile->authority }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        Phone Number:
                                    </div>
                                    <div class="col-md-6">
                                        {{ $requests->artist_profile->phone_number }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <span class="pull-right">
                                        <a href="{{ route('reject.request', ['request' => $requests->id]) }}" class="btn btn-xs btn-danger"
                                            onclick="event.preventDefault();
                                                     document.getElementById('reject-request-{{ $requests->id }}').submit();">
                                            Reject request
                                        </a>
                                        <form id="reject-request-{{ $requests->id }}" action="{{ route('reject.request', ['request' => $requests->id]) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection