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
                    <form class="form-horizontal" role="form" method="post" action="{{ route('user.address.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                            <label for="region" class="control-label">Region</label>
                            <select id="region" class="form-control" name="region" >
                                <option value="">Region</option>

                                @foreach($regions as $region)
                                <option value="{{$region->id}}" @if(old('region') == $region->id)selected="selected"@endif>{{$region->place}}</option>
                                @endforeach

                            </select>

                            @if ($errors->has('region'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('region') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
                            <label for="place" class="control-label">place</label>
                            <input type="text" name="place" class="form-control" value="{{ old('place') }}" placeholder="Place..." required autofocus>

                            @if ($errors->has('place'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('place') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="control-label">Address</label>
                            <textarea id="address" class="form-control" name="address" required>{{ old('address') }}</textarea>

                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Address
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('script')
@endsection