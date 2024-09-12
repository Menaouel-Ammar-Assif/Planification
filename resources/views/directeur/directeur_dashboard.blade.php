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
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/all.min.css')}}" rel="stylesheet">

    <link href="{{asset('assets/libs/morris.js/morris.css')}}" rel="stylesheet">
</head>
<style>
        .balls {
    width: 2.6em;
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
    justify-content: space-between;
    }

    .balls div {
    width: 0.6em;
    height: 0.6em;
    border-radius: 50%;
    background-color: #fc2f70;
    animation: fade 0.8s ease-in-out alternate infinite;
    }

    .balls div:nth-of-type(1) {
    animation-delay: -0.4s;
    }

    .balls div:nth-of-type(2) {
    animation-delay: -0.2s;
    }

    @keyframes fade {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
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
        animation: colorr 2.5s ease-in-out alternate infinite;
    }

        @keyframes colorr {
        from {
            color: rgb(253, 79, 79);
        }
        to {
            color: rgb(255, 255, 255);
        }

    }

    #atteinte {
        margin-left: 10px;
        border-radius: 15px;
        position: relative;
        width: 2em;
        height: 2em;
        border: 2px solid #ff05288c;
        overflow: hidden;
        animation: spin 3s ease infinite;
    }

    #atteinte::before {
        content: '';
        position: absolute;
        top: -3px;
        left: -3px;
        width: 2em;
        height: 2em;
        background-color: hsla(0, 100%, 72.2%, 0.63);
        transform-origin: center bottom;
        transform: scaleY(1);
        animation: fill 3s linear infinite;
    }

    @keyframes spin {
        50%,
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes fill {
        25%,
        50% {
            transform: scaleY(0);
    }
        100% {
            transform: scaleY(1);
        }
    }

    #atteinte2 {
    margin-left: 15px;
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
    justify-content: space-between;
    width: 2em;
    }

    .atteinte {
    width: 0.3em;
    height: 0.9em;
    background-color: #ff000080;
    }

    .atteinte:nth-of-type(1) {
    animation: grow 1.5s -0.45s ease-in-out infinite;
    }

    .atteinte:nth-of-type(2) {
    animation: grow 1.5s -0.3s ease-in-out infinite;
    }

    .atteinte:nth-of-type(3) {
    animation: grow 1.5s -0.15s ease-in-out infinite;
    }

    .atteinte:nth-of-type(4) {
    animation: grow 1.5s ease-in-out infinite;
    }

    @keyframes grow {
    0%,
    100% {
        transform: scaleY(1);
    }

    50% {
        transform: scaleY(2);
    }
    }

    .triangle {
        --r:12px;
    
        width: 55%;
        aspect-ratio: 1/cos(30deg);
        --_g:calc(tan(60deg)*var(--r)) bottom var(--r),#000 98%,#0000 101%;
        -webkit-mask:
        conic-gradient(from -30deg at 50% calc(200% - 3*var(--r)/2),#000 60deg,#0000 0)
            0 100%/100% calc(100% - 3*var(--r)/2) no-repeat,
        radial-gradient(var(--r) at 50% calc(2*var(--r)),#000 98%,#0000 101%),
        radial-gradient(var(--r) at left  var(--_g)),
        radial-gradient(var(--r) at right var(--_g));
        clip-path: polygon(50% 0,100% 100%,0 100%);
        background: linear-gradient(180deg,#fffb00,#EF760C00);
    }

    /* .ribbon
    {
        font-size: 12px;
        font-weight: bold;
        color: #fff;
    }
    .ribbon
    {
        --f: .5em;
        position: absolute;

        line-height: 1.5;
        padding-inline: 1lh;
        padding-bottom: var(--f);
        border-image: conic-gradient(#0008 0 0) 51%/var(--f);
        clip-path: polygon(
            100% calc(100% - var(--f)),100% 100%,calc(100% - var(--f)) calc(100% - var(--f)),var(--f) calc(100% - var(--f)), 0 100%,0 calc(100% - var(--f)),999px calc(100% - var(--f) - 999px),calc(100% - 999px) calc(100% - var(--f) - 999px));
        transform: translate(calc((cos(45deg) - 1)*100%), -100%) rotate(-45deg);
        transform-origin: 100% 100%;
        background: linear-gradient(to right, #f12711, #f5af19);
        z-index: +1;
    } */

    /* HTML: <div class="ribbon">Your text content</div> */
    /* .ribbon {
    font-size: 11px;
    font-weight: bold;
    color: #fff;
    
    }
    .ribbon {
    --f: .5em;
    --r: .8em; 
    
    position: absolute;
    left: 20px;
    padding: .2em;
    background: #0800ff;
    border-left: var(--f) solid #0005;
    border-bottom: var(--r) solid #0000;
    clip-path: polygon(var(--f) 0,100% 0,100% 100%,calc(50% + var(--f)/2) calc(100% - var(--r)), var(--f) 100%,var(--f) var(--f),0 var(--f));
    z-index: 10;
    } */

/* HTML: <div class="ribbon">Your text content</div> */
.ribbon {
  font-size: 11px;
  font-weight: bold;
  color: #fff;
}
.ribbon {
  --f: .5em; /* control the folded part*/
  --r: .8em; /* control the ribbon shape */
  
  position: absolute;
  /* top: 20px; */
  left: calc(-1*var(--f));
  padding-inline: .25em;
  line-height: 1.8;
  background: #0800ff;
  border-bottom: var(--f) solid #0005;
  border-right: var(--r) solid #0000;
  clip-path: 
    polygon(0 0,0 calc(100% - var(--f)),var(--f) 100%,
      var(--f) calc(100% - var(--f)),100% calc(100% - var(--f)),
      calc(100% - var(--r)) calc(50% - var(--f)/2),100% 0);
}


/* HTML: <div class="ribbon">Your text content</div> */
    .ribbonn {
    font-size: 28px;
    font-weight: bold;
    color: #fff;
    }
    .ribbonn {
    --c: #fdc16a;
    --r: 20%;
    
    padding: 1em 1.5em; 
    aspect-ratio: 1;
    display: grid;
    place-content: center;
    text-align: center;
    position: relative;
    z-index: 0;
    width: fit-content;
    
    }
    .ribbonn:before {
    content: "";
    position: absolute;
    z-index: -1;
    inset: 60% 20% -40%;
    background: color-mix(in srgb, var(--c), #000 35%);
    clip-path: polygon(5% 0,95% 0,100% 100%,50% calc(100% - var(--r)),0 100%);
    /* animation: wave 1.5s ease-in-out alternate infinite; */
    animation: customAni 3s ease 0s infinite normal none;
    }
    .ribbonn:after {
    content: "";
    position: absolute;
    z-index: -1;
    inset: 10%;
    rotate: 45deg;
    outline: .1em solid #0003;
    background: var(--c);
    outline-offset: -.4em;
    border-radius: .3em;
    }

    @keyframes customAni {
    0% {
        opacity: 1;
    }

    50% {
        opacity: 0.2;
    }

    100% {
        opacity: 1;
    }
    }


    /* @import url("https://fonts.googleapis.com/css2?family=Angkor&display=swap"); */

    .svgm {
        /* font-family: "Angkor", sans-serif; */
        width: 100%; height: 100%;
    }
    .svgm text {
        animation: stroke 5s infinite alternate;
        stroke-width: 2;
        stroke: #000000;
        /* font-size: 100px; */
    }
    @keyframes stroke {
        0%   {
            fill: rgba(78,27,44,0); stroke: rgba(0,0,0,1);
            stroke-dashoffset: 25%; stroke-dasharray: 0 50%; stroke-width: 2;
        }
        70%  {fill: rgba(78,27,44,0); stroke: rgba(0,0,0,1); }
        80%  {fill: rgba(78,27,44,0); stroke: rgba(0,0,0,1); stroke-width: 3; }
        100% {
            fill: rgba(78,27,44,1); stroke: rgba(0,0,0,0);
            stroke-dashoffset: -25%; stroke-dasharray: 50% 0; stroke-width: 0;
        }
    }

    .wrapperr {background-color: #ffffff};

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
                        <li class="sidebar-item selected"> <a class="sidebar-link sidebar-link font-weight-medium" href="{{ route('consult.dashboard') }}"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i>
                                <span>Dashboard</span></a>
                        </li>

                        {{-- @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                            <li class="list-divider"></li>

                            <li class="sidebar-item">
                                <a class="sidebar-link font-weight-medium" href="{{ route('directeur.ActionsPrio') }}" aria-expanded="false">
                                    <i class="fa-solid fa-star me-2"></i>
                                    <span>Actions Prioritaires</span>
                                </a>
                            </li>
                        @endif --}}

                        <li class="list-divider"></li>

                        <li class="sidebar-item">
                            <a class="sidebar-link font-weight-medium" href="{{ route('directeur.proposition') }}" aria-expanded="false"><i class="fa-solid fa-wand-magic-sparkles me-2"></i>
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

                        {{-- @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                            
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('directeur.ActionsCop') }}" aria-expanded="false">
                                    <i class="fa solid fa-file-contract pe-3" ></i>
                                    <span>Actions COP</span>
                                </a>
                            </li>
                        @endif --}}

                        @if (auth()->user()->id_dir && auth()->user()->id_dir == '9')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('directeur.pageCalculate') }}"
                                    aria-expanded="false"><i class="fa-solid fa-calculator me-2 fa-lg"></i>
                                    <span class="font-weight-medium">Les calculs</span>
                                </a>
                            </li>
                        @endif
                        @php
                            $found = false;
                        @endphp

                        @foreach ($NumDenom as $item)
                            @if (auth()->user()->id_dir == $item->id_dc)
                                <li class="sidebar-item">
                                    <a class="sidebar-link font-weight-medium" href="{{ route('directeur.copAdd') }}" aria-expanded="false">
                                        <i class="fa-solid fa-file-circle-plus fa-lg me-1"></i>
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


                                    <div class="col-8">
                                        <div class="row">

                                            <div class="col-sm-12 col-lg-4">
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
                                                                <span class="opacity-7 text-muted">
                                                                    <div class="balls">
                                                                        <div></div>
                                                                        <div></div>
                                                                        <div></div>
                                                                    </div>
                                                                </span>
                                                            </div>
                                                            {{-- <div class="ms-auto mt-md-3 mt-lg-0">
                                                                <span class="opacity-7 text-muted"><i data-feather="activity" class="text-dark"></i></span>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
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

                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card border-end " style="background: linear-gradient(to right, #f83832c7, #ffffff);">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">{{$etatRet}}</h2>
                                                                <h6 class="font-weight-medium mb-0 w-100 text-dark" >Actions Echues</h6>
                                                            </div>
                                                            <div class="ms-auto mt-md-3 mt-lg-0">
                                                                <span class="opacity-7 text-dark"><i class="fa-solid fa-hourglass-end fa-xl"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
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



                                            <div style="width: 65%"  >

                                                <div class="row">
                                                    <div class="col-md-6 ">
                                                        <h5>Temp Écoulé : <dive id="tmpDr" class="fw-bold text-dark"> {{$percentageElapsed}}% </dive> </h5>
                                                    </div>
                                                    
                                                    <div class="col-md-13">
                                                        <div class="progress">
                                                            <div id="progres1Dr" class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: {{$percentageElapsed}}%" aria-valuenow="{{$percentageElapsed}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <h5>Avancement : <dive id="avcDr" class="fw-bold text-dark"> {{$averageEtat}}% </dive> </h5>
                                                    </div>
                                                    <div class="col-md-13">
                                                        <div class="progress">
                                                            <div id="progres2Dr" class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style= "width: {{$averageEtat}}%;" aria-valuenow="{{$averageEtat}}%" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>




                                                                        {{-- <div id="atteinte2">
                                                                            <span class="atteinte"></span>
                                                                            <span class="atteinte"></span>
                                                                            <span class="atteinte"></span>
                                                                            <span class="atteinte"></span>
                                                                        </div> --}}
                                        {{-- animate-border --}}

                                    <div class="col-4">
                                        <div class="card border-warning p-0">
                                            <div class="card-header bg-warning text-center font-weight-medium text-dark">Actions seront atteintes dans 10 jours
                                                {{-- <div class="wrapperr"> --}}
                                                    {{-- <svg class="svgm">
                                                        <text x="50%" y="50%" dy=".35em" text-anchor="middle">
                                                            
                                                        </text>
                                                    </svg> --}}
                                                {{-- </div> --}}
                                            </div>
                                            <div class="card-body">
                                                {{-- <h5 class="card-title">Actions seront atteintes dans 10 jours :</h5> --}}
                                                <div class="row justify-content-center">
                                                    {{-- <div class="col-md-8 col-lg-5">
                                                        <div class="card rounded-pill border-end ">
                                                            <div class="card-body ">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="">
                                                                        <h4 class="text-dark d-flex mb-1 w-100 text-truncate font-weight-medium">
                                                                            @if($actionsInDanger == 1)
                                                                            <span style="margin-right: 8px; font-size: x-large">
                                                                                {{$actionsInDanger}}
                                                                            </span> 
                                                                            <span style="margin-top: 4px;">Action sera atteinte dans 10 jours</span>
                                                                            
                                                                        @else
                                                                            <span style="margin-right: 8px; font-size: x-large">
                                                                                {{$actionsInDanger}}
                                                                            </span> 
                                                                            <span style="margin-top: 4px;">Actions seront atteintes dans 10 jours</span>
                                                                            <div id="atteinte2">
                                                                                <span class="atteinte"></span>
                                                                                <span class="atteinte"></span>
                                                                                <span class="atteinte"></span>
                                                                                <span class="atteinte"></span>
                                                                            </div>
                                                                            
                                                                        @endif
                                                                        </h4>
                                                                    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}

                                                    <div class="ribbonn d-flex justify-content-center align-items-center">
                                                        <div style="margin-top: 25%;" class="">
                                                            
                                                            <h2 class="text-dark font-weight-medium">{{$actionsInDanger}}</h2>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    {{-- </div> --}}
                                {{-- </div> --}}


                        








                            <div class="card mt-3">
                                {{-- <div class="details-content"> --}}
                                    <table class="table border" id="dir_planif">
                                        <thead style="background-color: rgba(0, 133, 198, 0.74); color: #fff;">
                                            <tr>
                                                <th class="text-center h4">Code Action</th>
                                                <th class="text-center h4">Action</th>
                                                <th class="text-center h4">Date début</th>
                                                <th class="text-center h4">Date fin</th>
                                                <th class="text-center h4">Statut</th>
                                                <th class="text-center h4">Etat (Temps écoulé/Avancement)</th>
                                            </tr>
                                        </thead>

                                        <tbody class="table-group-divider">
                                            @foreach ($actions as $action)

                                                @php
                                                    $prio = $action->prioritaires; 
                                                @endphp

                                                <tr class="expandable" style="background-color: #f7f7f7;">
                                                    <td>{{ $action->code_act }}</td>
                                                    <td>
                                                        @if($action->id_p != '' && $action->id_cop != '')
                                                            
                                                            <div class="row">
                                                                <div class="col-md-8 col-lg-12">
                                                                    
                                                                        <div class="card-body">
                                                                            <div class="ribbon">C O P</div>
                                                                                <div class="d-flex align-items-center"> 
                                                                                    <span class="fs-6">
                                                                                        {{ $action->lib_act }}
                                                                                    </span>
                                                                                
                                                                                    <i class="fa-solid fa-star fa-beat ms-2" style="color: #FFD43B;" 
                                                                                        data-bs-toggle="tooltip" 
                                                                                        data-bs-placement="top" 
                                                                                        data-bs-original-title="{{ $prio->lib_p }}" 
                                                                                        title="">
                                                                                    </i>
                                                                                </div>
                                                                            
                                                                        </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        @elseif($action->id_cop != '')
                                                            
                                                            <div class="row">
                                                                <div class="col-md-8 col-lg-12">
                                                                    
                                                                        <div class="card-body">
                                                                            <div class="ribbon">C O P</div>
                                                                            <div class="d-flex align-items-center"> 
                                                                                <div>
                                                                                    <span class="fs-6">
                                                                                        {{ $action->lib_act }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        @elseif($action->id_p != '')
                                                            <span class="fs-6">
                                                                {{ $action->lib_act }}
                                                                <i class="fa-solid fa-star fa-beat" style="color: #FFD43B;" 
                                                                    data-bs-toggle="tooltip" 
                                                                    data-bs-placement="top" 
                                                                    data-bs-original-title="{{ $prio->lib_p }}" 
                                                                    title="">
                                                                </i>
                                                            </span>
                                                        @else
                                                            <span class="fs-6">
                                                                {{ $action->lib_act }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>{{ date('d/m/Y', strtotime($action->dd)) }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($action->df)) }}</td>
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

                                                <tr class="sub-table">

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
                                                            $actionMonthNumber = \Carbon\Carbon::parse($action->dd)->month;


                                                            $found = '0';
                                                            $found2 = '0';
                                                            $foundX = '1';

                                                            foreach ($desc_idAct_date as $desc){
                                                                if ($desc->id_act == $action->id_act && $desc->mois == ($month -1)){    
                                                                    $found = '1';
                                                                    break;
                                                                }
                                                            }
                                                            foreach ($desc_idAct_date as $desc){
                                                                if ($desc->id_act == $action->id_act && $desc->mois == ($month -2)){    
                                                                    $found2 = '1';
                                                                    break;
                                                                }
                                                            }


                                                            foreach ($desc_idAct_date as $desc){
                                                                if ($currentMonthNumber >= '4'){
                                                                    if ($desc->id_act == $action->id_act && $desc->mois == ($month -3) && $currentMonthNumber >= $actionMonthNumber)
                                                                    {    
                                                                        $foundX = '0';
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            
                                                        @endphp
                                                        @if ( $foundX == '0')

                                                            @if($found2 == '0' && $currentMonthNumber != '1' && $currentMonthNumber != '2' && $action->etat < '100')

                                                                <button type="button" class="btn btn-outline-danger my-3 fs-4" style="float: right; font-family: 'Times New Roman', Times, serif" data-bs-toggle="modal" data-bs-target="#pr2{{$action->id_act}}">
                                                                    {{-- <i class="fa-solid fa-backward me-1"></i> --}}
                                                                    Mois {{$months[$currentMonthNumber -2]}}<i class="fa-solid fa-circle-plus fa-lg ms-1"></i>
                                                                </button>

                                                            @elseif ($found == '0' && $currentMonthNumber != '1' && $action->etat < '100')
                                                                <button type="button" class="btn btn-outline-warning my-3 fs-4" style="float: right; font-family: 'Times New Roman', Times, serif" data-bs-toggle="modal" data-bs-target="#pr{{$action->id_act}}">
                                                                    {{-- <i class="fa-solid fa-backward me-1"></i> --}}
                                                                    Mois Précédent <i class="fa-solid fa-circle-plus fa-lg ms-1"></i>
                                                                </button>
                                                            @else

                                                                {{-- @if($day<=26)$action->df > $currentDateD  $descriptionCounts[$action->id_act] == 0 && --}}
                                                                @if( $action->etat < '100')
                                                                    <button type="button" class="btn btn-outline-success my-3 fs-4" style="float: right; font-family: 'Times New Roman', Times, serif" data-bs-toggle="modal" data-bs-target="#{{$action->id_act}}">
                                                                        {{-- <i class="fa-solid fa-thumbtack fa-fade fa-sm me-1"></i> --}}
                                                                        Mois Actuel <i class="fa-solid fa-circle-plus fa-lg ms-1"></i> 
                                                                    </button>
                                                                @endif
                                                                {{-- @endif --}}

                                                            @endif

                                                        @endif
                                                            
                                                        
                                                        {{-- Ajouter description --}}
                                                        <div class="modal fade" id="{{$action->id_act}}" tabindex="-1" role="dialog"
                                                                aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-full-width">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-info">
                                                                        <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act}}</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                            aria-hidden="true"></button>
                                                                    </div>

                                                                    <form method="POST" action="{{Route('directeur.dashboard.add_desc')}}">
                                                                        @csrf

                                                                        <div class="modal-body">


                                                                                <div class="row">
                                                                                    <div class="justify-content-center">
                                                                                        
                                                                                            <div style="text-align: center">
                                                                                                <h3><i class="fa-solid fa-calendar-days text-muted"></i> <span class="font-weight-medium">{{$months[$currentMonthNumber]}}</span></h3>
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
                                                                                            <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act}}" value="0">
                                                                                            <span name="rangeValue" id="rangeValue{{$action->id_act}}">0%</span>
                                                                                        @else
                                                                                            <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act}}" value="{{$action->etat}}">
                                                                                            <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act}}">{{$action->etat}}%</span>
                                                                                        @endif
                                                                                    </div>
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

                                                        {{-- Ajouter description_pre --}}
                                                        <div class="modal fade" id="pr{{$action->id_act}}" tabindex="-1" role="dialog"
                                                                aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-full-width">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-info">
                                                                        <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act}}</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                            aria-hidden="true"></button>
                                                                    </div>

                                                                    <form method="POST" action="{{Route('directeur.dashboard.add_desc_pre')}}">
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
                                                                                            <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act}}" value="0">
                                                                                            <span name="rangeValue" id="rangeValue{{$action->id_act}}">0%</span>
                                                                                        @else
                                                                                            <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act}}" value="{{$action->etat}}">
                                                                                            <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act}}">{{$action->etat}}%</span>
                                                                                        @endif
                                                                                    </div>
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

                                                        {{-- Ajouter description_pre2 -2 mois --}}
                                                        <div class="modal fade" id="pr2{{$action->id_act}}" tabindex="-1" role="dialog"
                                                                aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-full-width">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-info">
                                                                        <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act}}</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                            aria-hidden="true"></button>
                                                                    </div>

                                                                    <form method="POST" action="{{Route('directeur.dashboard.add_desc_pre2')}}">
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
                                                                                            <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act}}" value="0">
                                                                                            <span name="rangeValue" id="rangeValue{{$action->id_act}}">0%</span>
                                                                                        @else
                                                                                            <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act}}" value="{{$action->etat}}">
                                                                                            <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act}}">{{$action->etat}}%</span>
                                                                                        @endif
                                                                                    </div>
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








                                                        

                                                    <div class="ms-1 ps-2">
                                                        
                                                            <table class="table">
                                                                <thead style="background-color: #6a75e9; color: #fff">
                                                                    <tr>
                                                                        <th class="text-center" style="width: 25%;">Ce qui a été fait</th>
                                                                        <th class="text-center" style="width: 25%;">Ce qui reste à faire</th>
                                                                        <th class="text-center">Mois</th>
                                                                        <th class="text-center" style="width: 16%;">Date de remplissage</th>
                                                                        <th class="text-center" style="width: 19%;">Contraintes</th>
                                                                        <th class="text-center" style="width: 15%;">Avancement (%)</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="table-group-divider" style="width: 100px">
                                                                    
                                                                    @php
                                                                        $btnDisplayed = 'false';
                                                                    @endphp
                                                                    
                                                                    @foreach ($descriptions as $desc)
                                                                        @if ($desc->id_act == $action->id_act)
                                                                            @php
                                                                                $descMonth = \Carbon\Carbon::parse($desc->date)->month;
                                                                                
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
                                                                                            <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act}}</h4>
                                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                                aria-hidden="true"></button>
                                                                                        </div>

                                                                                        <form method="POST" action="{{Route('directeur.dashboard.update_desc')}}">
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
                                                                                                            <i class="fa-solid fa-circle-info"></i><div class="ms-2">Etat d'avancement de l'action</div>
                                                                                                        </div>
                                                                                                    
                                                                                                        <div class="col-8 mb-3 border border-1 border-primary border-start-0 p1">
                                                                                                            @if ($action->etat == '')
                                                                                                                <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act}}" value="0">
                                                                                                                <span name="rangeValue" id="rangeValue{{$action->id_act}}">0%</span>
                                                                                                            @else
                                                                                                                <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act}}" value="{{$action->etat}}">
                                                                                                                <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act}}">{{$action->etat}}%</span>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <input type="hidden" name="id_act" value="{{$action->id_act}}">
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
                                                                                    </div><!-- /.modal-content -->
                                                                                </div><!-- /.modal-dialog -->
                                                                            </div><!-- /.modal -->

                                                                            <tr style="background-color:#d7ddf8">
                                                                                <td class="td1">{{$desc->faite}}</td>
                                                                                <td class="td2">{{$desc->a_faire}}</td>
                                                                                <td>{{$months[$moiss]}}</td>
                                                                                <td class="td3 text-center">
                                                                                
                                                                                    @if ($desc->mois <= $mm2)
                                                                                        <span class="me-1">{{ date('d-m-Y H:i', strtotime($desc->date))}}</span> <span style="color: rgb(255, 96, 96);"><i class="fa-solid fa-stopwatch fa-lg"></i></span>
                                                                                    @else
                                                                                        <span>{{ date('d-m-Y H:i', strtotime($desc->date))}}</span>
                                                                                    @endif


                                                                                    @if ($desc->date_update !='')
                                                                                        <br>
                                                                                        <span class="text-success me-1">{{ date('d-m-Y H:i', strtotime($desc->date_update))}}</span><i class="fa-solid fa-pen fa-sm text-success"></i>
                                                                                    @endif

                                                                                </td>
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
                                                                                    @if($desc->date_update == '' && $action->df > $currentDateD  && $action->etat < '100' && $desc->mois == $currentMonthNumber)
                                                                                        <td colspan="5" class="text-end">
                                                                                            <button type="button" class="btn btn-outline-success px-3 me-1" data-bs-toggle="modal" data-bs-target="#d{{$desc->id_desc}}">
                                                                                                Modifier Mois Actuel<i class="fa-solid fa-pen-to-square ms-1"></i>
                                                                                            </button>
                                                                                        </td>
                                                                                    @endif
                                                                                
                                                                                {{-- @endif --}}




                                                                                

                                                                                @foreach ($descriptionsMPre as $desc2)
                                                                                    {{-- @if () --}}
        
                                                                                        @php
                                                                                            $descMonth = \Carbon\Carbon::parse($desc2->date)->month;
                                                                                            $moiss = (int) $desc2->mois;
                                                                                        @endphp
        
                                                                                        
                                                                                            {{-- $btnDisplayed_2 =='false' && --}}
                                                                                        @if( $btnDisplayed =='false' && $desc2->id_act == $action->id_act && $desc2->date_update == '' && $action->df > $currentDateD  && $action->etat < '100' && ($desc2->mois == ($currentMonthNumber - 1)))
                                                                                            <td colspan="6" class="text-end">   
                                                                                                <button type="button" class="btn btn-outline-warning px-3 me-1" data-bs-toggle="modal" data-bs-target="#d2{{$desc2->id_desc}}">
                                                                                                    Modifier Mois Précédent<i class="fa-solid fa-pen-to-square ms-1"></i>
                                                                                                </button>
                                                                                            </td>

                                                                                            {{-- Update description2  --}}
                                                                                            <div class="modal fade" id="d2{{$desc2->id_desc}}" tabindex="-1" role="dialog"
                                                                                                    aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                                                                                <div class="modal-dialog modal-full-width">
                                                                                                    <div class="modal-content">
                                                                                                        <div class="modal-header bg-success">
                                                                                                            <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act}}</h4>
                                                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                                                aria-hidden="true"></button>
                                                                                                        </div>
                
                                                                                                        <form method="POST" action="{{Route('directeur.dashboard.update_desc2')}}">
                                                                                                            @csrf
                
                                                                                                            <div class="modal-body">
                                                                                                                    {{-- Le modification est une (1) fois par mois --}}
                                                                                                                    <div class="col-12 alert alert-success d-flex align-items-center justify-content-center" role="alert">
                                                                                                                        <i class="fa-solid fa-triangle-exclamation fa-beat"></i><div class="ms-2">Si vous modifiez, vous ne pourrez plus changer</div>
                                                                                                                    </div>
                
                                                                                                                    <div class="justify-content-center">
                                                                                                                        <div style="text-align: center">
                                                                                                                            <h3><i class="fa-solid fa-calendar-days text-muted"></i> <span class="font-weight-medium">{{$months[$moiss]}}</span></h3>
                                                                                                                        </div>
                                                                                                                    </div>
                
                                                                                                                    <div class="form-floating mb-3">
                                                                                                                        <textarea class="form-control" style="background-color: #f8f8f8;" name="Input1" placeholder="" id="Input1" style="height: 130px">{{$desc2->faite}}</textarea>
                                                                                                                        <label for="Input1">Ce qui a été fait</label>
                                                                                                                    </div>
                
                                                                                                                    <div class="form-floating mb-3">
                                                                                                                        <textarea class="form-control" style="background-color: #f8f8f8;" name="Input2" placeholder="" id="Input2" style="height: 130px">{{$desc2->a_faire}}</textarea>
                                                                                                                        <label for="Input2">Ce qui reste à faire</label>
                                                                                                                    </div>
                
                                                                                                                    <div class="form-floating mb-3">
                                                                                                                        <textarea class="form-control" style="background-color: #f8f8f8;" name="Input3" placeholder="" id="Input3" style="height: 130px">{{$desc2->probleme}}</textarea>
                                                                                                                        <label for="Input3">Contraintes</label>
                                                                                                                    </div>
                
                                                                                                                    <div class="row justify-content-center">
                                                                                                                        <div class="col-3 alert alert-primary d-flex align-items-center text-center" role="alert">
                                                                                                                            <i class="fa-solid fa-circle-info"></i><div class="ms-2">Etat d'avancement de l'action</div>
                                                                                                                        </div>
                                                                                                                    
                                                                                                                        <div class="col-8 mb-3 border border-1 border-primary border-start-0 p1">
                                                                                                                            @if ($action->etat == '')
                                                                                                                                <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act}}" value="0">
                                                                                                                                <span name="rangeValue" id="rangeValue{{$action->id_act}}">0%</span>
                                                                                                                            @else
                                                                                                                                <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act}}" value="{{$action->etat}}">
                                                                                                                                <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act}}">{{$action->etat}}%</span>
                                                                                                                            @endif
                                                                                                                        </div>
                                                                                                                    </div>
                
                                                                                                                    <input type="hidden" name="id_act" value="{{$action->id_act}}">
                                                                                                                    <input type="hidden" name="id_desc" value="{{$desc2->id_desc}}">
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
                                                                                                    </div><!-- /.modal-content -->
                                                                                                </div><!-- /.modal-dialog -->
                                                                                            </div><!-- /.modal -->
                                                                                            
                                                                                            @php
                                                                                                $btnDisplayed = 'true';
                                                                                            @endphp 
                                                                                        @endif
                                                                                        
                                                                                    {{-- @endif --}}
                                                                                @endforeach



































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
