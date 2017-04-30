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
                            Address
                            <span class="pull-right">
                                <a href="{{ route('user.address.edit') }}" class="btn btn-xs btn-primary">
                                    Edit address
                                </a>
                            </span>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            {{ $address->region->place }}
                        </div>
                        <div class="col-md-12">
                            {{ $address->place->place }}
                        </div>
                        <div class="col-md-12">
                            {{ $address->address }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection