
@extends('.layouts.main')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <!-- Start Content-->
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
                    <h4 class="page-title">Create a user here </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Add a new user</h4>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{ route('ticket.store') }}" method="POST" id="addTicketForm" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="user_id" value="1">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Ticket Title" value="{{ old('title') }}">
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="4" placeholder="Ticket Description">{{ old('description') }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="priority" class="form-label">Priority</label>
                                                <select id="priority" class="form-select @error('priority') is-invalid @enderror" name="priority">
                                                    <option value="low">Low</option>
                                                    <option value="medium">Medium</option>
                                                    <option value="high">High</option>
                                                </select>
                                                @error('priority')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">Category</label>
                                                <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    {{-- <div class="mb-3">
                                        <label for="attachment" class="form-label">Attachment</label>
                                        <input type="file" class="form-control @error('attachment') is-invalid @enderror" id="attachment" name="attachment[]" multiple>
                                        @error('attachment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                 --}}
                                    <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
                                </form>
                                
                                


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const roleSelect = document.getElementById('role');
        const departmentInput = document.getElementById('departmentInput');
    
        roleSelect.addEventListener('change', function() {
            if (this.value === '2') {
                departmentInput.style.display = 'block';
            } else {
                departmentInput.style.display = 'none';
            }
        });
    </script>

@endsection

