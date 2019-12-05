<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
      <meta name="keywords" content="">
      <meta name="description" content="">
      <title>:: Ways, Regstration Page ::</title>
      <!-- FAVICON AND APPLE TOUCH -->
      <link rel="shortcut icon" href="<?php echo url('/');?>/images/icons/favicon.png">
      <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo url('/');?>/images/icons/apple-touch-57x57.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo url('/');?>/images/icons/apple-touch-72x72.png">
      <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo url('/');?>/images/icons/apple-touch-114x114.png">
      <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo url('/');?>/images/icons/apple-touch-144x144.png">
      <!-- FONTS -->
      <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,700,700italic">
      <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Dosis:300,400,600">
      <!-- BOOTSTRAP CSS -->
      <link rel="stylesheet" href="<?php echo url('/');?>/assets/css/bootstrap.min.css">
      <!-- FONT AWESOME -->
      <link rel="stylesheet" href="<?php echo url('/');?>/assets/fontawesome/css/font-awesome.min.css">
      <!-- MIU ICON FONT -->
      <link rel="stylesheet" href="<?php echo url('/');?>/reg/assets/flaticon/flaticon.css">
      <link rel="stylesheet" href="<?php echo url('/');?>/reg/assets/js/revolutionslider/css/settings.css">
      <!-- ANIMATIONS -->
      <link rel="stylesheet" href="<?php echo url('/');?>/reg/assets/js/animations/animate.min.css">
      <!-- CUSTOM & PAGES STYLE -->
      <link rel="stylesheet" href="<?php echo url('/');?>/reg/assets/css/custom.css">
      <link rel="stylesheet" href="<?php echo url('/');?>/reg/assets/css/pages-style.css">
   </head>
   <body>
      <div id="page-wrapper">
         @include('common.header2')

         @yield('content1')   
         <div class="form-area column">
            <div class="container">
               @yield('content')
            </div>
         </div>
      </div>
      <!-- PAGE-WRAPPER --> 
      <!-- GO TOP --> 
      <a id="go-top"><i class="fa fa-angle-up"></i></a> 
      <script>
         var siteUrl = '<?php echo url('/') ?>';
      </script>
      <!-- jQUERY --> 
      <script src="<?php echo url('/');?>/assets/js/jquery.js"></script> 
      <!-- BOOTSTRAP JS --> 
      <script src="<?php echo url('/');?>/assets/js/bootstrap.min.js"></script> 
      <!-- CONTACT FORM VALIDATE & SUBMIT --> 
      <script src="<?php echo url('/');?>/assets/js/jquery.validate.min.js"></script> 
      <!-- ANIMATIONS --> 
      <script src="<?php echo url('/');?>/reg/assets/js/animations/wow.min.js"></script> 
      <script src="<?php echo url('/');?>/reg/assets/js/script.js"></script>
      <script src="<?php echo url('/');?>/reg/assets/js/custom.js"></script>
   </body>
</html>