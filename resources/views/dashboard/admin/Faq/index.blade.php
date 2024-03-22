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
                        <li class="breadcrumb-item active">Faq's !</li>
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
                                <a href="{{ route('Faq.create') }}" class="btn btn-primary" id="addButton" style="width: 30%">Add A Faq</a>
                            </div>

                        </div>
                    </div>

                    <div id="yearly-sales-collapse" class="collapse show">
                        <div class="table-responsive">
                            <table class="table table-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Category</th>
                                        <th>Creator</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($faqs as $faq)
                                        <tr>
                                            <td>{{ $faq->id }}</td>
                                            <td>{{ strlen($faq->question) > 25 ? substr($faq->question, 0, 25) . '...' : $faq->question }}</td>
                                            <td>{{ strlen($faq->answer) > 25 ? substr($faq->answer, 0, 25) . '...' : $faq->answer }}</td>
                                            <td>{{ $faq->category->name }}</td>
                                            <td>{{ $faq->user->name }}</td>
                                            <td>
                                                @if ($faq->status === 1)
                                                    <span class="badge bg-info-subtle text-info">Pending</span>
                                                @elseif ($faq->status === 2)
                                                    <span class="badge bg-warning-subtle text-warning">Published</span>
                                                @elseif ($faq->status === 3)
                                                    <span class="badge bg-pink-subtle text-pink">Inactive</span>
                                                @else
                                                    <span class="badge bg-warning">Unknown Status</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('Faq.destroy', $faq->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                                </form>
                                                <a href="{{ route('Faq.edit', $faq->id) }}" class="btn btn-sm btn-primary">Update</a>
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

