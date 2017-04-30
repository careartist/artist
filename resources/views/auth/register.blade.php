@extends('layout.auth')

@section('head')
@endsection

@section('content')

        <div class="col-md-10 col-md-offset-1">
            <div class="card card-signup">
                <h2 class="card-title text-center">Register</h2>
                <div class="row">
                    <div class="col-md-5 col-md-offset-1">
                        <div class="info info-horizontal">
                            <div class="icon icon-rose">
                                <i class="material-icons">timeline</i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Marketing</h4>
                                <p class="description">
                                    We've created the marketing campaign of the website. It was a very interesting collaboration.
                                </p>
                            </div>
                        </div>

                        <div class="info info-horizontal">
                            <div class="icon icon-primary">
                                <i class="material-icons">code</i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Fully Coded in HTML5</h4>
                                <p class="description">
                                    We've developed the website with HTML5 and CSS3. The client has access to the code using GitHub.
                                </p>
                            </div>
                        </div>

                        <div class="info info-horizontal">
                            <div class="icon icon-info">
                                <i class="material-icons">group</i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Built Audience</h4>
                                <p class="description">
                                    There is also a Fully Customizable CMS Admin Dashboard for this product.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">

                        <form action="{{ route('auth.register') }}" method="post">
                            <div class="card-content">
                                {{ csrf_field() }}

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">assignment_ind</i>
                                    </span>
                                    <select class="form-control" name="account_type">
                                        <option value="">Selecteaza Tip Cont...</option>
                                        <option value="utilizator">Utilizator</option>
                                        <option value="uap">Artist - Membru UAP</option>
                                        <option value="artist">Artist</option>
                                    </select>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">fingerprint</i>
                                    </span>
                                    <input type="text" name="screen_name" class="form-control" placeholder="Screen Name...">
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">perm_identity</i>
                                    </span>
                                    <input type="text" name="first_name" class="form-control" placeholder="First Name...">
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">perm_identity</i>
                                    </span>
                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name...">
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">phone_android</i>
                                    </span>
                                    <input type="text" name="phone_number" class="form-control" placeholder="Phone Number...">
                                </div>

                                <hr>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">email</i>
                                    </span>
                                    <input type="text" name="email" class="form-control" placeholder="Email...">
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                    <input type="password" name="password" placeholder="Password..." class="form-control" />
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                    <input type="password" name="password_confirmation" placeholder="Password Confirmation..." class="form-control" />
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i> Register</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

@endsection

@section('scripts')
@endsection