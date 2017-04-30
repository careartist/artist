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
                    <p class="text-muted">If you have any questions, please feel free to contact us, our customer service center is working for you 24/7.</p>

                    <hr>

                    {{ Form::open(['route' => 'user.request.role.store']) }}

                        {{ Form::bsText('cui_number', null, ['placeholder' => 'CUI Number', 'required' => 'required', 'autofocus' => 'autofocus']) }}

                        {{ Form::bsText('legal_name', null, ['placeholder' => 'Legal Name', 'required' => 'required']) }}
                            
                        {{ Form::bsText('authority', null, ['placeholder' => 'Authority', 'required' => 'required']) }}

                        <hr>
                        <div class="text-center">
                            <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i> Request Artist Role</button>
                        </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection