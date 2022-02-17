@extends('user.layout')
@section('content_user')
    <div class="col-lg-8 col-12">
        <div class="card border-0 rounded shadow">
            <div class="card-body">
                <h5 class="text-md-left text-center">Tổng quát:</h5>

                <div role="tabpanel" class="tab-pane" id="messages">
                                <div class="product-tab-content">
                                    <div class="col-xs-6" style="margin-top: 30px">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Tổng số đơn hàng</th>
                                                <th>Đã xử lý</th>
                                                <th>Chưa xử lý</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{$totalorder}}</td>
                                                <td>{{$totalorderDone}}</td>
                                                <td>{{$totalorder > 0 ? $totalorder - $totalorderDone : 0 }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-xs-12" style="margin: 30px 0 30px 0">
                                        <h2 style="text-align: center">Chi tiết đơn hàng</h2>

                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Địa chỉ</th>
                                                <th>SĐT</th>
                                                <th>Tổng tiền</th>
                                                <th>Trạng thái</th>
                                                <th>Thời gian</th>
                                                <th>Chức năng</th>
                                            </tr>
                                            @if($orders)
                                            @foreach($orders as $order)
                                            <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->o_address}}</td>
                                            <td>{{$order->o_phone}}</td>
                                            <td>{{ number_format($order->o_total,0,',','.') }} VND</td>
                                            <td>
                                                @if ( $order->o_status == 1)
                                                    <span href="" class="btn btn-success">Đã xủ lý</span>
                                                @else
                                                    <span href="" class="btn btn-danger">Chờ xủ lý</span>
                                                @endif
                                            </td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>
                                                @if ( $order->o_status == 1)
                                                    <a class="js_order_item btn btn-info" data-id="{{ $order->id }}" href="{{ route('user.detail.order',$order->id) }}"><i class="fa fa-eye"></i> Xem</a>
                                                @endif 
                                            </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            </thead>
                                            <tbody>
                                          
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
            </div>
        </div>
    </div><!--end col-->

<!--js-->
<div class="modal fade" id="myModalOrder" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chi tiết đơn hàng #<b class="order_id"></b></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>            
            </div>
            <div class="modal-body" id="md_content">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
    <script>
        $(function (){
            $(".js_order_item").click(function (event){
                event.preventDefault();
                let $this = $(this);
                let url = $this.attr('href');
                $("#md_content").html('')
                $(".order_id").text($this.attr('data-id'));
                $("#myModalOrder").modal('show');

                $.ajax({
                    url: url,
                }).done(function (result){
                    if(result)
                    {
                        $("#md_content").html('').append(result);
                    }
                });
            });
        })
    </script>
@stop