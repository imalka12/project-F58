@extends('layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Dashboards @endslot
        @slot('title') Dashboard @endslot
    @endcomponent

    <div class="container">
        <div class="row">
            <div class="col-xl-4">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-3">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="img-thumbnail rounded-circle">
                                </div>
                                <h5 class="font-size-15 text-truncate">{{ auth()->user()->firstname }}</h5>
                            </div>

                            <div class="col-sm-8">
                                <div class="pt-4">

                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="font-size-15">{{ $totalUsers }}</h5>
                                            <p class="text-muted mb-0">Users</p>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="font-size-15">{{ $totalAds }}</h5>
                                            <p class="text-muted mb-0">Ads</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Monthly Earning</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="text-muted">This month</p>
                                <h3>Rs. {{ number_format($thisMonthTotalEarnings['payments']['thisMonth']) }}</h3>
                                <p class="text-muted">
                                    @if ($variationAmount > 0)
                                    <span class="text-success me-2">
                                        {{ number_format($upDownPercentage) }}%
                                        <i class="mdi mdi-arrow-up"></i>
                                    </span>
                                    @else
                                    <span class="text-danger me-2">
                                        {{ number_format($upDownPercentage) }}%
                                        <i class="mdi mdi-arrow-down"></i>
                                    </span>
                                    @endif
                                    From previous period
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <div class="" style="display: none;">
                                    <div id="radialBar-chart" class="apex-charts"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <h4 class="mt-2 mb-4">Advertisement Statistics - {{ date('F, Y') }}</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Published</p>
                                        <h4 class="mb-0">{{ $currentMonthPublishedAds }}</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                            <span class="avatar-title">
                                                <i class="bx bx-copy-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Promotions</p>
                                        <h4 class="mb-0">{{ $currentMonthPromotedAds }}</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center ">
                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-archive-in font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Renewals</p>
                                        <h4 class="mb-0">{{ $currentMonthRenewedAds }}</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex flex-wrap">
                            <h4 class="card-title mb-4">Advertisements Summary {{ date('Y') }}</h4>
                        </div>
                        <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>

@endsection

@section('script')
    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script>
        function generateMonthlyRevenueBarChart() {
            let options = {
                chart: {
                    height: 360,
                    type: "bar",
                    stacked: !0,
                    toolbar: {
                        show: !1
                    },
                    zoom: {
                        enabled: !0
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        columnWidth: "15%",
                        endingShape: "rounded"
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                series: [{
                        name: "Published",
                        data: {{ json_encode($yearlyAdStats['published']) }}
                    },
                    {
                        name: "Promoted",
                        data: {{ json_encode($yearlyAdStats['promoted']) }}
                    },
                    {
                        name: "Renewed",
                        data: {{ json_encode($yearlyAdStats['renewed']) }}
                    },
                ],
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
                },
                colors: ["#556ee6", "#f1b44c", "#34c38f"],
                legend: {
                    position: "top"
                },
                fill: {
                    opacity: 1
                },
            };
            let chart = new ApexCharts(document.querySelector("#stacked-column-chart"), options);
            chart.render();
        }

        function generateIncomeRadialChart() {
            let options = {
                chart: {
                    height: 200,
                    type: "radialBar",
                    offsetY: -10
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -135,
                        endAngle: 135,
                        dataLabels: {
                            name: {
                                fontSize: "13px",
                                color: void 0,
                                offsetY: 60
                            },
                            value: {
                                offsetY: 22,
                                fontSize: "16px",
                                color: void 0,
                                formatter: function(e) {
                                    return e + "%";
                                },
                            },
                        },
                    },
                },
                colors: ["#556ee6"],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        shadeIntensity: 0.15,
                        inverseColors: !1,
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 50, 65, 91]
                    }
                },
                stroke: {
                    dashArray: 4
                },
                series: ['{{ $upDownPercentage }}'],
                labels: ["Income Variance"],
            };
            // new ApexCharts(document.querySelector("#radialBar-chart"), options).render();
        }

        generateMonthlyRevenueBarChart();
        generateIncomeRadialChart();
    </script>
@endsection

@section('css')

@endsection
