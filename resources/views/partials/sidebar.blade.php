
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

    @if(auth()->user()->roles()->first()->name == 'admin')
        <ul class="side-nav">
            <li class="side-nav-title">Main</li>
            <li class="side-nav-item">
                <a href="{{route('dashboard')}}" class="side-nav-link">
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
                            <a href="{{route('users.index')}}">Users List</a>
                        </li>
                        <li>
                            <a href="{{route('users.create')}}">Add A User</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarClients" aria-expanded="false" aria-controls="sidebarClients" class="side-nav-link">
                    <i class="ri-user-line"></i>
                    <span> Clients </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarClients">
                    <ul class="side-nav-third-level">
                        <li>
                            <a href="{{route('clinets_list')}}">Clients List</a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarDepartments" aria-expanded="false" aria-controls="sidebarDepartments" class="side-nav-link">
                    <i class="ri-building-line"></i> 
                    <span> Departments </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarDepartments">
                    <ul class="side-nav-third-level">
                        <li>
                            <a href="{{route('department.index')}}">Department List</a>
                        </li>
                        <li>
                            <a href="{{route('department.create')}}">Add Department</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarCategories" aria-expanded="false" aria-controls="sidebarCategories" class="side-nav-link">
                    <i class="ri-menu-2-line"></i> 
                    <span> Categories </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarCategories">
                    <ul class="side-nav-third-level">
                        <li>
                            <a href="{{route('categories.index')}}">Category List</a>
                        </li>
                        <li>
                            <a href="{{route('categories.create')}}">Add Category</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarFAQs" aria-expanded="false" aria-controls="sidebarFAQs" class="side-nav-link">
                    <i class="ri-question-line"></i> 
                    <span> FAQs </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarFAQs">
                    <ul class="side-nav-third-level">
                        <li>
                            <a href="{{route('Faq.index')}}">FAQ List</a>
                        </li>
                        <li>
                            <a href="{{route('Faq.create')}}">Add FAQ</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarTickets" aria-expanded="false" aria-controls="sidebarTickets" class="side-nav-link">
                    <i class="ri-ticket-line"></i> 
                    <span> Tickets </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarTickets">
                    <ul class="side-nav-third-level">
                        <li>
                            <a href="{{route('ticket.index')}}">Ticket List</a>
                        </li>
                        <li>
                            <a href="{{route('ticket.index')}}">Add Ticket</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('FaqHome') }}" class="side-nav-link">
                    <i class="ri-questionnaire-fill"></i>
                    <span> All FAQs </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="" class="side-nav-link">
                    <i class="ri-message-3-line"></i>
                    <span> Messages </span>
                    <span class="badge bg-warning rounded-pill float-end">4</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{route('activity')}}" class="side-nav-link">
                    <i class="ri-history-line"></i>
                    <span>All Logs</span>
                </a>
            </li>
        </ul>
    @endif
            
    @if(auth()->user()->roles()->first()->name == 'support_agent')
    <ul class="side-nav">
        <li class="side-nav-title">Main</li>
        <li class="side-nav-item">
            <a href="{{route('agent_ticket.index')}}" class="side-nav-link">
                <i class="ri-dashboard-3-line"></i>
                <span> Dashboard </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarTickets" aria-expanded="false" aria-controls="sidebarTickets" class="side-nav-link">
                <i class="ri-ticket-line"></i> 
                <span> Tickets </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarTickets">
                <ul class="side-nav-third-level">
                    <li>
                        <a href="{{ route('agent_ticket.index') }}">Ticket List</a>
                    </li>
                    <li>
                        <a href="{{ route('agent_ticket.create') }}">Add Ticket</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="side-nav-item">
            <a href="{{ route('FaqHome') }}" class="side-nav-link">
                <i class="ri-questionnaire-fill"></i>
                <span> All FAQs </span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="" class="side-nav-link">
                <i class="ri-notification-3-line"></i>
                <span> Notifications </span>
                <span class="badge bg-success rounded-pill float-end">5</span>

                {{-- @if($unreadNotificationsCount > 0)
                    <span class="badge bg-success rounded-pill float-end">{{ $unreadNotificationsCount }}</span>
                @endif --}}
            </a>
        </li>

        <li class="side-nav-item">
            <a href="" class="side-nav-link">
                <i class="ri-message-3-line"></i>
                <span> Messages </span>
                <span class="badge bg-warning rounded-pill float-end">4</span>

                {{-- @if($unreadMessagesCount > 0)
                    <span class="badge bg-warning rounded-pill float-end">{{ $unreadMessagesCount }}</span>
                @endif --}}
            </a>
        </li>
    </ul>
@endif

@if(auth()->user()->roles()->first()->name == 'client')
<ul class="side-nav">
    <li class="side-nav-title">Main</li>
    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarFAQs" aria-expanded="false" aria-controls="sidebarFAQs" class="side-nav-link">
            <i class="ri-question-line"></i> 
            <span> FAQs </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarFAQs">
            <ul class="side-nav-third-level">
                <li>
                    <a href="{{ route('Faq.index') }}">FAQ List</a>
                </li>
            </ul>
        </div>
    </li>

    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarTickets" aria-expanded="false" aria-controls="sidebarTickets" class="side-nav-link">
            <i class="ri-ticket-line"></i> 
            <span> Tickets </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarTickets">
            <ul class="side-nav-third-level">
                <li>
                    <a href="{{ route('client_ticket.index') }}">Ticket List</a>
                </li>
                <li>
                    <a href="{{ route('client_ticket.create') }}">Add Ticket</a>
                </li>
            </ul>
        </div>
    </li>

    <!-- New Section -->
    <li class="side-nav-item">
        <a href="{{route('profile.index')}}" class="side-nav-link">
            <i class="ri-user-line"></i> 
            <span> Profile </span>
        </a>
    </li>
    <li class="side-nav-item">
        <a href="" class="side-nav-link">
            <i class="ri-notification-3-line"></i>
            <span> Notifications </span>
            <span class="badge bg-success rounded-pill float-end">5</span>

            {{-- @if($unreadNotificationsCount > 0)
                <span class="badge bg-success rounded-pill float-end">{{ $unreadNotificationsCount }}</span>
            @endif --}}
        </a>
    </li>

    <li class="side-nav-item">
        <a href="" class="side-nav-link">
            <i class="ri-message-3-line"></i>
            <span> Messages </span>
            <span class="badge bg-warning rounded-pill float-end">4</span>

            {{-- @if($unreadMessagesCount > 0)
                <span class="badge bg-warning rounded-pill float-end">{{ $unreadMessagesCount }}</span>
            @endif --}}
        </a>
    </li>
</ul>

@endif

    </div>

    <div class="clearfix"></div>
</div>
