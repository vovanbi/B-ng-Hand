@extends('admin.layouts.master')
@section('content')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
   

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Thống Kê
                </h1>
                <ol class="breadcrumb">
                    <li class="">
                        <i class="fa fa-dashboard"></i> Trang Chủ
                    </li>
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Thống Kê
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->


        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$countRating}}</div>
                                <div>Đánh giá mới!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('admin.list.rating')}}">
                        <div class="panel-footer">
                            <span class="pull-left">Xem chi tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$countUser}}</div>
                                <div>Thành viên!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('admin.list.user')}}">
                        <div class="panel-footer">
                            <span class="pull-left">Xem chi tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$countOrder}}</div>
                                <div>Đơn hàng!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('admin.list.order')}}">
                        <div class="panel-footer">
                            <span class="pull-left">Xem chi tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$countContact}}</div>
                                <div>Hỗ trợ!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('admin.get.list.contact')}}">
                        <div class="panel-footer">
                            <span class="pull-left">Xem chi tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="container"></div>
            </div>            
        </div>
       
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Danh sách đơn hàng mới</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên khách hàng</th>
                                    <th>SĐT</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Thời gian</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactionNews as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ isset( $transaction->user->name) ?  $transaction->user->name : '[N\A]' }}</td>
                                        <td>{{ $transaction->o_phone }}</td>
                                        <td>{{ number_format($transaction->o_total,0,',','.') }} VND</td>
                                        <td>
                                            @if ( $transaction->o_status == 1)
                                                <a href="" class="label label-success">Đã xủ lý</a>
                                            @else
                                                <a href="{{ route('admin.action.order',['status',$transaction->id]) }}" class="label label-default">Chờ xủ lý</a>
                                            @endif
                                        </td>
                                        <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Danh sách đánh giá mới</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên thành viên</th>
                                    <th>Sản phẩm</th>
                                    <th>Đánh giá</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($ratings))
                                    @foreach($ratings as $rating)
                                        <tr>
                                            <td>{{ $rating->id }}</td>
                                            <td>{{ isset($rating->user->name) ? $rating->user->name : $rating->ra_name }}</td>
                                            <td><a href="">{{ isset($rating->product->pro_name) ? $rating->product->pro_name : '[N\A]' }}</a></td>
                                            <td>{{ $rating->ra_number }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Danh sách liên hệ mới</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tiêu đề</th>
                                    <th>Họ tên</th>
                                    <th>Nội dung</th>
                                    <th>Trạng thái</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($contacts))
                                    @foreach($contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->id }}</td>
                                            <td>{{ $contact->c_title }}</td>
                                            <td>{{ $contact->c_name }}</td>
                                            <td>{{ $contact->c_content }}</td>
                                            <td>
                                                <a href="{{ route('admin.action.contact',['status',$contact->id]) }}" class="label {{ $contact->getStatus($contact->c_status)['class'] }}">{{ $contact->getStatus($contact->c_status)['name'] }}</a>
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
     <div class="container p-5">
        <h3 class="text-center">Biểu đồ thống kê sản phẩm bán chạy</h3>
        <div id="piechart" style="height: 500px;width: auto"></div>
    </div>
   
    </div>


@stop
@section('script')
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Tên sản phẩm', 'Đã mua'],

                @php
                foreach($products as $product) {
                    echo '["'.$product->pro_name.'",'.$product->pro_buy.'],';
                }
                @endphp
        ]);

          var options = {
            title: 'Biểu Đồ',
            is3D: true,
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart'));

          chart.draw(data, options);
        }
      </script>

    <script>
        // Create the chart
        let data = "{{ $dataMoney }}";
        dataChart = JSON.parse(data.replace(/&quot;/g,'"'));
        console.log(dataChart);
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Biểu đồ doanh thu ngày và tháng'
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Mức độ'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f} VND'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [
                {
                    name: "Browsers",
                    colorByPoint: true,
                    data: dataChart
                }
            ],
        });
    </script>
  


@stop
