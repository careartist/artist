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
                    <form class="form-horizontal" role="form" method="post" action="{{ route('address.update', ['address' => $address->id]) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                            <label for="region" class="control-label">Region</label>
                            <select name="region" id="region" class="form-control" required>
                                <option value="">Region</option>

                                @foreach($regions as $region)
                                <option value="{{$region->id}}"@if($region->id == $address->region_id)selected="selected"@endif>{{$region->place}}</option>
                                @endforeach

                            </select>

                            @if ($errors->has('region'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('region') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                        <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
                            <label for="place" class="col-md-4 control-label">City</label>
                            <input type="text" 
                                    name="place" 
                                    id="place" 
                                    class="form-control" 
                                    value="@if(old('place'))
                                                {{old('place')}}
                                            @else
                                                {{$address->place}}
                                            @endif" 
                                    placeholder="Place..." required autofocus>

                                    <option value="{{$place->id}}"@if($place->id == $address->place_id)selected="selected"@endif>{{$place->place}}</option>

                                    @endforeach
                                </select>
                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>
                            <textarea id="address" class="form-control" name="address" required>{{ $address->address }}{{ old('address') }}</textarea>

                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Address
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