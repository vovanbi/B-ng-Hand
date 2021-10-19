@extends('layout.app')
@section('content')
<!-- Hero Start -->
        <section class="bg-half bg-light d-table w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <div class="page-next-level">
                            <h4 class="title"> Bài Viết </h4>
                            <div class="page-next">
                                <nav aria-label="breadcrumb" class="d-inline-block">
                                    <ul class="breadcrumb bg-white rounded shadow mb-0">
                                        <li class="breadcrumb-item"><a href="{{route('home')}}">Trang Chủ</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Bài Viết</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>  <!--end col-->
                </div><!--end row-->
            </div> <!--end container-->
        </section><!--end section-->
        <!-- Hero End -->

        <!-- Shape Start -->
        <div class="position-relative">
            <div class="shape overflow-hidden text-white">
                <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>
        <!--Shape End-->

        <!-- Blog Start -->
        <section class="section">
            <div class="container">
                <div class="row">
                    <!-- BLog Start -->
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            @if(isset($articles))
                            @foreach($articles as $article)
                            <div class="col-lg-6 col-md-12 mb-4 pb-2">
                                <div class="card blog rounded border-0 shadow">
                                    <a href="{{ route('get.detail.article',$article->a_slug) }}">
                                        <div class="position-relative">                                       
                                            <img height="300px" src="{{ asset('uploads/article/'.$article->a_avatar) }}" class="card-img-top rounded-top" alt="...">
                                        <div class="overlay rounded-top bg-dark"></div>
                                        </div>
                                    </a>
                                    <div class="card-body content">
                                        <h5><a href="{{ route('get.detail.article',$article->a_slug) }}" class="card-title title text-dark">{{ $article->a_name }}</a></h5>
                                        <div class="post-meta d-flex justify-content-between mt-3">
                                            <ul class="list-unstyled mb-0">
                                                <li class="list-inline-item h6 date text-muted"><i class="mdi mdi-eye-outline"></i> {{ $article->a_view }} Lượt xem</li>
                                            </ul>
                                            <a href="{{ route('get.detail.article',$article->a_slug) }}" class="text-muted readmore">Xem Thêm <i class="mdi mdi-chevron-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="author">
                                        <small class="text-light user d-block"><i class="mdi mdi-account"></i> Admin</small>
                                        <small class="text-light date"><i class="mdi mdi-calendar-check"></i> {{ $article->created_at->format('d-m-Y') }}</small>
                                    </div>
                                </div>
                            </div><!--end col-->                                           
                            @endforeach
                            @endif
                            <!-- PAGINATION START -->
                            <div class="col-12">
                                <div class="pagination justify-content-center mb-0">
                                    {!! $articles->links() !!}
                                </div>                                
                            </div><!--end col-->


                            <!-- PAGINATION END -->
                        </div><!--end row-->
                    </div><!--end col-->
                    <!-- BLog End -->

                   @include('article.aside')
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- Blog End -->
@stop