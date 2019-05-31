@extends('layouts.admin_default')
@section('title', 'Dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Bảng điều khiển
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin_home') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Bảng điều khiển</li>
        </ol>
    </section>

    <section class="content">
        @if ($errors->any())
            <div class="box box-default" id="error-alert">

                <div class="box-body">

                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="$('#error-alert').hide()">×</button>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>

                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header" style="cursor: move;">
                        <i class="fa fa-area-chart"></i>
                        <h3 class="box-title">Thống kê dat hang theo ngay</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="contractChart" style="height:230px;width:100%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header" style="cursor: move;">
                        <i class="fa fa-newspaper-o"></i>
                        <h3 class="box-title">Tin tức</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Created_at</th>
                            </thead>
                            <tbody>
                            {{--@foreach($products as $item)--}}
                                {{--<tr>--}}
                                    {{--<td>{{ $item->name }}</td>--}}
                                    {{--<td><img style="width: 50px;" src="{{ \Modules\Products\Entities\Category::getDataUrl($item->image, "product") }}"> </td>--}}
                                    {{--<td>{{ $item->price }}</td>--}}
                                    {{--<td>{{ $item->quantity }}</td>--}}
                                    {{--<td>{{ $item->description }}</td>--}}
                                    {{--<td>{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}}</td>--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('scripts')

    <script src="{{ asset('js/chartjs/Chart.min.js') }}"></script>

    <script type="text/javascript">
        var label_claims = "";
        var areaChartData = {
            labels  : label_claims.split(','),
            datasets: [
                {
                    label               : 'Doanh thu theo tháng',
                    fillColor           : 'rgba(60,141,188,0.9)',
                    strokeColor         : 'rgba(60,141,188,0.8)',
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : JSON.parse(''),
                }
            ]
        }
        //- BAR CHART -
        //-------------
        var barChartCanvas                   = $('#contractChart').get(0).getContext('2d');
        var barChart                         = new Chart(barChartCanvas);
        var barChartData                     = areaChartData;
        barChartData.datasets[0].fillColor   = '#00a65a';
        barChartData.datasets[0].strokeColor = '#00a65a';
        barChartData.datasets[0].pointColor  = '#00a65a';
        var barChartOptions                  = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero        : true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines      : true,
            //String - Colour of the grid lines
            scaleGridLineColor      : 'rgba(0,0,0,.05)',
            //Number - Width of the grid lines
            scaleGridLineWidth      : 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines  : true,
            //Boolean - If there is a stroke on each bar
            barShowStroke           : true,
            //Number - Pixel width of the bar stroke
            barStrokeWidth          : 2,
            //Number - Spacing between each of the X value sets
            barValueSpacing         : 5,
            //Number - Spacing between data sets within X values
            barDatasetSpacing       : 1,
            //String - A legend template
            legendTemplate          : '',
            //Boolean - whether to make the chart responsive
            responsive              : true,
            maintainAspectRatio     : true
        }
        barChartOptions.datasetFill = true;
        barChart.Bar(barChartData, barChartOptions);
    </script>


@endsection
