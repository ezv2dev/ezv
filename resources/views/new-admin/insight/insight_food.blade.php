@extends('new-admin.layouts.admin_layout')

@section('title', 'Views - EZV2')

<style>
    li.active a.nav-link-insight:before,
    a.nav-link-insight:hover:before {
        visibility: visible;
        -webkit-transform: scaleX(1);
        transform: scaleX(1);
    }

    ul.nav-insight {
        list-style-type: none;
    }

    a.nav-link-insight {
        position: relative;
        color: #FF7400;
        text-decoration: none;
    }

    a.nav-link-insight:visited {
        color: #FF7400;
        text-decoration: none;
    }

    a.nav-link-insight:hover {
        color: #FF7400;
        text-decoration: none;
    }

    a.nav-link-insight:before {
        content: "";
        position: absolute;
        width: 100%;
        height: 2px;
        bottom: -2px;
        left: 0;
        background-color: #FF7400;
        visibility: hidden;
        -webkit-transform: scaleX(0);
        transform: scaleX(0);
        -webkit-transition: all 0.3s ease-in-out 0s;
        transition: all 0.3s ease-in-out 0s;
    }

    li.active a:before,
    a.nav-link-insight:hover:before {
        visibility: visible;
        -webkit-transform: scaleX(1);
        transform: scaleX(1);
    }

    .active {
        font-weight: 600 !important;
    }

    .rate {
        border-radius: 50% !important;
        width: 30px;
        height: 30px;
        font-weight: bold;
        box-shadow: none !important;
    }

    .btn-primary {
        background-color: #222222 !important;
        border-color: #222222 !important;
    }

    .btn-primary:hover {
        border-color: #FF7400 !important;
    }

    .data-total {
        font-size: 2.5rem;
        font-weight: bold;
    }

    @media (max-width:767px) {
        .text-xl {
            font-size: 1rem !important;
        }

        .rate {
            width: 25px;
            height: 25px;
            font-weight: normal;
        }

        .data-total {
            font-size: 1.5rem;
        }
    }
</style>

@section('content_admin')

    <div class="container pt-4">
        <div class="views text-dark text-center my-3 my-lg-5">
            <div class="mt-1">
                <div class="row">
                    <div class="col-12">
                        <div id="chartViews"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-5">
                        <div id="photoViews"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-5">
                        <div id="videoViews"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('new-admin.layouts.footer')

@endsection

@section('scripts')
    <script>
        Highcharts.chart('chartViews', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total Hotel Views'
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Views'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                @foreach ($arrayRestaurant as $key => $value)
                    {
                        name: {!! json_encode($key) !!},
                        data: {!! json_encode(array_values($value)) !!}
                    },
                @endforeach
            ]
        });
        Highcharts.chart('photoViews', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total Photo Views'
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Views'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                @foreach ($arrayPhoto as $key => $value)
                    {
                        name: {!! json_encode($key) !!},
                        data: {!! json_encode(array_values($value)) !!}
                    },
                @endforeach
            ]
        });
        Highcharts.chart('videoViews', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total Video Views'
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Views'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                @foreach ($arrayVideo as $key => $value)
                    {
                        name: {!! json_encode($key) !!},
                        data: {!! json_encode(array_values($value)) !!}
                    },
                @endforeach
            ]
        });
    </script>
@endsection
