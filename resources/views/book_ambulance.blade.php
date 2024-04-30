<!DOCTYPE html>
<html lang="en"><!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <title>DigitalCare</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{ config('app.url') }}/Frontend/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ config('app.url') }}/Frontend/images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ config('app.url') }}/Frontend/css/bootstrap.min.css">
    <!-- Pogo Slider CSS -->
    <link rel="stylesheet" href="{{ config('app.url') }}/Frontend/css/pogo-slider.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{ config('app.url') }}/Frontend/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ config('app.url') }}/Frontend/css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ config('app.url') }}/Frontend/css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body data-spy="scroll">

    <!-- Start top bar -->
    <div class="main-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-top">
                        <a class="new-btn-d br-2" href="/index"><span>Home
                            </span></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="wel-nots">
                        <p>Welcome to Our Health Lab!</p>
                    </div>
                    <div class="right-top">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End top bar -->

    <div id="appointment" class="appointment-main">
        <div class="container">
            @include('auth.message')
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-box">
                        <h2><i class="fa fa-ambulance btn btn-danger" aria-hidden="true"></i>Emergency Ambulance</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="well-block">
                        <div class="well-title">
                            <h2>Fill Up Quick Information</h2>
                        </div>
                        <form action="{{url('/book_ambulance')}}" method="POST">
                            @csrf
                            <!-- Form start -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Name</label>
                                        <input id="name" name="name" type="text" placeholder="Name"
                                            class="form-control input-md">
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="phone">Phone</label>
                                        <input id="phone" name="phone" type="text" placeholder="Phone"
                                            class="form-control input-md">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="phone">City</label>
                                        <input id="city" name="city" type="text" placeholder="Leave empty for current address"
                                            class="form-control input-md">
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" id="singlebutton" name="singlebutton"
                                            class="new-btn-d br-2">Book</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- form end -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="well-block">
                        <div class="well-title">
                            <h2>Don't Warry!</h2>
                        </div>
                        <div class="feature-block">
                            <img style="width:25rem; height:20rem;"
                                src="{{ asset('/digitalcare/ambulance/ambulance.jpg') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Footer -->
    <footer class="footer-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="footer-company-name">All Rights Reserved. &copy; 2018 <a href="#">Health Lab</a>
                        Design By : <a href="https://html.design/">html design</a></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" id="scroll-to-top" class="new-btn-d br-2"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="{{ config('app.url') }}/Frontend/js/jquery.min.js"></script>
    <script src="{{ config('app.url') }}/Frontend/js/popper.min.js"></script>
    <script src="{{ config('app.url') }}/Frontend/js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="{{ config('app.url') }}/Frontend/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ config('app.url') }}/Frontend/js/jquery.pogo-slider.min.js"></script>
    <script src="{{ config('app.url') }}/Frontend/js/slider-index.js"></script>
    <script src="{{ config('app.url') }}/Frontend/js/smoothscroll.js"></script>
    <script src="{{ config('app.url') }}/Frontend/js/TweenMax.min.js"></script>
    <script src="{{ config('app.url') }}/Frontend/js/main.js"></script>
    <script src="{{ config('app.url') }}/Frontend/js/owl.carousel.min.js"></script>
    <script src="{{ config('app.url') }}/Frontend/js/form-validator.min.js"></script>
    <script src="{{ config('app.url') }}/Frontend/js/contact-form-script.js"></script>
    <script src="{{ config('app.url') }}/Frontend/js/isotope.min.js"></script>
    <script src="{{ config('app.url') }}/Frontend/js/images-loded.min.js"></script>
    <script src="{{ config('app.url') }}/Frontend/js/custom.js"></script>
</body>
