
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
                            <li class="breadcrumb-item active">Departmetns!</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create a Department </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Departments</h4>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{route('department.store')}}" method="POST" >
                                    @csrf
                                
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Department Name</label>
                                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Department Name" value="{{ old('name') }}">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" id="submitButton" class="btn btn-primary" name="addUser">Submit</button>
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

