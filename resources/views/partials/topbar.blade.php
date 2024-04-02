@php
    $user = Auth::user();
    $notifications = $user->unreadNotifications;
@endphp

<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="{{ url('/') }}" class="logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
                    </span>
                </a>

                <!-- Logo Dark -->
                <a href="{{ url('/') }}" class="logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
                    </span>
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="ri-menu-line"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>


        </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <i class="ri-mail-line fs-22"></i>
                    <span class="noti-icon-badge badge text-bg-purple">4</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                    <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 fs-16 fw-semibold"> Messages</h6>
                            </div>
                            <div class="col-auto">
                                <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                    <small>Clear All</small>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div style="max-height: 300px;" data-simplebar>

                        <!-- item-->
                        <a href="javascript:void(0);"
                            class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon">
                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" class="img-fluid rounded-circle"
                                                alt="" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold fs-14">Cristina Pride <small
                                                class="fw-normal text-muted float-end ms-1">1 day ago</small></h5>
                                        <small class="noti-item-subtitle text-muted">Hi, How are you? What about our
                                            next meeting</small>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);"
                            class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon">
                                            <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" class="img-fluid rounded-circle"
                                                alt="" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold fs-14">Sam Garret <small
                                                class="fw-normal text-muted float-end ms-1">2 day ago</small></h5>
                                        <small class="noti-item-subtitle text-muted">Yeah everything is fine</small>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);"
                            class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon">
                                            <img src="{{ asset('assets/images/users/avatar-3.jpg') }}" class="img-fluid rounded-circle"
                                                alt="" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold fs-14">Karen Robinson <small
                                                class="fw-normal text-muted float-end ms-1">2 day ago</small></h5>
                                        <small class="noti-item-subtitle text-muted">Wow that's great</small>
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>

                    <!-- All-->
                    <a href="javascript:void(0);"
                        class="dropdown-item text-center text-primary text-decoration-underline fw-bold notify-item border-top border-light py-2">
                        View All
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <i class="ri-notification-3-line fs-22"></i>
                    <span class="noti-icon-badge badge text-bg-pink">{{ Auth::user()->unreadNotifications->count() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                    <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 fs-16 fw-semibold">Notification</h6>
                            </div>
                            <div class="col-auto">
                                <form action="{{ route('markAsAllRead') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-dark text-decoration-underline border-0 bg-transparent p-0">
                                        <small>Clear All</small>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
            
                    <div style="max-height: 300px;" data-simplebar>
                        @foreach ($notifications as $notification)
                        <form action="{{ route('markAsRead',$notification->id) }}" method="POST" class="mark-as-read-form">
                            @csrf
                            <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                            <button type="submit" class="dropdown-item notify-item">
                                <div class="notify-icon bg-warning-subtle">
                                    <i class="mdi mdi-account-plus text-warning"></i>
                                </div>
                                <div class="notify-details">
                                    {{ $notification->data['message'] }}
                                    <small class="noti-time">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                            </button>
                        </form>
                    @endforeach
                     
                    </div>
            
                    <!-- All-->
                    <a href=""
                        class="dropdown-item text-center text-primary text-decoration-underline fw-bold notify-item border-top border-light py-2">
                        View All
                    </a>
            
                </div>
            </li>
            



            <li class="d-none d-sm-inline-block">
                <div class="nav-link" id="light-dark-mode">
                    <i class="ri-moon-line fs-22"></i>
                </div>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                   <span class="account-user-avatar">
                    @if (Auth::user()->getFirstMedia('avatars'))
                         <img src="{{ Auth::user()->getFirstMedia('avatars')->getUrl() }}" class="rounded-circle" alt="Avatar" width="50">
                     @else 
                         <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                    @endif
                 </span>
                    <span class="d-lg-block d-none">
                        <h5 class="my-0 fw-normal"> <i
                                class="ri-arrow-down-s-line d-none d-sm-inline-block align-middle"></i></h5>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="{{route('profile.index')}}" class="dropdown-item">
                        <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                        <span>My Account</span>
                    </a>


                    <!-- item-->
                    <a href="#" class="dropdown-item">
                        <i class="ri-customer-service-2-line fs-18 align-middle me-1"></i>
                        <span>Support</span>
                    </a>

                    <!-- item-->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="#" class="dropdown-item"
                           onclick="event.preventDefault();
                            this.closest('form').submit();">
                            <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                            <span>Logout</span>
                        </a>
                    </form>
                </div>
            </li>
            {{-- <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#right-modal">Rightbar Modal</button> --}}

        </ul>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('markAllAsReadButton').addEventListener('click', function() {
            fetch('{{ route("markAsAllRead") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to mark all notifications as read');
                }
                console.log('All notifications marked as read successfully');
            })
            .catch(error => {
                console.error('Error marking all notifications as read:', error.message);
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.mark-as-read-form').forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                var formData = new FormData(form);

                fetch(this.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to mark notification as read');
                    }
                    console.log('Notification marked as read successfully');
                    // Optionally, you can update the UI here
                })
                .catch(error => {
                    console.error('Error marking notification as read:', error.message);
                });
            });
        });
    });
</script>
