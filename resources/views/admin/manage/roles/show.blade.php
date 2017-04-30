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
                        <h4>Role: {{ ucfirst(trans($role)) }}</h4>
                        <hr>
                            <div class="row">
                            @foreach($users as $user)
                                <div class="col-md-12">
                                    <span>
                                        <a href="{{ route('users.show', ['user' => $user->id]) }}"> {{ $user->profile->screen_name }}</a>
                                    </span>
                                    <span class="pull-right">
                                        <a href="{{ route('user.roles', ['user' => $user->id]) }}" class="btn btn-xs btn-primary">All roles</a>
                                    </span>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection