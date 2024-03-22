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
                        <div class="p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    {{-- <button type="button" class="btn btn-primary" style="width: 40%" data-bs-toggle="modal" data-bs-target="#add-department-modal">Add A Department</button> --}}
                                    
                                    <a href="{{route('department.create')}}"><button type="button" class="btn btn-primary" style="width: 40%" >Add A Department</button></a>

                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-nowrap table-hover mb-0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($departments as $department)
                                    <tr>
                                        <td>{{ $department->id }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>
                                            <form action="{{route('department.destroy' , $department->id)}}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                            </form>
                                            <a href="{{ route('department.edit', $department->id) }}" class="btn btn-sm btn-primary">Update</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
        {{-- the create moda start --}}
        <div id="add-department-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="add-category-form" action="{{ route('department.store') }}" method="POST" class="ps-3 pe-3">
                            @csrf
                            <div class="mb-3">
                                <label for="category-name" class="form-label">Department Name</label>
                                <input class="form-control" type="text" id="category-name" name="name" placeholder="Enter department name">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn rounded-pill btn-primary" type="submit" id="add-category-btn">Add Department</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- the create moda end --}}

        <div id="update-department-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="update-category-form" method="POST" class="ps-3 pe-3">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="department-name" class="form-label">Department Name</label>
                                <input class="form-control" type="text" id="department-name" name="name" placeholder="Enter updated department name" value="{{ old('name') }}" data-name="{{ $department->name }}">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn rounded-pill btn-primary" type="submit" id="update-category-btn">Update Department</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       

    </div>
   

@endsection

