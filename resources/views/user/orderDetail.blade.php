@if($ordersDetail)
    <table class="table">
        <thead>
        <tr>
            <th>Stt</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Size</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng tiền</th>
            <th>Chức năng</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ordersDetail as $key => $orderDetail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="{{ route('get.detail.product',[Str::slug($orderDetail->product->pro_name),$orderDetail->or_product_id]) }}" target="_blank">{{ $orderDetail->product->pro_name }}</a></td>
                <td>
                    <img style="width: 80px;height: 60px;" src="{{ asset('uploads/'.$orderDetail->product->images[0]->pi_avatar) }}">
                </td>
                <td>{{ $orderDetail->size }}</td>
                <td>{{ number_format($orderDetail->od_price,0,',','.') }} đ</td>
                <td>{{ $orderDetail->od_qty }}</td>
                <td>{{ number_format($orderDetail->od_qty * $orderDetail->od_price,0,',','.') }} đ</td>
                <td>
                    @if ($ordersDetail[0]->order->o_status == 1)
                        <a href="{{ route('get.detail.product',[Str::slug($orderDetail->product->pro_name),$orderDetail->or_product_id]) }}" target="_blank" class="btn btn-warning">Đánh giá</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif