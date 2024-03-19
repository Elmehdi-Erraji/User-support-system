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
                <a href="#" class="side-nav-link">
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
                            <a href="#">Add A User</a>
                        </li>
                        <li>
                            <a href="#">Users List</a>
                        </li>
                    </ul>
                </div>
            </li>
        <!-- Departments -->
    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarDepartments" aria-expanded="false" aria-controls="sidebarDepartments" class="side-nav-link">
            <i class="ri-building-line"></i> <!-- Choose an appropriate icon -->
            <span> Departments </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarDepartments">
            <ul class="side-nav-third-level">
                <li>
                    <a href="#">Add Department</a>
                </li>
                <li>
                    <a href="#">Department List</a>
                </li>
            </ul>
        </div>
    </li>

    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarFAQs" aria-expanded="false" aria-controls="sidebarFAQs" class="side-nav-link">
            <i class="ri-question-line"></i> <!-- Choose an appropriate icon -->
            <span> FAQs </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarFAQs">
            <ul class="side-nav-third-level">
                <li>
                    <a href="#">Add FAQ</a>
                </li>
                <li>
                    <a href="#">FAQ List</a>
                </li>
            </ul>
        </div>
    </li>
    <!-- Categories -->
    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarCategories" aria-expanded="false" aria-controls="sidebarCategories" class="side-nav-link">
            <i class="ri-menu-2-line"></i> <!-- Choose an appropriate icon -->
            <span> Categories </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarCategories">
            <ul class="side-nav-third-level">
                <li>
                    <a href="#">Add Category</a>
                </li>
                <li>
                    <a href="#">Category List</a>
                </li>
            </ul>
        </div>
    </li>
    <!-- Tickets -->
    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarTickets" aria-expanded="false" aria-controls="sidebarTickets" class="side-nav-link">
            <i class="ri-ticket-line"></i> <!-- Choose an appropriate icon -->
            <span> Tickets </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarTickets">
            <ul class="side-nav-third-level">
                <li>
                    <a href="#">Open a Ticket</a>
                </li>
                <li>
                    <a href="#">Ticket List</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarNewsletters" aria-expanded="false" aria-controls="sidebarNewsletters" class="side-nav-link">
            <i class="ri-mail-send-line"></i> <!-- Choose an appropriate icon -->
            <span> Newsletters </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarNewsletters">
            <ul class="side-nav-third-level">
                <li>
                    <a href="#">Create Newsletter</a>
                </li>
                <li>
                    <a href="#">Newsletter List</a>
                </li>
            </ul>
        </div>
    </li>
            
       

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
