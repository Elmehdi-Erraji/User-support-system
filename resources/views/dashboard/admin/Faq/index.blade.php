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
                        <li class="breadcrumb-item active">Faq's !</li>
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
                                                <input type="text" class="form-control form-control-sm me-2" placeholder="Search for faq's" name="search_query" id="searchQuery">
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
                                                                <label for="statusFilter" class="form-label">Status:</label>
                                                                <select id="statusFilter" class="form-select" name="status">
                                                                    <option value="null">Any</option>
                                                                    @foreach($statuses as  $key => $status)
                                                                        <option value="{{  $key+1  }}">{{ $key+1 }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="categoryFilter" class="form-label">Category:</label>
                                                                <select id="categoryFilter" class="form-select" name="category">
                                                                    <option value="null">Any</option>
                                                                    @foreach ($categories as $category)
                                                                    <option value="{{$category->id}}">{{$category->name}}</option>
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
                                        <a href="{{ route('Faq.create') }}" class="btn btn-primary" id="addButton" style="width: 30%">Add A Faq</a>
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
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Category</th>
                                        <th>Creator</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($faqs as $faq)
                                    <tr>
                                        <td>{{ $faq->id }}</td>
                                        <td>{{ strlen($faq->question) > 25 ? substr($faq->question, 0, 25) . '...' : $faq->question }}</td>
                                        <td>{{ strlen($faq->answer) > 25 ? substr($faq->answer, 0, 25) . '...' : $faq->answer }}</td>
                                        @if($faq->category_id == null)
                                            <td>No Category</td>
                                        @else
                                            <td>{{ $faq->category->name }}</td>
                                        @endif
                                        <td>{{ $faq->user->name }}</td>
                                        <td>
                                            @if ($faq->status === 1)
                                                <span class="badge bg-info-subtle text-info">Pending</span>
                                            @elseif ($faq->status === 2)
                                                <span class="badge bg-warning-subtle text-warning">Published</span>
                                            @elseif ($faq->status === 3)
                                                <span class="badge bg-pink-subtle text-pink">Inactive</span>
                                            @else
                                                <span class="badge bg-warning">Unknown Status</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('Faq.destroy', $faq->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                            </form>
                                            <a href="{{ route('Faq.edit', $faq->id) }}" class="btn btn-sm btn-primary">Update</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Pagination Links -->
                            <div class="pagination mt-3">
                                {{ $faqs->links() }}
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
      document.getElementById('statusFilter').value = 'null';
      document.getElementById('categoryFilter').value = 'null';
  });
  </script>
  
  
  
  
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const searchForm = document.getElementById('searchForm');
          const searchQuery = document.getElementById('searchQuery');
          const tableBody = document.getElementById('tableBody');
          const statusFilter = document.getElementById('statusFilter');
          const categoryFilter = document.getElementById('categoryFilter');
          const filterModalForm = document.getElementById('filterModalForm');
  
          function fetchSearchResults() {
              const searchValue = searchQuery.value.trim();
              const statusValue = statusFilter.value;
              const categoryValue = categoryFilter.value;
  
              fetch('{{ route('faq.search') }}', {
                  method: 'POST',
                  body: JSON.stringify({ 
                      search_query: searchValue,
                      status: statusValue,
                      category: categoryValue
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
                    row.innerHTML = `<td colspan="7" class="text-center">No FAQs found</td>`;
                    tableBody.appendChild(row);
                } else {
                    data.forEach(faq => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${faq.id}</td>
                            <td>${faq.question.length > 25 ? faq.question.substr(0, 25) + '...' : faq.question}</td>
                            <td>${faq.answer.length > 25 ? faq.answer.substr(0, 25) + '...' : faq.answer}</td>
                            <td>${faq.category ? faq.category.name : 'No Category'}</td>
                            <td>${faq.user.name}</td>
                            <td>
                                ${faq.status === 1 ? '<span class="badge bg-info-subtle text-info">Pending</span>' :
                                faq.status === 2 ? '<span class="badge bg-warning-subtle text-warning">Published</span>' :
                                faq.status === 3 ? '<span class="badge bg-pink-subtle text-pink">Inactive</span>' :
                                '<span class="badge bg-warning">Unknown Status</span>'}
                            </td>
                            <td>
                                <form action="{{ route('Faq.destroy', ':id') }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                </form>
                                <a href="{{ route('Faq.edit', ':id') }}" class="btn btn-sm btn-primary">Update</a>
                            </td>
                        `;
                        row.innerHTML = row.innerHTML.replace(/:id/g, faq.id); // Replace :id placeholder with actual faq id
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

