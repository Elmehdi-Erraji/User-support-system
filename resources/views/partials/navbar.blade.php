<nav class="navbar mobile-sidenav navbar-common navbar-sticky navbar-default validnavs">


    <div class="container d-flex justify-content-between align-items-center">            

        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{asset('assets_guest/img/guidely.png')}}" class="logo" alt="Logo">
            </a>
        </div>
        <!-- End Header Navigation -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-menu">

            <img src="{{asset('assets_guest/img/guidely.png')}}" alt="Logo">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                <i class="fa fa-times"></i>
            </button>
            
            <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                <li class="dropdown">
                    <a href="{{route('home')}}" class=" active" data-toggle="dropdown" >Home</a>
                </li>
                <li class="dropdown">
                    <a href="{{route('about')}}" class="" data-toggle="dropdown" >About</a>
                </li>
               
                <li class="dropdown">
                    <a href="#" class="" data-toggle="dropdown" >Our Services</a>
                </li>
                <li class="dropdown">
                    <a href="{{route('contact')}}" class="" data-toggle="dropdown" >Contact Us</a>
                </li>
              
            </ul>
        </div>
       
        <div class="attr-right">
            <div class="attr-nav">
                <ul>
                    <div class="button">
                        <a class="btn circle btn-theme-effect btn-sm" href="{{route('contact')}}" style="color: black; background-color: #007bff;">Start free trial</a>
                        <a class="btn circle btn-theme-effect btn-sm" href="{{route('register')}}" style="color: black; background-color: #28a745;"> Need help ?</a>
                    </div>
                </ul>
            </div>
        </div>
        
        
        

    </div>   
    <div class="overlay-screen"></div>
</nav>