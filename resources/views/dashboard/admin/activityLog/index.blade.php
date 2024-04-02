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
                                                                <label for="priorityFilter" class="form-label">Priorities:</label>
                                                                <select id="priorityFilter" class="form-select" name="priority">
                                                                    <option value="null">Any</option>
                                                                    {{-- @foreach($priorities as $priority)
                                                                        <option value="{{ $priority }}">{{ $priority }}</option>
                                                                    @endforeach --}}
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="statusFilter" class="form-label">Status:</label>
                                                                <select id="statusFilter" class="form-select" name="status">
                                                                    <option value="null">Any</option>
                                                                    {{-- @foreach($statuses as   $status)
                                                                        <option value="{{  $status  }}">{{ $status }}</option>
                                                                    @endforeach --}}
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
                                            <td>{{ $log->causer_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</td>
                                            <td>
                                                <!-- Add actions here -->
                                                <button type="button" class="btn btn-sm btn-success btn-view-details" data-bs-toggle="modal" data-bs-target="#activity-log-details-modal-{{ $log->id }}">View Details</button> 
                                                <form action="" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                                </form>
                                                <!-- Add more actions as needed -->
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
                                                                <p><strong>Causer:</strong> {{ $log->causer_name }}</p>
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

@endsection

