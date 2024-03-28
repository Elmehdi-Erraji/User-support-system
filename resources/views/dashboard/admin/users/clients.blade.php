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
            <!-- Todo-->
            <div class="card">
                <div class="card-body p-0">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-lg-6">
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
                                        <th>Number of Tickets</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $client->id }}</td>
                                        <td>
                                            @if ($client->getFirstMedia('avatars'))
                                            <img src="{{ asset($client->getFirstMedia('avatars')->getUrl()) }}" class="rounded-circle" alt="Avatar" width="50">
                                            @else
                                            No image
                                            @endif
                                        </td>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>
                                            @if ($client->status === 1)
                                            <span class="badge bg-info-subtle text-info">Pending</span>
                                            @elseif ($client->status === 2)
                                            <span class="badge bg-warning-subtle text-warning">Active</span>
                                            @elseif ($client->status === 3)
                                            <span class="badge bg-pink-subtle text-pink ">Banned</span>
                                            @else
                                            <span class="badge bg-warning">Unknown Status</span>
                                            @endif
                                        </td>
                                       
                                        
                                        <td>{{ $client->tickets()->count()}}</td>
                                        <td>
                                            @if ($client->trashed())
                                            <form action="{{ route('users.restore', $client->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-warning">Restore</button>
                                            </form>
                                            <form action="{{ route('users.force-delete', $client->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">Permanently Delete</button>
                                            </form>
                                            @else
                                            <a href="{{ route('users.edit', $client->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="{{ route('users.show', $client->id) }}" class="btn btn-sm btn-info">View Details</a>
                                            <form action="{{ route('users.destroy', $client->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
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

