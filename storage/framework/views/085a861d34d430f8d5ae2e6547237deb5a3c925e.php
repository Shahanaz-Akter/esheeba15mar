<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/website/css/bootstrap.min.css')); ?>">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/website/css/nice-select.min.css')); ?>">
    <!-- Box Icon CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/website/css/boxicons.min.css')); ?>">
    <!-- Modal Video CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/website/css/modal-video.min.css')); ?>">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/website/css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/website/css/owl.theme.default.min.css')); ?>">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/website/css/slick.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/website/css/slick-theme.css')); ?>">
    <!-- Odo Meter CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/website/css/odometer.min.css')); ?>">
    <!-- Swiper Slider CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/website/css/swiper-bundle.min.css')); ?>">
    <!-- Style CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/website/css/style.css')); ?>">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/website/css/responsive.css')); ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>eSheeba</title>

    <link rel="icon" type="image/png" href="<?php echo e(asset('public/website/images/favicon.png')); ?>">


    <style>
        /*.row{*/
        /*    text-align:center;*/
        /*}*/

        .pb-50 {
            padding-bottom: 50px;
        }

        #services {
            border-radius: 10px !important;
        }
    </style>

</head>

<body data-bs-spy="scroll" data-bs-offset="70" cz-shortcut-listen="true">

    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "101392599256879");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v14.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>



    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light two fixed-top">
        <div class="container">
            <a class="navbar-brand" href="https://esheeba.com">
                <!-- <img src="https://img.freepik.com/free-photo/beautiful-fashion-woman-violet-long-dress-hairstyle-with-pigtails-design-poses-studio_186202-3458.jpg?w=740&t=st=1699242879~exp=1699243479~hmac=98f3bd947611b4b79aa4df787b2a66427e43d7ea4cfa13853a0b7bcb4fe11c8f" alt=""> -->
                <img src="<?php echo e(asset('public/website/images/logo.png')); ?>" alt="Logo">
            </a>
            <span class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars-staggered"></i>
            </span>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#service">Services</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#nurses">Nurses</a>
                    </li>
                    <!-- <li class="nav-item">
                            <a class="nav-link" href="#screenshots">App Preview</a>
                        </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>

                </ul>

                <div class="side-nav five">
                    <div class="language">
                        <select name='lang' id='lang' onchange="reroute()">
                            <option value="en" selected>English</option>
                            <option value="bn">বাংলা</option>
                        </select>
                        <!--<div class="nice-select" tabindex="0">-->
                        <!--    <span class="current">English</span>-->
                        <!--    <ul class="list">-->
                        <!--        <li data-value="en" class="option" onclick="reroute('en')">English</li>-->
                        <!--        <li data-value="bn" class="option focus" onclick="reroute('en')">বাংলা</li>-->
                        <!--    </ul>-->
                        <!--</div>-->
                    </div>
                    <a href="https://wa.me/+8801710167688" target="_blank">
                        <img src="<?php echo e(asset('public/website/images/WA-EN.png')); ?>" style="width:50%; height:auto;">
                    </a>
                </div>

            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Banner -->
    <div id="home" class="banner-max-size">
        <div class="banner-area six">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-6">
                        <div class="banner-content">
                            <h1>All Nursing Services in Just One Tap</h1>
                            <div class="banner-btn-area">
                                <span style="color:white">Download App From</span>
                                <a class="common-btn" href="https://play.google.com/store/apps/details?id=com.esheeba.app" target="_blank">
                                    <i class="fa-brands fa-google-play"></i>&nbsp;&nbsp;
                                    Play Store
                                </a>
                                <!-- <a class="common-btn banner-btn" href="#" target="_blank">
                                        <i class="fa-brands fa-apple"></i>&nbsp;&nbsp;
                                        Apple Store
                                    </a> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="banner-img">
                            <img src="<?php echo e(asset('public/website/images/landingpage.png')); ?>" alt="Mobile">
                        </div>
                    </div>

                </div>
            </div>

            <div class="banner-shape-two">
                <img src="<?php echo e(asset('public/website/images/shape16.png')); ?>" alt="Shape">
                <img src="<?php echo e(asset('public/website/images/shape17.png')); ?>" alt="Shape">
                <img src="<?php echo e(asset('public/website/images/shape18.png')); ?>" alt="Shape">
                <img src="<?php echo e(asset('public/website/images/shape19.png')); ?>" alt="Shape">
                <img src="<?php echo e(asset('public/website/images/shape20.png')); ?>" alt="Shape">
            </div>

            <!--<div class="banner-play-btn">-->
            <!--    <button class="js-modal-btn" data-video-id="YLtFGWVWiGo">-->
            <!--        <i class="fa-solid fa-play" style="font-size:40px"></i>-->
            <!--    </button>-->
            <!--</div>-->

        </div>
    </div>
    <!-- End Banner -->



    <!-- Services -->

    <section class="testimonials-area two ptb-100" id="service">
        <div class="testimonials-shape">
            <img src="<?php echo e(asset('public/website/images/quote-shape1.png')); ?>" alt="Shape">
            <img src="<?php echo e(asset('public/website/images/quote-shape2.png')); ?>" alt="Shape">
        </div>
        <div class="container">
            <div class="section-title">
                <h2 class="pt-100">Our Dedicated Services</h2>
            </div>
            <div class="testimonials-slider-two services owl-theme owl-carousel owl-loaded owl-drag">

                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(-1425px, 0px, 0px); transition: all 0s ease 0s; width: 4754px;">

                        <div class="owl-item " style="width: 445.333px; margin-right: 30px;">
                            <div class="testimonials-item">

                                <img src="<?php echo e(asset('public/website/images/services/injection.png')); ?>" id="services" alt="Injection Service">
                                <h4>Injection Home Service</h4>

                            </div>
                        </div>
                        <div class="owl-item  " style="width: 445.333px; margin-right: 30px;">
                            <div class="testimonials-item">

                                <img src="<?php echo e(asset('public/website/images/services/dressing.png')); ?>" id="services" alt="Dressing Service">
                                <h4>Dressing Home Service</h4>
                            </div>
                        </div>
                        <div class="owl-item  " style="width: 445.333px; margin-right: 30px;">
                            <div class="testimonials-item">

                                <img src="<?php echo e(asset('public/website/images/services/therapy.png')); ?>" id="services" alt="Therapy Service">
                                <h4>Therapy Service</h4>
                            </div>
                        </div>
                        <div class="owl-item  " style="width: 445.333px; margin-right: 30px;">
                            <div class="testimonials-item">

                                <img src="<?php echo e(asset('public/website/images/services/day_care.png')); ?>" id="services" alt="Day Care Service">
                                <h4>Day Care Service</h4>

                            </div>
                        </div>
                        <div class="owl-item  " style="width: 445.333px; margin-right: 30px;">
                            <div class="testimonials-item">

                                <img src="<?php echo e(asset('public/website/images/services/blooddonation.png')); ?>" id="services" alt="Blood Donation Service">
                                <h4>Blood Donation Service</h4>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </section>
    <!-- End Services -->

    <!-- Quote -->
    <div class="quote-area pt-100 pb-70" id="contact">
        <div class="quote-shape">
            <img src="<?php echo e(asset('public/website/images/quote-shape1.png')); ?>" alt="Shape">

        </div>
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6">
                    <div class="quote-content">
                        <div class="section-title">

                            <h2>Contact</h2>

                        </div>
                        <ul>
                            <li>
                                <i class="fa-solid fa-phone"></i>
                                <a href="tel:+8801710167688">+880 1710-167688</a>

                            </li>
                            <li>
                                <i class="fa-solid fa-envelope"></i>
                                <a href="mailto:esheebabd@gmail.com">esheebabd@gmail.com</a>

                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">

                    <img src="<?php echo e(asset('public/website/images/phone (1).png')); ?>">

                </div>

            </div>
        </div>
    </div>
    <!-- End Quote -->

    <!-- About -->
    <div id="about" class="about-area three five pt-100 pb-70">
        <div class="container">
            <div class="row">

                <div class="col-lg-7">
                    <div class="about-content">
                        <ul>
                            <li>

                                <h3>About</h3>
                                <p>Esheeba is an online based platform where users can get medical services. We have created this platform where medical services are available for everyone. Esheeba app is available in playstore and you can get the service through the app. We provide and ensure the nursing service with utmost care. We are proud to be in the Telemedicine industry.</p>
                            </li>
                            <li>

                                <h3>Mission</h3>
                                <p>Our mission is to provide and improve the health and well-being of the people by ensuring highly effective service and care.</p>
                            </li>
                            <li>

                                <h3>Vision</h3>
                                <p>It is our vision to be a recognized as a community in which all people can achieve their full potential for health and well-being across the lifespan.</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="about-img-three">
                        <img src="<?php echo e(asset('public/website/images/nurse.png')); ?>" alt="About">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End About -->

    <!-- App -->
    <section id="features" class="app-area two three pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>Powerful Products With Delighted Features</h2>
            </div>
            <div class="row align-items-center justify-content-center">

                <div class="col-lg-4">
                    <div class="app-item">

                        <div class="app-inner justify-content-center">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                            <h3>
                                <a href="#">Use On Any Device</a>
                            </h3>
                            <p>The App is built to perform on any device flawlessly</p>

                        </div>

                        <div class="app-inner">
                            <i class="fa-solid fa-snowflake"></i>
                            <h3>
                                <a href="#">Attractive Interface</a>
                            </h3>
                            <p>The Interface is designed to ease up the whole experience</p>
                        </div>



                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="app-item">

                        <div class="app-img">
                            <img src="<?php echo e(asset('public/website/images/phone.png')); ?>" alt="App">
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="app-item">


                        <div class="app-inner">
                            <i class="fa-solid fa-display"></i>
                            <h3>
                                <a href="">Fully Responsive</a>
                            </h3>
                            <p>The App is fully responsive in every platform and device</p>
                        </div>

                        <div class="app-inner">
                            <i class="fa-solid fa-globe"></i>
                            <h3>
                                <a href="">Browser Compatibility</a>
                            </h3>
                            <p>Works flawlessly giving responsive design in every browser</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End App -->


    <!-- Screenshots -->
    <!-- <section id="screenshots" class="screenshots-area pt-100 pb-100">
            <div class="container-fluid p-0">
                <div class="section-title">
                    <h2>Checkout Our App Interface Screenshots</h2>
                </div>
                <div class="screenshots-slider owl-theme owl-carousel owl-loaded owl-drag">

                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transition: all 1s ease 0s; width: 6122px; transform: translate3d(-3060px, 0px, 0px);">
                    <div class="owl-item cloned" style="width: 292.167px; margin-right: 30px;">
                    <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/2.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item cloned" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/3.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item cloned" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/4.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item cloned" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/5.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item cloned" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/1.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item cloned" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/2.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/1.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/2.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/3.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/4.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item active" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/5.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item active" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/1.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item active center" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/2.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item cloned active" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/1.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item cloned active" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/2.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item cloned active" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/3.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item cloned" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/4.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item cloned" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/5.png')); ?>" alt="Screenshots">
                    </div>
                </div>
                <div class="owl-item cloned" style="width: 292.167px; margin-right: 30px;">
                <div class="screenshots-item">
                        <img src="<?php echo e(asset('public/website/images/1.png')); ?>" alt="Screenshots">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="owl-nav">
        </div>
        <div class="owl-dots disabled"></div>
    </div>
    </div>
    </section> -->
    <!-- End Screenshots -->

    <!-- Testimonials -->
    <section id="nurses" class="testimonials-area two ptb-100">
        <div class="testimonials-shape">
            <img src="<?php echo e(asset('public/website/images/quote-shape1.png')); ?>" alt="Shape">
            <img src="<?php echo e(asset('public/website/images/quote-shape2.png')); ?>" alt="Shape">
        </div>
        <div class="container">
            <div class="section-title">
                <h2>Our Professional Nurses</h2>
            </div>
            <div class="testimonials-slider-two nurses owl-theme owl-carousel owl-loaded owl-drag">

                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(-1425px, 0px, 0px); transition: all 0s ease 0s; width: 4754px;">
                        <div class="owl-item  " style="width: 445.333px; margin-right: 30px;">
                            <div class="testimonials-item">

                                <img src="<?php echo e(asset('public/website/images/nurse1.jpg')); ?>" alt="Nurse">
                                <h4>Papia Akter</h4>
                                <span>Labaid Hospital</span>
                                <span>Work Experience : 4 Years</span>

                            </div>
                        </div>
                        <div class="owl-item  " style="width: 445.333px; margin-right: 30px;">
                            <div class="testimonials-item">

                                <img src="<?php echo e(asset('public/website/images/nurse2.jpg')); ?>" alt="Nurse">
                                <h4>Arju Akter</h4>
                                <span>Uttara Crescent Hospital</span>
                                <span>Work Experience : 13 Years</span>

                            </div>
                        </div>
                        <div class="owl-item  " style="width: 445.333px; margin-right: 30px;">
                            <div class="testimonials-item">

                                <img src="<?php echo e(asset('public/website/images/nurse3.jpg')); ?>" alt="Nurse">
                                <h4>Shahana Akter</h4>
                                <span>Uttara Crescent Hospital</span>
                                <span>Work Experience : 3 Years</span>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </section>
    <!-- End Testimonials -->


    <!-- Copyright -->
    <div class="copyright-area">
        <div class="container">
            <div align="center">
                <div class="footer-item">
                    <div class="footer-logo">
                        <ul>
                            <li>
                                <a href="https://www.facebook.com/esheeba" target="_blank">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fa-brands fa-google-plus-g"></i>

                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            date_default_timezone_set("Asia/Dhaka");
            $current_year = date('Y');

            ?>
            <p>Copyright ©<?= $current_year ?> Esheeba. Designed By <a href="https://ztrios.com/" target="_blank">Ztrios Tech & Marketing</a></p>
        </div>
    </div>
    <!-- End Copyright -->

    <!-- Go Top -->
    <div class="go-top">
        <i class="fa-solid fa-circle-arrow-up"></i>
        <i class="fa-solid fa-circle-arrow-up"></i>
    </div>
    <!-- End Go Top -->


    <!-- Essential JS -->
    <script src="<?php echo e(asset('public/website/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/website/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/website/js/bootstrap.min.js')); ?>"></script>
    <!-- Form Validator JS -->
    <script src="<?php echo e(asset('public/website/js/form-validator.min.js')); ?>"></script>
    <!-- Contact JS -->
    <script src="<?php echo e(asset('public/website/js/contact-form-script.js')); ?>"></script>
    <!-- Ajax Chip JS -->
    <script src="<?php echo e(asset('public/website/js/jquery.ajaxchimp.min.js')); ?>"></script>
    <!-- Nice Select JS -->
    <script src="<?php echo e(asset('public/website/js/jquery.nice-select.min.js')); ?>"></script>
    <!-- Modal Video JS -->
    <script src="<?php echo e(asset('public/website/js/jquery-modal-video.min.js')); ?>"></script>
    <!-- Owl Carousel JS -->
    <script src="<?php echo e(asset('public/website/js/owl.carousel.min.js')); ?>"></script>
    <!-- Slick JS -->
    <script src="<?php echo e(asset('public/website/js/slick.min.js')); ?>"></script>
    <!-- Odo Meter JS -->
    <script src="<?php echo e(asset('public/website/js/odometer.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/website/js/jquery.appear.min.js')); ?>"></script>
    <!-- Swiper Slider JS -->
    <script src="<?php echo e(asset('public/website/js/swiper-bundle.min.js')); ?>"></script>
    <!-- Custom JS -->
    <script src="<?php echo e(asset('public/website/js/custom.js')); ?>"></script>

    <script>
        function reroute() {
            var lang = document.getElementById('lang').value;
            window.location = "/" + lang;
        }
    </script>


</body>

</html><?php /**PATH /home/858192.cloudwaysapps.com/xnrkmuucrp/public_html/resources/views/website/en.blade.php ENDPATH**/ ?>