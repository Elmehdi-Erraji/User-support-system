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
                            <li class="breadcrumb-item active">Categories!</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Welcome!</h4>
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
                                                    <input type="text" class="form-control form-control-sm me-2" placeholder="Search for categories" name="search_query" id="searchQuery">
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
                                        <br>
                                        <br>
                                        <div class="col-lg-6">
                                            <a href="{{ route('categories.create') }}" class="btn btn-primary" id="addButton" style="width: 30%">Add A Category</a>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-nowrap table-hover mb-0">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Department</th>
                                    <th>Tickets</th>
                                    <th>Faq's</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        
                                        <td>{{ $category->department->name }}</td>
                                        <td>{{$category->tickets->count()}}</td>
                                        <td>{{$category->faqs->count()}}</td>
                                        <td>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                            </form>
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Update</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- Pagination Links -->
                            <div class="pagination mt-3">
                                {{ $categories->links() }}
                            </div>
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

    <script>
        document.getElementById('resetFilters').addEventListener('click', function() {
             document.getElementById('departmentFilter').value = 'null';
      });
      </script>
      
      <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('searchForm');
            const searchQuery = document.getElementById('searchQuery');
            const tableBody = document.getElementById('tableBody');
            const departmentFilter = document.getElementById('departmentFilter');
    
            function fetchSearchResults() {
                const searchValue = searchQuery.value.trim();
                const departmentValue = departmentFilter.value;
    
                fetch('{{ route('categories.search') }}', {
                    method: 'POST',
                    body: JSON.stringify({ 
                        search_query: searchValue,
                        department: departmentValue
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
                        row.innerHTML = `<td colspan="5" class="text-center">No category found</td>`;
                        tableBody.appendChild(row);
                    } else {
                        data.forEach(category => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${category.name}</td>
                                <td>${category.department}</td>
                                <td>${category.ticketsCount}</td>
                                <td>${category.faqsCount}</td>
                                <td>
                                    <a href="{{ url('categories') }}/${category.id}/edit" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ url('categories') }}/${category.id}/destroy" method="POST" class="d-inline">
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

