@extends('layout.master')

@section('head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Address</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" action="{{ route('admin.address.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="region" class="col-md-4 control-label">Region</label>
                            <div class="col-md-6">
                                <select id="region" class="form-control" name="region" >
                                    <option value="">Region</option>

                                    @foreach($regions as $region)
                                    <option value="{{$region->id}}">{{$region->place}}</option>
                                    @endforeach

                                </select>

                                @if ($errors->has('region'))

                                    <span class="help-block">
                                        <strong>{{ $errors->first('region') }}</strong>
                                    </span>

                                @endif
                                
                            </div>
                        </div>

                        <div class="form-group hide" id="places">
                            <label for="place" class="col-md-4 control-label">place</label>

                            <div class="col-md-6">

                                <select name="place" id="place" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Select</option>
                                </select>
                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <textarea id="address" class="form-control" name="address"  autofocus>{{ old('address') }}</textarea>

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
                                    Add Address
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
            $('#places').removeClass('hide');
            var region_id = e.target.value;
            if(region_id != '')
            {
                $('#place').html('');
                $('#place').append('<option value="">Select</option>');
                                        
                $.get('{{ route('home') }}/user/ajax-places/' + region_id, function (data) 
                {
                    var last_id = 0;
                    $.each(data, function (index, placeObj) 
                    {
                        if(placeObj.p_id != last_id)
                        {
                            $('#place').append('<optgroup label="'+ placeObj.p_place +'"></optgroup>');
                            last_id = placeObj.p_id;
                        }
                        $('#place').append('<option data-tokens="'+placeObj.place+'" value="'+placeObj.id+'">'+placeObj.place+'</option>');
                    });
                    $('.selectpicker').selectpicker('refresh');
                });
            }
        });
    </script>

@endsection