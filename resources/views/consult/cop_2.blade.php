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
    <link rel="stylesheet" href="{{asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
    {{------------------------------------------DataTables-----------------------------------------------------}}

    <!-- This page css -->
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/all.min.css')}}" rel="stylesheet">

    <link href="{{asset('assets/libs/morris.js/morris.css')}}" rel="stylesheet">

</head>

<style>
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

    .ribbon2 {
    font-size: 28px;
    font-weight: bold;
    color: #fff;
    }
    .ribbon2 {
    --r: .8em;
    
    border-block: .5em solid #0000;
    padding-inline: calc(var(--r) + .25em) .5em;
    line-height: 1.8;
    clip-path: polygon(0 0,100% 0,100% 100%,0 100%,var(--r) calc(100% - .25em),0 50%,var(--r) .25em);
    background: radial-gradient(.2em 60% at right,#000000ab,#0000) border-box, #87C7FF87 padding-box;
    width: fit-content;
    }


    .ribbon3 {
        font-size: 28px;
        font-weight: bold;
        color: #fff;
    }
    .ribbon3 {
        padding-top: 10px;
        --r: .8em;        
        border-inline: .5em solid #0000;
        /* padding: .3em .1em calc(var(--r) + .1em); */
        /* clip-path: polygon(0 0,100% 0,100% 100%,calc(100% - .5em) 85%,50% calc(100% - var(--r)),.5em 85%,0 100%); */
        /* clip-path: polygon(0 0,100% 0,100% 100%,calc(100% - .5em) calc(100% - var(--r)),50% 86%,.5em calc(100% - var(--r)),0 100%); */
        background:
        radial-gradient(50% .2em at top,#000a,#0000) border-box,
        #ffffffab padding-box;
        width: 100%;
    }



    .ribbon4 {
    font-size: 28px;
    font-weight: bold;
    color: #fff;
    }
    .ribbon4 {
        --f: .4em;
    --r: .8em;
    position: absolute;
    right: 48px;
    top: 50px;
    padding: .2em;
    border: solid #0000;
    border-width: 0 calc(2*var(--f)) var(--r) 0;
    background: 
        radial-gradient(50% 100% at bottom,#0005 98%,#0000 101%) 
        100% 0/calc(2*var(--f)) var(--f) no-repeat border-box;
    /* background-color: #FDC16A; */
    background-color: #CCCCCC91;
    border-radius: var(--f) var(--f) 0 0;
    clip-path: polygon(100% 0,0 0,0 80%,calc(50% - var(--f)) calc(100% - var(--r)),calc(100% - 2*var(--f)) 80%,calc(100% - 2*var(--f)) var(--f),100% var(--f));
    }


    /* @media (max-width:1470px){
        .ribbon5 {
        font-size: 28px;
        font-weight: bold;
        color: #fff;
        }
        .ribbon5 {
            --f: .4em;
        --r: .8em;
        position: absolute;
        right: 41px;
        top: 21%;
        padding: .2em;
        border: solid #0000;
        border-width: 0 calc(2*var(--f)) var(--r) 0;
        background: 
            radial-gradient(50% 100% at bottom,#0005 98%,#0000 101%) 
            100% 0/calc(2*var(--f)) var(--f) no-repeat border-box;
        background-color: #FDC16A;
        border-radius: var(--f) var(--f) 0 0;
        clip-path: polygon(100% 0,0 0,0 80%,calc(50% - var(--f)) calc(100% - var(--r)),calc(100% - 2*var(--f)) 80%,calc(100% - 2*var(--f)) var(--f),100% var(--f));
        }
    } */
    /* @media (min-width:1471px){ */
        .ribbon5 {
        font-size: 28px;
        font-weight: bold;
        color: #fff;
        }
        .ribbon5 {
            z-index: 999;
        --f: .4em;
        --r: .8em;
        position: absolute;
        right: 41px;
        top: 3em;
        /* top: calc(-1*var(--f)); */
        padding: .2em;
        border: solid #0000;
        border-width: 0 calc(2*var(--f)) var(--r) 0;
        background: 
            radial-gradient(50% 100% at bottom,#0005 98%,#0000 101%) 
            100% 0/calc(2*var(--f)) var(--f) no-repeat border-box;
        /* background-color: #FDC16A; */
        background-color: #CCCCCC91;
        border-radius: var(--f) var(--f) 0 0;
        clip-path: polygon(100% 0,0 0,0 80%,calc(50% - var(--f)) calc(100% - var(--r)),calc(100% - 2*var(--f)) 80%,calc(100% - 2*var(--f)) var(--f),100% var(--f));
        }
    /* } */
    

    .ribbon7 {
    font-size: 15px;
    font-weight: bold;
    color: #000;
    }
    .ribbon7 {
    --r: .4em; /* control the cutout */
    
    border-block: .2em solid #0000;
    padding-inline: .5em calc(var(--r) + .25em);
    line-height: 1.8;
    clip-path: polygon(100% 0,0 0,0 100%,100% 100%,calc(100% - var(--r)) calc(100% - .25em),100% 50%,calc(100% - var(--r)) .25em);
    background:
    radial-gradient(.2em 50% at left,#000a,#0000) border-box,
    #f9fbfd padding-box; /* the color #e3e3e3  */
    width: fit-content;
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
            <nav class="navbar top-navbar navbar-expand-lg custom-navbar-width" style="background-color: rgba(0, 76, 255, 0.56); max-height:5px;">

                <div class="navbar-header" data-logobg="skin5" >
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>

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


                <div class="navbar-collapse collapse" id="navbarSupportedContent" style="border-bottom: transparent;">

                    <ul class="navbar-nav float-left me-auto ms-3 ps-1">
                        <!-- Notification -->
                        <li class="nav-item dropdown">

                            {{-- <li> --}}
                                <p class="nav-link pt-3 text-light fs-4" class="blockquote">
                                    <strong>Système de Planification</strong>
                                </p>
                            {{-- </li> --}}

                        </li>

                    </ul>

                    <ul class="navbar-nav float-left me-3 ms-auto ps-1">

                    </ul>

                    <ul class="navbar-nav float-end">

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

                                <button class="dropdown-item btn" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    <i data-feather="power" class="svg-icon me-2 ms-1"></i>
                                    Se déconnecter
                                </button>

                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin6" style="background-color: rgba(0, 76, 255, 0.56);">

            <div class="scroll-sidebar" data-sidebarbg="skin6">

                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link font-weight-medium" href="{{ route('consult.dashboard') }}"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i>
                                <span>Dashboard</span></a></li>
                        <li class="list-divider"></li>
                        
                        <li class="sidebar-item">
                            <a class="sidebar-link font-weight-medium" href="{{ route('consult.liaison') }}" aria-expanded="false"><i data-feather="list" class="feather-icon"></i>
                                <span>Déclinaison-Structures</span>
                            </a>
                        </li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="font-weight-medium">C O P</span></li>

                        <li class="sidebar-item">
                            <a class="sidebar-link font-weight-medium" href="{{ route('consult.cop') }}" aria-expanded="false"><i class="fa-solid fa-file-contract fa-lg pe-2"></i>
                                <span>COP</span>
                            </a>
                        </li>

                    </ul>
                </nav>

            </div>

        </aside>

        <div class="page-wrapper">


            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">

                        </div>
                </div>
            </div>


            <div class="container">
                <div class="row">
                
                    @php
                        $months = [
                                    3 => 'trimestre',
                                    6 => 'semestre',
                                    9 => 'neuf mois',
                                    12 => 'annuel',
                                ];
                        $currentMonthNumber = (int) $month;
                    @endphp

                    <div class="col-lg-12">
                        <div class="ribbon">C O P</div>


                        <div class="card">

                            <div class="row text-center justify-content-center" style="padding-top: 35px;">
                                <div class="col-6" style="width: fit-content;">
                                    <h2 class="text-dark"> <span class="font-weight-medium">Année</span> {{$year}}</h2>
                                </div>
                            </div>

                            <div class="card-body">


                                {{-- background: linear-gradient(to right, #280555,#280555, #290657, #430d85); --}}

                                <div class="row mt-3" style="padding: 20px; background: linear-gradient(to right, #d5d5d5,#dadada, #f0f0f0, #fff);">
                                    {{-- <div style='text-align:center;background-image: url("{{asset('assets/cible3.png')}});background-repeat:no-repeat;'> --}}
                                        

                                        <div class="col-7">
                                            <div class="col-6 mt-4">
                                                <div class="input-group">
                                                    <label class="input-group-text font-weight-bold" for="month"><i class="fa-regular fa-calendar-days fa-xl"></i> </label>
                                                    <select class="form-select form-control formselect required custom-radius" style="background-color: #e8eaec; color: #000; text-transform: uppercase;" id="month">
                                                        @for ($i = 3; $i <= $currentMonthNumber; $i = $i+3)
                                                            @php
                                                                $paddedValue = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                            @endphp
                                                            <option value="{{ $paddedValue }}" {{ $i == $currentMonthNumber ? 'selected' : '' }}>
                                                                {{ $months[$i] }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mt-4">
                                                <div class="input-group">
                                                    {{-- <i class="fa-solid fa-bullseye me-1 fa-lg"></i> background-color: #FFC55AA1;--}}

                                                    <label class="input-group-text font-weight-bold" for="Objectif" style="background-color: #FFA500; color: #fff; font-weight: bolder;"> Objectif </label>
                                                    <select class="form-select form-control formselect required" placeholder="" id="Objectif" name="Objectif" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;  color: #000000; background-color: #e8eaec;" >
                                                        <option value="0" style="font-weight: bolder; color: rgb(169, 168, 168);" disabled selected> Selectionnez une Objectf * </option>
                                                        @foreach ($Objectif as $item)
                                                            <option value="{{ $item->id_obj }}">{{ $item->lib_obj }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-lg-12 ms-0 mt-4">
                                                {{-- background-color: #FF5F008F; --}}
                                                <div class="input-group">
                                                    <label class="input-group-text font-weight-bold" for="SousObjectif" style="background-color: #FF5F00; color: #fff; font-weight: bolder;">Sous Objectif</label>
                                                    <select class="form-select form-control formselect required" placeholder="" id="SousObjectif" name="SousObjectif" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;  color: #000000; background-color: #e8eaec;">
                                                        {{-- <option value="0" style="font-weight: bolder; color:rgb(242, 242, 242)" disabled selected> Selectionnez une Sous Objectif * </option> --}}
                                                    </select>
                                                </div>

                                            </div>


                                            <div class="col-lg-12 mt-4">
                                                {{-- background-color: #002379ab; --}}
                                                <div class="input-group">
                                                    <label class="input-group-text font-weight-bold" for="Indicateur" style="font-weight: bolder; color: #fff; background-color: #002379;"><i class="fa-solid fa-arrow-trend-up me-1"></i> Indicateur</label>
                                                    <select class="form-select form-control formselect required" placeholder="" id="Indicateur" name="Indicateur" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;  color: #000000; background-color: #e8eaec;">
                                                        {{-- <option value="0" style="font-weight: bolder; color:rgb(242, 242, 242)" disabled selected> Selectionnez un Indicateur * </option> --}}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-5">
                                            <img src="{{asset('assets/cible7.png')}}" class="float-end" alt="" style="opacity: 70%; max-width: 67%;">
                                        </div>

                                    {{-- </div> --}}
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        {{-- <div class="ribbonR">Les calculs</div> style="background-color: rgba(232, 234, 236, 0.32); "--}}
                        <div class="card">
                            <div class="card-body" >

                                <div id="numDenom" class="col-lg-12 p-3 d-none" style="background-image: url('{{ asset('assets/calc6.jpg') }}'); background-size: cover; background-position: center;">
                                    
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">
                                                <label for="numVal" class="col-sm-6 col-form-label pe-0" style="font-weight: bold; font-size: 14px;" id="num"></label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control bg-white rounded fs-4" id="numVal" placeholder="" readonly>
                                                        <span class="input-group-text p-1" id="typeN"><h4 class="m-0"></h4></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr style="border-top: 2px solid #313131; width: 47%; margin-left: revert;">

                                            <div class="row">
                                                <label for="denomVal" class="col-sm-6 col-form-label pe-0" style="font-weight: bold; font-size: 14px;" id="denom"></label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control bg-white rounded fs-4" id="denomVal" placeholder="" readonly>
                                                        <span class="input-group-text p-1" id="typeD"><h4 class="m-0"></h4></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6 " style="align-content: center; padding-left: 0;">
                                            <div class="row" style="align-content: center;">   
                                                <div class="col-5 ps-0" style="align-content: center; margin-bottom: 20px;">

                                                    <div class="d-flex ribbon7" style="margin-left: 28px;">
                                                        <span class="h5 font-weight-medium mb-1 pt-1" id="performantN">Résultat :</span>
                                                    </div>

                                                    <div class="input-group">
                                                        <span class="input-group-text p-1" id="basic-addon1"><h2 class="m-0 p-0">=</h2></span>
                                                        <input type="text" id="Result" class="form-control bg-white fs-4" placeholder="Result" aria-label="Username" aria-describedby="basic-addon1" readonly>
                                                    </div>
                                                    

                                                </div>   


                                                <div class="col-3 ps-0" style="align-content: center;">

                                                    <div class="d-flex ribbon7 ms-1">
                                                        <span class="h5 font-weight-medium mb-1 pt-1" id="performantN">Cible :</span>
                                                    </div>

                                                    <div class="input-group mb-3 border border-primary border-1 rounded rounded-4">
                                                        <span class="input-group-text rounded-end rounded-4 p-1" style="background-color: #ff6161;" id="basic-addon2"><h2 class="m-0 p-0"> <i class="fa-solid fa-crosshairs text-white"></i> </h2></span>
                                                        <input type="text" id="Cible1" class="form-control bg-white rounded-start rounded-4 fs-4" placeholder="Cible" aria-label="Username" aria-describedby="basic-addon2" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-4 ps-0 mt-2" style="align-content: center;">

                                                    <div class="d-flex ribbon7">
                                                        <span class="h5 font-weight-medium mb-1 pt-1" id="performantN">Ecart :</span>
                                                    </div>

                                                    <div class="input-group border border-warning border-2 rounded rounded-2 " >

                                                        <input type="text" id="ecartND" class="form-control bg-white rounded-2 fs-4 text-center font-weight-bold" placeholder="Ecart" aria-label="Username" aria-describedby="basic-addon3" readonly>
                                                        <span class="input-group-text rounded-2 " style="background-color: #f0f0f0;">
                                                            <h3 id="performantIcon" style="margin-bottom: 0px; margin-top: 10px;">
                                                            </h3>
                                                        </span>
                                                    </div>

                                                    <div class="justify-content-center d-flex ribbon3">
                                                        <span class="h6 font-weight-medium text-dark" id="performantND"></span>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-9">
                                        <div class="alert alert-primary d-flex align-items-center mt-3" role="alert">
                                            <i class="fa-solid fa-circle-info me-2 fa-beat"></i>
                                            <div id="formuleNumDenom" class="font-weight-medium">
                                                La formule de calcul:
                                            </div>
                                        </div>
                                    </div>

                                </div>



                                <div id="chiffre" class="col-lg-12 p-4 d-none" style="background-color: rgba(232, 234, 236, 0.32); background-image: url('{{ asset('assets/calc6.jpg') }}'); background-size: cover; background-position: center; align-content: center;">
                    
                                    <div class="col-12" style="align-content: center; padding-left: 0;">
                                        <div class="row">   
                                            <div class="col-6">
                                                <div class="input-group mb-3" style="margin-top: 35px">
                                                    <span class="input-group-text border border-start font-weight-medium" style="font-size: large; color: #000000" id="chifr"></span>
                                                    <span class="input-group-text" id="basic-addon1"><h1 class="m-0">=</h1></span>
                                                    <input type="text" id="ResultChiffre" class="form-control bg-white fs-4" placeholder="Result" aria-label="Username" aria-describedby="basic-addon1" readonly>
                                                    <span class="input-group-text" id="typeC"><h4 class="m-0"></h4></span>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="d-flex ribbon7 ms-1">
                                                    <span class="h4 font-weight-medium mb-1 pt-1" id="performantN">Cible :</span>
                                                </div>

                                                <div class="input-group border border-primary border-1 rounded rounded-4">
                                                    <span class="input-group-text rounded-end rounded-4" style="background-color: #ff6161;" id="basic-addon2"><h1 class="m-0"><i class="fa-solid fa-crosshairs text-white"></i></h1></span>
                                                    <input type="text" id="Cible2" class="form-control bg-white rounded-start rounded-4" placeholder="Cible" aria-label="Username" aria-describedby="basic-addon2" readonly>
                                                </div>
                                            </div>

                                            <div class="col-3" style="align-content: center; margin-top: 1px;">

                                                <div class="d-flex ribbon7 ms-1">
                                                    <span class="h4 font-weight-medium mb-1 pt-1" id="performantN">Ecart :</span>
                                                </div>

                                                <div class="input-group border border-warning border-2 rounded rounded-2" >
                                                    <input type="text" id="ecartC" class="form-control bg-white rounded-2 fs-4 text-center font-weight-bold" placeholder="Ecart" aria-label="Username" aria-describedby="basic-addon5" readonly>
                                                    <span class="input-group-text rounded-2 " style="background-color: #f0f0f0;">
                                                        <h3 id="performantIcon2" style="margin-bottom: 0px; margin-top: 10px;">
                                                        
                                                        </h3>
                                                    </span>
                                                </div>

                                                {{-- <div class="text-start ribbon4">
                                                    <h3 id="performantIcon2" style="margin-bottom: 0px; margin-top: 10px;">
                                                        
                                                    </h3>
                                                </div> --}}

                                                <div class="justify-content-center d-flex ribbon3">
                                                    <span class="h5 font-weight-medium me-2 text-dark" id="performantC"></span>
                                                    
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-9">
                                        <div class="alert alert-primary d-flex align-items-center mt-3" role="alert">
                                            <i class="fa-solid fa-circle-info me-2 fa-beat"></i>
                                            <div id="formuleChiffre" class="font-weight-medium">
                                                La formule de calcul:
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{-- <table id="causes" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Cause</th>
                                            <th>Action Corrective</th>
                                            <th>Direction</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table> --}}

                                
                                    <div id="causes" class="col-lg-12 p-4 d-none mt-3" style="background-color: rgba(232, 234, 236, 0.32);" >
                                        <div class="col-12" style="align-content: center; padding-left: 0;">
                                            <div class="col-5 ps-0" style="align-content: center; margin-bottom: 15px;">
                                                <div class="d-flex ribbon7">
                                                    <span class="h3 font-weight-medium mb-1 pt-1">Analyse causale</span>
                                                </div>
                                            </div> 

                                            <div class="row">   
                                                <div class="col-12">
                                                    <div class="input-group mb-3" style="margin-top: 35px">
                                                        <span class="input-group-text" ><h3 class="m-0">Cause(s)</h3></span>
                                                        <input type="text" id="cause" class="form-control bg-white fs-4" placeholder="Cause(s)" aria-label="Cause" aria-describedby="basic-addon1" readonly>
                                                    </div>
                                                    <div class="input-group mb-3" style="margin-top: 35px">
                                                        <span class="input-group-text" ><h3 class="m-0">Action(s) corrective(s)</h3></span>
                                                        <input type="text" id="correct" class="form-control bg-white fs-4" placeholder="Action(s) corrective(s)" aria-label="Action Corrective" aria-describedby="basic-addon1" readonly>
                                                    </div>

                                                    <div class="input-group mb-3" style="margin-top: 35px">
                                                        <span class="input-group-text"><h3 class="m-0">Structure Centrale</h3></span>
                                                        <input type="text" id="dir" class="form-control bg-white fs-4" placeholder="Structure Centrale" aria-label="Structure Centrale" aria-describedby="basic-addon1" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>


                        {{-- <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">



                                    <div class="accordion" id="accordionPanelsStayOpenExample">

                                            <div class="accordion-item mb-1">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button p-0" type="button" data-bs-toggle="collapse" data-bs-target="#a" aria-expanded="true" aria-controls="">
                                                        
                                                        <ul class="list-group list-group-horizontal p-1" style="background-color: #dfe4fa; width: 100%;">
                                                            <li class="list-group-item font-weight-medium text-dark" style="width: 75%; border: none;">Les Actions</li>
                                                        </ul>

                                                    </button>
                                                </h2>

                                                <div id="a" class="accordion-collapse collapse">
                                                    <div class="accordion-body">

                                                        <ul class="list-group list-group-horizontal text-center" style="background-color: rgba(44, 44, 44, 0.74);">
                                                            <li class="list-group-item" style="width: 22%; color: #fff">Structure Centrale</li>
                                                            <li class="list-group-item" style="width: 32%; color: #fff">Action</li>
                                                            <li class="list-group-item" style="width: 12%; color: #fff">Date Debut</li>
                                                            <li class="list-group-item" style="width: 12%; color: #fff">Date Fin</li>
                                                            <li class="list-group-item" style="width: 9%;  color: #fff">Statut</li>
                                                            <li class="list-group-item" style="width: 13%; color: #fff">Avancement (%)</li>
                                                        </ul>

                                                        <div class="accordion" id="accordion"> --}}
                                                                {{-- @foreach($act_p as $act) --}}
                                                                    {{-- @if ($act->id_p == $prioritaire->id_p) --}}

                                                                        {{-- <ul class="list-group list-group-horizontal">


                                                                            <div class="accordion-item " style="width: 100%;">
                                                                                <h2 class="accordion-header">
                                                                                    <button class="accordion-button p-0" type="button" data-bs-toggle="collapse" data-bs-target="#b" aria-expanded="true" aria-controls="">
                                                                                        <ul class="list-group list-group-horizontal p-1" style="background-color: #ffffff; width: 100%;">




                                                                                            <li class="list-group-item text-dark font-weight-medium" style="width: 22%; border: none;">

                                                                                                lib_dir
                                                                                            </li>
                                                                                            <li class="list-group-item text-dark font-weight-medium" style="width: 32%; border: none;"></li>
                                                                                            <li class="list-group-item text-center" style="width: 12%; border: none;"></li>
                                                                                            <li class="list-group-item text-center" style="width: 12%; border: none;"></li>
                                                                                            <li class="list-group-item text-center" style="width: 9%;  border: none;">
                                                                                                
                                                                                            </li>
                                                                                            <li class="list-group-item text-center" style="width: 13%;  border: none;">
                                                                                                

                                                                                                    <div class="d-flex" style="flex-direction: column">
                                                                                                        <div class="fs-6"></div>
                                                                                                        <div class="progress " role="progressbar" aria-label="example" aria-valuenow="10%" aria-valuemin="0" aria-valuemax="100">
                                                                                                            <div class="progress-bar bg-success" style="width: 10%"></div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                
                                                                                            </li>

                                                                                        </ul>

                                                                                    </button>
                                                                                </h2>



                                                                                    <div id="b" class="accordion-collapse collapse">
                                                                                        <div class="accordion-body" style="padding-top: 0;">

                                                                                                <span class="badge text-dark p-0" style="z-index: 3; line-height: 33%;">
                                                                                                    . <br>.<br>.<br>.<br>.<br>.<br>.<br>.<br>.
                                                                                                </span>

                                                                                                <ul class="list-group list-group-horizontal text-center" style="background-color: #eeeeee71">
                                                                                                    <li class="list-group-item" style="width: 25%">Ce qui a été fait</li>
                                                                                                    <li class="list-group-item" style="width: 25%">Ce qui reste à faire</li>
                                                                                                    <li class="list-group-item" style="width: 25%">Contraintes</li>
                                                                                                    <li class="list-group-item" style="width: 13%">Date de remplissage</li>
                                                                                                    <li class="list-group-item" style="width: 12%">Avancement (%)</li>
                                                                                                </ul> --}}
                                                                                                    {{-- @foreach($descriptions as $description)
                                                                                                        @if ($act->id_act == $description->id_act) --}}
                                                                                                            {{-- <ul class="list-group list-group-horizontal">
                                                                                                                <li class="list-group-item text-dark" style="width: 25%"></li>
                                                                                                                <li class="list-group-item text-dark" style="width: 25%"></li>
                                                                                                                <li class="list-group-item text-dark" style="width: 25%"></li>
                                                                                                                <li class="list-group-item" style="width: 13%"> --}}
                                                                                                                    {{-- {{date('d-m-Y H:i', strtotime($description->date))}}
                                                                                                                    @if ($description->date_update !='')
                                                                                                                        <br>
                                                                                                                        <span class="text-success me-1">{{ date('d-m-Y H:i', strtotime($description->date_update))}}</span><i class="fa-solid fa-pen fa-sm text-success"></i>
                                                                                                                    @endif --}}
                                                                                                                {{-- </li>
                                                                                                                <li class="list-group-item" style="width: 12%">
                                                                                                                    <div class="d-flex" style="flex-direction: column">
                                                                                                                        <div class="fs-6">%</div>
                                                                                                                        <div class="progress " role="progressbar" aria-label="example" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                                                                            <div class="progress-bar bg-success" style="width: %"></div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </li>
                                                                                                            </ul> --}}
                                                                                                        {{-- @endif
                                                                                                    @endforeach --}}

                                                                                        {{-- </div>
                                                                                    </div>

                                                                            </div>

                                                                        </ul> --}}
                                                                    {{-- @endif
                                                                @endforeach --}}
                                                        {{-- </div>


                                                    </div>
                                                </div>
                                            </div>

                                        

                                    </div>



                                </div>
                            </div>
                        </div> --}}



                    <div class="col-12">
                        <ul class="nav nav-pills bg-nav-pills nav-justified">
                            <li class="nav-item">
                                <a href="#DC" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link rounded-0 active">
                                    <i class="mdi mdi-home-variant d-lg-none d-block me-1"></i>
                                    <span class="d-none d-lg-block">Au niveau Centrale</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#DR" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0 ">
                                    <i class="mdi mdi-account-circle d-lg-none d-block me-1"></i>
                                    <span class="d-none d-lg-block">Au niveau Régionale</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="DC">


                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
    
                                        <div class="table-responsive">
                                            <table id="actCop" class="table border">
                                                <thead>
                                                    <tr class="font-weight-medium text-light bg-info">
                                                        <th style="width: 20%">Structure Centrale</th>
                                                        <th style="width: 35%">Action</th>
                                                        <th style="width: 12%">Date début</th>
                                                        <th style="width: 12%">Date fin</th>
                                                        <th style="width: 21%">Etat (Temps ecoulé / Avancement %)</th>
                                                    </tr>
                                                </thead>
    
    
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="DR">
                            
                            
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
    
                                        <div class="table-responsive">
                                            <table id="actCopDr" class="table border">
                                                <thead>
                                                    <tr class="font-weight-medium text-light bg-info">
                                                        <th style="width: 20%">Direction Régionale</th>
                                                        <th style="width: 35%">Action</th>
                                                        <th style="width: 12%">Date début</th>
                                                        <th style="width: 12%">Date fin</th>
                                                        <th style="width: 21%">Etat (Temps ecoulé / Avancement %)</th>
                                                    </tr>
                                                </thead>
    
    
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

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
                <div class="modal-header bg-info">
                    <h4 class="modal-title text-light" id="myLargeModalLabel"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-hidden="true"></button>
                </div>
                <div class="modal-body">Cliquez sur « Se déconnecter » ci-dessous si vous êtes prêt à mettre fin à votre session en cours.</div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

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
<script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('dist/js/pages/datatable/datatable-basic.init.js')}}"></script>

{{-- <script src="{{asset('dist/js/bootstrap.bundle.min.js')}}"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

<script src="{{asset('dist/js/bootstrap.min.js')}}"></script>



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
        if(val< 99.99) {actColorTimeText = 'text-warning';}
        else           {actColorTimeText = 'text-danger'; }

        return actColorTimeText;
    }

    function colorStatText (val)
    {
        // if(val< 50) {actColorEtat = 'bg-warning';}
        // else        {actColorEtat = 'bg-success';}
        actColorEtat = 'text-success';

        return actColorEtat;
    }


    $(document).ready(function() {
        $('#actCopDr').DataTable();
    });

    ///////////// COP ///////////////
    $(document).ready(function () 
    {

        $('#Objectif').on('change', function () 
        {
                let id_obj = $(this).val();

                $('#SousObjectif').empty();
                $('#SousObjectif').append(`<option value="0" disabled selected>Traitement...</option>`);

            $.ajax({
                type: 'GET',
                url: '/sObj/' + id_obj,
                success: function (response)
                {
                    var response = JSON.parse(response);

                    $('#SousObjectif').empty();
                    $('#SousObjectif').append(`<option value="0" style="font-weight: bolder; color: rgb(169, 168, 168);" disabled selected>Selectionnez un Sous Objectif *</option>`);

                    response.forEach(element => { $('#SousObjectif').append(`<option value="${element['id_sous_obj']}">${element['lib_sous_obj']}</option>`); });
                }
            });
        });


        $('#SousObjectif').on('change', function () 
        {
                let id_sous_obj = $(this).val();

                $('#Indicateur').empty();
                $('#Indicateur').append(`<option value="0" disabled selected>Traitement...</option>`);

            $.ajax({

                type: 'GET',
                url: '/ind/' + id_sous_obj,
                success: function (response) 
                {
                    var response = JSON.parse(response);

                    $('#Indicateur').empty();
                    $('#Indicateur').append(`<option value="0" style="font-weight: bolder; color: rgb(169, 168, 168);" disabled selected>Selectionnez un Indicateur*</option>`);

                    response.forEach(element => { $('#Indicateur').append(`<option value="${element['id_ind']}">${element['lib_ind']}</option>`); });
                }
            });
        });



        $('#Indicateur').on('change', function () 
        {
                let id_ind = $(this).val();
                var dataTable = $('#actCop').DataTable();
                var dataTableDr = $('#actCopDr').DataTable();

                let month = $('#month').val();
                let progressBarHTML;
                let progressBarHTMLDr;
            $.ajax({

                type: 'GET',
                url: '/res/' + id_ind,
                data: { month: month },

                success: function (response) 
                {
                    console.log(response.ecartType)

                    dataTable.clear().draw(); 
                    dataTableDr.clear().draw(); 
                    // dataTable.on("draw.dt",function()
                    //     {
                    //         feather.replace();
                    //     });

                    if (response.type == 'nd') {

                        const unitMapping = {
                            'DA': 'DA',
                            'NB': ' ',
                            'J': 'Jours',
                            'HJ': 'Heures / Jours',
                            'H': 'Heures',
                        };

                        $('#numDenom').removeClass('d-none').addClass('d-block');
                        $('#chiffre').removeClass('d-block').addClass('d-none');

                        $('#typeN').text(unitMapping[response.uniteNum] || '/');
                        $('#typeD').text(unitMapping[response.uniteDenom] || '/');

                        $('#num').text((response.libNum || '/') + ' :');
                        $('#denom').text((response.libDenom || '/') + ' :');
                        $('#numVal').val(response.valNum || '/');
                        $('#denomVal').val(response.valDenom || '/');
                        $('#formuleNumDenom').text('La formule de calcul : ' + (response.formule || '/'));
                        $('#Result').val(response.R + ' %');
                        $('#Cible1').val((response.cible || '') + ' ' + (response.cibleUnite || ''));
                        $('#ecartND').val(response.ecart || '/');

                        if (response.ecartType =='positif') {
                            $('#performantND').text('Ecart : Positif');
                            $('#performantIcon').html('<i class="fa-solid fa-up-long fa-bounce text-success"></i>');
                        }else{
                            $('#performantND').text('Ecart : Négatif');
                            $('#performantIcon').html('<i class="fa-solid fa-down-long fa-bounce text-danger"></i>');
                        } 
                        
                    } else {

                        const unitMapping = {
                            'DA': 'DA',
                            'NB': ' ',
                            'J': 'Jours',
                            'HJ': 'Heures / Jours',
                            'H': 'Heures',
                        };

                        $('#numDenom').removeClass('d-block').addClass('d-none');
                        $('#chiffre').removeClass('d-none').addClass('d-block');
                        $('#typeC').text(unitMapping[response.uniteC] || '/');

                        $('#chifr').text(response.libChiffre || '/');
                        $('#ResultChiffre').val(response.valChiffre || '/');
                        $('#formuleChiffre').text('La formule de calcul: ' + (response.formule || '/'));
                        $('#Cible2').val((response.cible || '') + ' ' + (response.cibleUnite || ''));
                        $('#ecartC').val(response.ecart || '/');


                        if (response.ecartType =='positif') {
                            $('#performantC').text('Ecart : Positif');
                            $('#performantIcon2').html('<i class="fa-solid fa-up-long fa-bounce text-success"></i>');
                        }else{
                            $('#performantC').text('Ecart : Négatif');
                            $('#performantIcon2').html('<i class="fa-solid fa-down-long fa-bounce text-danger"></i>');
                        }

                    }

                    // $('#causes').empty();
                    //     response.causes.forEach(cause => {
                    //         $('#causes').append(`
                    //             <tr>
                    //                 <td>${cause.lib_cause}</td>
                    //                 <td>${cause.lib_act_cor}</td>
                    //                 <td>${cause.id_dir}</td>
                    //             </tr>
                    //         `);
                    //     });

                    if (response.ecartType === 'négatif') 
                    {
                        $('#causes').removeClass('d-none').addClass('d-block');
                    if (response.causes.length > 0) 
                    {
                        for (let i = 0 ; i<response.causes.length ; i++)

                        {
                            $('#cause').val(response.causes[i].lib_cause);
                            $('#correct').val(response.causes[i].lib_correct);
                            $('#dir').val(response.causes[i].lib_dir);
                        }
                            
                    }
                    else 
                    {
                        $('#cause').val();
                        $('#correct').val();
                        $('#dir').val();
                    }
                } else {
                    $('#causes').removeClass('d-block').addClass('d-none');
                }



                    response.actionsDc.forEach(function(action)
                        {
                            var startDate = new Date(action.dd);
                            var endDate = new Date(action.df);

                            let JSdate = @json($JSdate);
                            var currentDate = new Date(JSdate);

                            var totalDuration = endDate.getTime() - startDate.getTime();
                            var tempEcolAct;

                            if (currentDate < startDate) {
                                tempEcolAct = 0;
                            } else if (currentDate <= endDate) {
                                var currentDuration = currentDate.getTime() - startDate.getTime();
                                tempEcolAct = ((currentDuration / totalDuration) * 100);
                            } else {
                                tempEcolAct = 100;
                            }

                            actColorTime = colorTime (tempEcolAct);
                            actColorEtat = colorStat (action.etat);
                            
                            if(action.etat == null)
                            {
                                var progressBarHTML = '<div style="width: 90% ">' +
                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolAct.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress " role="progressbar" aria-label="example" aria-valuenow="' +tempEcolAct+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar ' +actColorTime+'" style="width: ' + tempEcolAct + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
    
                                            '<div class="d-flex justify-content-center mt-1" style="flex-direction: column">' +
                                                '<div class="text-center"> <span class="opacity-7 "><i data-feather="alert-triangle" class="text-danger"></i></span> </div>' +
                                                '<div class="progress border border-danger border-2" role="progressbar" aria-label="example" aria-valuenow="' +0+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar " style="width: ' + 0 + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                                        
                            }
                            else
                            {
                                var progressBarHTML = '<div style="width: 90% ">' +
                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolAct.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress " role="progressbar" aria-label="Animated striped example" aria-valuenow="' +tempEcolAct+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar '+actColorTime+'" style="width: ' + tempEcolAct + '%"></div>' +
                                                '</div>' +
                                            '</div>' +

                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Avancement : <span class="text-success">' +action.etat.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress border border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="' +action.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar '+actColorEtat+'" style="width: ' + action.etat + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                            }


                            response.act_cops.forEach(function(act_cop)
                            {
                                if(action.id_act == act_cop.id_act)
                                {
                                    var startDate = new Date(action.dd);
    
                                    var formattedStartDate = startDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
                                    var endDate = new Date(action.df);
    
                                    var formattedEndDate = endDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
    
                                    var newRow = dataTable.row.add([
                                    act_cop.lib_dc,
                                    act_cop.lib_act_cop,
                                    formattedStartDate,
                                    formattedEndDate,
                                    progressBarHTML,
                                    ]).draw(false).node();
                                    newRow.id = action.id_act;
    
                                }
                            });


                        });










                    response.actionsDr.forEach(function(actiondr)
                    {
                        var startDate = new Date(actiondr.dd);
                        var endDate = new Date(actiondr.df);

                        let JSdate = @json($JSdate);
                        var currentDate = new Date(JSdate);

                        var totalDuration = endDate.getTime() - startDate.getTime();
                        var tempEcolAct;

                        if (currentDate < startDate) {
                            tempEcolActDr = 0;
                        } else if (currentDate <= endDate) {
                            var currentDuration = currentDate.getTime() - startDate.getTime();
                            tempEcolActDr = ((currentDuration / totalDuration) * 100);
                        } else {
                            tempEcolActDr = 100;
                        }

                        actColorTimeDr = colorTime (tempEcolActDr);
                        actColorEtatDr = colorStat (actiondr.etat);
                    

                        if(actiondr.etat == null)
                            {
                                var progressBarHTMLDr = '<div style="width: 90% ">' +
                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolActDr.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress " role="progressbar" aria-label="example" aria-valuenow="' +tempEcolActDr+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar ' +actColorTimeDr+'" style="width: ' + tempEcolActDr + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
    
                                            '<div class="d-flex justify-content-center mt-1" style="flex-direction: column">' +
                                                '<div class="text-center"> <span class="opacity-7 "><i data-feather="alert-triangle" class="text-danger"></i></span> </div>' +
                                                '<div class="progress border border-danger border-2" role="progressbar" aria-label="example" aria-valuenow="' +0+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar " style="width: ' + 0 + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                                        
                            }
                            else
                            {
                                var progressBarHTMLDr = '<div style="width: 90% ">' +
                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolActDr.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress " role="progressbar" aria-label="Animated striped example" aria-valuenow="' +tempEcolActDr+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar '+actColorTimeDr+'" style="width: ' + tempEcolActDr + '%"></div>' +
                                                '</div>' +
                                            '</div>' +

                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Avancement : <span class="text-success">' +actiondr.etat.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress border border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="' +actiondr.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar '+actColorEtatDr+'" style="width: ' + actiondr.etat + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                            }

                        // var progressBarHTMLDr = 'Ahmed'
                        //  get directions name ////////////////////////////////////////
                        response.directionsDr.forEach(function(direction)
                        {
                            if(actiondr.id_dr == direction.id_dir)
                            {
                                var ddDate = new Date(actiondr.dd);
                                var formattedDD = ("0" + ddDate.getDate()).slice(-2) + "/" + ("0" + (ddDate.getMonth() + 1)).slice(-2) + "/" + ddDate.getFullYear();

                                var dfDate = new Date(actiondr.df);
                                var formattedDF = ("0" + dfDate.getDate()).slice(-2) + "/" + ("0" + (dfDate.getMonth() + 1)).slice(-2) + "/" + dfDate.getFullYear();

                                var newRow = dataTableDr.row.add([
                                direction.lib_dir,
                                actiondr.lib_act_cop_dr,
                                formattedDD,
                                formattedDF,
                                progressBarHTMLDr,
                                ]).draw(false).node();
                                newRow.id = actiondr.id_act_cop_dr;

                            }
                        });

                    });










                }
            });
        });

    });


    ///////////// get sub table ///////////////
    $(document).ready(function()
    {
        var dataTable = $('#actCop').DataTable();

        function getFrenchMonthName(monthNumber) {
            const months = [
                'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
                'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
            ];
            return months[monthNumber - 1]; 
        }
        function format(infos) {
            var html = '<table class="table subtable" style="background-color:#f0f3ff;">' +
            '<thead style="background-color:#d7ddf8">' +
                '<tr style="color:#6c6c6c;">' +
                    '<th style="width: 25% !important;">Ce qui a été fait</th>' +
                    '<th style="width: 25% !important;">Ce qui reste a faire</th>' +
                    '<th style="width: 25% !important;">Contraintes</th>' +
                    '<th style="width: 15% !important;">Date de remplissage</th>' +
                    '<th style="width: 15% !important;">Mois</th>' +
                    '<th style="width: 10% !important;">Avancement(%)</th>' +
                '</tr>' +
            '</thead>' +
            '<tbody >';

            infos.forEach(function(info)
            {
                var date = new Date(info.date);
                var formattedDate = date.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' , hour: '2-digit', minute: '2-digit', hour12: false});

                var updateDate = '';
                if (info.date_update && !isNaN(new Date(info.date_update).getTime())) {
                    var update = new Date(info.date_update);
                    updateDate = '<br><span class="text-success me-1">' + update.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' , hour: '2-digit', minute: '2-digit', hour12: false}) + '</span><i class="fa-solid fa-pen fa-sm text-success"></i>';
                }

                var moisName = getFrenchMonthName(parseInt(info.mois, 10));

                var descMonth = new Date(info.date).getMonth() +1;
                var mm1 = descMonth - 1;
                var mm2 = descMonth - 2;
                    console.log('descMonth:', descMonth, 'mm1:', mm1, 'mm2:', mm2, 'info.mois:', info.mois);
                var moisHtml = '';
                if (info.mois == mm1 || info.mois == mm2) {
                    moisHtml = '<span class="me-1">' + formattedDate + '</span> <span style="color: rgb(255, 96, 96);"><i class="fa-solid fa-stopwatch fa-lg"></i></span>';
                } else {
                    moisHtml = '<span>' + formattedDate + '</span>';
                }

                html += '<tr>' +
                            '<td class="td1">' + info.faite + '</td>' +
                            '<td class="td2">' + info.a_faire + '</td>' +
                            '<td class="td3">' + info.probleme + '</td>' +
                            '<td class="td4dr">' + moisHtml + (info.date_update !== '' ? updateDate : '') + '</td>' +
                            '<td class="td4">' + moisName + '</td>' +
                            '<td class="td5"> '+ '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                    '<div class="fs-6 text-success">' +info.etat.toFixed(2)+ '%</div>' +
                                                    '<div class="progress border border-success border-1" role="progressbar" aria-label="example" aria-valuenow="' +info.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                        '<div class="progress-bar bg-success" style="width: ' + info.etat + '%"></div>' +
                                                    '</div>' +
                                                '</div>' +
                            '</td>' +
                    '</tr>';
            });

            html += '</tbody>' + '</table>';
            return html;
        }

        // Event listener to toggle child rows //////////////////////////
        $('#actCop tbody').on('click', 'td', function()
        {
            var tr = $(this).closest('tr');
            var row = dataTable.row(tr);

            var act = $(this).closest('tr').attr('id');

            if (row.child.isShown())
            {

                row.child.hide();
                tr.removeClass('shown');
            }
            else
            {
                // Close any open rows
                dataTable.rows().every(function() {
                    if (this.child.isShown())
                    {
                        this.child.hide();
                        $(this.node()).removeClass('shown');
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: '{{ url("/subtable") }}/' + act,
                    success: function(response)
                    {
                        var subtableHtml = format(response.infos);
                        row.child(subtableHtml).show();
                        tr.addClass('shown');
                    },
                    error: function(xhr, status, error)
                    {
                        console.error('Error fetching data:', error);
                    }
                });
            }
        });
    });














        ///////////// get sub table Dr ///////////////
    $(document).ready(function()
    {
        var dataTableDr = $('#actCopDr').DataTable();

        function getFrenchMonthName(monthNumber) {
            const months = [
                'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
                'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
            ];
            return months[monthNumber - 1]; 
        }
        function format(infoss) {
            var html = '<table class="table subtable" style="background-color:#f0f3ff;">' +
            '<thead style="background-color:#d7ddf8">' +
                '<tr style="color:#6c6c6c;">' +
                    '<th style="width: 25% !important;">Ce qui a été fait</th>' +
                    '<th style="width: 25% !important;">Ce qui reste a faire</th>' +
                    '<th style="width: 25% !important;">Contraintes</th>' +
                    '<th style="width: 15% !important;">Date de remplissage</th>' +
                    '<th style="width: 15% !important;">Mois</th>' +
                    '<th style="width: 10% !important;">Avancement(%)</th>' +
                '</tr>' +
            '</thead>' +
            '<tbody >';

            infoss.forEach(function(info)
            {
                var date = new Date(info.date);
                var formattedDate = date.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' , hour: '2-digit', minute: '2-digit', hour12: false});

                var updateDate = '';
                if (info.date_update && !isNaN(new Date(info.date_update).getTime())) {
                    var update = new Date(info.date_update);
                    updateDate = '<br><span class="text-success me-1">' + update.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' , hour: '2-digit', minute: '2-digit', hour12: false}) + '</span><i class="fa-solid fa-pen fa-sm text-success"></i>';
                }

                var moisName = getFrenchMonthName(parseInt(info.mois, 10));

                var descMonth = new Date(info.date).getMonth() +1;
                var mm1 = descMonth - 1;
                var mm2 = descMonth - 2;
                    console.log('descMonth:', descMonth, 'mm1:', mm1, 'mm2:', mm2, 'info.mois:', info.mois);
                var moisHtml = '';
                if (info.mois == mm1 || info.mois == mm2) {
                    moisHtml = '<span class="me-1">' + formattedDate + '</span> <span style="color: rgb(255, 96, 96);"><i class="fa-solid fa-stopwatch fa-lg"></i></span>';
                } else {
                    moisHtml = '<span>' + formattedDate + '</span>';
                }

                html += '<tr>' +
                            '<td class="td1">' + info.faite + '</td>' +
                            '<td class="td2">' + info.a_faire + '</td>' +
                            '<td class="td3">' + info.probleme + '</td>' +
                            '<td class="td4dr">' + moisHtml + (info.date_update !== '' ? updateDate : '') + '</td>' +
                            '<td class="td4">' + moisName + '</td>' +
                            '<td class="td5"> '+ '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                    '<div class="fs-6 text-success">' +info.etat.toFixed(2)+ '%</div>' +
                                                    '<div class="progress border border-success border-1" role="progressbar" aria-label="example" aria-valuenow="' +info.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                        '<div class="progress-bar bg-success" style="width: ' + info.etat + '%"></div>' +
                                                    '</div>' +
                                                '</div>' +
                            '</td>' +
                    '</tr>';
            });

            html += '</tbody>' + '</table>';
            return html;
        }

        // Event listener to toggle child rows //////////////////////////
        $('#actCopDr tbody').on('click', 'td', function()
        {
            var tr = $(this).closest('tr');
            var row = dataTableDr.row(tr);

            var act = $(this).closest('tr').attr('id');

            if (row.child.isShown())
            {

                row.child.hide();
                tr.removeClass('shown');
            }
            else
            {
                // Close any open rows
                dataTableDr.rows().every(function() {
                    if (this.child.isShown())
                    {
                        this.child.hide();
                        $(this.node()).removeClass('shown');
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: '{{ url("/subtableDr") }}/' + act,
                    success: function(response)
                    {
                        console.log(response.infoss)


                        var subtableHtml = format(response.infoss);
                        row.child(subtableHtml).show();
                        tr.addClass('shown');
                    },
                    error: function(xhr, status, error)
                    {
                        console.error('Error fetching data:', error);
                    }
                });
            }
        });
    });
</script>

</body>

</html>
