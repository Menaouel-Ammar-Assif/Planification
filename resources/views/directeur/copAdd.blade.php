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

    <link rel="stylesheet" href="{{asset('assets/all.min.css')}}">
    <!-- This page css -->
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">

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
</style>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-lg" style="background-color: rgba(0, 76, 255, 0.56); max-height:5px;">
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


        <aside class="left-sidebar" data-sidebarbg="skin6" style="background-color:  rgba(0, 76, 255, 0.56);">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link font-weight-medium" href="{{ route('consult.dashboard') }}"
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
                            <a class="sidebar-link font-weight-medium" href="{{ route('directeur.proposition') }}" aria-expanded="false"><i class="fa-solid fa-wand-magic-sparkles me-2"></i>
                                @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                                    <span class="hide-menu">Proposer Des Actions</span>
                                @else
                                    <span class="hide-menu">Actions Ajustées</span>
                                @endif
                            </a>
                        </li>

                        
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu font-weight-medium">C O P</span></li>

                        @if (auth()->user()->id_dir && auth()->user()->id_dir == '9')
                            
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('directeur.pageCalculate') }}" 
                                    aria-expanded="false"><i class="fa-solid fa-calculator me-2 fa-lg"></i>
                                    <span>Les calculs</span>
                                </a>
                            </li>
                        @endif

                        <li class="sidebar-item">
                            <a class="sidebar-link font-weight-medium" href="{{ route('directeur.copAdd') }}" aria-expanded="false">
                                <i class="fa-solid fa-file-circle-plus fa-lg me-1"></i>
                                {{-- <i class="fa-solid fa-file-contract fa-lg pe-2"></i> --}}
                                <span>COP</span>
                            </a>
                        </li>

                        {{-- @if ($hasNegativeEcart)
                        @php
                            $periods = [
                                'trimestre' => 'Trimestre',
                                'semestre' => 'Semestre',
                                'neuf_mois' => 'Neuf mois',
                                'annuel' => 'Annuel',
                            ];
                        @endphp

                        @foreach ($periods as $periodKey => $periodLabel)
                            @if ($currentPeriod == $periodKey && $currentPeriod >= $periode)
                                <li class="list-divider"></li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link font-weight-medium" href="{{ route('directeur.analyse') }}" aria-expanded="false">
                                        <i class="fa-solid fa-magnifying-glass-chart fa-lg me-1"></i>
                                        <span>Analyse causale</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                        @endif --}}

                        
                        {{-- @foreach($indicateurs as $indicateur) --}}
                        @if($latestCobValeur->isNotEmpty())
                            <li class="sidebar-item">
                                <a class="sidebar-link font-weight-medium" href="{{ route('directeur.analyse') }}" aria-expanded="false">
                                    <i class="fa-solid fa-magnifying-glass-chart fa-lg me-1"></i>
                                    <span>Analyse causale</span>
                                </a>
                            </li>
                            {{-- @break  --}}
                        @endif
                    {{-- @endforeach --}}

                    
                    
                        


                        

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
                    @if (session()->has('success'))
                        <div class="container-fluid">
                            <div class="alert alert-success">
                                <h4>{{session()->get('success')}}</h4>
                            </div>
                        </div>
                    @endif


                    @php
                        $months = [
                                    3 => 'trimestre',
                                    6 => 'semestre',
                                    9 => 'neuf mois',
                                    12 => 'annuel',
                                ];
                        $currentMonthNumber = (int) $month;
                    @endphp
                    {{-- <div class="align-self-center">
                        <div class=" float-end mb-4" style="width: revert;">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected> <h1> {{$months[$currentMonthNumber]}} </h1> </option>
                            </select>
                        </div>
                    </div> --}}

                    <div class="col-lg-12">
                        <div class="ribbon">C O P</div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3" style="padding-top: 80px;">LISTE DES INFORMATIONS (DENOMINATEUR/NUMERATEUR) A INTEGRER DANS LE SYSTEME COP</h4>

                                    <form action="{{ route('directeur.CopAddStore') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="col-3 mt-4 mb-2" style="float: inline-end; padding: 8px;">
                                            <div class="input-group">
                                                
                                                <select class="form-select form-control formselect required custom-radius text-center" name="month" style="background-color: #49a4ff; color: #ffffff; text-transform: uppercase;" id="month">
                                                    @for ($i = 3; $i <= $currentMonthNumber; $i = $i+3)
                                                        @php
                                                            $paddedValue = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                        @endphp
                                                        <option value="{{ $paddedValue }}" {{ $i == $currentMonthNumber ? 'selected' : '' }}>
                                                            {{ $months[$i] }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                <label class="input-group-text font-weight-bold" for="month"><i class="fa-regular fa-calendar-days fa-xl"></i> </label>
                                            </div>
                                        </div>





                                        <table class="table table-bordered border-primary">
                                            <thead>
                                                <tr class="table-primary text-center">
                                                    <th scope="col">N°</th>
                                                    <th scope="col">CHAMPS A RENSEIGNER</th>
                                                    <th scope="col" id="addMonth"></th>
                                                </tr>
                                            </thead>
                                                {{-- <input class="py-3 px-1" type="text" placeholder="Écrire..." style="outline: none; border: none; background-color: #cfe2ff4d; width: -moz-available;"  data-nav="true" id="chmp" name="chmp">  --}}

                                            <tbody>
                                                @foreach ($NumDenom as $item)
                                                    @if ($item->id_dc == auth()->user()->id_dir)
                                                        @php
                                                            $val = '';
                                                        @endphp

                                                        @foreach($NumDenomVals as $ND)
                                                            @if($item->id_num_denom == $ND->id_num_denom)
                                                                <?php 
                                                                    $val = trim($ND->val);                                                                            
                                                                ?>
                                                            @endif
                                                        @endforeach

                                                        <tr>
                                                            <th scope="row" class="text-center">{{$item->id_num_denom}}</th>
                                                            <td>{{$item->lib_num_denom}}</td>
                                                            <td class="p-1">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control py-2 px-1" id="chmp{{$item->id_num_denom}}" value="{{$val}}" name="chmp{{$item->id_num_denom}}" aria-label="" style="outline: none; border: none; background-color: #cfe2ff4d;" placeholder="Écrire...">
                                                                    @switch($item->unite)
                                                                        @case('DA')
                                                                            <span class="input-group-text">DA</span>
                                                                            @break

                                                                        @case('NB')
                                                                            @break

                                                                        @case('HJ')
                                                                            <span class="input-group-text">heures/ jours</span>
                                                                            @break

                                                                        @case('H')
                                                                            <span class="input-group-text">heures/ heures disponibles</span>
                                                                            @break

                                                                        @case('J')
                                                                            <span class="input-group-text">jours</span>
                                                                            @break

                                                                        @default
                                                                        
                                                                    @endswitch
                                                                        
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            
                                        </table>

                                        <button type="button" class="btn btn-success float-end font-weight-medium" data-bs-toggle="modal" data-bs-target="#info-alert-modal">Ajouter</button>

                                        <!-- Info Alert Modal -->
                                        <div id="info-alert-modal" class="modal fade" tabindex="-1" role="dialog"
                                                aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center">
                                                            <i class="dripicons-information h1 text-info"></i>
                                                            <h4 class="mt-2" id="addMonthModel" ></h4>
                                                            

                                                            <button type="submit" class="btn btn-success my-2"
                                                                data-bs-dismiss="modal">Ajouter</button>
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->

                                        {{-- <button type="submit" class="btn btn-success float-end px-3 py-2" data-bs-dismiss="modal">Ajouter</button> --}}
                                    </form>
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
    <script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('dist/js/pages/datatable/datatable-basic.init.js')}}"></script>
    
    {{-- <script src="{{asset('dist/js/bootstrap.bundle.min.js')}}"></script> --}}
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    
    <script src="{{asset('dist/js/bootstrap.min.js')}}"></script>

    {{-- <script>
        $('#month').on('change', function () {
            let month = $(this).val();
            $('input[id^="chmp"]').val('');
            
            $.ajax({
                type: 'GET',
                url: '/addMonth/' + month,
                success: function (response) {
                    $('#addMonth').html('VALEUR ' + '<span class="text-danger" style="text-transform: uppercase">' + response.month + '</span>' + ' ' + response.year);
    
                    $.each(response.NumDenomVals, function(index, item) {
                        let value = item.val ? item.val : '';
                        $('#chmp' + item.id_num_denom).val(value);
                    });
                    },
                error: function (error) {
                    console.error('Il exist an Err:', error);
                }
            });
        });
    </script> --}}

    <script>
        $(document).ready(function () {
            // Trigger AJAX request on page load
            fetchData();
            
            // Bind AJAX request to the change event of the select dropdown
            $('#month').on('change', function () {
                fetchData();
            });
        });
        
        function fetchData() {
            let month = $('#month').val();
            $('input[id^="chmp"]').val('');
            
            $.ajax({
                type: 'GET',
                url: '/addMonth/' + month,
                success: function (response) {
                    $('#addMonth').html('VALEUR ' + '<span class="text-danger" style="text-transform: uppercase">' + response.month + '</span>' + ' ' + response.year);
                    $('#addMonthModel').html('Ajouter pour ' + '<span class="text-danger" style="text-transform: uppercase">' + response.month + '</span>' + ' ' + response.year);

                    $.each(response.NumDenomVals, function(index, item) {
                        let value = item.val ? item.val : '';
                        $('#chmp' + item.id_num_denom).val(value);
                    });
                },
                error: function (error) {
                    console.error('An error occurred:', error);
                }
            });
        }
    </script>
    
</body>
</html>