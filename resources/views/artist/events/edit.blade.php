@extends('layout.master')

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('breadcrumbs')
        <div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>New account</h1>
                    </div>
                    <div class="col-md-5">
                        <ul class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('events.index') }}">Events</a></li>
                            <li>Add Event</li>
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
            <form action="{{ route('events.update', ['event' => $event->id]) }}" method="post">

            	{{ csrf_field() }}
                {{ method_field('PUT') }}

                {{ Form::bsText('title', $event->title, ['placeholder' => 'Title']) }}

                <div class="form-group{{ $errors->has('event_type') ? ' has-error' : '' }}">
                    <label for="event_type" class="control-label">Event Type</label>

                    <select id="event_type" class="form-control" name="event_type" >
                        <option value="">Select</option>
                        @foreach($event_types as $type)
                        <option value="{{ $type->name }}" @if($type->name == $event->type) selected="selected"@endif>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('event_type'))
                        <span class="help-block">
                            <strong>{{ $errors->first('event_type') }}</strong>
                        </span>
                    @endif
                </div>


                {{ Form::bsTextarea('description', $event->description, ['placeholder' => 'Description']) }}

                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('start_at') ? ' has-error' : '' }}">
                        <label for="start_at" class="control-label">Start Date</label>
                        <div class="input-append date form_datetime">
                            <input type="text" class="form-control" value="@if(old('start_at')){{ old('start_at') }}@else{{$event->start_at}}@endif" name="start_at" id="start_at" readonly>
                            <span class="pull-right">
	                            <span class="add-on"><i class="fa fa-times" aria-hidden="true"></i></span>
	                            <span class="add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </span>
                        </div>
                        @if ($errors->has('start_at'))
                            <span class="help-block">
                                <strong>{{ $errors->first('start_at') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('end_at') ? ' has-error' : '' }}">
                        <label for="end_at" class="control-label">End Date</label>
                        <div class="input-append date form_datetime">
                            <input type="text" class="form-control" value="@if(old('end_at')){{ old('end_at') }}@else{{$event->end_at}}@endif" name="end_at" id="end_at" readonly>
                            <span class="pull-right">
	                            <span class="add-on"><i class="fa fa-times" aria-hidden="true"></i></span>
	                            <span class="add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </span>
                        </div>
                        @if ($errors->has('end_at'))
                            <span class="help-block">
                                <strong>{{ $errors->first('end_at') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('event_price') ? ' has-error' : '' }}">
                    <label for="event_price" class="control-label">Event Price</label>
                    <select id="event_price" class="form-control" name="event_price" >
                        <option value="">Select</option>
                        <option value="free"@if($event->price == 'free') selected="selected"@endif>Free</option>
                        <option value="paid"@if($event->price == 'paid') selected="selected"@endif>Paid</option>
                    </select>
                    @if ($errors->has('event_price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('event_price') }}</strong>
                        </span>
                    @endif
                </div>

                {{ Form::bsText('contact_name', $event->contact_name, ['placeholder' => 'Contact Name']) }}

                {{ Form::bsText('contact_email', $event->contact_email, ['placeholder' => 'Contact Email']) }}

                {{ Form::bsText('contact_phone', $event->contact_phone, ['placeholder' => 'Contact Phone Number']) }}

                <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                    <label for="tags" class="control-label">Tags</label>
                    <select class="js-tags form-control" name="tags[]" id="tags" multiple="multiple">
                    @foreach($tags as $tag)
                        <option value="{{$tag->name}}">{{ $tag->name }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i> Edit Event</button>
                </div>
            </form>
        </div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/select2.full.min.js') }}"></script>

<script>
    $(".js-tags").select2({
      tags: true,
      tokenSeparators: [',', ' '],
      placeholder: 'Select or type your tags'
    }).val([@foreach($event->tags as $tag)"{{$tag->name}}"@if(!$loop->last),@endif @endforeach]).trigger('change');
</script>

<script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
<script>

    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        minuteStep: 10,
        pickerPosition: "bottom-left"
    });

    var start_at = $('#start_at');

    $('#end_at').on('change', function(ev){
            if ($('#end_at').val() < $('#start_at').val()){
                $('#end_at').val('');
            }
        });
</script>

@endsection