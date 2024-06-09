<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FF - Dashboard</title>
    <link href="{{ asset('css/css_Admin/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/css_Admin/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/css_Admin/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/css_Admin/styles.css') }}" rel="stylesheet">

    {{-- <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    <title>@yield('title', config('app.name'))</title>
    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><span>FF</span>Admin</a>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <em class="fa fa-envelope"></em><span class="label label-danger">15</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <em class="fa fa-bell"></em><span class="label label-info">5</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="profile-sidebar">
                <div class="profile-userpic">
                    <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
                </div>
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">Username</div>
                    <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="divider"></div>
            <form role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" style="border-radius: 20px">
                </div>
            </form>
            <ul class="nav menu">
                <li class=""><a href="{{{route('admin.categories.index')}}}"><em class="fa fa-dashboard">&nbsp;</em>
                        Category</a></li>
                <li  class=""><a href="{{{route('admin.brands.index')}}}"><em class="fa fa-calendar">&nbsp;</em> Brand</a></li>
                <li  class=""><a href="{{{route('admin.products.index')}}}"><em class="fa fa-bar-chart">&nbsp;</em> Product</a>
                </li>
                <li  class=""><a href="elements.html"><em class="fa fa-toggle-off">&nbsp;</em> Warehouse</a></li>
                <li  class=""><a href="panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>
                <li  class=""><a href="login.html"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
            </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <h1>@yield('title')</h1>
            <div class="row">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- Include JS files -->
    <script src="{{ asset('js/jsAdmin/app.js') }}"></script>
    <script src="{{ asset('js/jsAdmin/bootstrap.js') }}"></script>
</body>

</html>
