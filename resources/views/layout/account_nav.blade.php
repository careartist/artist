        <header>

            <!-- *** TOP ***
_________________________________________________________ -->
<div id="top">
    <div class="container">
        <div class="row">
            <div class="col-xs-5 contact">
                <p class="hidden-sm hidden-xs">Contact us on +420 777 555 333 or hello@universal.com.</p>
                <p class="hidden-md hidden-lg"><a href="#" data-animate-hover="pulse"><i class="fa fa-phone"></i></a>  <a href="#" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                </p>
            </div>
            <div class="col-xs-7">
                <!-- <div class="social"> -->
                    <!-- <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a> -->
                    <!-- <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a> -->
                    <!-- <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a> -->
                    <!-- <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a> -->
                <!-- </div> -->

                <div class="login">
                    @if(Sentinel::check())
                    <ul class="nav navbar-right">
                        <li>
                            <a href="{{ route('user.profile') }}">{{ Sentinel::getUser()->profile->screen_name }}</a>
                        </li>
                        <li>
                            <a href="{{ route('auth.logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout 
                            </a>
                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                    @else
                    <a href="{{ route('auth.login') }}"><i class="fa fa-sign-in"></i> <span class="hidden-xs text-uppercase">Sign in</span></a>
                    <a href="{{ route('auth.register') }}"><i class="fa fa-user"></i> <span class="hidden-xs text-uppercase">Sign up</span></a>
                    <!-- <a href="#" data-toggle="modal" data-target="#login-modal"><i class="fa fa-sign-in"></i> <span class="hidden-xs text-uppercase">Sign in</span></a> -->
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

            <!-- *** TOP END *** -->

            <!-- *** NAVBAR ***
    _________________________________________________________ -->

            <!-- *** NAVBAR END *** -->

        </header>
