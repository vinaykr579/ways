<nav class="navbar navbar-default templatemo-nav" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>
            <a href="<?php echo url('/');?>" class="navbar-brand"><img src="<?php echo url('/');?>/assets/images/logo.png"></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
            @if(Request::is('/'))
                <li><a href="#top">HOME</a></li>
            @else
                <li><a class="external" href="<?php echo url('/');?>">HOME</a></li> 
            @endif
                <li><a href="#about">ABOUT</a></li>
                <li><a href="#service">BENEFITS</a></li> 
                <li><a class="external" href="<?php echo url('/');?>/app">LOGIN</a></li>
                <li><a class="external" href="<?php echo url('/');?>/registration">REGISTER</a></li>
                <li><a href="#contact">CONTACT</a></li>
            </ul>
        </div>
    </div>
</nav>