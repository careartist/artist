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
                    <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>

                    <hr>


                    {{ Form::model($profile, ['route' => ['artist.profile.update']]) }}

                    	{{ csrf_field() }}
                        {{ method_field('PUT') }}

                        {{ Form::bsTextarea('bio', null, ['placeholder' => 'Artist Bio']) }}

                        <div class="text-center">
                            <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i> Edit Bio</button>
                        </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection