@extends('layout.app')
@section('content')
<!-- Hero Start -->
        <section class="bg-half bg-light d-table w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <div class="page-next-level">
                            <h4 class="title"> Giỏ Hàng </h4>
                            <div class="page-next">
                                <nav aria-label="breadcrumb" class="d-inline-block">
                                    <ul class="breadcrumb bg-white rounded shadow mb-0">
                                        <li class="breadcrumb-item"><a href="{{route('home')}}">Trang Chủ</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Giỏ Hàng</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div> <!--end container-->
        </section><!--end section-->
        <div class="position-relative">
            <div class="shape overflow-hidden text-white">
                <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>
        <!-- Hero End -->

        <!-- Start -->
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive bg-white shadow">
                            <table class="table table-center table-padding mb-0">
                                <thead>
                                    <tr> 
                                        <th class="py-3" style="min-width:20px ">Stt</th>                                      
                                        <th class="py-3" style="min-width: 300px;">Sản phẩm</th>
                                        <th class="py-3" style="min-width:20px ">Size</th>
                                        <th class="text-center py-3" style="min-width: 160px;">Giá</th>
                                        <th class="text-center py-3" style="min-width: 160px;">Số lượng</th>
                                        <th class="text-center py-3" style="min-width: 160px;">Tổng</th>
                                        <th class="py-3" style="min-width:20px "></th>
                                        <th class="py-3" style="min-width:20px "><a href="{{ route('destroy.cart') }}" class="text-danger">X</a></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $stt = 1 ?>
                                    @foreach($products as $key => $product)
                                    <tr>
                                        <form action="{{ route('update.cart',$key) }}" method="get">
                                        <td class="text-center">{{ $stt }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('uploads/'.$product->options->avatar) }}" class="img-fluid avatar avatar-small rounded shadow" style="height:auto;" alt="">
                                                <h6 class="mb-0 ml-3">{{ $product->name }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <select style="width: 68px;padding: 0px;" class="form-control size" name="size">
                                                <option value="S" {{ $product->options->size=='S' ? 'selected':'' }}>S</option>
                                                <option value="M" {{ $product->options->size=='M' ? 'selected':'' }}>M</option>
                                                <option value="L" {{ $product->options->size=='L' ? 'selected':'' }}>L</option>
                                                <option value="XL" {{ $product->options->size=='XL' ? 'selected':'' }}>XL</option>
                                            </select>
                                        </td>
                                        <td class="text-center">{{ number_format($product->price,0,',','.') }} đ</td>
                                        <td class="text-center">                                           
                                            <input type="button" value="-" class="minus btn btn-icon btn-soft-primary font-weight-bold">
                                            <input type="number" id="fafa" step="1" min="1" max="{{$product->options->number}}" name="quantity" value="{{ $product->qty }}" title="Qty" class="btn btn-icon btn-soft-primary font-weight-bold">

                                            <input type="button" value="+" class="plus btn btn-icon btn-soft-primary font-weight-bold">
                                        </td>
                                        <td class="text-center font-weight-bold">{{ number_format($product->qty * $product->price,0,',','.') }} đ</td>
                                        <td class="h6"><button style="padding: 0;border: none;background: none" class="text-info" type="submit"><i class="fuil uil-edit"></i></button></td>
                                        <td class="h6"><a href="{{ route('delete.cart',$key) }}" class="text-danger">X</a></td>
                                        </form>
                                    
                                    </tr>

                                    <?php $stt++ ?>
                                    @endforeach                                   
                                </tbody>
                            </table>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
                <div class="row">
                    <div class="col-lg-8 col-md-6 mt-4 pt-2">
                        <a href="{{ route('home') }}" class="btn btn-black">Mua thêm</a>
                        <!-- <a href="" class="btn btn-soft-primary ml-2">Cập nhật</a> -->
                    </div>
                    <div class="col-lg-4 col-md-6 ml-auto mt-4 pt-2">
                        <div class="table-responsive bg-white rounded shadow">
                            <table class="table table-center table-padding mb-0">
                                <tbody>
                                    <tr>
                                        <th colspan="2" class="h6 text-center">Thông tin đơn hàng</th>
                                    </tr>
                                    <!-- <tr>
                                        <td class="h6">Thuế</td>
                                        <td class="text-center font-weight-bold">$ 219</td>
                                    </tr> -->
                                    <tr class="bg-light">
                                        <td class="h6">Tổng tiền</td>
                                        <td class="text-center font-weight-bold">{{ Cart::subtotal(0,3) }} đ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 pt-2 text-right">
                            <a href="{{ route('get.form.pay') }}" class="btn btn-black">Thanh toán</a>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- End -->
@stop
@section('script')
<script>
    $('.plus').click(function () {
        var element = document.getElementById('fafa');
        var number = element.getAttribute('max');
        var number = Number(number);
        console.log(number);
        if ($(this).prev().val() < number) {
            $(this).prev().val(+$(this).prev().val() + 1);
        }
    });
    $('.minus').click(function () {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
    });
</script>
@stop