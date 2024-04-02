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
                                                                <label for="priorityFilter" class="form-label">Activity:</label>
                                                                <select id="logEvent" class="form-select" name="event">
                                                                    <option value="null">Any</option>
                                                                   
                                                                        <option value="deleted">Delete</option>
                                                                        <option value="updated">Update</option>
                                                                   
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
                                        <th>Description</th>
                                        <th>Log Name</th>
                                        <th>Causer</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($logs as $log)
                                        <tr>
                                            <td>{{ strlen($log->description) > 25 ? substr($log->description, 0, 25) . '...' : $log->description }}</td>
                                            <td>
                                                @if($log->event === 'deleted')
                                                    <span class="badge bg-secondary text-white ">{{ $log->event }}</span>
                                                @elseif($log->event === 'updated')
                                                    <span class="badge bg-warning ">{{ $log->event }}</span>
                                                @else   
                                                    <span class="badge bg-secondary">{{ $log->event }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $log->causer->name}}</td>
                                            <td>{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-success btn-view-details" data-bs-toggle="modal" data-bs-target="#activity-log-details-modal-{{ $log->id }}">View Details</button> 
                                                <form action="{{route('activity.destroy',$log->id)}}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="activity-log-details-modal-{{ $log->id }}" tabindex="-1" role="dialog" aria-labelledby="activityLogDetailsModalTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title" id="activityLogDetailsModalTitle">Activity Log Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                    @if($log->event === 'deleted')
                                                                    <p><strong>Log Name:</strong> <span class="badge bg-secondary text-white ">{{ $log->event }}</span></p>
                                                                    @elseif($log->event === 'updated')
                                                                    <p><strong>Log Name:</strong> <span class="badge bg-warning ">{{ $log->event }}</span></p>
                                                                    @else   
                                                                    <p><strong>Log Name:</strong> <span class="badge bg-secondary">{{ $log->event }}</span></p>
                                                                    @endif
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p><strong>Description:</strong> {{ \Illuminate\Support\Str::limit($log->description, 100) }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                 <p><strong>Causer:</strong> {{ $log->causer->name }}</p> 
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                                
                            </table>
                            <!-- Pagination Links -->
                             <div class="pagination mt-3">
                                {{ $logs->links() }}
                            </div>
                             
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
    document.getElementById('logEvent').value = 'null';
    });
</script>

 <script>
  document.addEventListener('DOMContentLoaded', function() {
      const searchForm = document.getElementById('searchForm');
      const searchQuery = document.getElementById('searchQuery');
      const tableBody = document.getElementById('tableBody');
      const logEventFilter = document.getElementById('logEvent');
      const filterModalForm = document.getElementById('filterModalForm');

      function fetchSearchResults() {
          const searchValue = searchQuery.value.trim();
          const eventValue = logEventFilter.value;

          fetch('{{ route('activity.serach') }}', {
              method: 'POST',
              body: JSON.stringify({ 
                  search_query: searchValue,
                  event: eventValue 
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
        row.innerHTML = `<td colspan="5" class="text-center">No activity logs found</td>`;
        tableBody.appendChild(row);
    } else {
        data.forEach(log => {
            const createdDate = new Date(log.created_at).toLocaleString();

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${log.description.length > 25 ? log.description.substring(0, 25) + '...' : log.description}</td>
                <td>
                    ${log.event === 'deleted' ? '<span class="badge bg-danger text-white">Deleted</span>' :
                    log.event === 'updated' ? '<span class="badge bg-warning text-dark">Updated</span>' :
                    '<span class="badge bg-secondary">' + log.event + '</span>'}
                </td>
                <td>${log.causer_name}</td>
                <td>${createdDate}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-success btn-view-details" data-bs-toggle="modal" data-bs-target="#activity-log-details-modal-${log.id}">View Details</button> 
                    <form action="/activity/${log.id}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                    </form>
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

