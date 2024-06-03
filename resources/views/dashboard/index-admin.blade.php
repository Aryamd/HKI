@extends('layouts.vertical', ["page_title"=> "Dashboard"])

@section('css')
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/selectize/selectize.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li> --}}
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="widget-rounded-circle card bg-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="avatar-lg rounded-circle bg-white border-white border">
                                <i class="fe-award font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="text-end">
                                <h3 class="text-white mt-1"><span data-plugin="counterup">{{ $nPaten }}</span></h3>
                                <h3 class="text-white mb-1 text-truncate">Total Paten</h3>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-4">
            <div class="widget-rounded-circle card bg-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="avatar-lg rounded-circle bg-white border-white border">
                                <i class="fe-gitlab font-22 avatar-title text-success"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="text-end">
                                <h3 class="text-white mt-1"><span data-plugin="counterup">{{ $nMerek }}</span></h3>
                                <h3 class="text-white mb-1 text-truncate">Total Merek</h3>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-4">
            <div class="widget-rounded-circle card bg-info">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="avatar-lg rounded-circle bg-white border-white border">
                                <i class="fe-film font-22 avatar-title text-info"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="text-end">
                                <h3 class="text-white mt-1"><span data-plugin="counterup">{{ $nHakCipta }}</span></h3>
                                <h3 class="text-white mb-1 text-truncate">Total Hak Cipta</h3>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-4">
            <div class="widget-rounded-circle card bg-warning">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="avatar-lg rounded-circle bg-white border-white border">
                                <i class="fe-layers font-22 avatar-title text-dark"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $nDesainIndustri }}</span></h3>
                                <h3 class="text-dark mb-1 text-truncate">Total Desain Industri</h3>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-4">
            <div class="widget-rounded-circle card bg-danger">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="avatar-lg rounded-circle bg-white border-white border">
                                <i class="fe-cpu font-22 avatar-title text-danger"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="text-end">
                                <h3 class="text-white mt-1"><span data-plugin="counterup">{{ $nDTLST }}</span></h3>
                                <h3 class="text-white mb-1 text-truncate">Total DTLST</h3>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div> --}}

                    <h4 class="header-title mb-0">Total Pengajuan HaKI</h4>

                    <div class="widget-chart text-center" dir="ltr">

                        <div id="total-pengajuan" class="mt-0" data-colors="#f1556c"></div>

                        <h5 class="text-muted mt-0">Total Pengajuan HaKI</h5>
                        <h2>{{ $nComplete }} / {{ $nAll }}</h2>

                        <p class="text-muted w-75 mx-auto sp-line-2">Total keseluruhan pengajuan HaKI baik Paten, Merek, Hak Cipta, Desain Industri, dan DTLST.</p>

                        {{-- <div class="row mt-3">
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                <h4><i class="fe-arrow-down text-danger me-1"></i>$7.8k</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                <h4><i class="fe-arrow-up text-success me-1"></i>$1.4k</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                                <h4><i class="fe-arrow-down text-danger me-1"></i>$15k</h4>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col-->

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body pb-2">
                    {{-- <div class="float-end d-none d-md-inline-block">
                        <div class="btn-group mb-2">
                            <button type="button" class="btn btn-xs btn-light">Today</button>
                            <button type="button" class="btn btn-xs btn-light">Weekly</button>
                            <button type="button" class="btn btn-xs btn-secondary">Monthly</button>
                        </div>
                    </div> --}}

                    <h4 class="header-title mb-3">Analisa Pengajuan</h4>

                    <div dir="ltr">
                        <div id="analisa-pengajuan" class="mt-4" data-colors="#6658dd,#1abc9c,#4fc6e1,#f7b84b,#f1556c"></div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col-->
    </div>
    <!-- end row -->

</div> <!-- container -->
@endsection

@section('script')
<script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/libs/selectize/selectize.min.js')}}"></script>

<script>
    $(document).ready(function() {
        //
        // Total Pengajuan
        //
        var colors = ['#f1556c'];
        var dataColors = $("#total-pengajuan").data('colors');
        if (dataColors) {
            colors = dataColors.split(",");
        }
        var options = {
            series: [{{ ($nComplete == 0 ? 0 : $nComplete/$nAll*100) }}],
            chart: {
                height: 310,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '65%',
                    }
                },
            },
            colors: colors,
            labels: ['Terselesaikan'],
        };

        var chart = new ApexCharts(document.querySelector("#total-pengajuan"), options);
        chart.render();


        //
        // Analisis Pengajuan
        //
        var colors = ['#6658dd','#1abc9c','#4fc6e1','#f7b84b','#f1556c'];
        var dataColors = $("#analisa-pengajuan").data('colors');
        if (dataColors) {
            colors = dataColors.split(",");
        }
        var options = {
            chart: {
                height: 378,
                type: 'line',
                zoom: {
                    enabled: false,
                },
                toolbar: {
                    show: false,
                },
            },
            colors: colors,
            dataLabels: {
                enabled: true,
            },
            stroke: {
                width: [2, 2, 2, 2, 2],
                curve: "smooth",
            },
            series: [
                {
                    name: 'Paten',
                    data: [0, 2, 1, 3, 5, 4, 7, 6, 8, 9, 11, 10]
                },
                {
                    name: 'Merek',
                    data: [0, 0, 1, 1, 0, 1, 2, 1, 2, 1, 0, 2]
                },
                {
                    name: 'Hak Cipta',
                    data: [1, 3, 3, 5, 5, 7, 7, 8, 8, 5, 7, 9]
                },
                {
                    name: 'Desain Industri',
                    data: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
                },
                {
                    name: 'DTLST',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }
            ],
            title: {
                text: "Total Pengajuan HaKI",
                align: "center",
                style: {
                    fontSize: "18px",
                    color: "#6c757d",
                },
            },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Okt", "Nop", "Des"],
                title: {
                    text: "Bulan 2024",
                },
            },
            yaxis: {
                title: {
                    text: "Pengajuan",
                },
                min: 0,
                max: 12,
            },
        };

        var chart = new ApexCharts(document.querySelector("#analisa-pengajuan"), options);
        chart.render();

        // // Datepicker
        // $('#dash-daterange').flatpickr({
        //     altInput: true,
        //     mode: "range",
        //     altFormat: "F j, y",
        //     defaultDate: 'today'
        // });
    });
</script>
@endsection
