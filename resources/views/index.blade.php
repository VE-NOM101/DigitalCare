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

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

    <!-- LOADER -->
    <!-- <div id="preloader">
  <div class="loader">
   <img src="images/preloader.gif" alt="" />
  </div>
    </div>end loader -->
    <!-- END LOADER -->

    <!-- Start top bar -->
    <div class="main-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-top">
                        <a class="new-btn-d br-2" href="/login"><span>
                                @if (Auth::user())
                                    {{ 'Dashboard' }}@else{{ 'Log in' }}
                                @endif
                            </span></a>
                        @if (Auth::user())
                            <a class="new-btn-d br-2" href="/logout"><span>Log Out</span></a>
                        @else
                            <a class="new-btn-d br-2" href="/register"><span>Sign Up</span></a>
                        @endif

                        <div class="p-2"><a href="{{ url('/book_ambulance/') }}" class="btn btn-danger"><i
                                    class="fa fa-ambulance" aria-hidden="true"></i>Emergency Ambulance</a>
                        </div>
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
    @include('auth.info')
    <!-- Start header -->
    <header class="top-header">
        <nav class="navbar header-nav navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/index"><img src="{{ config('app.url') }}/Frontend/images/logo.png"
                        alt="image"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-wd"
                    aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                    <ul class="navbar-nav">
                        <li><a class="nav-link active" href="#home">Home</a></li>
                        <li><a class="nav-link" href="#about">About Us</a></li>
                        <li><a class="nav-link" href="#services">Services</a></li>
                        <li><a class="nav-link" href="#appointment">Appointment</a></li>
                        <li><a class="nav-link" href="#departments">Departments</a></li>
                        <li><a class="nav-link" href="#gallery">Gallery</a></li>
                        <li><a class="nav-link" href="#team">Doctor</a></li>
                        <li><a class="nav-link" href="#blog">Campaign</a></li>
                        <li><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- End header -->

    <!-- Start Banner -->
    <div class="ulockd-home-slider">
        <div class="container-fluid">
            <div class="row">
                <div class="pogoSlider" id="js-main-slider">
                    <div class="pogoSlider-slide" data-transition="fade" data-duration="1500"
                        style="background-image:url({{ config('app.url') }}/Frontend/images/slider-01.jpg);">
                        <div class="lbox-caption pogoSlider-slide-element">
                            <div class="lbox-details">
                                <h1>Welcome to Health Lab</h1>
                                <p>Fusce convallis ante id purus sagittis malesuada. Sed erat ipsum </p>
                                <a href="#" class="btn">Contact Us</a>
                            </div>
                        </div>
                    </div>
                    <div class="pogoSlider-slide" data-transition="fade" data-duration="1500"
                        style="background-image:url({{ config('app.url') }}/Frontend/images/slider-02.jpg);">
                        <div class="lbox-caption pogoSlider-slide-element">
                            <div class="lbox-details">
                                <h1>We are Expert in The Field of Health Lab</h1>
                                <p>Fusce convallis ante id purus sagittis malesuada. Sed erat ipsum</p>
                                <a href="#appointment" class="btn">Appointment</a>
                            </div>
                        </div>
                    </div>
                    <div class="pogoSlider-slide" data-transition="fade" data-duration="1500"
                        style="background-image:url({{ config('app.url') }}/Frontend/images/slider-03.jpg);">
                        <div class="lbox-caption pogoSlider-slide-element">
                            <div class="lbox-details">
                                <h1>Welcome to Health Lab</h1>
                                <p>Fusce convallis ante id purus sagittis malesuada. Sed erat ipsum </p>
                                <a href="#" class="btn">Contact Us</a>
                            </div>
                        </div>

                    </div>
                </div><!-- .pogoSlider -->
            </div>
        </div>
    </div>
    <!-- End Banner -->

    <!-- Start About us -->
    <div id="about" class="about-box">
        <div class="about-a1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title-box">
                            <h2>About Us</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row align-items-center about-main-info">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h2> Welcome to Health Lab </h2>
                                <p>Fusce convallis ante id purus sagittis malesuada. Sed erat ipsum, suscipit sit amet
                                    auctor quis, vehicula ut leo. Maecenas felis nulla, tincidunt ac blandit a,
                                    consectetur quis elit. Nulla ut magna eu purus cursus sagittis. Praesent fermentum
                                    tincidunt varius. Proin sit amet tempus magna. Fusce pellentesque vulputate urna.
                                </p>
                                <p>Fusce convallis ante id purus sagittis malesuada. Sed erat ipsum, suscipit sit amet
                                    auctor quis, vehicula ut leo. Maecenas felis nulla, tincidunt ac blandit a,
                                    consectetur quis elit. Nulla ut magna eu purus cursus sagittis. Praesent fermentum
                                    tincidunt varius. Proin sit amet tempus magna. Fusce pellentesque vulputate urna.
                                </p>
                                <a href="#" class="new-btn-d br-2">Read More</a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="about-m">
                                    <ul id="banner">
                                        <li>
                                            <img src="{{ config('app.url') }}/Frontend/images/about-img-01.jpg"
                                                alt="">
                                        </li>
                                        <li>
                                            <img src="{{ config('app.url') }}/Frontend/images/about-img-02.jpg"
                                                alt="">
                                        </li>
                                        <li>
                                            <img src="{{ config('app.url') }}/Frontend/images/about-img-03.jpg"
                                                alt="">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About us -->

    <!-- Start Services -->
    <div id="services" class="services-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-box">
                        <h2>Services</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="serviceBox">
                                <div class="service-icon"><i class="fa fa-h-square" aria-hidden="true"></i></div>
                                <h3 class="title">Lorem ipsum dolor</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur.
                                </p>
                                <a href="#" class="new-btn-d br-2">Read More</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="serviceBox">
                                <div class="service-icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
                                <h3 class="title">Lorem ipsum dolor</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur.
                                </p>
                                <a href="#" class="new-btn-d br-2">Read More</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="serviceBox">
                                <div class="service-icon"><i class="fa fa-hospital-o" aria-hidden="true"></i></div>
                                <h3 class="title">Lorem ipsum dolor</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur.
                                </p>
                                <a href="#" class="new-btn-d br-2">Read More</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="serviceBox">
                                <div class="service-icon"><i class="fa fa-stethoscope" aria-hidden="true"></i></div>
                                <h3 class="title">Lorem ipsum dolor</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur.
                                </p>
                                <a href="#" class="new-btn-d br-2">Read More</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="serviceBox">
                                <div class="service-icon"><i class="fa fa-wheelchair" aria-hidden="true"></i></div>
                                <h3 class="title">Lorem ipsum dolor</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur.
                                </p>
                                <a href="#" class="new-btn-d br-2">Read More</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="serviceBox">
                                <div class="service-icon"><i class="fa fa-plus-square" aria-hidden="true"></i></div>
                                <h3 class="title">Lorem ipsum dolor</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur.
                                </p>
                                <a href="#" class="new-btn-d br-2">Read More</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="serviceBox">
                                <div class="service-icon"><i class="fa fa-medkit" aria-hidden="true"></i></div>
                                <h3 class="title">Lorem ipsum dolor</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur.
                                </p>
                                <a href="#" class="new-btn-d br-2">Read More</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="serviceBox">
                                <div class="service-icon"><i class="fa fa-user-md" aria-hidden="true"></i></div>
                                <h3 class="title">Lorem ipsum dolor</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur.
                                </p>
                                <a href="#" class="new-btn-d br-2">Read More</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="serviceBox">
                                <div class="service-icon"><i class="fa fa-ambulance" aria-hidden="true"></i></div>
                                <h3 class="title">Lorem ipsum dolor</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur.
                                </p>
                                <a href="#" class="new-btn-d br-2">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services -->

    <!-- Start Appointment -->
    <div id="appointment" class="appointment-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-box">
                        <h2>Appointment</h2>
                        <p>Any medical concerns or issues?</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="well-block">
                        <div class="well-title">
                            <h2>Book an Appointment</h2>
                        </div>
                        @include('auth.error')
                        @include('auth.message')
                        @if (Auth::user())
                            <form action="{{ url('/request_appointment') }}" method="POST">
                                @csrf
                                <!-- Form start -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="name">Name</label>
                                            <input id="name" name="name" type="text"
                                                placeholder="{{ Auth::user()->name }}"
                                                value="{{ Auth::user()->name }}" disabled
                                                class="form-control input-md">
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="email">Email</label>
                                            <input id="email" name="email" type="email"
                                                placeholder="{{ Auth::user()->email }}"
                                                value="{{ Auth::user()->email }}" disabled
                                                class="form-control input-md">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="phone">Phone</label>
                                            <input id="phone" name="phone" type="text" placeholder="Phone"
                                                class="form-control input-md">
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="date">Preferred Date</label>
                                            <input id="date" name="preferred_date" type="date"
                                                class="form-control input-md">
                                        </div>
                                    </div>
                                    <!-- Select Basic -->
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="time">Preferred Time</label>
                                            <input id="time" name="preferred_time" type="time"
                                                class="form-control input-md">
                                        </div>
                                    </div> --}}
                                    <!-- Select Basic -->

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="doctorlist">Doctor</label>
                                            <select id="doctorlist" name="doctor_id" class="form-control">
                                                <option value="{{ $getDoctor->first()->id }}">
                                                    {{ $getDoctor->first()->name . ' ( ' . $getDepartment->find($getDoctor->first()->department_id)->name . ' )' }}
                                                </option>
                                                @foreach ($getDoctor as $item)
                                                    @if ($item->id != $getDoctor->first()->id)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name . ' ( ' . $getDepartment->find($item->department_id)->name . ' )' }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="time">Description</label>
                                            <textarea name="description" class="form-control" id="about" style="height: 100px"></textarea>
                                        </div>
                                    </div>
                                    <!-- Button -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="singlebutton" name="singlebutton" class="new-btn-d br-2">Make
                                                An Appointment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div style="font-size:1.5rem;" class="alert alert-warning alert-dismissible fade show"
                                role="alert">
                                Please login first
                            </div>
                        @endif
                        <!-- form end -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="well-block">
                        <div class="well-title">
                            <h2>Why Appointment with Us</h2>
                        </div>
                        <div class="feature-block">
                            <div class="feature feature-blurb-text">
                                <h4 class="feature-title">24/7 Hours Available</h4>
                                <div class="feature-content">
                                    <p>Integer nec nisi sed mi hendrerit mattis. Vestibulum mi nunc, ultricies quis
                                        vehicula et, iaculis in magnestibulum.</p>
                                </div>
                            </div>
                            <div class="feature feature-blurb-text">
                                <h4 class="feature-title">Experienced Staff Available</h4>
                                <div class="feature-content">
                                    <p>Aliquam sit amet mi eu libero fermentum bibendum pulvinar a turpis. Vestibulum
                                        quis feugiat risus. </p>
                                </div>
                            </div>
                            <div class="feature feature-blurb-text">
                                <h4 class="feature-title">Low Price & Fees</h4>
                                <div class="feature-content">
                                    <p>Praesent eu sollicitudin nunc. Cras malesuada vel nisi consequat pretium. Integer
                                        auctor elementum nulla suscipit in.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Appointment -->

    <!-- Start Departments -->
    <div id="departments" class="services-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-box">
                        <h2>Departments</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme">
                        @foreach ($getDepartment as $item)
                            <div class="item">
                                <div class="serviceBox">
                                    <div class="service-icon"><img
                                            style="border-radius: 50%; width:80px; height:80px;"
                                            src="{{ asset('digitalcare/admin/departments/' . $item->photo_path) }}"
                                            alt="{{ $item->photo_path }}" /></i></div>
                                    <h3 class="title">{{ $item->name }}</h3>
                                    <div style="height: 300px; overflow-y: auto;">
                                        <p class="description">
                                            {{ $item->description }}
                                        </p>
                                    </div>

                                    <a href="https://www.kokilabenhospital.com/departments/clinical.html"
                                        class="new-btn-d br-2">Read More</a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Departments -->

    <!-- Start Gallery -->
    <div id="gallery" class="gallery-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-box">
                        <h2>Gallery</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                    </div>
                </div>
            </div>

            <div class="popup-gallery row clearfix">
                <div class="col-md-3 col-sm-6">
                    <div class="box-gallery">
                        <img src="{{ config('app.url') }}/Frontend/images/gallery-01.jpg" alt="">
                        <div class="box-content">
                            <h3 class="title">Lorem ipsum dolor</h3>
                            <ul class="icon">
                                <li><a href="{{ config('app.url') }}/Frontend/images/gallery-01.jpg"><i
                                            class="fa fa-picture-o" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="box-gallery">
                        <img src="{{ config('app.url') }}/Frontend/images/gallery-02.jpg" alt="">
                        <div class="box-content">
                            <h3 class="title">Lorem ipsum dolor</h3>
                            <ul class="icon">
                                <li><a href="{{ config('app.url') }}/Frontend/images/gallery-02.jpg"><i
                                            class="fa fa-picture-o" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="box-gallery">
                        <img src="{{ config('app.url') }}/Frontend/images/gallery-03.jpg" alt="">
                        <div class="box-content">
                            <ul class="icon">
                                <li><a href="{{ config('app.url') }}/Frontend/images/gallery-03.jpg"><i
                                            class="fa fa-picture-o" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="box-gallery">
                        <img src="{{ config('app.url') }}/Frontend/images/gallery-04.jpg" alt="">
                        <div class="box-content">
                            <h3 class="title">Lorem ipsum dolor</h3>
                            <ul class="icon">
                                <li><a href="{{ config('app.url') }}/Frontend/images/gallery-04.jpg"><i
                                            class="fa fa-picture-o" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="box-gallery">
                        <img src="{{ config('app.url') }}/Frontend/images/gallery-05.jpg" alt="">
                        <div class="box-content">
                            <h3 class="title">Lorem ipsum dolor</h3>
                            <ul class="icon">
                                <li><a href="{{ config('app.url') }}/Frontend/images/gallery-05.jpg"><i
                                            class="fa fa-picture-o" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="box-gallery">
                        <img src="{{ config('app.url') }}/Frontend/images/gallery-06.jpg" alt="">
                        <div class="box-content">
                            <h3 class="title">Lorem ipsum dolor</h3>
                            <ul class="icon">
                                <li><a href="{{ config('app.url') }}/Frontend/images/gallery-06.jpg"><i
                                            class="fa fa-picture-o" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="box-gallery">
                        <img src="{{ config('app.url') }}/Frontend/images/gallery-07.jpg" alt="">
                        <div class="box-content">
                            <h3 class="title">Lorem ipsum dolor</h3>
                            <ul class="icon">
                                <li><a href="{{ config('app.url') }}/Frontend/images/gallery-07.jpg"><i
                                            class="fa fa-picture-o" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="box-gallery">
                        <img src="{{ config('app.url') }}/Frontend/images/gallery-08.jpg" alt="">
                        <div class="box-content">
                            <h3 class="title">Lorem ipsum dolor</h3>
                            <ul class="icon">
                                <li><a href="{{ config('app.url') }}/Frontend/images/gallery-08.jpg"><i
                                            class="fa fa-picture-o" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Gallery -->

    <!-- Start Team -->
    <div id="team" class="team-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-box">
                        <h2>Our Doctor</h2>
                        <p>Meet the best, Get treatment from expert.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($getDoctor as $item)
                    <div class="col-md-4 col-sm-6">
                        <div class="our-team">
                            <div class="pic">
                                <img style="max-height: 400px;"
                                    src="@if ($item->photo_path) {{ asset('digitalcare/doctors/profile/' . $item->photo_path) }} @else{{ asset('digitalcare/doctors/profile/img-1.jpg') }} @endif"
                                    alt="Photo">
                            </div>
                            <div class="team-content">
                                <h3 class="title">{{ $item->name }}</h3>
                                <span class="post">{{ $getDepartment->find($item->department_id)->name }}</span>
                                <ul class="social">
                                    <li><a href="{{ $item->facebook }}"><i class="fa fa-facebook"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="{{ $item->linkedin }}"><i class="fa fa-linkedin"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="mailto:{{ $item->email }}"><i class="fa fa-envelope"
                                                aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    </div>

    <!-- End Team -->

    <!-- Start Blog -->
    <div id="blog" class="blog-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-box">
                        <h2>Campaign</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($getCampaign as $item)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="blog-inner">
                            <div class="blog-img">
                                <img class="img-fluid" src="{{asset('digitalcare/admin/campaign/'.$item->photo_path) }}"
                                    alt="" />
                            </div>
                            <div class="item-meta">
                                @if($item->type=="free") <span class="badge bg-success">Free</span>
                                @else <span class="badge bg-warning">Paid</span>
                                <span class="badge bg-danger">{{$item->reg_fee}} Tk</span>
                                @endif
                                <a href="#"><i class="fa fa-user-o"></i> Admin</a>
                                <span class="dti">{{ \Carbon\Carbon::parse($item->from_date)->format('d-M-Y') }} -
                                    {{ \Carbon\Carbon::parse($item->to_date)->format('d-M-Y') }} At {{ \Carbon\Carbon::parse($item->time)->format('H:i A') }}</span>
                            </div>
                            <h2>{{$item->name}}</h2>
                            <p style="height: 200px; overflow-y: auto;">{{ $item->description }}</p>

                            <a class="new-btn-d br-2" href="{{$item->form_link}}">Register Now <i class="fa fa-angle-double-right"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
    <!-- End Blog -->

    <!-- Start Contact -->
    <div id="contact" class="contact-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-box">
                        <h2>Contact us</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-12 col-xs-12">
                    <div class="contact-block">
                        <form id="contactForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Your Name" required data-error="Please enter your name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" placeholder="Your Email" id="email"
                                            class="form-control" name="name" required
                                            data-error="Please enter your email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Your number" id="number"
                                            class="form-control" name="number" required
                                            data-error="Please enter your number">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" id="message" placeholder="Your Message" rows="8"
                                            data-error="Write your message" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="submit-button text-center">
                                        <button class="btn btn-common" id="submit" type="submit">Send
                                            Message</button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-lg-12 col-xs-12">
                    <div class="left-contact">
                        <h2>Address</h2>
                        <div class="media cont-line">
                            <div class="media-left icon-b">
                                <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            </div>
                            <div class="media-body dit-right">
                                <h4>Address</h4>
                                <p>Fleming 196 Woodside Circle Mobile, FL 36602</p>
                            </div>
                        </div>
                        <div class="media cont-line">
                            <div class="media-left icon-b">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </div>
                            <div class="media-body dit-right">
                                <h4>Email</h4>
                                <a href="#">demoinfo@gmail.com</a><br>
                                <a href="#">demoinfo@gmail.com</a>
                            </div>
                        </div>
                        <div class="media cont-line">
                            <div class="media-left icon-b">
                                <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                            </div>
                            <div class="media-body dit-right">
                                <h4>Phone Number</h4>
                                <a href="#">12345 67890</a><br>
                                <a href="#">12345 67890</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- End Contact -->

    <!-- Start Subscribe -->
    <div class="subscribe-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="subscribe-inner text-center clearfix">
                        <h2>Subscribe</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.</p>
                        <form action="#" method="post">
                            <div class="form-group">
                                <input class="form-control-1" id="email-1" name="email"
                                    placeholder="Email Address" required="" type="text">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="new-btn-d br-2">
                                    Subscribe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Subscribe -->

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

</html>
