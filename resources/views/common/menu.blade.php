<div class="col-sm-9">
    
    <!-- SEARCH -->
    <form id="search-form" name="search-form" method="get" action="#">
        <fieldset>
            <input type="text" name="search" placeholder="">
        </fieldset>
    </form>
    
    <!-- MENU --> 
    <nav>
    
        <a id="mobile-menu-button" href="#"><i class="fa fa-bars"></i></a>
                            
        <ul class="menu clearfix" id="menu">
            <li><a href="<?php echo url('/');?>">Home</a></li>
            <li class="dropdown active">
                <a href="<?php echo url('/');?>">Ways</a>
                <ul>
                    <li><a href="about-us">About us</a></li>
                    <li><a href="testimonials">Testimonials</a></li>
                    
                    
                </ul>
            </li>
            <li class="dropdown">
                <a href="services">Services</a>
                <ul>
                    <li><a href="services">Services</a></li>
                    <li><a href="single-service">Single service</a></li>
                    <li><a href="pricing-plan">Pricing plan</a></li>                                       
                    <li><a href="pricing-plan">Calculate Pricing</a></li>                                       
                </ul>
            </li>
            <li>
                <a href="login">Sign In</a>
            </li>                               
            <li>
                <a href="registration">Register</a>
            </li>                               
            <li>
                <a href="contact-us">Contact</a>
            </li>		
                                    
        </ul>
    
    </nav>

</div>