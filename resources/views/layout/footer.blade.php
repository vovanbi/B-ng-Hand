<!-- Footer Start -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
                        <a href="#" class="logo-footer">
                            <img src="{{ asset('') }}images/logo.png" height="100" alt="">
                        </a>
                        <p class="mt-4">Công ty được thành lập ngày 12-8-2020 với mong muốn mang lại nhưng sản phẩm tốt nhất cho khách hàng.</p>
                        <ul class="list-unstyled social-icon social mb-0 mt-4">
                            <li class="list-inline-item"><a href="https://www.facebook.com/ShoesShop-Gi%C3%A0y-Th%E1%BB%83-Thao-100300708882499/" class="rounded"><i data-feather="facebook" class="fea icon-sm fea-social"></i></a></li>
                            <li class="list-inline-item"><a href="https://www.facebook.com/ShoesShop-Gi%C3%A0y-Th%E1%BB%83-Thao-100300708882499/" class="rounded"><i data-feather="instagram" class="fea icon-sm fea-social"></i></a></li>
                            <li class="list-inline-item"><a href="https://www.facebook.com/ShoesShop-Gi%C3%A0y-Th%E1%BB%83-Thao-100300708882499/" class="rounded"><i data-feather="twitter" class="fea icon-sm fea-social"></i></a></li>
                            <li class="list-inline-item"><a href="https://www.facebook.com/ShoesShop-Gi%C3%A0y-Th%E1%BB%83-Thao-100300708882499/" class="rounded"><i data-feather="linkedin" class="fea icon-sm fea-social"></i></a></li>
                        </ul><!--end icon-->
                    </div><!--end col-->
                    
                    <div class="col-lg-2 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                        <h5 class="text-light footer-head">Thông tin</h5>
                        <ul class="list-unstyled footer-list mt-4">
                            <li><a href="{{route('get.aboutUs')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Giới thiệu</a></li>                           
                            <li><a href="{{route('get.contact')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Liên hệ</a></li>
                            <li> 
                                @if(\Auth::check())
                                <a href="{{route('get.user')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Tài khoản</a>
                                @else
                                <a href="{{route('get.user')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Tài khoản</a>
                                @endif
                            </li>
                            <li><a href="{{route('get.login')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Đăng nhập</a></li>
                        </ul>
                    </div><!--end col-->
                    
                    <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                        <h5 class="text-light footer-head">Hỗ trợ khách hàng</h5>
                        <ul class="list-unstyled footer-list mt-4">
                            <li><a href="{{route('get.aboutUs')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Đặt hàng & Thanh toán</a></li>
                            <li><a href="{{route('get.aboutUs')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Giao hàng & Nhận hàng</a></li>
                            <li><a href="{{route('get.aboutUs')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Chính sách bảo mật</a></li>
                            <li><a href="{{route('get.aboutUs')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Điều khoản dịch vụ</a></li>
                            <li><a href="{{route('get.aboutUs')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Câu hỏi thường gặp</a></li>
                        </ul>
                    </div><!--end col-->

                    <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                        <!-- <h5 class="text-light footer-head">Gửi mail</h5>
                        <p class="mt-4">Đăng ký và nhận các thủ thuật mới nhất qua email.</p>
                        <form>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="foot-subscribe form-group">
                                        <label>Write your email <span class="text-danger">*</span></label>
                                        <div class="position-relative">
                                            <i data-feather="mail" class="fea icon-sm icons"></i>
                                            <input type="email" name="email" id="emailsubscribe" class="form-control pl-5 rounded" placeholder="Your email : " required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="submit" id="submitsubscribe" name="send" class="btn btn-soft-primary btn-block" value="Subscribe">
                                </div>
                            </div>
                        </form> -->
                        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FB%25C3%25B4ng-Hand-101387339002437&tabs=timeline&width=255&height=255&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=1267571153658728" width="255" height="255" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </footer><!--end footer-->
        <footer class="footer footer-bar">
            <div class="container text-center">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="text-sm-left">
                            <p class="mb-0">© 2019-20 Bông Hand. Design with <i class="mdi mdi-heart text-danger"></i> by <a href="" target="_blank" class="text-reset">Bông Hand</a>.</p>
                        </div>
                    </div><!--end col-->

                    <!-- <div class="col-sm-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                        <ul class="list-unstyled text-sm-right mb-0">
                            <li class="list-inline-item"><a href="javascript:void(0)"><img src="images/payments/american-ex.png" class="avatar avatar-ex-sm" title="American Express" alt=""></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)"><img src="images/payments/discover.png" class="avatar avatar-ex-sm" title="Discover" alt=""></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)"><img src="images/payments/master-card.png" class="avatar avatar-ex-sm" title="Master Card" alt=""></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)"><img src="images/payments/paypal.png" class="avatar avatar-ex-sm" title="Paypal" alt=""></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)"><img src="images/payments/visa.png" class="avatar avatar-ex-sm" title="Visa" alt=""></a></li>
                        </ul>
                    </div> -->
                </div><!--end row-->
            </div><!--end container-->
        </footer><!--end footer-->
<!-- Footer End -->