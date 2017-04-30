@extends('layout.account')

@section('head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    
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

                        <div class="form-group">
                            <label for="region" class="col-md-4 control-label">Region</label>
                            <div class="col-md-6">
                                <select id="region" class="form-control" name="region" >
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
                        </div>

                        <div class="form-group" id="places">
                            <label for="place" class="col-md-4 control-label">City</label>

                            <div class="col-md-6">

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
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <textarea id="address" class="form-control" name="address"  autofocus>{{ $address->address }}{{ old('address') }}</textarea>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
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