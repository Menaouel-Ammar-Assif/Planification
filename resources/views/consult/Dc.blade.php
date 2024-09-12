<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/logo.png')}}">
    <title>Système de Planification</title>
    <!-- This page css -->

    <link rel="stylesheet" href="{{asset('/dist/css/bootstrap.min.css')}}"> <!-- Bootstrap style -->

    <!-- Custom CSS -->    
    <link href="../dist/css/all.min.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<style>
        .balls {
    width: 2.5em;
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
    justify-content: space-between;
    }

    .balls div {
    width: 0.8em;
    height: 0.8em;
    border-radius: 50%;
    background-color: #fc2f70;
    transform: translateY(-100%);
    animation: wave 0.8s ease-in-out alternate infinite;
    }

    .balls div:nth-of-type(1) {
    animation-delay: -0.4s;
    }

    .balls div:nth-of-type(2) {
    animation-delay: -0.2s;
    }

    @keyframes wave {
    from {
        transform: translateY(-100%);
    }
    to {
        transform: translateY(100%);
    }
    }


    .animate-charcter
    {
    text-transform: uppercase;
    background-image: linear-gradient(
        -225deg,
        #231557 0%,
        #44107a 29%,
        #ff1361 67%,
        #fff800 100%
    );
    background-size: auto auto;
    background-clip: border-box;
    background-size: 200% auto;
    color: #fff;
    background-clip: text;
    text-fill-color: transparent;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: textclip 2s linear infinite;
    display: inline-block;
        font-size: 20px;
    }

    @keyframes textclip {
    to {
        background-position: 200% center;
    }
    }

</style>
<body>

    <?php
    use Carbon\Carbon;

    ?>
    
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-lg">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand justify-content-center">
                        <!-- Logo icon -->
                        <a class="d-flex align-items-center " href="{{ route('directeur.dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left me-auto ms-3 ps-1">
                        <!-- Notification -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)"
                                id="bell" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span><i data-feather="bell" class="svg-icon"></i></span>
                                <span class="badge text-bg-primary notify-no rounded-circle">0</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                                <ul class="list-style-none">
                                    <li>
                                        {{-- <div class="message-center notifications position-relative">
                                            <!-- Message -->
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <div class="btn btn-danger rounded-circle btn-circle"><i
                                                        data-feather="airplay" class="text-white"></i></div>
                                                <div class="w-75 d-inline-block v-middle ps-2">
                                                    <h6 class="message-title mb-0 mt-1">Luanch Admin</h6>
                                                    <span class="font-12 text-nowrap d-block text-muted">Just see
                                                        the my new
                                                        admin!</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-success text-white rounded-circle btn-circle"><i
                                                        data-feather="calendar" class="text-white"></i></span>
                                                <div class="w-75 d-inline-block v-middle ps-2">
                                                    <h6 class="message-title mb-0 mt-1">Event today</h6>
                                                    <span
                                                        class="font-12 text-nowrap d-block text-muted text-truncate">Just
                                                        a reminder that you have event</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:10 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-info rounded-circle btn-circle"><i
                                                        data-feather="settings" class="text-white"></i></span>
                                                <div class="w-75 d-inline-block v-middle ps-2">
                                                    <h6 class="message-title mb-0 mt-1">Settings</h6>
                                                    <span
                                                        class="font-12 text-nowrap d-block text-muted text-truncate">You
                                                        can customize this template
                                                        as you want</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:08 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-primary rounded-circle btn-circle"><i
                                                        data-feather="box" class="text-white"></i></span>
                                                <div class="w-75 d-inline-block v-middle ps-2">
                                                    <h6 class="message-title mb-0 mt-1">Pavan kumar</h6> <span
                                                        class="font-12 text-nowrap d-block text-muted">Just
                                                        see the my admin!</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span>
                                                </div>
                                            </a>
                                        </div> --}}
                                    </li>
                                    <li>
                                        <a class="nav-link pt-3 text-center text-dark" href="javascript:void(0);">
                                            <strong>Check all notifications</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Notification -->
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->

                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-end">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!-- <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <form>
                                    <div class="customize-input">
                                        <input class="form-control custom-shadow custom-radius border-0 bg-white"
                                            type="search" placeholder="Search" aria-label="Search">
                                        <i class="form-control-icon" data-feather="search"></i>
                                    </div>
                                </form>
                            </a>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="../assets/images/users/user__.png" alt="user" class="rounded-circle"
                                    width="40">
                                <span class="ms-2 d-none d-lg-inline-block"><span></span> <span
                                        class="text-dark">Directeur général.</span> <i data-feather="chevron-down"
                                        class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href="{{route('profile.edit')}}"><i data-feather="user"
                                        class="svg-icon me-2 ms-1"></i>
                                    Profile
                                </a>


                                <div class="dropdown-divider"></div>
                                {{-- <a class="dropdown-item" href="javascript:void(0)"><i data-feather="power"
                                        class="svg-icon me-2 ms-1"></i>
                                    Logout
                                </a> --}}

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i data-feather="power" class="svg-icon me-2 ms-1"></i>
                                    Se déconnecter
                                </a>
                            
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('consult.dashboard') }}"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li class="list-divider"></li>

                        <li class="nav-small-cap"><span class="hide-menu">Les Directions</span></li>

                        <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link" href="{{ route('direction.centrale') }}" aria-expanded="false"><i data-feather="tag" class="feather-icon"></i>
                                <span
                                    class="hide-menu">Directions Centrales
                                </span>
                            </a>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('direction.regionale') }}"
                            aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                class="hide-menu">Directions Régionales
                            </span></a>
                        </li>
                        
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <!-- <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Centre National de la Foramtion Douaniere</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Apps</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Ticket List</li>
                                </ol>
                            </nav>
                        </div>
                    </div> -->
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-start">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected>
                                    {{-- {{$direction}} --}}
                                    
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Column -->
                                        
                                        <div class="col-md-8 col-lg-4">
                                            {{-- <div class="card">
                                                <div class="card-body">
                                                    <div class="row justify-content-between position-relative">
                                                        <div class="col-5 m-0 p-0" style="z-index: 1;">
                                                            <div class="rounded-pill border border-3 border-success p-1 text-center">
                                                                <h3 class="font-light text-dark-100" style="margin-bottom: 1px;">01 - 2022</h3>
                                                                <h6 class="text-body-secondary">Date début</h6>
                                                            </div>
                                                        </div>
                                                
                                                        <div class="col-2 m-0 p-0"> 
                                                            <div class="p-0 m-0 position-absolute top-50 start-50 translate-middle" style="width: inherit; height: 7%; background: linear-gradient(to right, #22ca80, #ff4f70);">
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="col-5 m-0 p-0" style="z-index: 1;">
                                                            <div class="rounded-pill border border-3 border-danger p-1 text-center">
                                                                <h3 class="font-light text-dark-100" style="margin-bottom: 1px;">12 - 2024</h3> 
                                                                <h6 class="text-body-secondary">Date fin</h6>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='d-flex'>
                                                        <div class="mt-3 me-2"><H3 class="animate-charcter">Action en cours</H3> </div>
                                                        <!-- <div class="balls">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div> -->

                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    <!-- Column -->
                                    {{-- <div class="col-lg-4 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Temps écoulé</h4>
                                                <div class="text-center">
                                                    <input data-plugin="knob" data-width="150" data-height="150" data-linecap=round
                                                        data-fgColor="#db4d4d" value="67a" data-skin="tron" data-angleOffset="180"
                                                        data-readOnly=true data-thickness=".1" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Avencement</h4>
                                                <div class="text-center">
                                                    <input data-plugin="knob" data-width="150" data-height="150" data-linecap=round
                                                        data-fgColor="#4dce5b" value="90" data-skin="tron" data-angleOffset="180"
                                                        data-readOnly=true data-thickness=".2" />
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <!-- Column -->
                                </div>
                                
                                {{-- <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">List Directions Régionales</h4>
                                        <div class="row">
                                            <div class="col-4">
                                                <div id="list-example" class="list-group">
                                                    @foreach ($dc as $direction)
                                                            <a class="list-group-item list-group-item-action" href="{{$direction->id_dir}}">{{$direction->lib_dir}}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="position-relative p-3 border overflow-auto" style="height: 200px" data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" tabindex="0">
                                                    @foreach ($dc as $direction)
                                                            <h4 id="{{$direction->id_dir}}">{{$direction->lib_dir}}</h4>
                                                            <p>
                                                                Ex consequat commodo adipisicing exercitation aute
                                                                excepteur occaecat ullamco duis aliqua id magna
                                                                ullamco eu. Do aute ipsum ipsum ullamco cillum
                                                                consectetur ut et aute consectetur labore. Fugiat
                                                                laborum incididunt tempor eu consequat enim dolore
                                                                proident. Qui laborum do non excepteur nulla magna
                                                                eiusmod consectetur in. Aliqua et aliqua officia
                                                                quis et incididunt voluptate non anim reprehenderit
                                                                adipisicing dolore ut consequat deserunt mollit
                                                                dolore. Aliquip nulla enim veniam non fugiat id
                                                                cupidatat nulla elit cupidatat commodo velit ut
                                                                eiusmod cupidatat elit dolore.
                                                            </p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}



                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Liste Directions Centrales</h4>
                                        <div class="row">
                                            
                                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                                
                                                @foreach($dc as $direction)
                                                    
                                                        <div class="accordion-item mb-1">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{$direction->id_dir}}" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                                    {{$direction->code}} - {{$direction->lib_dir}}
                                                                </button>
                                                            </h2>
                                                            <div id="{{$direction->id_dir}}" class="accordion-collapse collapse">
                                                                <div class="accordion-body">
                                                                    <button type="button" style="float: inline-end;" class="btn btn-info mb-3 p-1"
                                                                            data-bs-toggle="popover" data-bs-placement="right"
                                                                            data-bs-custom-class="custom-popover"
                                                                            data-bs-title="Les sous-directions régionales"
                                                                            data-bs-content="
                                                                                @foreach($corre as $c)
                                                                                    @foreach($SousDirection as $s)
                                                                                        @if ($c->id_dir == $direction->id_dir)
                                                                                            @if ($c->id_sous_dir == $s->id_sous_dir)
                                                                                            - {{$s->lib_sous_dir}} 
                                                                                            @endif   
                                                                                        @endif
                                                                                    
                                                                                    @endforeach
                                                                                @endforeach 

                                                                            ">
                                                                            <i data-feather="eye" class="feather-icon ms-4 me-3"></i>

                                                                            {{-- La correspondance entre {{$direction->code}} et Les sous-directions régionales --}}
                                                                            {{-- <i data-feather="plus-circle" class="feather-icon ms-4 me-3"></i> --}}

                                                                            {{-- <i data-feather="trending-up" class="feather-icon"></i> --}}
                                                                            
                                                                    </button>











                                                                <table class="table" id="mainTable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Action</th>
                                                                                <th scope="col">Date début</th>
                                                                                <th scope="col">Date fin</th>
                                                                                <th scope="col" class="text-center">Statut</th>
                                                                                <th scope="col">Echéancier</th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        @foreach($action as $a)
                                                                            @foreach($vdaDc as $vda)
                                                                                @if ($direction->id_dir == $vda->id_dc && $vda->id_act == $a->id_act)
                                                                                    
                                                                                


                                                                                        <tbody>
                                                                                            <tr class="expandable">
                                                                                                
                                                                                                <th class="text-start" style="max-width:400px;">{{$a->lib_act}}</th>
                                                                                                <td>{{$a->dd}}</td>
                                                                                                <td>{{$a->df}}</td>
                                                                                                <td class="text-center">
                                                                                                    {{-- <i class="fa-solid fa-circle fa-xs" style="color: #09e155;"></i> --}}
                                                                                                    <i data-feather="clock" class="feather-icon text-warning"></i>
                                                                                                    <i data-feather="check-circle" class="feather-icon text-success"></i>
                                                                                                    <i data-feather="pause-circle" class="feather-icon text-danger"></i>

                                                                                                </td>
                                                                                                <td>
                                                                                                    {{-- <div class="progress">
                                                                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                                                            {{$a->dd}}-{{$a->df}}
                                                                                                        </div>
                                                                                                    </div> --}}
                                                                                                    <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 75%"></div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                    
                                                                                            
                                                                                        </tbody>



                                                                                @endif
                                                                            @endforeach
                                                                        @endforeach
                                                                </table>


                                                                














                                                                </div>
                                                            </div>
                                                        </div>
                                                @endforeach

                                                

                                            </div>


                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center text-muted">
                Système de Planification
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->



    <!-- Logout Modal-->
    {{-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Prêt à partir ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Cliquez sur « Se déconnecter » ci-dessous si vous êtes prêt à mettre fin à votre session en cours.</div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                        <button class="btn btn-primary">
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Se déconnecter') }}
                            </x-dropdown-link>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}


    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>

    {{-- <script src="{{asset('/dist/js/bootstrap.bundle.min.js')}}"></script> --}}

    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/dist/js/all.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <script src="../assets/extra-libs/knob/jquery.knob.min.js"></script>
    <script>
        $(function () {
            $('[data-plugin="knob"]').knob();
        });
    </script>
</body>

</html> 