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
                    <h4 class="page-title">Departmetns!</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <!-- Categories Table -->
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
                                                    <input type="text" class="form-control form-control-sm me-2" placeholder="Search for departments" name="search_query" id="searchQuery">
                                                   
                                                    <button type="submit" class="btn btn-primary ms-2" id="searchButton">Search</button>
                                                </div>
                                                
                                                
                                                
                                            </form>
                                            
                                        </div>
                                        <br>
                                        <br>
                                        <div class="col-lg-6">
                                            <a href="{{ route('categories.create') }}" class="btn btn-primary" id="addButton" style="width: 30%">Add A Department</a>
                                        </div>
                                    </div>
                            </div>
                        </div>


                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Department</th>
                                        <th scope="col">Agents</th>
                                        <th scope="col">Categories</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @if(isset($departments) && $departments->isNotEmpty())
                                        @foreach($departments as $department)
                                            <tr>
                                                <td>{{ $department->name }}</td>
                                                <td>{{ $department->agents->count() }}</td>
                                                <td>{{ $department->categories->count() }}</td>
                                                <td>
                                                    @if($department->trashed())
                                                        <form action="{{ route('department.restore', $department->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                                        </form>
                                                        <form action="{{ route('department.forceDelete', $department->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Permanently Delete</button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('department.destroy', $department->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                                        </form>
                                                        <a href="{{ route('department.edit', $department->id) }}" class="btn btn-sm btn-primary">Update</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">No departments found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            
                            <!-- Pagination Links -->
                            <div class="pagination justify-content-center mt-3">
                                {{ $departments->links() }}
                            </div>
                        </div>
                        



                      
                    </div>


                </div>
            </div>
        </div>
                    @if (Session::has('success'))
                            <script>
                                console.log("SweetAlert initialization script executed!");
                                Swal.fire("Success", "{{ Session::get('success') }}", 'success');
                            </script>
                        @endif
    </div>        
    
      
      <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('searchForm');
            const searchQuery = document.getElementById('searchQuery');
            const tableBody = document.getElementById('tableBody');
    
            function fetchSearchResults() {
                const searchValue = searchQuery.value.trim();
    
                fetch('{{ route('departments.search') }}', {
                    method: 'POST',
                    body: JSON.stringify({ 
                        search_query: searchValue,
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
                        row.innerHTML = `<td colspan="5" class="text-center">No departments found</td>`;
                        tableBody.appendChild(row);
                    } else {
                        data.forEach(department => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${department.name}</td>
                                <td>${department.department}</td>
                                <td>${department.agentsCount}</td>
                                <td>${department.categoriesCount}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Actions">
                                        ${department.trashed ? `
                                            <form action="/categories/${department.id}/restore" method="POST" class="d-inline">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="PUT">
                                                <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                            </form>
                                            <form action="/categories/${department.id}/force-delete" method="POST" class="d-inline">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">Permanently Delete</button>
                                            </form>
                                        ` : `
                                            <a href="/categories/${department.id}/edit" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="/categories/${department.id}" method="POST" class="d-inline">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                            </form>
                                        `}
                                    </div>
                                </td>
                            `;
                            tableBody.appendChild(row);
                        });
                    }
                })

            }
    
            searchForm.addEventListener('submit', function(event) {
                event.preventDefault(); 
                fetchSearchResults();
            });
    
            document.getElementById('searchButton').addEventListener('click', function() {
                fetchSearchResults();
            });
        });
    </script>
    

@endsection

