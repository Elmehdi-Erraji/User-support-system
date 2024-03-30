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
                        <li class="breadcrumb-item active">Welcome!</li>
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
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="app-search">
                                <form action="{{ route('users.search') }}" method="POST" class="mt-3">
                                    @csrf 
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm me-2" placeholder="Search for users" name="search_query">
                                        <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#filterModal">
                                            <i class="ri-filter-line"></i> 
                                        </button>
                                        <button type="submit" class="btn btn-primary ms-2">Search</button>
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
                                                        <label for="roleFilter" class="form-label">Role:</label>
                                                        <select id="roleFilter" class="form-select" name="role">
                                                            <option value="">Any</option>
                                                            @foreach ($roles as $role)
                                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="statusFilter" class="form-label">Status:</label>
                                                        <select id="statusFilter" class="form-select" name="status">
                                                            <option value="null">Any</option>
                                                            @foreach($statuses as  $key => $status)
                                                                <option value="{{  $key+1  }}">{{ ucfirst($status) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="departmentFilter" class="form-label">Department:</label>
                                                        <select id="departmentFilter" class="form-select" name="department">
                                                            <option value="null">Any</option>
                                                            @foreach ($departments as $department)
                                                            <option value="{{$department->id}}">{{$department->name}}</option>
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
                                    <th>Image</th>
                                    <th>Username</th>
                                    <th>E-mail</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Department</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="tableBody">
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>
                                            @if ($user->getFirstMedia('avatars'))
                                                <img src="{{ asset($user->getFirstMedia('avatars')->getUrl()) }}" class="rounded-circle" alt="Avatar" width="50">
                                            @else
                                                No image
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>

                                        <td>
                                            @if ($user->status === 1)
                                                <span class="badge bg-info-subtle text-info">Pending</span>
                                            @elseif ($user->status === 2)
                                                <span class="badge bg-warning-subtle text-warning">Active</span>
                                            @elseif ($user->status === 3)
                                                <span class="badge bg-pink-subtle text-pink ">Banned</span>
                                            @else
                                                <span class="badge bg-warning">Unknown Status</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->roles()->exists())
                                                {{ $user->roles()->first()->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->department_id)
                                                {{ $user->department->name }}
                                            @endif
                                        </td>
                                        <td>
                                            
                                        
                                            @if ($user->trashed())
                                                <form action="{{ route('users.restore', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-warning">Restore</button>
                                                </form>
                                                <form action="{{ route('users.force-delete', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger delete-btn">Permanently Delete</button>
                                                </form>
                                            @else
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="{{ route('agent_show', $user->id) }}" class="btn btn-sm btn-success">View Details</a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
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
<script>
    document.getElementById('resetFilters').addEventListener('click', function() {
        document.getElementById('roleFilter').value = '';
        document.getElementById('statusFilter').value = '';
        document.getElementById('departmentFilter').value = '';
    });
</script>
@endsection

