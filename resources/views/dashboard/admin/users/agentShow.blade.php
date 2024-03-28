@extends('layouts.main')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-sm-12">
                    <div class="profile-bg-picture" style="background-image:url({{ asset('assets/bg-profile.jpg') }})">
                        <span class="picture-bg-overlay"></span>
                    <!-- overlay -->
                </div>
                <!-- meta -->
                <div class="profile-user-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            @if ($user->getFirstMedia('avatars'))
                                <div class="profile-user-img"><img src="{{ $user->getFirstMedia('avatars')->getUrl() }}" alt="" class="avatar-lg rounded-circle"></div>
                            @else
                                <div class="profile-user-img"><i class="ri-account-circle-line fs-18 align-middle me-1"></i></div>
                            @endif
                            <div class="">
                                <h4 class="mt-4 fs-17 ellipsis">{{ $user->name }}</h4>
                                <p class="text-muted mb-0"><small>{{ $user->email }}</small></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex justify-content-end align-items-center gap-2">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Go Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ meta -->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card p-0">
                    <div class="card-body p-0">
                        <div class="profile-content">
                            <ul class="nav nav-underline nav-justified gap-0">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" data-bs-target="#aboutme" type="button" role="tab" aria-controls="home" aria-selected="true" href="#aboutme">Assigned Tickets</a></li>
                            </ul>

                            <div id="yearly-sales-collapse" class="collapse show">
                                <div class="table-responsive">
                                    <table class="table table-nowrap table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Priority</th>
                                                <th>Status</th>
                                                <th>Category</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                           
                                            @foreach ($assignedTickets as $ticket)
                                            <tr>
                                                <td>{{ $ticket->id }}</td>
                                                <td>{{ $ticket->title }}</td>
                                                <td>
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
                                                </td>
                                                <td>
                                                    @if ($ticket->status === 'open')
                                                    <span class="badge bg-info text-white">{{ ucfirst($ticket->status) }}</span>
                                                    @elseif ($ticket->status === 'in_progress')
                                                    <span class="badge bg-warning text-white">{{ ucfirst($ticket->status) }}</span>
                                                    @elseif ($ticket->status === 'resolved')
                                                    <span class="badge bg-success text-white">{{ ucfirst($ticket->status) }}</span>
                                                    @elseif ($ticket->status === 'closed')
                                                    <span class="badge bg-secondary text-white">{{ ucfirst($ticket->status) }}</span>
                                                    @else
                                                    <span class="badge bg-secondary text-white">Unknown Status</span>
                                                    @endif
                                                </td>
                                                <td>{{ $ticket->category->name }}</td>
                                                <td>{{ $ticket->created_at->isoFormat('Do MMMM YYYY, h:mm:ssa') }}</td>
                                                @if ($ticket->updated_at != $ticket->created_at)
                                                <td>{{ $ticket->updated_at->isoFormat('Do MMMM YYYY, h:mm:ssa') }}</td>
                                                @else
                                                <td>Not updated yet</td>
                                                @endif
                                                
                                                <td>
                                                    @if ($ticket->trashed())
                                                        <form action="{{ route('tickets.restore', $ticket->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-sm btn-warning">Restore</button>
                                                        </form>
                                                        <form action="{{ route('tickets.force-delete', $ticket->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger delete-btn">Force Delete</button>
                                                        </form>
                                                    @else
                                                        <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                        <button type="button" class="btn btn-sm btn-success btn-view-details" data-bs-toggle="modal" data-bs-target="#scrollable-modal-{{ $ticket->id }}" data-ticket-id="{{ $ticket->id }}">View Details</button> 
                                                        <form action="{{ route('ticket.destroy', $ticket->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                                        </form>
                                                    @endif
                                                </td>
                                                
                                            </tr>
                                            <div class="modal fade" id="scrollable-modal-{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="scrollableModalTitle">Ticket Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <p><strong>Title:</strong> {{ $ticket->title }}</p>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <p><strong>Status:</strong>
                                                                        @switch($ticket->status)
                                                                            @case('open')
                                                                                <span class="badge bg-info text-white">{{ ucfirst($ticket->status) }}</span>
                                                                                @break
                                                                            @case('in_progress')
                                                                                <span class="badge bg-warning text-white">{{ ucfirst($ticket->status) }}</span>
                                                                                @break
                                                                            @case('resolved')
                                                                                <span class="badge bg-success text-white">{{ ucfirst($ticket->status) }}</span>
                                                                                @break
                                                                            @case('closed')
                                                                                <span class="badge bg-secondary text-white">{{ ucfirst($ticket->status) }}</span>
                                                                                @break
                                                                            @default
                                                                                <span class="badge bg-secondary text-white">Unknown Status</span>
                                                                        @endswitch
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <p><strong>Priority:</strong>
                                                                        @switch($ticket->priority)
                                                                            @case('low')
                                                                                <span class="badge bg-success">{{ ucfirst($ticket->priority) }}</span>
                                                                                @break
                                                                            @case('medium')
                                                                                <span class="badge bg-warning">{{ ucfirst($ticket->priority) }}</span>
                                                                                @break
                                                                            @case('high')
                                                                                <span class="badge bg-danger">{{ ucfirst($ticket->priority) }}</span>
                                                                                @break
                                                                            @default
                                                                                <span class="badge bg-secondary">Unknown Priority</span>
                                                                        @endswitch
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p><strong>Description:</strong> {{ $ticket->description }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-info">Edit</a>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                    @if (Session::has('success'))
                                        <script>
                                            console.log("SweetAlert initialization script executed!");
                                            Swal.fire("Success", "{{ Session::get('success') }}", 'success');
                                        </script>
                                    @endif
        
        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
   @if (Session::has('success'))
    <script>
        console.log("SweetAlert initialization script executed!");
        Swal.fire("Success", "{{ Session::get('success') }}", 'success');
    </script>
@elseif (Session::has('error'))
    <script>
        console.log("SweetAlert initialization script executed!");
        Swal.fire("Error", "{{ Session::get('error') }}", 'error');
    </script>
@endif
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("edit-profile-button").addEventListener("click", function() {
                document.querySelector('a[href="#edit-profile"]').click();
            });
        });
    </script>
@endsection
