
@extends('.layouts.main')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
                                        @error('attachment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                 --}}
                             
                                    <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
                                </form>
                                
                                <form action="/" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                                data-upload-preview-template="#uploadPreviewTemplate">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            
                                <div class="dz-message needsclick">
                                    <i class="h1 text-muted ri-upload-cloud-2-line"></i>
                                    <h3>Drop files here or click to upload.</h3>
                                    <span class="text-muted font-13">(This is just a demo dropzone. Selected files are
                                        <strong>not</strong> actually uploaded.)</span>
                                </div>
                            </form>
                            
                            <!-- Preview -->
                            <div class="dropzone-previews mt-3" id="file-previews"></div>
                            
                            <!-- file preview template -->
                            {{-- <div class="d-none" id="uploadPreviewTemplate">
                                <div class="card mt-1 mb-0 shadow-none border">
                                    <div class="p-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                                            </div>
                                            <div class="col ps-0">
                                                <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                                                <p class="mb-0" data-dz-size></p>
                                            </div>
                                            <div class="col-auto">
                                                <!-- Button -->
                                                <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                                    <i class="ri-close-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             --}}
                                      


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('assets/vendor/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/fileupload.init.js') }}"></script>
</body>
@endsection

