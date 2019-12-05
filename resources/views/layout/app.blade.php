<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144375505-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-144375505-1');
    var siteurl = '<?php echo url('/')?>';
    </script>

    <meta charset="utf-8">
    <title>:: Ways - Next Generation Tolling ::</title> 
    <link rel="shortcut icon" href="<?php echo url('/');?>/assets/images/favicon.png">
    <!-- <meta name="description" content=" "> -->
    <meta name="keywords"  content="Intelligent Transportation System, Toll Management System, TMS, HTMS,
     Advanced Tolling Solutions, Electronic Toll Collection, Advanced/Highway Traffic Management System, 
     Smart Traffic Management System, Traffic Solutions, Smart City Solutions, Parking Management System, 
     automatic number plate recognition, RFID, Fastag, Start Up India, Make In India ,Ways Studio, 
     Pepal Private Limited, Toll Plaza, Highways Solution, Toll Operational System, CCTV Cameras,
      IP Camera, Fastag, ANPR, NHAI, Rajiv Gandhi Sea Link, RFID, MIS Reports" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo url('/');?>/assets/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo url('/');?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo url('/');?>/assets/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo url('/');?>/assets/css/templatemo-style.css">
</head>
	<body id="top">

		<!-- start preloader -->
		@include('common.preloader')
    	<!-- end preloader -->

        <!-- start header -->
        @include('common.header')
        <!-- end header -->

    	<!-- start navigation -->
		@include('common.navigation')
		<!-- end navigation -->

        @yield('content')
        <!-- start copyright -->
        @include('common.footer')
        <!-- end copyright -->
        <script src="<?php echo url('/');?>/assets/js/jquery.js"></script>
        <script src="<?php echo url('/');?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo url('/');?>/assets/js/jquery.singlePageNav.min.js"></script>
        <script src="<?php echo url('/');?>/assets/js/typed.js"></script>
        <script src="<?php echo url('/');?>/assets/js/wow.min.js"></script>
        <script src="<?php echo url('/');?>/assets/js/jquery.validate.min.js"></script>
        <script src="<?php echo url('/');?>/assets/js/custom.js"></script>

	</body>
</html>