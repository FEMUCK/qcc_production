{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Dashboard Ecommerce')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/animate-css/animate.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard.css')}}"> --}}
@endsection

{{-- page content --}}
@section('content')
<?php
    foreach($data as $value){
        if(isset($data['cntbyactcat'])){
            $cntbyactcat = $data['cntbyactcat'];
        }
        if(isset($data['sumbycostcat'])){
            $sumbycostcat = $data['sumbycostcat'];
        }
    }

    // ประกาศตัวแปรไว้ก่อนใช้งานด้านบนนี้เลย เพื่อป้องกัน error กรณี sum แล้วเป็น null
    $act_cat = '';
    $cnt_act_cat = '';

    if(isset($cntbyactcat)){
        foreach($cntbyactcat as $cntbyactcat_item){
            $act_cat = $cntbyactcat_item->act_cat;
            $cnt_act_cat = $cntbyactcat_item->cnt_act_cat;

            // เนื่องจากข้อมูลมาเป็น array จึงต้องทำการกำหนด condition เพื่อให้สามารถ extract ค่าที่ต้องการออกมาใช้งานได้ มิฉะนั้นต้องเขียน Model แยก จะทำให้ code รกเกินความจำเป็น อีกวิธีนึงก็คือการ for loop ใน public function ของตัวมันเองแล้ว return ค่ามา
            if($act_cat == 'เทคนิค'){
                $act_cat1 = $act_cat;
                $cnt_act_cat1 = $cnt_act_cat;
            }elseif($act_cat == 'สำนักงาน'){
                $act_cat2 = $act_cat;
                $cnt_act_cat2 = $cnt_act_cat;
            }
        }
    }

    if(isset($sumbycostcat)){
        foreach($sumbycostcat as $sumbycostcat_item){
            $sum_reduced_cost = $sumbycostcat_item->sum_reduced_cost;
            $sum_available_capacity_improvement = $sumbycostcat_item->sum_available_capacity_improvement;
            $sum_increase_efficiency = $sumbycostcat_item->sum_increase_efficiency;
        }
    }else{
        $sum_reduced_cost = '';
        $sum_available_capacity_improvement = '';
        $sum_increase_efficiency = '';
    }
?>

<div class="section">
    <!--card stats start-->
    <div id="card-stats" class="pt-0">
        <div class="row">

            <div class="col s12 m4">
                <div class="card gradient-45deg-light-blue-cyan gradient-shadow border-radius-3 animate fadeLeft">
                    <div class="card-content center">
                        <img src="{{asset('images/icon/technique.svg')}}" alt="images" class="width-40" />
                        <h5 class="white-text lighten-4">{{ number_format($cnt_act_cat1) }}</h5>
                        <p class="white-text lighten-4">ผลงานด้าน{{ $act_cat1 }}</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card gradient-45deg-amber-amber gradient-shadow border-radius-3 animated fadeInDown">
                    <div class="card-content center">
                        <img src="{{asset('images/icon/office.svg')}}" alt="images" class="width-40" />
                        <h5 class="white-text lighten-4">{{ number_format($cnt_act_cat2) }}</h5>
                        <p class="white-text lighten-4">ผลงานด้าน{{ $act_cat2 }}</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card gradient-45deg-green-teal gradient-shadow border-radius-3 animate fadeRight">
                    <div class="card-content center">
                        <img src="{{asset('images/icon/allactivity.svg')}}" alt="images" class="width-40" />
                        <h5 class="white-text lighten-4">{{ number_format($cnt_act_cat1 + $cnt_act_cat2) }}</h5>
                        <p class="white-text lighten-4">ผลงานทั้งสิ้น</p>
                    </div>
                </div>
            </div>

            {{-- Number Format SOURCE : https://laracasts.com/discuss/channels/laravel/show-integer-price-separate-with-comma-or-dot?page=1 , https://www.oreilly.com/library/view/php-in-a/0596100671/re68.html#:~:text=The%20number_format()%20function%20rounds,adds%20commas%20in%20between%20thousands. --}}
            <div class="col s12 m4 l4 xl4">
                <div class="card gradient-45deg-indigo-blue gradient-shadow min-height-100 white-text animate fadeLeft">
                <div class="padding-4">
                    <div class="row">
                        <div class="col s7 m7">
                            <i class="material-icons background-round mt-5 mdi mdi-bitcoin prefix"></i>
                            <p>ลดค่าใช้จ่าย</p>
                        </div>
                        <div class="col s5 m5 right-align">
                            <h5 class="mb-0 white-text">{{ number_format($sum_reduced_cost,2) }}</h5>
                            <p class="no-margin">บาท/ปี</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col s12 m4 l4 xl4">
                <div class="card gradient-45deg-deep-orange-orange gradient-shadow min-height-100 white-text animated fadeInUp">
                <div class="padding-4">
                    <div class="row">
                        <div class="col s7 m7">
                            <i class="material-icons background-round mt-5 prefix">network_check</i>
                            <p>เพิ่มความพร้อมจ่าย</p>
                        </div>
                        <div class="col s5 m5 right-align">
                            <h5 class="mb-0 white-text">{{ number_format($sum_available_capacity_improvement,2) }}</h5>
                            <p class="no-margin">%/ปี</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col s12 m4 l4 xl4">
                <div style="background: linear-gradient(45deg,#1b5e20,#4caf50);" class="card gradient-shadow min-height-100 white-text animate fadeRight">
                    <div class="padding-4">
                        <div class="row">
                            <div class="col s7 m7">
                                <i class="material-icons background-round mt-5 mdi mdi-finance prefix"></i>
                                <p>เพิ่มประสิทธิภาพ</p>
                            </div>
                            <div class="col s5 m5 right-align">
                                <h5 class="mb-0 white-text">{{ number_format($sum_increase_efficiency,2) }}</h5>
                                <p class="no-margin">%/ปี</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--card stats end-->
    <!--yearly & weekly revenue chart start-->
    <div id="sales-chart">
        <div class="row">
            <div class="col s12 m8 l8">
                <!--Bar Chart-->
                <div id="chartjs-bar-chart" class="card animate fadeUp">
                    <div class="card-content">
                        <h4 class="card-title">ผลงานแยกประเภทตามสายรอง</h4>
                        <div class="row">
                            <div class="col s12">
                                {{-- <p class="mb-2">
                                    A bar chart is a way of showing data as bars. It is sometimes used to show trend data, and the
                                    comparison
                                    of multiple data sets side by side.
                                </p> --}}
                                <div class="sample-chart-wrapper">
                                    <canvas id="qcc-horizontalbar-chart" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m4 l4">
                <!--Polar Chart-->
                <div id="chartjs-polar-chart" class="card animate fadeUp">
                    <div class="card-content">
                        <h4 class="card-title">จำนวนผลงานแยกตามสายรอง</h4>
                        <div class="row">
                            <div class="col s12">
                                {{-- <p class="mb-2">
                                    Polar area charts are similar to pie charts, but each segment has the same angle - the radius of the
                                    segment differs depending on the value.
                                </p> --}}
                                <div class="sample-chart-wrapper">
                                    <canvas id="qcc-polar-chart" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m12 l12">
                <!--Bar Chart-->
                <div id="chartjs-bar-chart" class="card animate fadeUp">
                    <div class="card-content">
                        <h4 class="card-title">ค่าต่าง ๆ แยกตามสายรอง</h4>
                        <div class="row">
                            <div class="col s12">
                                <div class="sample-chart-wrapper">
                                    <canvas id="qcc-verticalbar-chart" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
    <!--yearly & weekly revenue chart end-->
    {{-- <div id="sales-chart">
        <div class="row">

            </div>
        </div>
    </div> --}}
    <!--end container-->
</div>
@endsection

{{-- vendor script --}}
@section('vendor-script')
<script src="{{asset('vendors/chartjs/chart.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/charts-chartjs.js')}}"></script>

<script>
$(document).ready(function(){

    var url = '{{ url('gethorizontalbarchartdata') }}';
    $.get(url, function (data) {
        // Bar chart
        // ------------

        //Get the context of the Chart canvas element we want to select
        var ctx = $("#qcc-horizontalbar-chart");

        // Chart Options
        var chartOptions = {
        // Elements options apply to all of the options unless overridden in a dataset
        // In this case, we are setting the border of each horizontal bar to be 2px wide and green
        elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: "rgb(0, 255, 0)",
                    borderSkipped: "left"
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            responsiveAnimationDuration: 500,
            legend: {
                position: "top"
            },
            scales: {
                xAxes: [
                    {
                    display: true,
                    gridLines: {
                        color: "#f3f3f3",
                        drawTicks: false
                    },
                    scaleLabel: {
                        display: true
                    }
                }
            ],
            yAxes: [
                    {
                        display: true,
                        gridLines: {
                            color: "#f3f3f3",
                            drawTicks: false
                        },
                        scaleLabel: {
                            display: true
                        }
                    }
                ]
            },
            title: {
                display: false,
                text: "Chart.js Horizontal Bar Chart"
            }
        };

        // Chart Data
        var chartData = {
            labels: data.labels,
            datasets: [
                {
                    label: "ผลงานด้านเทคนิค",
                    data: data.datatechnique,
                    backgroundColor: "#03a9f4",
                    hoverBackgroundColor: "#0288d1",
                    borderColor: "transparent"
                },
                {
                    label: "ผลงานด้านสำนักงาน",
                    data: data.dataoffice,
                    backgroundColor: "#ffc107",
                    hoverBackgroundColor: "#ffa000",
                    borderColor: "transparent"
                }
            ]
        };

        var config = {
            type: "horizontalBar",
            // type: "bar",

            // Chart Options
            options: chartOptions,

            data: chartData
        };

        // Create the chart
        var barChart = new Chart(ctx, config);

    });
});
</script>

<script>
$(document).ready(function(){

    var url = '{{ url('getpolarchartdata') }}';
    $.get(url, function (data) {
        // console.log(data);
        // alert(data.labels);
        // Polar chart
        // ----------------
        //Get the context of the Chart canvas element we want to select
        var ctx = $("#qcc-polar-chart");

        // Chart Options
        var chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            responsiveAnimationDuration: 500,
            legend: {
                position: "top"
            },
            title: {
                display: false,
                text: "Chart.js Polar Area Chart"
            },
            scale: {
                ticks: {
                    beginAtZero: true
                },
                reverse: false
            },
            animation: {
                animateRotate: false
            }
        };

        // Chart Data
        var chartData = {
            labels: data.labels,
            datasets: [
                {
                    data:  data.data_cnt_act_by_long,
                    backgroundColor: ["#f44336", "#e91e63", "#9c27b0", "#3f51b5", "#03a9f4", "#009688", "#8bc34a", "#ffeb3b", "#ff9800",],
                    label: "My dataset" // for legend
                }
            ]
        };

        var config = {
        type: "polarArea",
        // Chart Options
        options: chartOptions,
        data: chartData
        };

        // Create the chart
        var polarChart = new Chart(ctx, config);
    });
});
</script>

<script>
    $(document).ready(function(){

        var url = '{{ url('getverticalbarchartdata') }}';
        $.get(url, function (data) {
            // Bar chart
            // ------------

            //Get the context of the Chart canvas element we want to select
            var ctx = $("#qcc-verticalbar-chart");

            // Chart Options
            var chartOptions = {
            // Elements options apply to all of the options unless overridden in a dataset
            // In this case, we are setting the border of each horizontal bar to be 2px wide and green
            elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: "rgb(0, 255, 0)",
                        borderSkipped: "left"
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                responsiveAnimationDuration: 500,
                legend: {
                    position: "top"
                },
                scales: {
                    xAxes: [
                        {
                        display: true,
                        gridLines: {
                            color: "#f3f3f3",
                            drawTicks: false
                        },
                        scaleLabel: {
                            display: true
                        }
                    }
                ],
                yAxes: [
                        {
                            display: true,
                            gridLines: {
                                color: "#f3f3f3",
                                drawTicks: false
                            },
                            scaleLabel: {
                                display: true
                            }
                        }
                    ]
                },
                title: {
                    display: false,
                    text: "Chart.js Horizontal Bar Chart"
                }
            };

            // Chart Data
            var chartData = {
                labels: data.labels,
                datasets: [
                    {
                        label: "ลดค่าใช้จ่าย",
                        data: data.data_reduced_cost,
                        backgroundColor: "#2196f3",
                        hoverBackgroundColor: "#1976d2",
                        borderColor: "transparent"
                    },
                    {
                        label: "เพิ่มความพร้อมจ่าย",
                        data: data.data_available_capacity_improvement,
                        backgroundColor: "#ffc107",
                        hoverBackgroundColor: "#ffa000",
                        borderColor: "transparent"
                    },
                    {
                        label: "เพิ่มประสิทธิภาพ",
                        data: data.data_increase_efficiency,
                        backgroundColor: "#4caf50",
                        hoverBackgroundColor: "#388e3c",
                        borderColor: "transparent"
                    },
                ]
            };

            var config = {
                // type: "horizontalBar",
                type: "bar",

                // Chart Options
                options: chartOptions,

                data: chartData
            };

            // Create the chart
            var barChart = new Chart(ctx, config);

        });
    });
    </script>
@endsection
