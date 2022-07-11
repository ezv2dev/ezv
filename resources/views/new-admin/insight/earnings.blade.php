@extends('new-admin.layouts.admin_layout')

@section('title', 'Earnings - EZV2')

<style>
    li.active a.nav-link-insight:before, a.nav-link-insight:hover:before {
        visibility: visible;
        -webkit-transform: scaleX(1);
        transform: scaleX(1);
    }

    ul.nav-insight {
  list-style-type: none;
}

.active{
        font-weight: 600 !important;
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
          <li class="nav-item active">
            <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard_earnings') }}">Earnings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-insight" href="{{ route('insight_dashboard_views') }}">Views</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="col-8">
        <div class="earnings pt-5 pb-5 text-dark">
            <div class="select-month">
                <label class="form-label" for="example-select">Select year</label>
                <br>
                  <select name="year" class="form-control" onchange="changeYear(this.value);">
                    <option value="">Select a year</option>
                    <?php
                    $month = date('m');
                    $nextmonth = $month +1;
                    $year = date('Y');
                    $previousyear = $year -1;
                    for( $m=1; $m<=1; ++$m ) {
                        $month_label = date('F', mktime(0, 0, 0, $m, 1));
                      ?>
                        <option value="<?php echo $previousyear; ?>"><?php echo $previousyear; ?></option>
                      <?php } ?>

                    <?php
                    $month = date('m');
                    $year = date('Y');
                    // $previousyear = $year -1;
                    for( $m=1; $m<=1; ++$m ) {
                      $month_label = date('F', mktime(0, 0, 0, $m, 1));
                    ?>
                      <option value="<?php echo $year; ?>"><?php echo $year; ?> (Current)</option>
                    <?php } ?>

                    <?php
                    $month = date('m');
                    $year = date('Y');
                    $nextyear = $year +1;
                    for( $m=1; $m<=1; ++$m ) {
                        $month_label = date('F', mktime(0, 0, 0, $m, 1));
                    ?>
                        <option value="<?php echo $nextyear; ?>"><?php echo $nextyear; ?></option>
                    <?php } ?>
                  </select>
            </div>
            <div class="value-earnings mt-5">
                <h3 id="getEarnings" class="text-xl" style="font-weight: bold; color: rgb(54, 50, 50)">IDR 0.00</h3>
                <p>Booked earnings for <span id="select-year"><?php echo date('Y'); ?></span></p>
            </div>
            <div class="charts-bar">
                <div id="chartViews" class="mt-5"></div>
            </div>
            <div class="details-earning mt-5">
                <h3 class="text-md" style="color: rgb(54, 50, 50)"><b>2022 details</b></h3>
                <hr>
                <p>You have no listings currently listed</p>
                <hr>
                <p>Cleaning fees <span style="float: right">$0</span></p>
                <hr>
                <p>Cancellation fees <span style="float: right">$0</span></p>
                <p>Incurred in 2022</p>
                <hr>
                <a href="#">View transaction history</a>
                <hr>
                <a href="#">View tax information</a>
                <p class="mt-5"><a href="#" style="text-decoration: underline; color: black;">Give feedback</a></p>
            </div>
        </div>
    </div>
</div>

@include('new-admin.layouts.footer')

@endsection

@section('scripts')

<script>
    let data =  <?php echo json_encode($chart, JSON_NUMERIC_CHECK) ?>;
    // console.log(data);
    const chart = Highcharts.chart('chartViews', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Earnings in 2022'
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
                text: 'Rp',
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
        series: [
        {
            name: 'Paid out',
            // data: []
            data: data
        }]
    });

    function changeYear(id){
        // console.log(year);
        $.ajax({
            type: "GET",
            url: "/dashboard/earnings/" + id,
            dataType: "JSON",
            success: function(data){
                if (data.total == 0){
                    document.getElementById('getEarnings').textContent = "IDR 0.00";
                    document.getElementById('select-year').textContent = id;

                    $.ajax({
                        type: "GET",
                        url: "/dashboard/earnings/charts/" + id,
                        dataType: "JSON",
                        success: function(response){
                            chart.addSeries({
                                name: 'Paid out',
                                data: [0,0,0,0,0,0,0,0,0,0,0,0]
                            });
                            chart.series[0].remove();
                            chart.setTitle({text: `Earnings in ${id}`});
                        },

                    });
                }
                else {
                    var formatter =  new Intl.NumberFormat('en-US', {
                        style: 'currency',
                        currency: 'IDR',
                    });
                    var total_price = formatter.format(data.total).replace(/(\.0+|0+)$/, '');
                    // console.log(total_price);
                    document.getElementById('select-year').textContent = id;
                    document.getElementById('getEarnings').textContent = total_price;

                    $.ajax({
                        type: "GET",
                        url: "/dashboard/earnings/charts/" + id,
                        dataType: "JSON",
                        success: function(response){
                            chart.addSeries({
                                name: 'Paid out',
                                data: response
                            });
                            chart.series[0].remove();
                            chart.setTitle({text: `Earnings in ${id}`});
                        },

                    });
                }
            },

	    });
    }

</script>

@endsection
