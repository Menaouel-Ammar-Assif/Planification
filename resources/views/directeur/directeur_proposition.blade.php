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

    <link rel="stylesheet" href="{{asset('assets/all.min.css')}}">
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

        <aside class="left-sidebar" data-sidebarbg="skin6" style="background-color:  rgba(49, 148, 175, 0.556)">

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

        <div class="page-wrapper" style="background-color: #dfe8f0">
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
            <div class="container">

                @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                    <div class="row">
                        <div class="col-12">

                            <div class="card border-end ">
                                <div class="card-body">
                                <div class="card-header mb-1  text-dark">
                                    <h3 class="font-weight-medium">Proposer des actions aux Directions Régionales</h3>
                                </div>

                                <form action="{{ Route('directeur-proposition.add_act_pro') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-4" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
                                        <label for="act_pro" class="form-label p-2">Proposez une action</label>
                                        <textarea class="form-control" id="act_pro" name="act_pro"></textarea>
                                    </div>

                                    <div class="row ms-1 me-1 mb-4" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">

                                        <div class="col-5">
                                            <div class="mb-4 col-6 mt-3" >
                                                <label for="dd" class="form-label font-weight-medium">Choisissez la date de début</label>
                                                <input type="date" class="form-control" style="box-shadow: rgba(255, 255, 255, 0.17) 0px -23px 25px 0px inset, rgba(255, 255, 255, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;" id="dd" name="dd">
                                            </div>

                                            <div class="mb-4 col-6">
                                                <label for="df" class="form-label font-weight-medium">Choisissez la date de fin</label>
                                                <input type="date" class="form-control" id="df" name="df" style="box-shadow: rgba(255, 255, 255, 0.17) 0px -23px 25px 0px inset, rgba(255, 255, 255, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;">
                                            </div>
                                        </div>
                                        
                                        <div class="col-7 p-3" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
                                            <h3 class="text-dark font-weight-medium">Directions Régionales</h3>
                                            @foreach ($directionsDr as $dr)
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input" role="switch" name="selected_dr[]" value="{{ $dr->id_dir }}">
                                                    <label class="form-check-label">{{ $dr->lib_dir }}</label>
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="row ms-1 me-1 justify-content-between">
                                        {{-- <div class="mb-4 col-7 p-3" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
                                            <h3 class="text-dark font-weight-medium">Indicateurs</h3>
                                            @foreach ($indicateurs as $ind)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="selected_indicateurs[]" value="{{ $ind->id_ind }}">
                                                    <label class="form-check-label">{{ $ind->lib_ind }}</label>
                                                </div>
                                            @endforeach
                                        </div> --}}

                                        
                                        
                                        <div class=" float-end">
                                            <button type="submit" class="btn btn-lg rounded-pill btn-success ps-3 pe-3 font-weight-medium align-text-bottom" style="float: inline-end;">Valider</button>
                                        </div>
                                    </div>

                                    
                                </form>





                                </div>
                            </div>

                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_act_pro" class="table border">

                                    @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)

                                        <thead>
                                            <tr class="table-primary">
                                                <th>Action Proposée</th>
                                                <th>Date Début</th>
                                                <th>Date Fin</th>
                                                <th>Directions Régionales</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $uniqueRows = [];
                                            @endphp
                                            @foreach ($actions as $action)
                                                    @php
                                                        $row = $action->lib_act_pro . '_' . $action->dd . '_' . $action->df . '_' . $dr->lib_dir;
                                                    @endphp
                                                    @if (!in_array($row, $uniqueRows))
                                                        <tr>
                                                            <td>{{ $action->lib_act_pro }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($action->dd)) }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($action->df)) }}</td>
                                                            <td>
                                                                @foreach($directionsDr as $dr) 
                                                                    @foreach($action->actionsProDrs as $p)
                                                                        @if($dr->id_dir == $p->id_dir)
                                                                            {{$dr->lib_dir}}
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $uniqueRows[] = $row;
                                                        @endphp
                                                    @endif
                                            @endforeach

                                    @else
                                    <thead>
                                        <tr class="table-primary">
                                            <th>Action Proposée</th>
                                            <th>Date Début</th>
                                            <th>Date Fin</th>
                                            <th>Structure Centrale</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @php
                                                $uniqueRows = [];
                                            @endphp
                                            @foreach ($actions as $action)
                                                @php
                                                    $row = $action->lib_act_pro . '_' . $action->dd . '_' . $action->df;
                                                @endphp
                                                <tr>
                                                    <td>{{ $action->lib_act_pro }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($action->dd)) }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($action->df)) }}</td>
                                                    <td>
                                                        @foreach ($action->actionsProDrs as $a)
                                                            @if (!in_array($row, $uniqueRows))
                                                                {{$a->lib_created_by}}
                                                                @php
                                                                    $uniqueRows[] = $row;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
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



    $(document).ready(function() {
        $('.details-content').each(function() {
            $(this).find('table').DataTable();
        });
    });

</script>



<script>
$(document).ready(function() {
    $('#zero_act_pro').DataTable();
});
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

        rangeInput.addEventListener('input', function() {
            rangeValueSpan.textContent = rangeInput.value;
        });
        });
    });
</script>
{{------------------------------------------PROPOSER ACTION-------------------------------------------}}
{{--------------------------------------Get Sous Objectifs List ---------------------------------}}
<script>
    $(document).ready(function () {
        $('#obj').change(function () {
            var objId = $(this).val();

                $.ajax({
                    type: "GET",
                    url: '/directeur/proposition/getSousObjs/' + objId,
                    success: function (response) {


                        var response = JSON.parse(response);

                        $('#sousObjList').empty();
                        $('#sousObjList').append(`<option value="0" disabled selected>Selectionner un sous objectif *</option>`);

                        response.forEach(element => { $('#sousObjList').append(`<option value="${element['id_sous_obj']}">${element['lib_sous_obj']}</option>`); });

                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
                });
        });
    });
</script>



</body>

</html>
