
@extends('.layouts.main')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Style for the file items */
        .file-item {
            display: inline-block;
            margin-right: 10px; /* Adjust spacing between file items */
        }
    
        /* Style for images */
        .file-item img {
            max-width: 100px; /* Adjust maximum width of images */
            max-height: 100px; /* Adjust maximum height of images */
        }
    </style>
<body>

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
                                <form action="{{ route('client_ticket.store') }}" method="POST" id="addTicketForm" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
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
                                        <div id="selectedFiles"></div>
                                        @error('attachment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                                    <div class="mb-3">
                                        <label for="attachment" class="form-label">Attachment</label>
                                        <input type="file" class="form-control" id="attachment" name="attachment[]" multiple>
                                        <div id="selectedFiles"></div> <!-- Container to display selected files -->
                                    </div>
                                
                             
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
        // Function to display selected files (including images)
        function displaySelectedFiles(input) {
            const files = input.files;
            const selectedFilesContainer = document.getElementById('selectedFiles');
            selectedFilesContainer.innerHTML = ''; // Clear previous selection
    
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileItem = document.createElement('div');
                fileItem.classList.add('file-item'); // Add the 'file-item' class to the file item
    
                if (file.type.startsWith('image/')) {
                    // If the file is an image, display the image itself
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    fileItem.appendChild(img);
                } else {
                    // If the file is not an image, display its name
                    fileItem.textContent = file.name;
                }
    
                selectedFilesContainer.appendChild(fileItem);
            }
        }
    
        // Event listener to trigger displaySelectedFiles function when files are selected
        document.getElementById('attachment').addEventListener('change', function() {
            displaySelectedFiles(this);
        });
    </script>

    <script src="{{ asset('assets/vendor/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/fileupload.init.js') }}"></script>
</body>
@endsection

