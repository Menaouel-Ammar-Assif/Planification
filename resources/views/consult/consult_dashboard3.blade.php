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

    {{------------------------------------------DataTables-----------------------------------------------------}}
    <link rel="stylesheet" href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css">
    {{------------------------------------------DataTables-----------------------------------------------------}}

    <!-- This page css -->
    <link href="../dist/css/style.min.css" rel="stylesheet">

    <link href="../assets/libs/morris.js/morris.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
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


    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #fff;
        background-color: #0177cc !important;
    }








</style>

<body>
<!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
<!-- ============================================================== -->

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full"  >
        <!-- ============================================================== -->
        
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-lg custom-navbar-width" style="background-color: rgba(49, 148, 175, 0.556);max-height:5px;">

                <div class="navbar-header" data-logobg="skin5" >
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                
                <!-- ============================================================== -->
                    <div class="navbar-brand justify-content-center">
                        <!-- Logo icon -->
                        <a class="d-flex align-items-center " href="{{ route('directeur.dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>
                
                <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>

                
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    
                    <ul class="navbar-nav float-left me-auto ms-3 ps-1">
                        <!-- Notification -->
                        <li class="nav-item dropdown">
                            
                            {{-- <li> --}}
                                <p class="nav-link pt-3 text-light" class="blockquote">
                                    <strong>Système de Planification</strong>
                                </p>
                            {{-- </li> --}}

                        </li>

                    </ul>

                    <ul class="navbar-nav float-left me-3 ms-auto ps-1">
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
                                        class="text-dark">Directeur Général</span> <i data-feather="chevron-down"
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
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6" style="background-color:  rgba(49, 148, 175, 0.556)">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item selected"> <a class="sidebar-link sidebar-link" href="{{ route('consult.dashboard') }}"
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
                    <div class="col-5 align-self-center">
                            
                        </div>
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
                <div class="row">



                    <div class="col-12">


                                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                    <li class="nav-item">
                                        <a href="#Tous" data-bs-toggle="tab" aria-expanded="false"
                                            class="nav-link rounded-0 active">
                                            <i class="mdi mdi-home-variant d-block me-1"></i>
                                            <span class="d-none d-lg-block">Toutes Les Directions</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#Centrale" data-bs-toggle="tab" aria-expanded="true"
                                            class="nav-link rounded-0 ">
                                            <i class="mdi mdi-account-circle d-block me-1"></i>
                                            <span class="d-none d-lg-block">Directions Centrales</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#Regionale" data-bs-toggle="tab" aria-expanded="false"
                                            class="nav-link rounded-0">
                                            <i class="mdi mdi-settings-outline d-block me-1"></i>
                                            <span class="d-none d-lg-block">Directions Régionales</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane show active" id="Tous">
                                        
                                        <div class="row">

                                            <div class="col-7">

                                                <div class="row">
                                                    {{-- Tous --}}
                                                    <div class="col-sm-12 col-lg-4">
                                                        <div class="card border border-info border-2">
                                                            <div class="card-body">
                                                                <a href="#" id="myLinkC" type="btn" style="text-decoration: none;">
                                                                    <div class="d-flex align-items-center">
                                                                        <div id="buttonWrapper" class="clickable">
                                                                            <div class="d-inline-flex align-items-center">
                                                                                <h2 class="text-dark mb-1 font-weight-medium">{{$numActions}}</h2>
                                                                            </div>
                                                                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Toutes Les Actions</h6>
                                                                        </div>
                                                                        <div class="ms-auto mt-md-3 mt-lg-0">
                                                                            <span class="opacity-7 text-muted"><i data-feather="home" class="text-muted"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-lg-4">
                                                        <div class="card border border-info border-1">
                                                            <div class="card-body">
                                                                <a href="#" id="myLinkC" type="btn" style="text-decoration: none;">
                                                                    <div class="d-flex align-items-center">
                                                                        <div id="buttonWrapper" class="clickable">
                                                                            <div class="d-inline-flex align-items-center">
                                                                                <h2 class="text-dark mb-1 font-weight-medium">9</h2>
                                                                            </div>
                                                                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Les Actions Prioritaires</h6>
                                                                        </div>
                                                                        <div class="ms-auto mt-md-3 mt-lg-0">
                                                                            <span class="opacity-7 text-muted"><i data-feather="star" class="text-muted"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-11">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h4 class="card-title">Temps écoulé</h4>
                                                                <div class="text-center">
                                                                    <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                                        <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" style="width: 75%">75%</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="col-11">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h4 class="card-title">Avancement</h4>
                                                                <div class="text-center">
                                                                    <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{$AvancementD}}" aria-valuemin="0" aria-valuemax="100">
                                                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: {{$AvancementD}}%">{{$AvancementD}}%</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>







                                                </div>
                                            </div>

                                            <div class="col-lg-5">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Toutes Les Actions</h4>
                                                        <div id="morris-donut-chart"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>











                                        {{-- <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table id="zero_config" class="table border">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Code</th>
                                                                        <th>Action</th>
                                                                        <th>Date début</th>
                                                                        <th>Date fin</th>
                                                                        <th>Etat</th>
                                                                    </tr>
                                                                </thead>
                                                                
                                                                
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                    





















                                        <div class="col-lg-10">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Les Actions Prioritaires</h4>
                                                    <div class="list-group list-group-flush">
                                                        <button type="button" class="list-group-item list-group-item-action position-relative">
                                                            <span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-info">1</span>La refonte du statut particulier des fonctionnaires de l’administration des douanes.
                                                        </button>
                                                        <button type="button" class="list-group-item list-group-item-action"><span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-info">2</span>La réorganisation des services de l’administration des douanes, au niveau central et  déconcentré.</button>
                                                        <button type="button" class="list-group-item list-group-item-action"><span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-info">3</span>La refonte du code des douanes et les textes d’application y afférents.</button>
                                                        <button type="button" class="list-group-item list-group-item-action"><span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-info">4</span>La finalisation de la numérisation intégrale.</button>
                                                        <button type="button" class="list-group-item list-group-item-action"><span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-info">5</span>La gestion des finances par obligation des résultats.</button>
                                                        <button type="button" class="list-group-item list-group-item-action" aria-current="true"><span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-info">6</span>La réalisation d’infrastructures (nouveau siège de la DGD, d’autres sièges …).</button>
                                                        <button type="button" class="list-group-item list-group-item-action" aria-current="true"><span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-info">7</span>La gestion de la ressource humaine par la mise en place du référentiel des  emplois et des compétences.</button>
                                                        <button type="button" class="list-group-item list-group-item-action" aria-current="true"><span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-info">8</span>Le renforcement des capacités par l’instauration d’une nouvelle politique de formation.</button>
                                                        <button type="button" class="list-group-item list-group-item-action" aria-current="true"><span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-info">9</span>Les modalités de mise en œuvre du contrat d’objectifs et de performance.</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-11">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Bar Chart</h4>
                                                    <div id="morris-bar-chart"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane " id="Centrale">

                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="row">

                                                        {{-- Select DR --}}
                                                            <div class="col-lg-12 mt-2 ">
                                                                <div class="card border-end">    
                                                                    <div class="customize-input float-start">
                                                                        <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius" id="directionselect">
                                                                            <option selected disabled>Toutes les directions Dc</option>
                                                                            @foreach ($directionsDc as $direction)
                                                                                <option value="{{ $direction->id_dir }}">{{ $direction->code }} - {{ $direction->lib_dir }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        {{-- Tous --}}
                                                        <div class="col-sm-12 col-lg-4">
                                                            <div class="card border border-info border-2">
                                                                <div class="card-body">
                                                                    <a href="#" id="myLinkC" type="btn" style="text-decoration: none;">
                                                                        <div class="d-flex align-items-center">
                                                                            <div id="buttonWrapper" class="clickable">
                                                                                <div class="d-inline-flex align-items-center">
                                                                                    <h2 class="text-dark mb-1 font-weight-medium">{{$numActDc }}</h2>
                                                                                </div>
                                                                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Toutes Les Actions</h6>
                                                                            </div>
                                                                            <div class="ms-auto mt-md-3 mt-lg-0">
                                                                                <span class="opacity-7 text-muted"><i data-feather="home" class="text-muted"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-lg-4">
                                                            <div class="card border-end">
                                                                <div class="card-body">
                                                                    <a href="#" id="myLinkC" type="btn" style="text-decoration: none;">
                                                                        <div class="d-flex align-items-center">
                                                                            <div id="buttonWrapper" class="clickable">
                                                                                <div class="d-inline-flex align-items-center">
                                                                                    <h2 class="text-dark mb-1 font-weight-medium" id="actParDirDc"></h2>
                                                                                </div>
                                                                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Les Actions Par Direction</h6>
                                                                            </div>
                                                                            
                                                                            <div class="ms-auto mt-md-3 mt-lg-0">
                                                                                {{-- <span class="opacity-7 text-muted"><i data-feather="codesandbox" class="text-success"></i></span> --}}
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- En cours --}}
                                                        <div class="col-sm-12 col-lg-4">
                                                            <div class="card border-end">
                                                                <div class="card-body">
                                                                    <a href="#" id="myLinkC" type="btn" style="text-decoration: none;">
                                                                        <div class="d-flex align-items-center">
                                                                            <div id="buttonWrapper" class="clickable">
                                                                                <div class="d-inline-flex align-items-center">
                                                                                    <h2 class="text-dark mb-1 font-weight-medium" id="etatEncDc"></h2>
                                                                                </div>
                                                                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Actions En Cours</h6>
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
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                        
                                                        {{-- Terminées --}}
                                                        <div class="col-sm-12 col-lg-4">
                                                            <div class="card border-end ">
                                                                <div class="card-body">
                                                                    <a href="#" id="myLinkT" type="btn" style="text-decoration: none;">
                                                                        <div class="d-flex align-items-center">
                                                                            <div>
                                                                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium" id="etatTermDc"></h2>
                                                                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Actions Terminées</h6>
                                                                            </div>
                                                                            <div class="ms-auto mt-md-3 mt-lg-0">
                                                                                <span class="opacity-7 text-muted"><i data-feather="check-circle" class="text-success"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- Retardées --}}
                                                        <div class="col-sm-12 col-lg-4">
                                                            <div class="card border-end ">
                                                                <div class="card-body">
                                                                    <a href="#" id="myLinkR" type="btn" style="text-decoration: none;">
                                                                        <div class="d-flex align-items-center">
                                                                            <div>
                                                                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium" id="etatRetDc"></h2>
                                                                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Actions Retardées</h6>
                                                                            </div>
                                                                            <div class="ms-auto mt-md-3 mt-lg-0">
                                                                                <span class="opacity-7 text-muted"><i data-feather="loader" class="text-danger"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="row ms-2">
                                                        <div class="card border-end mt-2">
                                                            <div class="card-body">
                                                                <div class="progress" role="progressbar" aria-label="Danger striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                                    <div class="progress-bar progress-bar-striped bg-danger" style="width: 90%">90%</div>
                                                                </div>

                                                                <div class="progress mt-4" role="progressbar" aria-label="Success striped example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                                    <div class="progress-bar progress-bar-striped bg-success" style="width: {{$AvancementDc}}%">{{$AvancementDc}}%</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                            

                                            
                                                        <div class="card border-end mt-2">
                                                            <div class="card-body">
                                                                <div class="progress" role="progressbar" aria-label="Danger striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                                    <div class="progress-bar progress-bar-striped bg-danger" style="width: 90%">90%</div>
                                                                </div>

                                                                <div class="progress mt-4" role="progressbar" aria-label="Success striped example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                                    <div class="progress-bar progress-bar-striped bg-success" id="progress-bar-Dc" style="width: 0%">0%</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>

                                        </div>
                    
                                        <div class="col-lg-12 mt-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table">
                                                        <table id="zero_config" class="table table-bordered">
                                                            <thead class="table-info">
                                                                <tr>
                                                                    <th scope="col">Action</th>
                                                                    <th scope="col">Date début</th>
                                                                    <th scope="col">Date fin</th>
                                                                    <th scope="col" class="text-center">Statut</th>
                                                                    <th scope="col">Etat d'avancement</th>
                                                                </tr>
                                                            </thead>
                                                        
                                                            <tbody class="table-group-divider" id="directions_table_body">
                                                                
                                                            </tbody>
                                                        </table>
                    
                                                        
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </div>









                                    </div>
                                    <div class="tab-pane" id="Regionale">
                                    

                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="row">
                        
                                                        {{-- select tous les directions --}}
                                                        <div class="col-lg-12 mt-2 ">
                                                            <div class="card border-end">    
                                                                <div class="customize-input float-start">
                                                                    <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius" id="directionDrSelect">
                                                                        <option selected disabled>Toutes les directions Dr</option>
                                                                        @foreach ($directionsDr as $direction)
                                                                            <option value="{{ $direction->id_dir }}">{{ $direction->code }} - {{ $direction->lib_dir }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                        {{-- Tous --}}
                                                        <div class="col-sm-12 col-lg-4">
                                                            <div class="card border border-info border-2">
                                                                <div class="card-body">
                                                                    <a href="#" id="myLinkC" type="btn" style="text-decoration: none;">
                                                                        <div class="d-flex align-items-center">
                                                                            <div id="buttonWrapper" class="clickable">
                                                                                <div class="d-inline-flex align-items-center">
                                                                                    <h2 class="text-dark mb-1 font-weight-medium">{{$numActDr }}</h2>
                                                                                </div>
                                                                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Toutes Les Actions</h6>
                                                                            </div>
                                                                            <div class="ms-auto mt-md-3 mt-lg-0">
                                                                                <span class="opacity-7 text-muted"><i data-feather="home" class="text-muted"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-lg-4">
                                                            <div class="card border-end">
                                                                <div class="card-body">
                                                                    <a href="#" id="myLinkC" type="btn" style="text-decoration: none;">
                                                                        <div class="d-flex align-items-center">
                                                                            <div id="buttonWrapper" class="clickable">
                                                                                <div class="d-inline-flex align-items-center">
                                                                                    <h2 class="text-dark mb-1 font-weight-medium" id="actParDirDr"></h2>
                                                                                </div>
                                                                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Les Actions Par Direction</h6>
                                                                            </div>
                                                                            
                                                                            <div class="ms-auto mt-md-3 mt-lg-0">
                                                                                {{-- <span class="opacity-7 text-muted"><i data-feather="codesandbox" class="text-success"></i></span> --}}
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-lg-4">
                                                            <div class="card border-end">
                                                                <div class="card-body">
                                                                    <a href="#" id="myLinkC" type="btn" style="text-decoration: none;">
                                                                        <div class="d-flex align-items-center">
                                                                            <div id="buttonWrapper" class="clickable">
                                                                                <div class="d-inline-flex align-items-center">
                                                                                    <h2 class="text-dark mb-1 font-weight-medium" id="etatEncDr"></h2>
                                                                                </div>
                                                                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Actions En Cours</h6>
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
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-sm-12 col-lg-4">
                                                            <div class="card border-end ">
                                                                <div class="card-body">
                                                                    <a href="#" id="myLinkT" type="btn" style="text-decoration: none;">
                                                                        <div class="d-flex align-items-center">
                                                                            <div>
                                                                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium" id="etatTermDr"></h2>
                                                                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Actions Terminées</h6>
                                                                            </div>
                                                                            <div class="ms-auto mt-md-3 mt-lg-0">
                                                                                <span class="opacity-7 text-muted"><i data-feather="check-circle" class="text-success"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-12 col-lg-4">
                                                            <div class="card border-end ">
                                                                <div class="card-body">
                                                                    <a href="#" id="myLinkR" type="btn" style="text-decoration: none;">
                                                                        <div class="d-flex align-items-center">
                                                                            <div>
                                                                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium" id="etatRetDr"></h2>
                                                                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Actions Retardées</h6>
                                                                            </div>
                                                                            <div class="ms-auto mt-md-3 mt-lg-0">
                                                                                <span class="opacity-7 text-muted"><i data-feather="loader" class="text-danger"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        {{-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Toutes les actions prioritaires</button>

                                                        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                                                          <div class="offcanvas-header">
                                                            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Toutes les actions prioritaires</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                          </div>
                                                          <div class="offcanvas-body">
                                                            <div class="list-group list-group-flush">
                                                                <button type="button" class="list-group-item list-group-item-action">La refonte du statut particulier des fonctionnaires de l’administration des douanes.</button>
                                                                <button type="button" class="list-group-item list-group-item-action">La réorganisation des services de l’administration des douanes, au niveau central et  déconcentré.</button>
                                                                <button type="button" class="list-group-item list-group-item-action">La refonte du code des douanes et les textes d’application y afférents.</button>
                                                                <button type="button" class="list-group-item list-group-item-action">La finalisation de la numérisation intégrale.</button>
                                                                <button type="button" class="list-group-item list-group-item-action">La gestion des finances par obligation des résultats.</button>
                                                                <button type="button" class="list-group-item list-group-item-action" aria-current="true">La réalisation d’infrastructures (nouveau siège de la DGD, d’autres sièges …).</button>
                                                                <button type="button" class="list-group-item list-group-item-action" aria-current="true">La gestion de la ressource humaine par la mise en place du référentiel des  emplois et des compétences.</button>
                                                                <button type="button" class="list-group-item list-group-item-action" aria-current="true">Le renforcement des capacités par l’instauration d’une nouvelle politique de formation.</button>
                                                                <button type="button" class="list-group-item list-group-item-action" aria-current="true">Les modalités de mise en œuvre du contrat d’objectifs et de performance.</button>
                                                            </div>

                                                          </div>
                                                        </div> --}}
                                                        
                        
                                                        {{-- <div class="col-sm-12 col-lg-4">
                                                            <div class="card border-end">
                                                                <div class="card-body">
                                                                    <a href="#" id="myLinkC" type="btn" style="text-decoration: none;">
                                                                        <div class="d-flex align-items-center">
                                                                            <div id="buttonWrapper" class="clickable">
                                                                                <div class="d-inline-flex align-items-center">
                                                                                    <h2 class="text-dark mb-1 font-weight-medium">{{$CActRC}}</h2>
                                                                                </div>
                                                                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Actions En Cours / DR</h6>
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
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                        
                        
                                                        <div class="col-sm-12 col-lg-4">
                                                            <div class="card border-end ">
                                                                <div class="card-body">
                                                                    <a href="#" id="myLinkT" type="btn" style="text-decoration: none;">
                                                                        <div class="d-flex align-items-center">
                                                                            <div>
                                                                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">{{$CActRT}}</h2>
                                                                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Actions Terminées / DR
                                                                                </h6>
                                                                            </div>
                                                                            <div class="ms-auto mt-md-3 mt-lg-0">
                                                                                <span class="opacity-7 text-muted"><i data-feather="check-circle" class="text-success"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                        
                        
                                                        <div class="col-sm-12 col-lg-4">
                                                            <div class="card border-end ">
                                                                <div class="card-body">
                                                                    <a href="#" id="myLinkT" type="btn" style="text-decoration: none;">
                                                                        <div class="d-flex align-items-center">
                                                                            <div>
                                                                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">{{$CActRR}}</h2>
                                                                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Actions Retardées / DR
                                                                                </h6>
                                                                            </div>
                                                                            <div class="ms-auto mt-md-3 mt-lg-0">
                                                                                <span class="opacity-7 text-muted"><i data-feather="loader" class="text-danger"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                </div>
                                            </div>

                                            
                                            <div class="col-lg-4">
                                                <div class="row ms-2">
                                                        <div class="card border-end mt-2">
                                                            <div class="card-body">
                                                                <div class="progress" role="progressbar" aria-label="Danger striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                                    <div class="progress-bar progress-bar-striped bg-danger" style="width: 90%">90%</div>
                                                                </div>

                                                                <div class="progress mt-4" role="progressbar" aria-label="Success striped example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                                    <div class="progress-bar progress-bar-striped bg-success" style="width: {{$AvancementDr}}%">{{$AvancementDr}}%</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                            

                                            
                                                        <div class="card border-end mt-2">
                                                            <div class="card-body">
                                                                <div class="progress" role="progressbar" aria-label="Danger striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                                    <div class="progress-bar progress-bar-striped bg-danger" style="width: 90%">90%</div>
                                                                </div>

                                                                <div class="progress mt-4" role="progressbar" aria-label="Success striped example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                                    <div class="progress-bar progress-bar-striped bg-success" id="progress-bar-Dr" style="width: 0%">0%</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                    
                                        <div class="col-lg-12 mt-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table">
                                                        <table id="zero_configg" class="table table-bordered">
                                                            <thead class="table-info">
                                                                <tr>
                                                                    <th scope="col">Action</th>
                                                                    <th scope="col">Date début</th>
                                                                    <th scope="col">Date fin</th>
                                                                    <th scope="col" class="text-center">Statut</th>
                                                                    <th scope="col">Etat d'avancement</th>
                                                                </tr>
                                                            </thead>
                                                        
                                                            <tbody class="table-group-divider" id="directionsDr_table_body">
                                                                
                                                            </tbody>
                                                        </table>
                    
                                                        
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </div>

                                    </div>
                                </div>

                    </div>

                    {{-- <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Bar Chart</h4>
                                <div id="morris-bar-chart"></div>
                            </div>
                        </div>
                    </div> --}}

                    <!-- column -->

                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center text-muted" >
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

{{------------------------------------------DataTables-----------------------------------------------------}}
{{-- <script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
<script src="../dist/js/pages/datatable/datatable-basic.init.js"></script> --}}

<script src="{{asset('dist/js/bootstrap.bundle.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

<script src="{{asset('dist/js/bootstrap.min.js')}}"></script>




<script>


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
















// Ajax directionDc
$(document).ready(function() {
    $('#directionselect').on('change', function () {
        var directionId = $(this).val();

        $.ajax({
            type: 'GET',
            url: '/consult/direction/'+ directionId,
            success: function(response) {
                console.log(response);

                $('#etatEncDc').text(response.etatEncDc);
                $('#etatTermDc').text(response.etatTermDc);
                $('#etatRetDc').text(response.etatRetDc);
                $('#actParDirDc').text(response.numActionsDc);

                var percentageCompletion = Math.round(response.AvncmDc);
                $('#progress-bar-Dc').css('width', percentageCompletion + '%').text(percentageCompletion + '%');

                if (typeof response === 'string') {
                    response = JSON.parse(response);
                }

                    $('#directions_table_body').empty();

                    response.actions.forEach(function(item) {
                        $('#directions_table_body').append(`
                            <tr id="${item.id_act}">
                                <td>${item['lib_act']}</td>
                                <td>${item.dd}</td>
                                <td>${item.df}</td>
                                <td></td>
                                <td>${item.etat}</td>
                            </tr>
                        `);
                    });
            }
        });
    });
});



// Ajax directionDr

$(document).ready(function() {
    $('#directionDrSelect').on('change', function () {
        var directionDrId = $(this).val();

        $.ajax({
            type: 'GET',
            url: '/consult/directionDr/'+ directionDrId,
            success: function(response) {
                console.log(response);

                // Ensure response is parsed as JSON
                if (typeof response === 'string') {
                    response = JSON.parse(response);
                }
                $('#etatEncDr').text(response.etatEncDr);
                $('#etatTermDr').text(response.etatTermDr);
                $('#etatRetDr').text(response.etatRetDr);
                $('#actParDirDr').text(response.numActionsDr);

                var percentageCompletionn = Math.round(response.AvncmDr);
                $('#progress-bar-Dr').css('width', percentageCompletionn + '%').text(percentageCompletionn + '%');

                $('#directionsDr_table_body').empty();
                response.actionsDr.forEach(function(action) {
                    $('#directionsDr_table_body').append(`
                        <tr id="${action.id_act}">
                            <td>${action.lib_act}</td>
                            <td>${action.dd}</td>
                            <td>${action.df}</td>
                            <td></td>
                            <td>${action.etat}</td>
                        </tr>
                    `);
                });

            }
        });
    });
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    $(document).ready(function() {
    // Initially hide all sub-tables
    $('.sub-table').hide();

    // Add click event listener to each row with class 'expandable'
    $('.expandable').click(function() {
        
        $(this).next('.sub-table').toggle();
    });
});
    
</script>

<script>


</script>
                            {{-- +
                              '<tr id="sub-table">' +
                                '<td>' + data.id_dir + '</td>' +
                                '<td>' + data.code + '</td>' +
                                '<td>' + data.lib_dir + '</td>' +
                              '</tr>' --}}
<script>
    
    var C= {{ $etatEnc }};
    var T= {{ $etatTerm }};
    var R= {{ $etatRet }};
    
    var data = <?php echo $dataJson; ?>;
        // Dashboard 1 Morris-chart
$(function () 
{
    "use strict";

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Actions En Cours",
            value: C,

        }, {
            label: "Actions Terminées",
            value: T
        }, {
            label: "Actions Retardées",
            value: R
        }],
        resize: true,
        colors:['#fb7a09', '#38ff00', '#fb0909']
    });

// Morris bar chart
    Morris.Bar({
        element: 'morris-bar-chart',
        data: data,
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['A', 'B'],
        barColors:['#92f78a', '#e65555'],
        hideHover: 'auto',
        gridLineColor: '#eef0f2',
        resize: true
    });

});    


 
    </script>



</body>

</html> 