@extends('layouts.main')

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
                    <h4 class="page-title">Welcome!</h4>
                </div>
            </div>
        </div>

        <!-- end page title -->
        <div class="row">
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-primary">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-ticket-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Tickets Assigned">Tickets Assigned</h6>
                        <h2 class="my-2">25</h2> 
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-info">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-ticket-fill widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Tickets Resolved">Tickets Resolved</h6>
                        <h2 class="my-2">18</h2> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Todo-->
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="" class="btn btn-primary" id="addButton" style="width: 30%">Add A User</a>
                                </div>

                            </div>
                        </div>

                        <div id="yearly-sales-collapse" class="collapse show">
                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Username</th>
                                        <th>E-mail</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                    {{-- @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>
                                                @if ($user->getFirstMedia('avatars'))
                                                    <img src="{{ asset($user->getFirstMedia('avatars')->getUrl()) }}" class="rounded-circle" alt="Avatar" width="50">
                                                @else
                                                    No image
                                                @endif
                                            </td>
                                            <td>{{ $user->fullName }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>

                                            <td>
                                                @if ($user->status === 1)
                                                    <span class="badge bg-info-subtle text-info">Pending</span>
                                                @elseif ($user->status === 2)
                                                    <span class="badge bg-warning-subtle text-warning">Active</span>
                                                @elseif ($user->status === 3)
                                                    <span class="badge bg-pink-subtle text-pink ">Banned</span>
                                                @else
                                                    <span class="badge bg-warning">Unknown Status</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->roles()->exists())
                                                    {{ $user->roles()->first()->name }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger  delete-btn">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                    </tbody>
                                </table>
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


@endsection

