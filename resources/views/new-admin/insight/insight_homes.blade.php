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

    <!-- Main page content-->
    <div class="container pt-4">
        <div class="views text-dark text-center my-3 my-lg-5">
            <div class="mt-1">
                <div class="row">
                    <div class="col-12">
                        <div id="chartViews"></div>
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
                text: 'Total Homes Views'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
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
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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
            series: [{
                name: 'Tokyo',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

            }, {
                name: 'New York',
                data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

            }, {
                name: 'London',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

            }, {
                name: 'Berlin',
                data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

            }]
        });
    </script>
@endsection
