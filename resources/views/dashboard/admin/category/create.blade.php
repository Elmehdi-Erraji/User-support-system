
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
                            <li class="breadcrumb-item active">Categories!</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create a category here </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Add a new category</h4>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{route('categories.store')}}" method="POST" >
                                    @csrf
                                
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Category Name</label>
                                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Category Name" value="{{ old('name') }}">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <div class="mb-3" id="departmentInput" >
                                            <label for="department" class="form-label">Department</label>
                                            <select class="form-select @error('department') is-invalid @enderror" id="department" name="department_id">
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('department')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" id="submitButton" class="btn btn-primary" >Submit</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Go Back</a>
                                </form>
                                


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

