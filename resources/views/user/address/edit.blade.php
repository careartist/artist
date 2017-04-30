@extends('layout.master')

@section('head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    
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
                            <li>Edit Address</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('content')
        <div class="box">
            <form class="form-horizontal" role="form" method="post" action="{{ route('user.address.update') }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="region" class="control-label">Region</label>
                    <select id="region" class="form-control" name="region" >
                        <option value="">Region</option>

                        @foreach($regions as $region)
                        <option value="{{$region->id}}"@if($region->id == $address->region_id)selected="selected"@endif>{{$region->place}}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group" id="places">
                    <label for="place" class="control-label">City</label>
                    <select name="place" id="place" class="form-control selectpicker" data-live-search="true">
                        <option value="">Select</option>
                        <?php $last_id = 0; ?>
                        @foreach($places as $place)
                        @if($place->p_id != $last_id)

                        <optgroup label="{{ $place->p_loc }}"></optgroup>');
                        <?php $last_id = $place->p_id ?>
                        @endif

                        <option value="{{$place->id}}"@if($place->id == $address->place_id)selected="selected"@endif>{{$place->place}}</option>

                        @endforeach
                    </select>
                </div>

                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address" class="control-label">Address</label>
                    <textarea id="address" class="form-control" name="address"  autofocus>{{ $address->address }}{{ old('address') }}</textarea>
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
@endsection

@section('script')

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

    <script>
        $('#region').on('change', function (e) 
        {
            var region_id = e.target.value;
            if(region_id != '')
            {
                $('#place').html('');
                $('#place').append('<option value="">Select</option>');
                                        
                $.get('{{ route('home') }}/user/ajax-places/' + region_id, function (data) 
                {
                    var last_id = 0;
                    $.each(data, function (index, cityObj) 
                    {
                        if(cityObj.p_id != last_id)
                        {
                            $('#place').append('<optgroup label="'+ cityObj.p_place +'"></optgroup>');
                            last_id = cityObj.p_id;
                        }
                        $('#place').append('<option data-tokens="'+cityObj.place+'" value="'+cityObj.id+'">'+cityObj.place+'</option>');
                    });
                    $('.selectpicker').selectpicker('refresh');
                });
            }
        });
    </script>

@endsection