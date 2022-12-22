<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">

        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu"></i>
            </a>
            <a href="{{ url('/dashboard') }}">
                <img class="img-fluid" src="{{ asset('src/icon/logicon.png') }}" style="width: 150px;">
            </a>
            <a class="mobile-options">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-right">
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('src/icon/avatar.jpg') }}" class="img-radius" alt="User-Profile-Image">
                            <span>{{ Auth::User()->name }}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li><a href="{{ route('logout') }}"><i class="feather icon-log-out"></i> Logout</a></li>
                        </ul>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>