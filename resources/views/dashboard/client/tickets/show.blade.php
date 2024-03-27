
@extends('.layouts.main')

@section('content')

<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="profile-bg-picture" style="background-image: url('{{ asset('assets/images/bg-profile.jpg') }}')">
                <span class="picture-bg-overlay"></span>
                <!-- overlay -->
            </div>
            <!-- meta -->
            <div class="profile-user-box">
                <div class="row">
                    <div class="col-sm-6">
                        @if (Auth::user()->getFirstMedia('avatars'))
                            <div class="profile-user-img"><img src="{{ Auth::user()->getFirstMedia('avatars')->getUrl() }}" alt="" class="avatar-lg rounded-circle"></div>
                        @else
                            <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                        @endif

                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex justify-content-end align-items-center gap-2">
                            <a href="{{ route('client_ticket.edit', $ticket->id) }}" class="btn btn-info">
                                <i class="ri-settings-2-line align-text-bottom me-1 fs-16 lh-1"></i>
                                Edit Ticket
                            </a>
                        <form action="{{ route('client_ticket.destroy', $ticket->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-soft-danger">
                                <i class="ri-delete-bin-line align-text-bottom me-1 fs-16 lh-1"></i>
                                Delete Ticket
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card p-0">
                <div class="card-body p-0">
                    <div class="profile-content">
                        <ul class="nav nav-underline nav-justified gap-0">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" data-bs-target="#aboutme" type="button" role="tab" aria-controls="home" aria-selected="true" href="#aboutme">Ticket Details</a></li>
                            <li class="nav-item"><a class="nav-link " data-bs-toggle="tab" data-bs-target="#my_requests" type="button" role="tab" aria-controls="home" aria-selected="true" href="#my_requests">My Reservations</a></li>
                        </ul>

                        <div class="tab-content m-0 p-4">
                            <div class="tab-pane active" id="aboutme" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                <div class="profile-desk">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h2 class="text-uppercase fs-24 text-dark">Ticket Details</h2>
                                            <div class="mt-4">
                                                <h4 class="fs-20 text-dark">Ticket Information</h4>
                                                <p class="text-muted fs-16"><strong>Title:</strong> {{ $ticket->title }}</p>
                                                <p class="text-muted fs-16"><strong>Description:</strong> {{ $ticket->description }}</p>
                                                <p class="text-muted fs-16"><strong>Status:</strong> 
                                                    @switch($ticket->status)
                                                        @case('open')
                                                            <span class="badge bg-info text-white">Open</span>
                                                            @break
                                                        @case('in_progress')
                                                            <span class="badge bg-warning text-white">In Progress</span>
                                                            @break
                                                        @case('resolved')
                                                            <span class="badge bg-success text-white">Resolved</span>
                                                            @break
                                                        @case('closed')
                                                            <span class="badge bg-secondary text-white">Closed</span>
                                                            @break
                                                        @default
                                                            <span class="badge bg-secondary text-white">Unknown</span>
                                                    @endswitch
                                                </p>
                                                <p class="text-muted fs-16"><strong>Priority:</strong> 
                                                    @switch($ticket->priority)
                                                        @case('low')
                                                            <span class="badge bg-success">Low</span>
                                                            @break
                                                        @case('medium')
                                                            <span class="badge bg-warning">Medium</span>
                                                            @break
                                                        @case('high')
                                                            <span class="badge bg-danger">High</span>
                                                            @break
                                                        @default
                                                            <span class="badge bg-secondary">Unknown</span>
                                                    @endswitch
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <hr> <!-- Separate the two sections with a line -->
                                            <h2 class="text-uppercase fs-24 text-dark">Support Agent Information</h2>
                                            <div class="mt-4">
                                                <h4 class="fs-20 text-dark">Agent Information</h4>
                                                <p class="text-muted fs-16"><strong>Name:</strong> agent</p>
                                                <p class="text-muted fs-16"><strong>Email:</strong> <a href="mailto:test@mail.com">test@mail.com</a></p>
                                                <p class="text-muted fs-16"><strong>Contact:</strong> <!-- Add contact information here --></p>
                                                <!-- Add contact button here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
</div>

@endsection

