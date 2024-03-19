<div class="leftside-menu">
    <!-- Brand Logo Light -->
    <a href="#" class="logo logo-light">
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="logo">
            </span>
        <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
            </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="#" class="logo logo-dark">
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="dark logo">
            </span>
        <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
            </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" >

       
        <ul class="side-nav">
            <li class="side-nav-title">Main</li>
            <li class="side-nav-item">
                <a href="" class="side-nav-link">
                    <i class="ri-home-3-line"></i>
                    <span> Back Home </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarUsers" aria-expanded="false" aria-controls="sidebarUsers" class="side-nav-link">
                    <i class="ri-group-2-line"></i>
                    <span> Users </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarUsers">
                    <ul class="side-nav-third-level">
                        <li>
                            <a href="">Add A User</a>
                        </li>
                        <li>
                            <a href="">Users List</a>
                        </li>
                    </ul>
                </div>
            </li>
        
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEvents" aria-expanded="false" aria-controls="sidebarEvents" class="side-nav-link">
                    <i class="ri-calendar-event-line"></i>
                    <span> Events </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEvents">
                    <ul class="side-nav-third-level">
                        <li>
                            <a href="">Event List</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Additional data -->
            <li class="side-nav-title">Static Informations</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarCategory" aria-expanded="false" aria-controls="sidebarCategory" class="side-nav-link">
                    <i class="ri-folder-line"></i>
                    <span> Category </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarCategory">
                    <ul class="side-nav-third-level">
                        <li>

                            <a href="">Categories list</a>

                        </li>

                    </ul>
                </div>
            </li>
        </ul>
       

         {{-- @if(auth()->user()->roles()->first()->name == 'orgonizer')
        <ul class="side-nav">
            <li class="side-nav-title">Main</li>

            <li class="side-nav-item">
                <a href="{{route('home')}}" class="side-nav-link">
                    <i class="ri-home-3-line"></i>
                    <span> Back Home </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span> Dashboard </span>
                </a>
            </li>

           


           

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEvents" aria-expanded="false" aria-controls="sidebarEvents" class="side-nav-link">
                    <i class="ri-calendar-event-line"></i>
                    <span> Events </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEvents">
                    <ul class="side-nav-third-level">
                        <li>
                            <a href="{{route('event.create')}}">Add An Event</a>
                        </li>
                        <li>
                            <a href="{{route('event.index')}}">Event List</a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
        @endif  --}}


         {{-- @if(auth()->user()->roles()->first()->name == 'client')
        <ul class="side-nav">
            <li class="side-nav-title">Main</li>

            <li class="side-nav-item">
                <a href="{{route('home')}}" class="side-nav-link">
                    <i class="ri-home-3-line"></i>
                    <span> Back Home </span>
                </a>
            </li>


        </ul>
        @endif  --}}


    </div>

    <div class="clearfix"></div>
</div>
