
@extends('layouts.app')
   @section('content')

    <!-- Start Banner 
    ============================================= -->
    <div class="banner-area banner-style-three text-light text-default" style="background-image: url(assets_guest/img/shape/25.png);">
        <div class="shape-left" style="background-image: url(assets_guest/img/shape/26.png);"></div>
        <div class="container">
            <div class="double-items">
                <div class="row align-center">

                    <div class="col-lg-6 info">
                        <h2 class="wow fadeInRight" data-wow-defaul="300ms">We're building software<strong>to manage business</strong></h2>
                        <p class="wow fadeInLeft" data-wow-delay="500ms">
                            Lasted hunted enough an up seeing in lively letter. Had judgment out opinions property the supplied.
                        </p>
                        <a class="btn btn-md circle btn-light effect wow fadeInUp" data-wow-delay="700ms" href="{{route('register')}}">Get Started <i class="fas fa-angle-right"></i></a>
                    </div>

                     <div class="col-lg-6 thumb wow fadeInRight" data-wow-delay="900ms">
                        <img src="{{asset('assets_guest/img/dashboard/1.png')}}" alt="Thumb">
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End Banner -->

    <!-- Star About Area
    ============================================= -->
    <div id="about" class="about-area bg-gray default-padding">
        <!-- Shape -->
        <div class="fixed-shape-left">
            <img src="{{ asset('assets_guest/img/shape/9.png') }}" alt="Shape">
        </div>
        <!-- End Shape -->
        <div class="container">
            <div class="about-items">
                <div class="row align-center">
                    <div class="col-lg-6">
                        <div class="thumb">
                            <img class="wow fadeInLeft" data-wow-delay="300ms" src="{{ asset('assets_guest/img/dashboard/3-a.png') }}" alt="Thumb">
                            <img class="wow fadeInUp" data-wow-delay="500ms" src="{{ asset('assets_guest/img/dashboard/2-a.png') }}" alt="Thumb">
                        </div>
                    </div>
                    <div class="col-lg-6 info wow fadeInRight">
                        <h4>Story about us</h4>
                        <h2>Perfect place to Design, Development, Software.</h2>
                        <ul>
                            <li>
                                <h5>Free Download App</h5>
                                <p>
                                    Fruit defer in party me built under first. Forbade him but savings sending ham general. So play do in near park that pain. 
                                </p>
                            </li>
                            <li>
                                <h5>Trusted and Reliable</h5>
                                <p>
                                    Fruit defer in party me built under first. Forbade him but savings sending ham general. So play do in near park that pain. 
                                </p>
                            </li>
                        </ul>
                        <div class="button">
                            <a class="btn circle btn-theme-effect btn-sm" href="{{route('register')}}" >Start free trial</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About Area -->

    <!-- Star Subscribe Area
    ============================================= -->
    <div class="subscribe-area text-center text-light relative">
        <div class="half-bg-top-gray"></div>
        <div class="container">
            <div class="subscribe-items">
                <i class="flaticon-email"></i>
                <!-- Shape -->
                <div class="fixed-shape-bottom">
                    <img src="{{ asset('assets_guest/img/shape/14.png') }}" alt="Shape">
                </div>
                <!-- End Shape -->
                <div class="row align-center">
                    <div class="col-lg-8 offset-lg-2">
                        <h2>Signup for a trial</h2>
                        <p>
                            Create your free account now and get 30 days free trial <br> No credit card required
                        </p>
                        <form action="#">
                            <input type="email" placeholder="Your Email" class="form-control" name="email">
                            <button type="submit"> Subscribe</button>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Subscribe Area -->

    <!-- Start Features
    ============================================= -->
    <div id="features" class="our-features-area default-padding bottom-less">
        <!-- Fixed BG -->
        <div class="fixed-bg" style="background-image: url(assets_guest/img/shape/17.png);"></div>
        <!-- Fixed BG -->
        <div class="container">
            <div class="feature-items">
                <div class="row">
                    <!-- Single Item -->
                    <div class="single-item col-lg-4 col-md-6">
                        <div class="item service-banner" style="background-image: url(assets_guest/img/banner/3.jpg);">
                            <h4>Our Features</h4>
                            <h2>Work smarter with powerful features</h2>
                            <a class="btn circle btn-theme-effect btn-sm" href="{{route('register')}}">View More</a>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="single-item col-lg-4 col-md-6">
                        <div class="item">
                           <div class="icon">
                               <i class="flaticon-integration"></i>
                           </div>
                           <div class="info">
                               <h4><a href="{{route('register')}}">App Integration</a></h4>
                               <p>
                                    Passage weather as up am exposed. And natural related man subject eagerness it. concluded consisted or no gentleman.
                               </p>
                           </div>
                       </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="single-item col-lg-4 col-md-6">
                        <div class="item">
                           <div class="icon">
                               <i class="flaticon-rgb-1"></i>
                           </div>
                           <div class="info">
                               <h4><a href="#">Color Schemes</a></h4>
                               <p>
                                    Passage weather as up am exposed. And natural related man subject eagerness it. concluded consisted or no gentleman.
                                </p>
                           </div>
                       </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="single-item col-lg-4 col-md-6">
                        <div class="item">
                           <div class="icon">
                               <i class="flaticon-resolution-1"></i>
                           </div>
                           <div class="info">
                               <h4><a href="#">High Resolution</a></h4>
                               <p>
                                    Passage weather as up am exposed. And natural related man subject eagerness it. concluded consisted or no gentleman.
                               </p>
                           </div>
                       </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="single-item col-lg-4 col-md-6">
                        <div class="item">
                            <div class="icon">
                               <i class="flaticon-drag"></i>
                           </div>
                           <div class="info">
                               <h4><a href="#">Drag And Drop</a></h4>
                               <p>
                                    Passage weather as up am exposed. And natural related man subject eagerness it. concluded consisted or no gentleman.
                               </p>
                           </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="single-item col-lg-4 col-md-6">
                        <div class="item">
                            <div class="icon">
                               <i class="flaticon-showcase"></i>
                           </div>
                           <div class="info">
                               <h4><a href="#">Perfect Showcase</a></h4>
                               <p>
                                    Passage weather as up am exposed. And natural related man subject eagerness it. concluded consisted or no gentleman.
                               </p>
                           </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Our Features -->

    <!-- Start Choose Us Area 
    ============================================= -->
    <div class="choose-us-area default-padding bg-gray">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-6 thumb">
                    <img src="{{ asset('assets_guest/img/illustration/2.png') }}" alt="dashboard">

                </div>
                
                <div class="col-lg-6 info">
                    <div class="item-box">
                        <h4>Why Choose us</h4>
                        <h2>Create your app page <br> With expert developer</h2>
                        <p>
                            Journey greatly or garrets. Draw door kept do so come on open mean. Estimating stimulated how reasonably precaution diminution she simplicity sir but. Questions am sincerity zealously concluded consisted or no gentleman it. 
                        </p>
                        <ul>
                            <li>
                                <i class="fas fa-layer-group"></i>
                                <h5>Friendly Interface</h5>
                            </li>
                            <li>
                                <i class="fas fa-fingerprint"></i>
                                <h5>Strong Encryption</h5>
                            </li>
                        </ul>
                        <div class="progress-box">
                            <h5>Success Rate</h5>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" data-width="78">
                                     <span>78%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Choose Us Area -->

    <!-- Start Fun Factor Area
    ============================================= -->
    <div class="fun-factor-area relative text-light">
        <div class="half-bg-top-gray"></div>
        <div class="container">
            <div class="fun-fact-items text-center">
                <div class="row">
                    <div class="col-lg-3 col-md-6 item">
                        <div class="fun-fact">
                            <div class="timer" data-to="687" data-speed="5000">687</div>
                            <span class="medium">Projects Completed</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 item">
                        <div class="fun-fact">
                            <div class="timer" data-to="655" data-speed="5000">655</div>
                            <span class="medium">Active clients</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 item">
                        <div class="fun-fact">
                            <div class="timer" data-to="450" data-speed="5000">450</div>
                            <span class="medium">Cups of coffee</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 item">
                        <div class="fun-fact">
                            <div class="timer" data-to="1200" data-speed="5000">1200</div>
                            <span class="medium">Happy clients</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Fun Factor Area -->

    <!-- Start Overview 
    ============================================= -->
    <div id="overview" class="overview-area relative relative default-padding carousel-shadow">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h2>Quick Software Overview</h2>
                        <div class="devider"></div>
                        <p>
                            Outlived no dwelling denoting in peculiar as he believed. Behaviour excellent middleton be as it curiosity departure ourselves very extreme future. 
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-full">
            <div class="row">
                <div class="col-lg-12">
                    <div class="overview-carousel owl-carousel owl-theme">
                        <!-- Single item -->
                        <div class="item">
                            <div class="thumb">
                                <img src="{{ asset('assets_guest/img/dashboard/4.png') }}" alt="Thumb">
                                <a href="{{ asset('assets_guest/img/dashboard/4.png') }}" class="item popup-gallery theme video-play-button">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="content">
                                <h4><span>01</span> App Intry</h4>
                            </div>
                        </div>
                        <!-- End Single item -->
                        <!-- Single item -->
                        <div class="item">
                            <div class="thumb">
                                <img src="{{ asset('assets_guest/img/dashboard/5.png') }}" alt="Thumb">
                                <a href="{{ asset('assets_guest/img/dashboard/5.png') }}" class="item popup-gallery theme video-play-button">
                                    <i class="fa fa-plus"></i>
                                </a>
                                
                            </div>
                            <div class="content">
                                <h4><span>02</span> Admin Dashboard</h4>
                            </div>
                        </div>
                        <!-- End Single item -->
                        <!-- Single item -->
                        <div class="item">
                            <div class="thumb">
                                <img src="{{ asset('assets_guest/img/dashboard/3.png') }}" alt="Thumb">
                                <a href="{{ asset('assets_guest/img/dashboard/3.png') }}" class="item popup-gallery theme video-play-button">
                                    <i class="fa fa-plus"></i>
                                </a>
                                
                            </div>
                            <div class="content">
                                <h4><span>03</span>Admin Dashboard</h4>
                            </div>
                        </div>
                        <!-- End Single item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Overview -->


    <!-- Start Pricing 
    ============================================= -->
    <div id="pricing" class="pricing-area bg-dark default-padding bottom-less">
        <div class="shape" style="background-image: url({{ asset('assets_guest/img/shape/16.png') }});"></div>

        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h2>Our Packages</h2>
                        <div class="devider"></div>
                        <p>
                            Outlived no dwelling denoting in peculiar as he believed. Behaviour excellent middleton be as it curiosity departure ourselves very extreme future. 
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="pricing-items">
                <div class="row">
                    <!-- Single Itme -->
                    <div class="col-lg-4 col-md-6 single-item">
                        <div class="pricing-item">
                            <i class="fas fa-rocket"></i>
                            <div class="pricing-header">
                                <h4>Free trial</h4>
                                <span>Save 25%</span>
                            </div>
                            <div class="price">
                                <h2><sup>$</sup>0 <sub>/ Monthly</sub></h2>
                            </div>
                            <a class="btn circle btn-theme-effect btn-sm" href="{{route('contact')}}">Purchase Plan</a>
                            <ul>
                                <li><i class="fas fa-check"></i> Demo file</li>
                                <li><i class="fas fa-check"></i> 10 GB Dedicated Hosting free</li>
                                <li><i class="fas fa-check"></i> Lifetime free Support</li>
                                <li><i class="fas fa-check"></i> SEO Optimized</li>
                                <li><i class="fas fa-times"></i> Live Support</li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Itme -->

                    <!-- Single Itme -->
                    <div class="col-lg-4 col-md-6 single-item">
                        <div class="pricing-item">
                            <i class="fas fa-gem"></i>
                            <div class="pricing-header">
                                <h4>Regular</h4>
                                <span>Save 35%</span>
                            </div>
                            <div class="price">
                                <h2><sup>$</sup>29 <sub>/ Monthly</sub></h2>
                            </div>
                            <a class="btn circle btn-theme-effect btn-sm" href="{{route('contact')}}">Purchase Plan</a>
                            <ul>
                                <li><i class="fas fa-check"></i> Demo file</li>
                                <li><i class="fas fa-check"></i> 10 GB Dedicated Hosting free</li>
                                <li><i class="fas fa-check"></i> Lifetime free Support</li>
                                <li><i class="fas fa-check"></i> SEO Optimized</li>
                                <li><i class="fas fa-times"></i> Live Support</li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Itme -->

                    <!-- Single Itme -->
                    <div class="col-lg-4 col-md-6 single-item">
                        <div class="pricing-item">
                            <i class="fa fa-chart-pie"></i>
                            <div class="pricing-header">
                                <h4>Extended</h4>
                                <span>Save 49%</span>
                            </div>
                            <div class="price">
                                <h2><sup>$</sup>59 <sub>/ Monthly</sub></h2>
                            </div>
                            <a class="btn circle btn-theme-effect btn-sm" href="{{route('contact')}}">Purchase Plan</a>
                            <ul>
                                <li><i class="fas fa-check"></i> Demo file</li>
                                <li><i class="fas fa-check"></i> 10 GB Dedicated Hosting free</li>
                                <li><i class="fas fa-check"></i> Lifetime free Support</li>
                                <li><i class="fas fa-check"></i> SEO Optimized</li>
                                <li><i class="fas fa-check"></i> Live Support</li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Itme -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Pricing Area -->


    <!-- Start Free Trial 
    ============================================= -->
    <div class="free-trial-area text-light text-center relative">
        <div class="trial-box" style="background-image: url(assets_guest/img/shape/8.png);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <h5>Free Trial</h5>
                        <h2>Start Your 14 Days Free <br> Trials Today!</h2>
                        <form action="#">
                            <input type="email" placeholder="Your Email" class="form-control" name="email">
                            <button type="submit"> Free Trial</button>  
                        </form>
                    </div>
                </div>
            </div>
            <div class="illustration">
                <img src="assets_guest/img/illustration/1.png" alt="illustration">
            </div>
        </div>
    </div>
    <!-- End Free Trial -->


@endsection
