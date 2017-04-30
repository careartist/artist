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
                    @if(count($requests) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <ul>
                            @foreach($requests as $request)
                                <li>
                                    <a href="{{ route('users.show', ['user' => $request->user->id]) }}">
                                        {{ $request->user->profile->screen_name }}
                                    </a>

                                    <span class="pull-right">
                                        <a href="{{ route('requests.show', ['request' => $request->id]) }}">
                                            See Request
                                        </a>
                                    </span>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            no requests
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection