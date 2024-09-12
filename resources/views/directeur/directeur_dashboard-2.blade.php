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
    <title >Système de Planification</title>

    <!-- This page css -->
    <link href="../dist/css/style.min.css" rel="stylesheet">

    <link href="../assets/libs/morris.js/morris.css" rel="stylesheet">
</head>
<style>
        .balls {
    width: 1em;
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
    justify-content: space-between;
    }

    .balls div {
    width: 0.7em;
    height: 0.6em;
    border-radius: 50%;
    background-color: #fc2f70;
    transform: translateY(-70%);
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
        transform: translateY(80%);
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
            font-size: 15px;
    }

    @keyframes textclip {
    to {
        background-position: 200% center;
    }
    }

    .sub-table {
    display: none;
    }

    .sub-table td input {
        width: 100%;
    }

    .animate-border{
        animation: wave 1.5s ease-in-out alternate infinite;
    }
    .animate-border h6{
        animation: colorr 1.5s ease-in-out alternate infinite;
    }

        @keyframes wave {
        from {
            background-color: rgb(255, 255, 255);
        }
        to {
            background-color: rgb(255, 241, 241);
        }}

        @keyframes colorr {
        from {
            color: rgb(253, 158, 158);
        }
        to {
            color: rgb(255, 255, 255);
        }

    }

</style>
<body>
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
            <nav class="navbar top-navbar navbar-expand-lg" style="background-color: rgba(49, 148, 175, 0.556);max-height:5px;">
                <div class="navbar-header" data-logobg="skin6" style="background-color: transparent">
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
                        
                        <li class="nav-item dropdown ms-3 mt-4">

                            <div class="card py-3 px-2 text-light rounded-pill" style="width: max-content; background-color: transparent; font-size: 18px; font-weight: bolder">
                                {{$dir}}
                            </div>

                        </li>

                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->

                    </ul>

                    <ul class="navbar-nav float-left me-3 ms-auto ps-1">
                        <!-- Notification -->
                        <li class="nav-item dropdown mt-2">
                            <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)"
                                id="bell" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span class="text-light"><i data-feather="bell" class="svg-icon"></i></span>
                                <span class="badge text-bg-primary notify-no rounded-circle">0</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                                <ul class="list-style-none">
                                    <li>
                                        <a class="nav-link pt-3 text-center text-dark" href="javascript:void(0);">
                                            <strong>Vérifiez toutes les notifications</strong>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <!-- End Notification -->
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
                                    class="text-dark">Directeur {{$code}}</span> <i data-feather="chevron-down"
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

                                <button class="dropdown-item btn" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    <i data-feather="power" class="svg-icon me-2 ms-1"></i>
                                    Se déconnecter
                                </button>

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


        <aside class="left-sidebar" data-sidebarbg="skin6" style="background-color:  rgba(49, 148, 175, 0.556)">

            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav">


                    <ul id="sidebarnav">
                        <li class="sidebar-item selected"> <a class="sidebar-link sidebar-link" href="{{ route('consult.dashboard') }}"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a>
                        </li>

                        <li class="list-divider"></li>

                        @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                        @else
                            <li class="sidebar-item">
                                <a class="sidebar-link font-weight-medium" href="{{ route('directeur.cop') }}" aria-expanded="false"><i data-feather="tag" class="feather-icon"></i>
                                <span class="hide-menu">Actions COP</span></a>
                            </li>
                        @endif

                        <li class="sidebar-item">
                            <a class="sidebar-link font-weight-medium" href="{{ route('directeur.proposition') }}" aria-expanded="false"><i data-feather="tag" class="feather-icon"></i>
                                @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                                    <span class="hide-menu">Proposer Des Actions</span>
                                @else
                                    <span class="hide-menu">Actions Ajustées</span>
                                @endif
                            </a>
                        </li>
                    </ul>







                </nav>

            </div>
        </aside>


        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="background-color: rgb(245, 245, 245)">
            {{-- <div class="page-wrapper" style="background-color: #dfe8f0"> --}}

            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">

                    @if (session()->has('success'))
                        <div class="container-fluid">
                            <div class="alert alert-success">
                                <h4>{{session()->get('success')}}</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        {{-- <div class="card"> --}}
                            {{-- <div class="card-body"> --}}
                                <div class="row">

                                        {{-- <div class="col-md-8 col-lg-4"> --}}
                                            {{-- <div class="card">
                                                <div class="card-body">
                                                    <div class="row justify-content-between position-relative">
                                                        <div class="col-5 m-0 p-0" style="z-index: 1;">
                                                            <div class="rounded-pill border border-3 border-success p-1 text-center">
                                                                <h3 class="font-light text-dark-100" style="margin-bottom: 1px;">02 - 2024</h3>
                                                                <h6 class="text-body-secondary">Date début</h6>
                                                            </div>
                                                        </div>

                                                        <div class="col-2 m-0 p-0">
                                                            <div class="p-0 m-0 position-absolute top-50 start-50 translate-middle" style="width: inherit; height: 7%; background: linear-gradient(to right, #22ca80, #ff4f70);">

                                                            </div>
                                                        </div>

                                                        <div class="col-5 m-0 p-0" style="z-index: 1;">
                                                            <div class="rounded-pill border border-3 border-danger p-1 text-center">
                                                                <h3 class="font-light text-dark-100" style="margin-bottom: 1px;">09 - 2024</h3>
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


                                            {{-- tous --}}
                                        <!-- <div class="col-md-8 col-lg-3">
                                            <div class="card border-end ">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                                                @if ($actions)
                                                                    {{count($actions)}}
                                                                @endif
                                                            </h2>
                                                            <h4 class="text-dark mb-0 w-100">Toutes les actions</h4>
                                                        </div>
                                                        <div class="ms-auto mt-md-3 mt-lg-0">
                                                            <span class="opacity-7 text-muted"><i data-feather="activity"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="col-md-8 col-lg-3">
                                            <div class="card border-end">
                                                <div class="card-body border border-dark border-2">
                                                        <div class="d-flex align-items-center">
                                                            <div id="buttonWrapper" class="clickable">
                                                                <div class="d-inline-flex align-items-center">
                                                                    <h2 class="text-dark mb-1 font-weight-medium">
                                                                        @if ($actions)
                                                                            {{count($actions)}}
                                                                        @endif
                                                                    </h2>
                                                                </div>
                                                                <h6 class="font-weight-medium mb-0 w-100 text-dark">Toutes les actions</h6>
                                                            </div>

                                                            <div class="ms-auto mt-md-3 mt-lg-0">
                                                                <span class="opacity-7 text-muted"><i data-feather="layers" class="text-dark"></i></span>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- en cours --}}
                                        <!-- <div class="col-md-8 col-lg-3">
                                            <div class="card border-end">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h2 class="text-dark mb-0 w-100 text-truncate font-weight-medium">
                                                                @if ($actions)
                                                                    {{$etatEnC}}
                                                                @endif
                                                            </h2>
                                                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">
                                                                <div class="me-2"><H3 class="animate-charcter">Actions en cours</H3> </div>
                                                            </h6>
                                                        </div>
                                                        <div class="ms-auto mt-md-3 mt-lg-0">
                                                            <span class="opacity-7 text-muted">
                                                                <div class="balls">
                                                                    <div></div>
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="col-md-8 col-lg-3">
                                            <div class="card border-end" style="background: linear-gradient(to right, #f0833ac7, #ffffff);">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div id="buttonWrapper" class="clickable">
                                                            <div class="d-inline-flex align-items-center">
                                                                <h2 class="text-dark mb-1 font-weight-medium">
                                                                    @if ($actions)
                                                                        {{$etatEnC}}
                                                                    @endif
                                                                </h2>
                                                            </div>
                                                            <h6 class="font-weight-medium mb-0 w-100 text-dark" >Actions En Cours</h6>
                                                        </div>

                                                        <div class="ms-auto mt-md-3 mt-lg-0">
                                                        <span class="opacity-7 text-muted"><i data-feather="activity" class="text-dark"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- Retardées --}}
                                        <!-- <div class="col-md-8 col-lg-3">
                                            <div class="card border-end ">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h2 class="text-dark mb-0 w-100 text-truncate font-weight-medium">
                                                                {{$etatRet}}
                                                            </h2>
                                                            <h4 class="text-dark pb-1 mb-0 w-100">Actions Retardées</h4>
                                                        </div>
                                                        <div class="ms-auto mt-md-3 mt-lg-0">
                                                            <span class="opacity-7 text-muted"><i data-feather="loader" class="text-danger"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->


                                        <div class="col-md-8 col-lg-3">
                                            <div class="card border-end " style="background: linear-gradient(to right, #f83832c7, #ffffff);">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">{{$etatRet}}</h2>
                                                            <h6 class="font-weight-medium mb-0 w-100 text-dark" >Actions Echues</h6>
                                                        </div>
                                                        <div class="ms-auto mt-md-3 mt-lg-0">
                                                            <span class="opacity-7 text-muted"><i data-feather="loader" class="text-dark"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>





                                        {{-- Terminées --}}
                                        <!-- <div class="col-md-8 col-lg-3">
                                            <div class="card border-end ">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                                                {{$etatTerm}}
                                                            </h2>
                                                            <h4 class="text-dark mb-0 w-100">Actions Terminées
                                                            </h4>
                                                        </div>
                                                        <div class="ms-auto mt-md-3 mt-lg-0">
                                                            <span class="opacity-7 text-muted"><i data-feather="check-circle" class="text-success"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="col-md-8 col-lg-3">
                                            <div class="card border-end" style="background: linear-gradient(to right, #2bff3db9, #ffffff);">
                                                <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">{{$etatTerm}}</h2>
                                                                <h6 class="font-weight-medium mb-0 w-100 text-dark" >Actions Finalisées
                                                                </h6>
                                                            </div>
                                                            <div class="ms-auto mt-md-3 mt-lg-0">
                                                                <span class="opacity-7 text-muted"><i data-feather="check-circle" class="text-dark"></i></span>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>



                                </div>
                                    {{-- </div> --}}
                                {{-- </div> --}}


                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-8 col-lg-5">
                                        <div class="card rounded-pill border-end animate-border">
                                            <div class="card-body ">
                                                <div class="d-flex align-items-center">
                                                    <div class="">
                                                        <h4 class="text-dark d-flex mb-1 w-100 text-truncate font-weight-medium">
                                                            <span style="margin-right: 8px; font-size: x-large">
                                                                {{$actionsInDanger}}</span> <span style="margin-top: 4px;">Action sera atteinte dans 10 jours</span>
                                                        </h4>
                                                        {{-- <h4 class="font-weight-medium mb-0">
                                                        </h4> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6 float-right">
                                        {{-- <div class="row"> --}}

                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Temps écoulé</h4>
                                                        <div class="text-center">
                                                            <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{$percentageElapsed}}" aria-valuemin="0" aria-valuemax="100">
                                                                <div id="progres1" class="progress-bar bg-danger progress-bar-striped  progress-bar-animated" style="width: {{$percentageElapsed}}%">{{$percentageElapsed}}%</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Avancement (%)</h4>
                                                        <div class="text-center">
                                                            <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{$averageEtat}}" aria-valuemin="0" aria-valuemax="100">
                                                                <div id="progres2" class="progress-bar  bg-danger progress-bar-striped progress-bar-animated" style="width: {{$averageEtat}}%">{{$averageEtat}}%</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="row  mt-3">
                                                <div class="col-md-3">
                                                    <h5>Temp Écoulé</h5>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="progress">
                                                        <div id="progres1" class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width:{{$percentageElapsed}}%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">{{$percentageElapsed}}%</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-3">
                                                    <h5>Avancement</h5>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="progress">
                                                        <div id="progres2" class="progress-bar progress-bar-striped bg-success" role="progressbar" style= "width:{{$averageEtat}}%;" aria-valuenow="%" aria-valuemin="0" aria-valuemax="100">{{$averageEtat}}%</div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                        {{-- </div> --}}
                                    </div>

                                </div>
                            </div>
                        </div>








                            <div class="card">
                                {{-- <div class="details-content"> --}}
                                    <table class="table border" id="dir_planif">
                                        <thead style="background-color: rgba(44, 44, 44, 0.74); color: #fff;">
                                            <tr>
                                                <th>Action</th>
                                                <th>Date début</th>
                                                <th>Date fin</th>
                                                <th>Statut</th>
                                                <th>Etat (Temps écoulé/Avancement)</th>
                                            </tr>
                                        </thead>

                                        <tbody class="table-group-divider">
                                            @foreach ($actions as $action)

                                                <tr class="expandable" style="background-color: #f7f7f7;">
                                                    <td><span class="fs-6">{{$action->lib_act}}</span></td>
                                                    <td>{{ date('d-m-Y', strtotime($action->dd)) }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($action->df)) }}</td>
                                                    <td class="text-center">

                                                        @php
                                                            // $actionDate = date('Y-m', strtotime($action->date_fin));
                                                        @endphp

                                                        @if ($action->etat == '100')
                                                            <i data-feather="check-circle" class="feather-icon text-success"></i>
                                                        @else
                                                            @if($action->df >= $currentDate)
                                                                <i data-feather="clock" class="feather-icon text-warning"></i>
                                                            @else
                                                                <i data-feather="pause-circle" class="feather-icon text-danger"></i>
                                                            @endif
                                                        @endif


                                                    </td>
                                                    <td>
                                                        {{-- @if ($action->etat == '0') --}}

                                                            {{-- <div class="d-flex justify-content-center" style="flex-direction: column">

                                                                <div class="fs-6">0%</div>

                                                                <div class="progress border border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100">
                                                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 0%"></div>
                                                                </div>

                                                            </div> --}}
                                            
                                                        {{-- @else --}}
                                                            @if ($action->etat == '')
                                                                <div class="d-flex justify-content-center" style="flex-direction: column">
                                                                    <div class="text-center"> <span class="opacity-7 "><i data-feather="alert-triangle" class="text-danger"></i></span> </div>
                                                                    <div class="progress border border-danger border-2" role="progressbar" aria-label="Animated striped example" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100">
                                                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 0%"></div>
                                                                    </div>
                                                                </div>

                                                            @else
                                                                <div class="d-flex justify-content-center" style="flex-direction: column">

                                                                    <div class="fs-6">{{$action->etat}}%</div>

                                                                    <div class="progress border border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100">
                                                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: {{$action->etat}}%"></div>
                                                                    </div>

                                                                </div>
                                                            @endif
                                                        {{-- @endif --}}
                                                    </td>
                                                </tr>

                                                <tr class="sub-table">

                                                    <td colspan="5">
                                                        {{-- @foreach ($desc_idAct_date as $desc) --}}
                                                        
                                                                {{-- @php
                                                                    $desc_month = date('m', strtotime($desc->date));
                                                                @endphp --}}

                                                            {{-- @if ( $action->id_act == $desc->id_act && $desc_month == $month )

                                                            @else   --}}
                                                                <button type="button" class="btn btn-outline-info float-end" data-bs-toggle="modal"
                                                                    data-bs-target="#{{$action->id_act}}">
                                                                    <i data-feather="plus-circle" class="feather-icon"></i>
                                                                </button>   
                                                            {{-- @endif --}}

                                                        {{-- @endforeach --}}

                                                        <div class="modal fade" id="{{$action->id_act}}" tabindex="-1" role="dialog"
                                                                aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-full-width">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-info">
                                                                        <h4 class="modal-title text-light" id="myLargeModalLabel">{{$action->lib_act}}</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                            aria-hidden="true"></button>
                                                                    </div>

                                                                    <form method="POST" action="{{Route('directeur.dashboard.add_desc')}}">
                                                                        @csrf

                                                                        <div class="modal-body">

                                                                                <div class="form-floating mb-3">
                                                                                    <textarea class="form-control" name="Input1" placeholder="" id="Input1" style="height: 130px"></textarea>
                                                                                    <label for="Input1">Ce qui a été fait</label>
                                                                                </div>

                                                                                <div class="form-floating mb-3">
                                                                                    <textarea class="form-control" name="Input2" placeholder="" id="Input2" style="height: 130px"></textarea>
                                                                                    <label for="Input2">Ce qui reste à faire</label>
                                                                                </div>

                                                                                <div class="form-floating mb-3">
                                                                                    <textarea class="form-control" name="Input3" placeholder="" id="Input3" style="height: 130px"></textarea>
                                                                                    <label for="Input3">Contraintes</label>
                                                                                </div>

                                                                                <div class="mb-3">

                                                                                    @if ($action->etat == '')
                                                                                        <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act}}" value="0">
                                                                                        <span name="rangeValue" id="rangeValue{{$action->id_act}}">0%</span>
                                                                                    @else
                                                                                        <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act}}" value="{{$action->etat}}">
                                                                                        <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act}}">{{$action->etat}}%</span>
                                                                                    @endif


                                                                                </div>

                                                                                <input type="hidden" name="id_act" value="{{$action->id_act}}">
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                                                                Fermer
                                                                            </button>
                                                                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal">
                                                                                Ajouter
                                                                            </button>
                                                                        </div>

                                                                    </form>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->

                                                    <div class="ms-4 ps-2" style="border-left: 3px dotted;">

                                                        {{-- <div class="table-responsive" style="max-width: 900px;"> --}}

                                                            <table class="table">
                                                                <thead style="background-color: #6a75e9; color: #fff">
                                                                    <tr>
                                                                        <th style="width: 25%;">Ce qui a été fait</th>
                                                                        <th style="width: 25%;">Ce qui reste à faire</th>
                                                                        <th style="width: 15%;">Date début</th>
                                                                        <th style="width: 20%;" class="text-center">Contraintes</th>
                                                                        <th style="width: 15%;" class="text-center">Avancement (%)</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="table-group-divider" style="width: 100px">

                                                                    @foreach ($descriptions as $desc)
                                                                        @if ($desc->id_act == $action->id_act)

                                                                            <tr style="background-color:#d7ddf8">
                                                                                <td class="td1">{{$desc->faite}}</td>
                                                                                <td class="td2">{{$desc->a_faire}}</td>
                                                                                <td class="td3">{{ date('d-m-Y', strtotime($desc->date))}}</td>
                                                                                <td class="td4">{{$desc->probleme}}</td>
                                                                                <td style="width: 150px;">

                                                                                    <div class="d-flex justify-content-center" style="flex-direction: column">
                                                                                        <div class="fs-6 text-success">{{$desc->etat}}%</div>
                                                                                        <div class="progress " role="progressbar" aria-label="example" aria-valuenow="{{$desc->etat}}" aria-valuemin="0" aria-valuemax="100">
                                                                                            <div class="progress-bar bg-success" style="width: {{$desc->etat}}%"></div>
                                                                                        </div>
                                                                                    </div>

                                                                                    {{-- </span> --}}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>


                                </div>

                            </div>




                    </div>
                </div>
            </div>
            <footer class="footer text-center text-muted">
                Système de Planification
            </footer>
        </div>
    </div>


    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title text-light" id="myLargeModalLabel"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-hidden="true"></button>
                </div>
                <div class="modal-body">Cliquez sur « Se déconnecter » ci-dessous si vous êtes prêt à mettre fin à votre session en cours.</div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        {{-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button> --}}
                        <button class="btn btn-primary">
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Se déconnecter') }}
                            </x-dropdown-link>
                        </button>
                    
                    </form>
                </div>

                

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>

    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{asset('dist/js/app-style-switcher.js')}}"></script>

    <script src="{{asset('dist/js/feather.min.js')}}"></script>

    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>

    <script src="{{asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <!-- themejs -->
    <!--Menu sidebar -->

    <script src="{{asset('dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('dist/js/custom.min.js')}}"></script>
    <!-- This Page JS -->
    <!--Morris JavaScript -->
    <script src="{{asset('assets/libs/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('assets/libs/morris.js/morris.min.js')}}"></script>
    {{-- <script src="{{asset('dist/js/pages/morris/morris-data.js')}}"></script> --}}


    {{-------------------------------------------------------------------------------------}}








    <script>
        $(function () {
            $('[data-plugin="knob"]').knob();
        });


    </script>



<script>

//############################################### START COLOR FUNCTION ##########################################################//

    function colorTime (val)
    {
        if(val< 99.99) {actColorTime = 'bg-warning';}
        else           {actColorTime = 'bg-danger'; }

        return actColorTime;
    }

    function colorStat (val)
    {
        // if(val< 50) {actColorEtat = 'bg-warning';}
        // else        {actColorEtat = 'bg-success';}
        actColorEtat = 'bg-success';

        return actColorEtat;
    }

//################################################ END COLOR FUNCTION ###########################################################//

    /////////////////////////////////////////////////// Ajax load page Dir /////////////////////////////////////////////
            var Time= {{ $percentageElapsed }};
            var Avencemt= {{ $averageEtat }};

            var progressOne = document.getElementById("progres1");
            var progressTow = document.getElementById("progres2");

            ColorTim = colorTime (Time);
            ColorEtat = colorStat (Avencemt);

            progressOne.classList.forEach(function(className)
            {
                if (className.startsWith("bg-")) {progressOne.classList.remove(className);}
            });

            progressTow.classList.forEach(function(className)
            {
                if (className.startsWith("bg-")) {progressTow.classList.remove(className);}
            });

            progressOne.classList.add(""+ColorTim+"");
            progressTow.classList.add(""+ColorEtat+"");

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


</script>













<script>
    // sub_table
    $(document).ready(function() {
    // Add click event listener to each row with class 'expandable'
    $('.expandable').click(function() {
        // Toggle visibility of the sub-table
        $(this).next('.sub-table').toggle();
    });
});


$(document).ready(function(){
    $('#toggleForm').click(function(){
        $('#myModal').modal('show');
    });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

    var rangeInputs = document.querySelectorAll('[id^="customRange"]');
    var rangeValueSpans = document.querySelectorAll('[id^="rangeValue"]');

    // Iterate over each range input and set up event listeners
    rangeInputs.forEach(function(rangeInput, index) {
        var rangeValueSpan = rangeValueSpans[index];
        rangeValueSpan.textContent = rangeInput.value + '%';
        rangeInput.addEventListener('input', function() {
            rangeValueSpan.textContent = rangeInput.value + '%';
        });
        });
    });
</script>




</body>

</html>
