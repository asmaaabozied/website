@extends('frontend.app')

@section('content')


    <div class="top-category section-padding mb-4">

    <div class="row">
        <div class="col-md-12">
            <div class="main-title">
                <div class="btn-group float-right right-action">
                    <a href="#" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                    </div>
                </div>
                <h6>Channels Categories</h6>
            </div>
        </div>
        <div class="col-md-12">
            <div class="owl-carousel owl-carousel-category owl-loaded owl-drag">

                <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-2931px, 0px, 0px); transition: all 1s ease 0s; width: 4320px;">
                        @foreach($categories as $category)
                        <div class="owl-item cloned" style="width: 154.275px;">


                            <div class="item">

                                <div class="category-item">
                                    <a href="#">
                                        <img class="img-fluid" src="{{asset('uploads/category/images/'.$category->icon_img)}}" alt="">
                                        <h6>{{$category->category_name}}</h6>
                                        <p>74,853 views</p>
                                    </a>
                                </div>

                            </div>


                        </div>

                        @endforeach


                            </div></div>

                            </div></div></div>

    <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><i class="fa fa-chevron-left"></i></button></div><div class="owl-dots"></div>
        </div>

<hr>


    <div class="video-block section-padding">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title">
                    <div class="btn-group float-right right-action">
                        <a href="#" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                        </div>
                    </div>
                    <h6>Featured Videos</h6>
                </div>
            </div>
            @foreach($videos as $video)
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="video-card">
                    <div class="video-card-image">
                        <a class="play-icon" href="{{asset($video->file_name)}}"><i class="fas fa-play-circle"></i></a>
                        <a href="{{asset($video->file_name)}}"><img class="img-fluid" src="{{asset($video->icon_image)}}" alt=""></a>
                        <div class="time">3:50</div>
                    </div>
                    <div class="video-card-body">
                        <div class="video-title">
                            <a href="">{{$video->title}}</a>
                        </div>
                        <div class="video-page text-success">

                            {{Str::limit($video['descp'], 30)}}  <a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                        </div>
                        <div class="video-view">

                            {{$video->views}}M views &nbsp;<i class="fas fa-calendar-alt"></i>

                            {{ isset($video->creation_date) ? $video->creation_date->diffForHumans() :''	 }}
                        </div>
                    </div>
                </div>
            </div>

            @endforeach





        </div>
    </div>

  <hr class="mt-0">

    <div class="video-block section-padding">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title">
                    <div class="btn-group float-right right-action">
                        <a href="#" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                        </div>
                    </div>
                    <h6>Popular Channels</h6>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="channels-card">
                    <div class="channels-card-image">
                        <a href="#"><img class="img-fluid" src="img/s1.png" alt=""></a>
                        <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Subscribe <strong>1.4M</strong></button></div>
                    </div>
                    <div class="channels-card-body">
                        <div class="channels-title">
                            <a href="#">Channels Name</a>
                        </div>
                        <div class="channels-view">
                            382,323 subscribers
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="channels-card">
                    <div class="channels-card-image">
                        <a href="#"><img class="img-fluid" src="img/s2.png" alt=""></a>
                        <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Subscribe <strong>1.4M</strong></button></div>
                    </div>
                    <div class="channels-card-body">
                        <div class="channels-title">
                            <a href="#">Channels Name</a>
                        </div>
                        <div class="channels-view">
                            382,323 subscribers
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="channels-card">
                    <div class="channels-card-image">
                        <a href="#"><img class="img-fluid" src="img/s3.png" alt=""></a>
                        <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-secondary btn-sm">Subscribed <strong>1.4M</strong></button></div>
                    </div>
                    <div class="channels-card-body">
                        <div class="channels-title">
                            <a href="#">Channels Name <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle"></i></span></a>
                        </div>
                        <div class="channels-view">
                            382,323 subscribers
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="channels-card">
                    <div class="channels-card-image">
                        <a href="#"><img class="img-fluid" src="img/s4.png" alt=""></a>
                        <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Subscribe <strong>1.4M</strong></button></div>
                    </div>
                    <div class="channels-card-body">
                        <div class="channels-title">
                            <a href="#">Channels Name</a>
                        </div>
                        <div class="channels-view">
                            382,323 subscribers
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer class="sticky-footer">
        <section class="section-padding footer-list">
            <div class="container">
                <div class="row">
               >
                    <div class="col-lg-3 col-md-3">
                        <div class="footer-logo mb-4"><a class="logo" href="index.html"><img alt="" src="img/logo.png" class="img-fluid"></a></div>
                        <p>86 Petersham town, New South wales Waedll Steet, Australia</p>
                        <p class="mb-0"><a href="#" class="text-dark"><i class="fas fa-mobile fa-fw"></i> +61 525 240 310</a></p>
                        <p class="mb-0"><a href="#" class="text-dark"><i class="fas fa-envelope fa-fw"></i> iamosahan@gmail.com</a></p>
                        <p class="mb-0"><a href="#" class="text-dark"><i class="fas fa-globe fa-fw"></i> www.askbootstrap.com</a></p>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <h6 class="mb-4">Company</h6>
                        <ul>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Legal</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Privacy</a></li>
                            <li><a href="#">Terms</a></li>
                            <li><a href="{{route('contacts')}}">Contact us</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <h6 class="mb-4">Features</h6>
                        <ul>
                            <li><a href="#">Retention</a></li>
                            <li><a href="#">People</a></li>
                            <li><a href="#">Messages</a></li>
                            <li><a href="#">Infrastructure</a></li>
                            <li><a href="#">Platform</a></li>
                            <li><a href="#">Funnels</a></li>
                            <li><a href="#">Live</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <h6 class="mb-4">Solutions</h6>
                        <ul>
                            <li><a href="#">Enterprise</a></li>
                            <li><a href="#">Financial Services</a></li>
                            <li><a href="#">Consumer Tech</a></li>
                            <li><a href="#">Entertainment</a></li>
                            <li><a href="#">Product</a></li>
                            <li><a href="#">Marketing</a></li>
                            <li><a href="#">Analytics</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <h6 class="mb-4">NEWSLETTER</h6>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Email Address...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button"><i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <small>It is a long established fact that a reader will be distracted by..</small>
                        <h6 class="mb-2 mt-4">DOWNLOAD APP</h6>
                        <div class="app">
                            <a href="#"><img alt="" src="img/google.png"></a>
                            <a href="#"><img alt="" src="img/apple.png"></a>
                        </div>
                    </div>
                    </div>

            </div>
        </section>

    </footer>


@endsection
