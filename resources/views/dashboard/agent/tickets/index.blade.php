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
            <div class="card widget-flat text-bg-primary">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-ticket-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Tickets Assigned">Tickets Assigned</h6>
                    <h2 class="my-2">{{$ticketsAssigned}}</h2> 
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-info">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-ticket-fill widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Tickets Resolved">Tickets Resolved</h6>
                    <h2 class="my-2">{{$ticketsResolved}}</h2> 
                </div>
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
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="app-search">
                                    <form id="searchForm">
                                        @csrf 
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm me-2" placeholder="Search for users" name="search_query" id="searchQuery">
                                            <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#filterModal">
                                                <i class="ri-filter-line"></i> 
                                            </button>
                                            <button type="submit" class="btn btn-primary ms-2" id="searchButton">Search</button>
                                        </div>
                                        
                                        <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg modal-right">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-light">
                                                        <h5 class="modal-title" id="filterModalLabel">Filters</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="priorityFilter" class="form-label">Priorities:</label>
                                                            <select id="priorityFilter" class="form-select" name="priority">
                                                                <option value="null">Any</option>
                                                                @foreach($priorities as $priority)
                                                                    <option value="{{ $priority }}">{{ $priority }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="statusFilter" class="form-label">Status:</label>
                                                            <select id="statusFilter" class="form-select" name="status">
                                                                <option value="null">Any</option>
                                                                @foreach($statuses as   $status)
                                                                    <option value="{{  $status  }}">{{ $status }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                                                        <button type="button" class="btn btn-secondary" id="resetFilters">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </form>
                                </div>
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
                                    @if ($ticket->status != 'wrong_category')
                                   
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
                                                <a href="{{ route('agent_ticket.edit', $ticket->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <button type="button" class="btn btn-sm btn-success btn-view-details" data-bs-toggle="modal" data-bs-target="#scrollable-modal-{{ $ticket->id }}" data-ticket-id="{{ $ticket->id }}">View Details</button>  
                                                <form action="{{ route('agent_ticket.destroy', $ticket->id) }}" method="POST" class="d-inline">
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
                                                    <a href="{{ route('client_ticket.edit', $ticket->id) }}" class="btn btn-info">Edit</a>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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
<script>
    document.getElementById('resetFilters').addEventListener('click', function() {
    document.getElementById('priorityFilter').value = 'null';
    document.getElementById('statusFilter').value = 'null';
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.getElementById('searchForm');
        const searchQuery = document.getElementById('searchQuery');
        const tableBody = document.getElementById('tableBody');
        const priorityFilter = document.getElementById('priorityFilter');
        const statusFilter = document.getElementById('statusFilter');
        const filterModalForm = document.getElementById('filterModalForm');

        function fetchSearchResults() {
            const searchValue = searchQuery.value.trim();
            const priorityValue = priorityFilter.value;
            const statusValue = statusFilter.value;

            fetch('{{ route('agent.search') }}', {
                method: 'POST',
                body: JSON.stringify({ 
                    search_query: searchValue,
                    priority: priorityValue,
                    status: statusValue,
                }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
  tableBody.innerHTML = '';

  if (data.length === 0) {
      const row = document.createElement('tr');   
      row.innerHTML = `<td colspan="10" class="text-center">No Tickets found</td>`;
      tableBody.appendChild(row);
  } else {
      data.forEach(ticket => {
          const createdDate = new Intl.DateTimeFormat('en-US', { 
              year: 'numeric', 
              month: 'long', 
              day: '2-digit',
              hour: 'numeric', 
              minute: 'numeric', 
          
              hour12: true 
          }).format(new Date(ticket.created_at));

          const updatedDate = ticket.updated_at !== ticket.created_at ? 
              new Intl.DateTimeFormat('en-US', { 
                  year: 'numeric', 
                  month: 'long', 
                  day: '2-digit',
                  hour: 'numeric', 
                  minute: 'numeric', 
              
                  hour12: true 
              }).format(new Date(ticket.updated_at)) : 'Not updated yet';

          const row = document.createElement('tr');
          row.innerHTML = `
              <td>${ticket.id}</td>
              <td>${ticket.title}</td>
              <td>
                  ${ticket.priority === 'low' ? '<span class="badge bg-success">Low</span>' :
                  ticket.priority === 'medium' ? '<span class="badge bg-warning">Medium</span>' :
                  ticket.priority === 'high' ? '<span class="badge bg-danger">High</span>' :
                  '<span class="badge bg-secondary">Unknown</span>'}
              </td>
              <td>
                  ${ticket.status === 'open' ? '<span class="badge bg-info text-white">open</span>' :
                  ticket.status === 'in_progress' ? ' <span class="badge bg-warning text-white">in_progress</span>' :
                  ticket.status === 'resolved' ? '<span class="badge bg-success text-white">resolved</span>' :
                  ticket.status === 'closed' ? '<span class="badge bg-secondary text-white">closed</span>' :
                  ticket.status === 'wrong_category' ? '<span class="badge bg-secondary text-red">wrong_category</span>' :
                  '<span class="badge bg-secondary text-white">Unknown Status</span>'}
              </td>
              <td>${ticket.category.name}</td>
              <td>${ticket.user.name}</td>
              <td>${ticket.support_agent.name}</td>
              <td>${createdDate}</td>
              <td>${updatedDate}</td>
              <td>
                  ${ticket.deleted_at ? `
                      <form action="/tickets/${ticket.id}/restore" method="POST" class="d-inline">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="_method" value="PUT">
                          <button type="submit" class="btn btn-sm btn-warning">Restore</button>
                      </form>
                      <form action="/tickets/${ticket.id}/force-delete" method="POST" class="d-inline">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="_method" value="DELETE">
                          <button type="submit" class="btn btn-sm btn-danger delete-btn">Force Delete</button>
                      </form>
                  ` : `
                      <a href="/ticket/${ticket.id}/edit" class="btn btn-sm btn-primary">Edit</a>
                      <button type="button" class="btn btn-sm btn-success btn-view-details" data-bs-toggle="modal" data-bs-target="#scrollable-modal-${ticket.id}" data-ticket-id="${ticket.id}">View Details</button> 
                      <form action="/ticket/${ticket.id}" method="POST" class="d-inline">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="_method" value="DELETE">
                          <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                      </form>
                  `}
              </td>
          `;
          tableBody.appendChild(row);
      });
  }
})



            .catch(error => {
                console.error('Error:', error);
            });
        }

        searchForm.addEventListener('submit', function(event) {
            event.preventDefault(); 
            fetchSearchResults();
        });

        document.getElementById('searchButton').addEventListener('click', function() {
            fetchSearchResults();
        });

        filterModal.addEventListener('submit', function(event) {
            event.preventDefault();
            if (event.target !== document.getElementById('resetFilters')) {
                fetchSearchResults();
                $('#filterModal').modal('hide'); 
            }
        });
    });
</script>
@endsection

