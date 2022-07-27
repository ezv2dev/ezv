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

    .active{
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
    .data-total{
        font-size:2.5rem;
        font-weight:bold;
    }
    @media (max-width:767px){
        .text-xl{
            font-size:1rem !important;
        }
        .rate {
            width: 25px;
            height: 25px;
            font-weight: normal;
        }
        .data-total{
            font-size:1.5rem;
        }
    }

</style>

@section('content_admin')

<!-- Main page content-->
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light rounded">
        <div class="collapse navbar-collapse" id="navbarsExample09">
            <ul class="navbar-nav mr-auto nav-insight">
                <li class="nav-item">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard') }}">Opportunites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard_reviews') }}">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard_earnings') }}">Earnings</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard_views') }}">Views</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="views text-dark text-center my-3 my-lg-5">
        <div class="mt-2">
            <div class="row">
                <div class="col-4">
                    <h3 class="data-total" style="color: rgb(54, 50, 50)">{{ $views }}</h3>
                    <p>Views</p>
                </div>
                <div class="col-4">
                    <h3 class="data-total" style="color: rgb(54, 50, 50)">{{ $booking }}</h3>
                    <p>New bookings</p>
                </div>
                <div class="col-4 d-flex">
                    <div>
                        <h3 class="data-total" style="color: rgb(54, 50, 50)">0 %</h3>
                        <p>Booking rate</p>
                    </div>
                    <button type="button" class="rate btn-primary" data-toggle="tooltip" data-placement="bottom" title="The percentage of guests who book after viewing your listing">
                        ?
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="chartViews" class="mt-5"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="bookingViews" class="mt-5"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="bookingRateViews" class="mt-5"></div>
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
            text: 'Counter Page Views Villa'
        },
        subtitle: {
            text: ''
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
            @foreach ($arrayVilla as $key => $value)
                {
                    name: {!! json_encode($key) !!},
                    data: {!! json_encode(array_values($value)) !!}
                },
            @endforeach
        ]
    });

</script>

<script>
    Highcharts.chart('bookingViews', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Counter New Bookings Villa'
        },
        subtitle: {
            text: ''
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
            pointFormat: '<tr><td style="color:{series.color};font-size:10px; padding:0">{series.name}: </td>' +
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
            @foreach ($arrayBookingVilla as $key => $value)
                {
                    name: {!! json_encode($key) !!},
                    data: {!! json_encode(array_values($value)) !!}
                },
            @endforeach
        ]
    });

</script>

<script>
    Highcharts.chart('bookingRateViews', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Counter Booking Rate Villa'
        },
        subtitle: {
            text: ''
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
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
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
            name: '{{ $villaChart[0]['name'] }}',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        }, {
            name: '{{ $villaChart[1]['name'] }}',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }]
    });

</script>
@endsection
