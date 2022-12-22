<div id="header" class="header navbar-default">
    <!-- begin navbar-header -->
    <div class="navbar-header">
        <a href="{{ url('/admins') }}" class="navbar-brand">
        <img class="img-fluid" src="{{ asset('src/icon/logicon.png') }}">
    </a>
    </div>
    <!-- end navbar-header --><!-- begin header-nav -->
    <ul class="navbar-nav navbar-right">
        <li class="navbar-form">
            <form action="" method="POST" name="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter keyword" />
                    <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </li>
        <li class="dropdown navbar-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('src/admin/icon/avatar.jpg') }}" alt="" /> 
                <span class="d-none d-md-inline">{{ Auth::user()->username }}</span> <b class="caret"></b>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="javascript:;" class="dropdown-item">Edit Profile</a>
                <div class="dropdown-divider"></div>
                <a href="javascript:;" class="dropdown-item">Log Out</a>
            </div>
        </li>
    </ul>
    <!-- end header-nav -->
</div>