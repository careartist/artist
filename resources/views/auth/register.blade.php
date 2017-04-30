@extends('layout.master')

@section('head')
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
                            <li><a href="{{ route('home') }}">Home</a>
                            </li>
                            <li>New account</li>
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

            <form action="{{ route('auth.register') }}" method="post">
                {{ csrf_field() }}
                
                {{ Form::bsSelect('account_type', ['utilizator' => 'Utilizator', 'uap' => 'Artist - Membru UAP', 'artist' => 'Artist'], null, ['placeholder' => 'Select']) }}

                {{ Form::bsText('screen_name', null, ['placeholder' => 'Screen Name']) }}

                {{ Form::bsText('first_name', null, ['placeholder' => 'First Name']) }}
                    
                {{ Form::bsText('last_name', null, ['placeholder' => 'Last Name']) }}

                {{ Form::bsText('phone_number', null, ['placeholder' => 'Phone Number']) }}

                <hr>
                {{ Form::bsEmail('email', null, ['placeholder' => 'Your Email address']) }}

                {{ Form::bsPassword('password', ['placeholder' => 'Your Password']) }}

                {{ Form::bsPassword('password_confirmation', ['placeholder' => 'Password Confirm']) }}

                <div class="text-center">
                    <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i> Register</button>
                </div>
            </form>
        </div>
@endsection

@section('scripts')
@endsection