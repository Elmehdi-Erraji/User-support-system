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
    <!-- end page title -->
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
                                        <th>User</th>
                                        <th>Agent</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($tickets as $ticket)
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
                                            @else
                                            <span class="badge bg-secondary text-white">Unknown Status</span>
                                            @endif
                                        </td>
                                        <td>{{ $ticket->category->name }}</td>
                                        {{-- <td>{{ $ticket->department->name }}</td> --}}
                                        <td>{{ $ticket->user->name }}</td>
                                        <td>{{ $ticket->agent ? $ticket->agent->name : 'Unassigned' }}</td>
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
                                                <a href="" class="btn btn-sm btn-success">View Details</a>
                                                <form action="{{ route('ticket.destroy', $ticket->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                        
                                    </tr>
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

