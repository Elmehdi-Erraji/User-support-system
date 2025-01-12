@extends('layouts.main')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                        <li class="breadcrumb-item active">Tickets!</li>
                    </ol>
                </div>
                <h4 class="page-title">Welcome!</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-success">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-ticket-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Open Tickets">Open Tickets</h6>
                    <h2 class="my-2">{{$openTickets}}</h2> 
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-warning">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-ticket-fill widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Tickets Resolved">Tickets Resolved</h6>
                    <h2 class="my-2">{{$resolvedTickets}}</h2> 
                </div>
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-12">
            <!-- Todo-->
            <div class="card">
                <div class="card-body p-0">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-lg-6">
                            </div>

                        </div>
                    </div>

                    <div id="yearly-sales-collapse" class="collapse show">
                        <div class="table-responsive">
                            <table class="table table-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        {{-- <th>Description</th> --}}
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        {{-- <th>Department</th> --}}
                                        {{-- <th>User</th> --}}
                                        <th>Agent</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($tickets as $ticket)
                                    {{-- @if ($ticket->status === 'wrong_category') 
                                    <tr></tr>
                                    @else --}}
                                    <tr>
                                        <td>{{ $ticket->id }}</td>
                                        <td>{{ $ticket->title }}</td>
                                        {{-- <td>{{ $ticket->description }}</td> --}}
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
                                            @elseif ($ticket->status === 'wrong_category')
                                            <span class="badge bg-secondary text-red">{{ ucfirst($ticket->status) }}</span>
                                            @else
                                            <span class="badge bg-secondary text-white">Unknown Status</span>
                                            @endif
                                        </td>
                                        <td>{{ $ticket->category->name }}</td>
                                        {{-- <td>{{ $ticket->department->name }}</td> --}}
                                        {{-- <td>{{ $ticket->user->name }}</td> --}}
                                        <td>{{ $ticket->support_agent_id ? $ticket->supportAgent->name : 'Unassigned' }}</td>
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
                                                <a href="{{ route('client_ticket.edit', $ticket->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <button type="button" class="btn btn-sm btn-success btn-view-details" data-bs-toggle="modal" data-bs-target="#scrollable-modal-{{ $ticket->id }}" data-ticket-id="{{ $ticket->id }}">View Details</button>  
                                                <form action="{{ route('client_ticket.destroy', $ticket->id) }}" method="POST" class="d-inline">
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
                                                                        @case('wrong_category')
                                                                            <span class="badge bg-secondary text-red">{{ ucfirst($ticket->status) }}</span>
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
                                                            @if($ticket->status == 'wrong_category')
                                                                <div class="col-md-12">
                                                                    <p><strong>Why is this labeled as Wrong category:</strong> {{ $ticket->motif }}</p>
                                                                </div>
                                                            @else
                                                                <div class="col-md-12">
                                                                    <p><strong>Description:</strong> {{ $ticket->description }}</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <!-- Attachments Section -->
                                                        <div class="col-md-12">
                                                            <h5>Attachments:</h5>
                                                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                                                                @foreach($ticket->getMedia('attachments') as $media)
                                                                    <div class="col">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                @if (Str::startsWith($media->mime_type, 'image/'))
                                                                                    <!-- Display image with link to full-size image -->
                                                                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                                                                        <img src="{{ $media->getUrl() }}" class="card-img-top" alt="{{ $media->name }}">
                                                                                    </a>
                                                                                @else
                                                                                    <!-- Display link to download file -->
                                                                                    <a href="{{ $media->getUrl() }}" class="card-link" target="_blank">{{ $media->name }}</a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ route('client_ticket.edit', $ticket->id) }}" class="btn btn-info">Edit</a>
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

@endsection

