
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
                            <li class="breadcrumb-item active">Faq's!</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Welcome !</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Update the Faq</h4>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{ route('Faq.update', $faq->id) }}" method="POST" id="updateFaqForm" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="user_id" value="1">
                                    <div class="mb-3">
                                        <label for="question" class="form-label">Question</label>
                                        <input type="text" id="question" class="form-control @error('question') is-invalid @enderror" name="question" placeholder="Enter the FAQ question" value="{{ old('question', $faq->question) }}">
                                        @error('question')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="answer" class="form-label">Answer</label>
                                        <textarea id="answer" class="form-control @error('answer') is-invalid @enderror" name="answer" rows="4" placeholder="Enter the FAQ answer">{{ old('answer', $faq->answer) }}</textarea>
                                        @error('answer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select id="" class="form-select @error('status') is-invalid @enderror" name="status">
                                            <option value="1" {{ old('status', $faq->status) == 1 ? 'selected' : '' }}>Pending</option>
                                            <option value="2" {{ old('status', $faq->status) == 2 ? 'selected' : '' }}>Active</option>
                                            <option value="3" {{ old('status', $faq->status) == 3 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $faq->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <button type="submit" id="updateButton" class="btn btn-primary">Update</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Go Back</a>
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

