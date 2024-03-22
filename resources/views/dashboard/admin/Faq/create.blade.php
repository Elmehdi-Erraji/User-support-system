
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
                                <form action="{{ route('Faq.store') }}" method="POST" id="addFaqForm" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="user_id" value="1">
                                    <div class="mb-3">
                                        <label for="question" class="form-label">Question</label>
                                        <input type="text" id="question" class="form-control @error('question') is-invalid @enderror" name="question" placeholder="Enter the FAQ question" value="{{ old('question') }}">
                                        @error('question')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="answer" class="form-label">Answer</label>
                                        <textarea id="answer" class="form-control @error('answer') is-invalid @enderror" name="answer" rows="4" placeholder="Enter the FAQ answer">{{ old('answer') }}</textarea>
                                        @error('answer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select id="" class="form-select @error('status') is-invalid @enderror" name="status">
                                            <option value="1" >Pending</option>
                                            <option value="2" >Active</option>
                                            <option value="3" >Inactive</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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

@endsection

