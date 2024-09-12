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

    {{------------------------------------------DataTables-----------------------------------------------------}}
    <link rel="stylesheet" href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css">
    {{------------------------------------------DataTables-----------------------------------------------------}}

    <!-- This page css -->
    

    <link href="../dist/css/style.min.css" rel="stylesheet">
    <link href="../assets/all.min.css" rel="stylesheet">

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

    .ribbon
    {
        font-size: 28px;
        font-weight: bold;
        color: #fff;
    }
    .ribbon
    {
        --f: .5em;
        position: absolute;
        /* top: 0; */
        /* left: 0; */
        line-height: 1.8;
        padding-inline: 1lh;
        padding-bottom: var(--f);
        border-image: conic-gradient(#0008 0 0) 51%/var(--f);
        clip-path: polygon(
            100% calc(100% - var(--f)),100% 100%,calc(100% - var(--f)) calc(100% - var(--f)),var(--f) calc(100% - var(--f)), 0 100%,0 calc(100% - var(--f)),999px calc(100% - var(--f) - 999px),calc(100% - 999px) calc(100% - var(--f) - 999px));
        transform: translate(calc((cos(45deg) - 1)*100%), -100%) rotate(-45deg);
        transform-origin: 100% 100%;
        /* background-color: #F07818; */
        background: linear-gradient(to right, #f12711, #f5af19);
        z-index: +1;
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
            <nav class="navbar top-navbar navbar-expand-lg" style="background-color: rgba(0, 76, 255, 0.56);max-height:5px;">
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
                <div class="navbar-collapse collapse" id="navbarSupportedContent" style="border-bottom: transparent;">
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
                        {{-- <li class="nav-item dropdown mt-2">
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
                        </li> --}}
                        <!-- End Notification -->
                    </ul>

                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-end">
                        
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

        <aside class="left-sidebar" data-sidebarbg="skin6" style="background-color:  rgba(0, 76, 255, 0.56)">

            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav">


                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link font-weight-medium" href="{{ route('consult.dashboard') }}"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i>
                                <span>Dashboard</span></a>
                        </li>

                        {{-- @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                            <li class="sidebar-item">
                                <a class="sidebar-link font-weight-medium" href="{{ route('directeur.ActionsPrio') }}" aria-expanded="false">
                                    <i class="fa-solid fa-star pe-3"></i>
                                    <span>Actions Prioritaires</span>
                                </a>
                            </li>
                        @endif --}}

                        <li class="list-divider"></li>

                        <li class="sidebar-item">
                            <a class="sidebar-link font-weight-medium" href="{{ route('directeur.proposition') }}" aria-expanded="false"><i class="fa-solid fa-wand-magic-sparkles me-1"></i>
                                @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                                    <span>Proposer Des Actions</span>
                                @else
                                    <span>Actions Ajustées</span>
                                @endif
                            </a>
                        </li>





                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="font-weight-medium">C O P</span></li>
                        @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                        @else
                            
                            <li class="sidebar-item">
                                <a class="sidebar-link font-weight-medium" href="{{ route('directeur.cop') }}" aria-expanded="false">
                                    <i class="fa-solid fa-file-contract fa-lg pe-2"></i>
                                    <span class="font-weight-medium">Actions COP</span>
                                </a>
                            </li>

                        @endif

                        



                        {{-- <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu font-weight-medium">C O P</span></li> --}}

                        @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                            {{-- <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu font-weight-medium">C O P</span></li> --}}
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('directeur.ActionsCop') }}" aria-expanded="false">
                                    <i class="fa solid fa-file-contract pe-3" ></i>
                                    <span>Actions COP</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->id_dir && auth()->user()->id_dir == '9')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('directeur.pageCalculate') }}"
                                    aria-expanded="false"><i class="fa-solid fa-calculator me-2 fa-lg"></i>
                                    <span class="font-weight-medium">Les calculs</span>
                                </a>
                            </li>
                        @else
                        @php
                            $found = false;
                        @endphp

                        @foreach ($NumDenom as $item)
                            @if (auth()->user()->id_dir == $item->id_dc)
                                <li class="sidebar-item">
                                    <a class="sidebar-link font-weight-medium" href="{{ route('directeur.copAdd') }}" aria-expanded="false">
                                        <i data-feather="file-plus" class="feather-icon"></i>
                                        <span>COP</span>
                                    </a>
                                </li>
                                @php
                                    $found = true;
                                @endphp
                            @endif

                            @if ($found)
                                @break
                            @endif
                        @endforeach
                        @endif

                    </ul>



                </nav>

            </div>
        </aside>

        <div class="page-wrapper">


            <div class="page-breadcrumb">
                <div class="row">
                    @if (session()->has('success'))
                        <div class="container-fluid">
                            <div class="alert alert-success">
                                <h4>{{session()->get('success')}}</h4>
                            </div>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="container-fluid">
                            <div class="alert alert-danger">
                                <h4>{{session()->get('error')}}</h4>
                            </div>
                        </div>
                    @endif

                    @if (session()->has('complet-success'))
                        <div class="container-fluid">
                            <div class="alert alert-success">
                                <h4>{{session()->get('complet-success')}} <i data-feather="check-square" class="text-dark float-end"></i></h4>
                            </div>
                        </div>
                    @endif
                    <div class="col-5 align-self-center">

                        </div>
                </div>
            </div>


            <div class="container">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <table class="table border text-dark" id="cop_dr">
                                <thead style="background-color: rgba(25, 151, 235, 0.74); color: #fff" class="text-center">
                                    <tr>
                                        <th>Code Action</th>
                                        <th>Action</th>
                                        <th>Indicateur de Performance</th>
                                        <th>Date début</th>
                                        <th>Date fin</th>
                                        <th>Etat</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                                @foreach($ActionsCopDr as $action)
                                                    @if ($action->id_dr == auth()->user()->id_dir)
                                                        <tr class="expandable" style="background-color: #f7f7f7">
                                                            <td>{{ $action->code_act }}</td>
                                                            <td>{{ $action->lib_act_cop_dr }}</td>
                                                            <td class="font-weight-medium">
                                                                @foreach($action->actCopDrInds as $actCopDrInd)
                                                                    <button type="button" class="" style="background-color: transparent; border: none; box-shadow: none;"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        data-bs-custom-class="custom-tooltip"
                                                                        data-bs-title="{{$actCopDrInd->indicateur->formule}}.">
                                                                        <span><a class="link-offset-2 link-underline">{{$actCopDrInd->indicateur->lib_ind}}</a></span>
                                                                    </button>
                                                                @endforeach
                                                            </td>
                                                            <td>{{ date('d/m/Y', strtotime($action->dd)) }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($action->df)) }}</td>
                                                            <td class="text-center">
                                                        @php
                                                                $startDate = \Carbon\Carbon::parse($action->dd);
                                                                $endDate =  \Carbon\Carbon::parse($action->df);
                                                                $currentDate = \Carbon\Carbon::now();
                                                            
                                                                $totalDuration = $startDate->diffInDays($endDate);
                                                                $tempEcolAct;
                                                            
                                                                if ($currentDate < $startDate) {
                                                                    $tempEcolAct = 0;
                                                                } else if ($currentDate <= $endDate) {
                                                                    $currentDuration = $startDate->diffInDays($currentDate);
                                                                    $tempEcolAct = (($currentDuration / $totalDuration) * 100);
                                                                } else {
                                                                    $tempEcolAct = 100;
                                                                }
                                                            
                                                                // Determine background color class
                                                                $progressColorClass = $tempEcolAct < 99.99 ? 'bg-warning' : 'bg-danger';
                                                            @endphp
                                                            
                                                            <div class="d-flex justify-content-center" style="flex-direction: column">
                                                                <div class="fs-6"> Temps écoulé :{{ number_format($tempEcolAct, 2) }}%</div>
                                                                <div class="progress border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100">
                                                                    <div class="progress-bar {{ $progressColorClass }} progress-bar-striped progress-bar-animated" style="width: {{ number_format($tempEcolAct, 2) }}%"></div>
                                                                </div>
                                                            </div>





                                                            @if ($action->etat == '')
                                                                <div class="d-flex justify-content-center" style="flex-direction: column">
                                                                    <div class="text-center"> <span class="opacity-7 "><i data-feather="alert-triangle" class="text-danger"></i></span> </div>
                                                                    <div class="progress border border-danger border-2" role="progressbar" aria-label="Animated striped example" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100">
                                                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 0%"></div>
                                                                    </div>
                                                                </div>

                                                            @else
                                                                <div class="d-flex justify-content-center" style="flex-direction: column">

                                                                    <div class="fs-6 text-dark">Avancement :{{$action->etat}}%</div>

                                                                    <div class="progress border border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100">
                                                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: {{$action->etat}}%"></div>
                                                                    </div>

                                                                </div>
                                                            @endif
                                                            </td>
                                                        </tr>
                                                        <tr  class="sub-table">
                                                            <td colspan="6">
                                                                @php
                                                                    $months = [
                                                                                1 => 'Janvier',
                                                                                2 => 'Février',
                                                                                3 => 'Mars',
                                                                                4 => 'Avril',
                                                                                5 => 'Mai',
                                                                                6 => 'Juin',
                                                                                7 => 'Juillet',
                                                                                8 => 'Août',
                                                                                9 => 'Septembre',
                                                                                10 => 'Octobre',
                                                                                11 => 'Novembre',
                                                                                12 => 'Décembre'
                                                                            ];
        
                                                                    $currentMonthNumber = (int) $month;
                                                                    $found = '0';
                                                                    $found2 = '0';
                                                                    $foundX = '0';

                                                                    foreach ($desc_idAct_date as $desc){
                                                                        if ($desc->id_act_cop_dr == $action->id_act_cop_dr && $desc->mois == ($month -1)){    
                                                                            $found = '1';
                                                                            break;
                                                                        }
                                                                    }
                                                                    foreach ($desc_idAct_date as $desc){
                                                                        if ($desc->id_act_cop_dr == $action->id_act_cop_dr && $desc->mois == ($month -2)){    
                                                                            $found2 = '1';
                                                                            break;
                                                                        }
                                                                    }

                                                                    foreach ($desc_idAct_date as $desc){
                                                                        if ($currentMonthNumber >= '4'){
                                                                            if ($desc->id_act_cop_dr == $action->id_act_cop_dr && $desc->mois != ($month -1) && $desc->mois != ($month -2) && $desc->mois != ($month -3) ){    
                                                                                $foundX = '1';
                                                                                break;
                                                                            }
                                                                        }
                                                                    }

                                                                @endphp

                                                                {{-- @if ( $foundX == '0') --}}

                                                                    {{-- @if($found2 == '0' && $month != '1' && $month != '2' && $action->etat < '100')

                                                                        <button type="button" class="btn btn-outline-danger my-3 fs-4" style="float: right; font-family: 'Times New Roman', Times, serif" data-bs-toggle="modal" data-bs-target="#pr2{{$action->id_act_cop_dr}}">
                                                                            Mois {{$months[$currentMonthNumber -2]}}<i class="fa-solid fa-circle-plus fa-lg ms-1"></i>
                                                                        </button>

                                                                    @elseif ($found == '0' && $month != '1' && $action->etat < '100')
                                                                        <button type="button" class="btn btn-outline-warning my-3 fs-4" style="float: right; font-family: 'Times New Roman', Times, serif" data-bs-toggle="modal" data-bs-target="#pr{{$action->id_act_cop_dr}}">
                                                                            Mois Précédent <i class="fa-solid fa-circle-plus fa-lg ms-1"></i>
                                                                        </button>
                                                                    @else --}}

                                                                        
                                                                        @if($descriptionCounts[$action->id_act_cop_dr] == 0 && $action->etat < '100')
                                                                            <button type="button" class="btn btn-outline-success my-3 fs-4" style="float: right; font-family: 'Times New Roman', Times, serif" data-bs-toggle="modal" data-bs-target="#{{$action->id_act_cop_dr}}">
                                                                                Mois Actuel <i class="fa-solid fa-circle-plus fa-lg ms-1"></i> 
                                                                            </button>
                                                                        @endif
                                                                    {{-- @endif
                                                                @endif --}}

                                                                {{-- Ajouter description --}}
                                                                <div class="modal fade" id="{{$action->id_act_cop_dr}}" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-full-width">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header bg-info">
                                                                                <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act_cop_dr}}</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                            </div>

                                                                            <form method="POST" action="{{Route('directeur.dashboard.add_desc_cop')}}">
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="justify-content-center">
                                                                                                    <div style="text-align: center">
                                                                                                        <h3><i class="fa-solid fa-calendar-days text-muted"></i> 
                                                                                                            <span class="font-weight-medium">{{$months[$currentMonthNumber]}}</span></h3>
                                                                                                    </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-floating mb-3">
                                                                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input1" placeholder="" id="Input1" style="height: 130px"></textarea>
                                                                                            <label for="Input1">Ce qui a été fait</label>
                                                                                        </div>

                                                                                        <div class="form-floating mb-3">
                                                                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input2" placeholder="" id="Input2" style="height: 130px"></textarea>
                                                                                            <label for="Input2">Ce qui reste à faire</label>
                                                                                        </div>

                                                                                        <div class="form-floating mb-3">
                                                                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input3" placeholder="" id="Input3" style="height: 130px"></textarea>
                                                                                            <label for="Input3">Contraintes</label>
                                                                                        </div>

                                                                                        <div class="row justify-content-center">
                                                                                            <div class="col-3 alert alert-primary d-flex align-items-center text-center" role="alert">
                                                                                                <i class="fa-solid fa-circle-info"></i><div class="ms-2">Etat d'avancement de l'action </div>
                                                                                            </div>
                                                                                        
                                                                                            <div class="col-8 mb-3 border border-1 border-primary border-start-0 p1">
                                                                                                @if ($action->etat == '')
                                                                                                    <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="0">
                                                                                                    <span name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">0%</span>
                                                                                                @else
                                                                                                    <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="{{$action->etat}}">
                                                                                                    <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">{{$action->etat}}%</span>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>

                                                                                        <input type="hidden" name="id_act_cop_dr" value="{{$action->id_act_cop_dr}}">
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
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{-- Ajouter description_pre --}}
                                                                <div class="modal fade" id="pr{{$action->id_act_cop_dr}}" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-full-width">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header bg-info">
                                                                                <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act_cop_dr}}</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                            </div>

                                                                            <form method="POST" action="{{Route('directeur.dashboard.add_desc_pre_cop')}}">
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="justify-content-center">
                                                                                                <div style="text-align: center;">
                                                                                                    <h3 class=""><i class="fa-solid fa-calendar-days text-muted"></i> <span class="font-weight-medium ">{{$months[$currentMonthNumber -1]}}</span></h3>
                                                                                                </div>
                                                                                        </div>
                                                                                    </div>

                                                                                        <div class="form-floating mb-3">
                                                                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input1" placeholder="" id="Input1" style="height: 130px"></textarea>
                                                                                            <label for="Input1">Ce qui a été fait</label>
                                                                                        </div>

                                                                                        <div class="form-floating mb-3">
                                                                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input2" placeholder="" id="Input2" style="height: 130px"></textarea>
                                                                                            <label for="Input2">Ce qui reste à faire</label>
                                                                                        </div>

                                                                                        <div class="form-floating mb-3">
                                                                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input3" placeholder="" id="Input3" style="height: 130px"></textarea>
                                                                                            <label for="Input3">Contraintes</label>
                                                                                        </div>

                                                                                        <div class="row justify-content-center">
                                                                                            <div class="col-3 alert alert-primary d-flex align-items-center text-center" role="alert">
                                                                                                <i class="fa-solid fa-circle-info"></i><div class="ms-2">Etat d'avancement de l'action </div>
                                                                                            </div>
                                                                                        
                                                                                            <div class="col-8 mb-3 border border-1 border-primary border-start-0 p1">
                                                                                                @if ($action->etat == '')
                                                                                                    <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="0">
                                                                                                    <span name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">0%</span>
                                                                                                @else
                                                                                                    <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="{{$action->etat}}">
                                                                                                    <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">{{$action->etat}}%</span>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>

                                                                                        <input type="hidden" name="id_act_cop_dr" value="{{$action->id_act_cop_dr}}">
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
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{-- Ajouter description_pre2 -2 mois --}}
                                                                <div class="modal fade" id="pr2{{$action->id_act_cop_dr}}" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-full-width">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header bg-info">
                                                                                <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act_cop_dr}}</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                    aria-hidden="true"></button>
                                                                            </div>

                                                                            <form method="POST" action="{{Route('directeur.dashboard.add_desc_pre2_cop')}}">
                                                                                @csrf

                                                                                <div class="modal-body">

                                                                                    <div class="row">
                                                                                        <div class="justify-content-center">

                                                                                                <div style="text-align: center;">
                                                                                                    <h3><i class="fa-solid fa-calendar-days text-muted"></i> <span class="font-weight-medium">{{$months[$currentMonthNumber -2]}}</span></h3>
                                                                                                </div>
                                                                                            
                                                                                        </div>
                                                                                    </div>

                                                                                        <div class="form-floating mb-3">
                                                                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input1" placeholder="" id="Input1" style="height: 130px"></textarea>
                                                                                            <label for="Input1">Ce qui a été fait</label>
                                                                                        </div>

                                                                                        <div class="form-floating mb-3">
                                                                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input2" placeholder="" id="Input2" style="height: 130px"></textarea>
                                                                                            <label for="Input2">Ce qui reste à faire</label>
                                                                                        </div>

                                                                                        <div class="form-floating mb-3">
                                                                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input3" placeholder="" id="Input3" style="height: 130px"></textarea>
                                                                                            <label for="Input3">Contraintes</label>
                                                                                        </div>

                                                                                        <div class="row justify-content-center">
                                                                                            <div class="col-3 alert alert-primary d-flex align-items-center text-center" role="alert">
                                                                                                <i class="fa-solid fa-circle-info"></i><div class="ms-2">Etat d'avancement de l'action </div>
                                                                                            </div>
                                                                                        
                                                                                            <div class="col-8 mb-3 border border-1 border-primary border-start-0 p1">
                                                                                                @if ($action->etat == '')
                                                                                                    <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="0">
                                                                                                    <span name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">0%</span>
                                                                                                @else
                                                                                                    <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="{{$action->etat}}">
                                                                                                    <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">{{$action->etat}}%</span>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>

                                                                                        <input type="hidden" name="id_act_cop_dr" value="{{$action->id_act_cop_dr}}">
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
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="ms-1 ps-2">
                                                                    <table class="table">
                                                                        <thead style="background-color: #6a75e9; color: #fff">
                                                                            <tr>
                                                                                <th style="width: 25%;">Ce qui a été fait</th>
                                                                                <th style="width: 25%;">Ce qui reste à faire</th>
                                                                                <th style="width: 16%;">Date de remplissage</th>
                                                                                <th>Mois</th>
                                                                                <th style="width: 19%;" class="text-center">Contraintes</th>
                                                                                <th style="width: 15%;" class="text-center">Avancement (%)</th>
        
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="table-group-divider" style="width: 100px">
                                                                            @foreach ($descriptions as $desc)
                                                                                @if ($desc->id_act_cop_dr == $action->id_act_cop_dr)
        
                                                                                @php
                                                                                    $descMonth = \Carbon\Carbon::parse($desc->date)->month;
                                                                                    $mm1 = $descMonth - 1;
                                                                                    $mm2 = $descMonth - 2;
        
                                                                                    $moiss = (int) $desc->mois;
                                                                                @endphp
        
                                                                                    {{-- @if($day<=26)
                                                                                        @if($desc->date_update == '' && $action->df > $currentDateD  && $action->etat < '100' && $descMonth == $month)
                                                                                            <button type="button" class="btn btn-outline-success px-3 float-end me-1" data-bs-toggle="modal"
                                                                                                data-bs-target="#d{{$desc->id_desc}}">
                                                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                                                            </button>
                                                                                        @endif
                                                                                    @endif --}}
        
                                                                                    {{-- Update description  --}}
                                                                                    <div class="modal fade" id="d{{$desc->id_desc}}" tabindex="-1" role="dialog"
                                                                                            aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                                                                        <div class="modal-dialog modal-full-width">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header bg-success">
                                                                                                    <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act_cop_dr}}</h4>
                                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                                                </div>
        
                                                                                                <form method="POST" action="{{Route('directeur.dashboard.update_desc_cop')}}">
                                                                                                    @csrf
        
                                                                                                    <div class="modal-body">
                                                                                                            {{-- Le modification est une (1) fois par mois --}}
                                                                                                            <div class="col-12 alert alert-success d-flex align-items-center justify-content-center" role="alert">
                                                                                                                <i class="fa-solid fa-triangle-exclamation fa-beat"></i><div class="ms-2">Si vous modifiez, vous ne pourrez plus changer</div>
                                                                                                            </div>
        
                                                                                                            <div class="justify-content-center">
                                                                                                                <div style="text-align: center">
                                                                                                                    <h3><i class="fa-solid fa-calendar-days text-muted"></i> <span class="font-weight-medium">{{$months[$currentMonthNumber]}}</span></h3>
                                                                                                                </div>
                                                                                                            </div>
        
                                                                                                            <div class="form-floating mb-3">
                                                                                                                <textarea class="form-control" style="background-color: #f8f8f8;" name="Input1" placeholder="" id="Input1" style="height: 130px">{{$desc->faite}}</textarea>
                                                                                                                <label for="Input1">Ce qui a été fait</label>
                                                                                                            </div>
        
                                                                                                            <div class="form-floating mb-3">
                                                                                                                <textarea class="form-control" style="background-color: #f8f8f8;" name="Input2" placeholder="" id="Input2" style="height: 130px">{{$desc->a_faire}}</textarea>
                                                                                                                <label for="Input2">Ce qui reste à faire</label>
                                                                                                            </div>
        
                                                                                                            <div class="form-floating mb-3">
                                                                                                                <textarea class="form-control" style="background-color: #f8f8f8;" name="Input3" placeholder="" id="Input3" style="height: 130px">{{$desc->probleme}}</textarea>
                                                                                                                <label for="Input3">Contraintes</label>
                                                                                                            </div>
        
                                                                                                            <div class="row justify-content-center">
                                                                                                                <div class="col-3 alert alert-primary d-flex align-items-center text-center" role="alert">
                                                                                                                    <i class="fa-solid fa-circle-info"></i><div class="ms-2">Etat d'avancement de l'action </div>
                                                                                                                </div>
                                                                                                            
                                                                                                                <div class="col-8 mb-3 border border-1 border-primary border-start-0 p1">
                                                                                                                    @if ($action->etat == '')
                                                                                                                        <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="0">
                                                                                                                        <span name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">0%</span>
                                                                                                                    @else
                                                                                                                        <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="{{$action->etat}}">
                                                                                                                        <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">{{$action->etat}}%</span>
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                            </div>
        
                                                                                                            <input type="hidden" name="id_act" value="{{$action->id_act_cop_dr}}">
                                                                                                            <input type="hidden" name="id_desc" value="{{$desc->id_desc}}">
                                                                                                    </div>
        
                                                                                                    <div class="modal-footer">
                                                                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                                                                                            Fermer
                                                                                                        </button>
                                                                                                        <button type="submit" class="btn btn-success" data-bs-dismiss="modal">
                                                                                                            Modifier
                                                                                                        </button>
                                                                                                    </div>
        
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
        
                                                                                    <tr style="background-color:#d7ddf8">
                                                                                        <td class="td1">{{$desc->faite}}</td>
                                                                                        <td class="td2">{{$desc->a_faire}}</td>
                                                                                        <td class="td3">
                                                                                        
                                                                                            @if ($desc->mois == $mm2 || $desc->mois == $mm1)
                                                                                                <span class="me-1">{{ date('d-m-Y H:i', strtotime($desc->date))}}</span> <span style="color: rgb(255, 96, 96);"><i class="fa-solid fa-stopwatch fa-lg"></i></span>
                                                                                            @else
                                                                                                <span>{{ date('d-m-Y H:i', strtotime($desc->date))}}</span>
                                                                                            @endif
        
        
                                                                                            @if ($desc->date_update !='')
                                                                                                <br>
                                                                                                <span class="text-success me-1">{{ date('d-m-Y H:i', strtotime($desc->date_update))}}</span><i class="fa-solid fa-pen fa-sm text-success"></i>
                                                                                            @endif
        
                                                                                        </td>
                                                                                        <td>{{$months[$moiss]}}</td>
                                                                                        <td class="td4 text-center">{{$desc->probleme}}</td>
                                                                                        <td class="text-center" style="width: 150px;">
        
                                                                                            <div class="d-flex justify-content-center" style="flex-direction: column">
                                                                                                <div class="fs-6 text-dark">{{$desc->etat}}%</div>
                                                                                                <div class="progress " role="progressbar" aria-label="example" aria-valuenow="{{$desc->etat}}" aria-valuemin="0" aria-valuemax="100">
                                                                                                    <div class="progress-bar bg-success" style="width: {{$desc->etat}}%"></div>
                                                                                                </div>
                                                                                            </div>
        
                                                                                        </td>
                                                                                    </tr>
        
                                                                                    <tr>
                                                                                        {{-- @if($day<=26) --}}
                                                                                            @if($desc->date_update == '' && $action->df > $currentDateD  && $action->etat < '100' && $desc->mois == $month)
                                                                                                <td colspan="6" class="text-end">
                                                                                                    <button type="button" class="btn btn-outline-success px-3 me-1" data-bs-toggle="modal" data-bs-target="#d{{$desc->id_desc}}">
                                                                                                        Modifier <i class="fa-solid fa-pen-to-square ms-1"></i>
                                                                                                    </button>
                                                                                                </td>
                                                                                            @endif
                                                                                        {{-- @endif --}}
                                                                                    </tr>
        
                                                                                    
                                                                                @endif
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            
                                        {{-- @endforeach
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer text-center text-muted" >
                Système de Planification
            </footer>

        </div>
    </div>


    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h4 class="modal-title " id="myLargeModalLabel"></h4>
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
<script src="{{asset('assets/all.min.js')}}"></script>

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
<script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
<script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>

{{-- <script src="{{asset('dist/js/bootstrap.bundle.min.js')}}"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

<script src="{{asset('dist/js/bootstrap.min.js')}}"></script>

    {{-------------------------------------------------------------------------------------}}
<script>
    $(function () {
        $('[data-plugin="knob"]').knob();
    });


</script>
<script>
      $(document).ready(function(){
            $('#cop_dr').DataTable();
        });
</script>


<script>
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

function colorTimeText (val)
{
    if(val< 99.99) {actColorTime = 'text-warning';}
    else           {actColorTime = 'text-danger'; }

    return actColorTime;
}

function colorStatText (val)
{
    // if(val< 50) {actColorEtat = 'bg-warning';}
    // else        {actColorEtat = 'bg-success';}
    actColorEtat = 'text-success';

    return actColorEtat;
}


// $(document).ready(function() {
//     $('#actCop').DataTable();
// });


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
