
@extends('.layouts.main')

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
                    <h4 class="page-title">edit a user here </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Edit user</h4>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{ route('users.update', $user->id) }}" method="POST" id="updateUserForm">
                                    @csrf
                                    @method('PUT')
                                
                                    <div class="mb-3">
                                        <label for="" class="">Status</label>
                                        <select class="form-select" id="user_status" name="status">
                                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Pending</option>
                                            <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>Active</option>
                                            <option value="3" {{ $user->status == 3 ? 'selected' : '' }}>Banned</option>
                                        </select>
                                    </div>
                                
                                    <div id="banReasonField" class="mb-3" style="display: none;">
                                        <label for="ban_reason" class="form-label">Ban Reason</label>
                                        <textarea id="ban_reason" name="ban_reason" class="form-control" rows="3" placeholder="Enter the reason for banning the user"></textarea>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="role" class="form-label">User Role</label>
                                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" @if($user->roles->contains($role->id)) selected @endif>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3" id="departmentInput" style="display: none;">
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
                                
                                    <div class="mb-3">
                                        <button type="submit" id="submitButton" class="btn btn-primary" name="updateUser">Submit</button>
                                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Go Back</a>
                                    </div>
                                </form>
                                
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        var form = document.getElementById('updateUserForm');
                                        var userStatusSelect = document.getElementById('user_status');
                                        var banReasonField = document.getElementById('banReasonField');
                                
                                        function toggleReasonField() {
                                            if (userStatusSelect.value === '3') {
                                                banReasonField.style.display = 'block';
                                            } else {
                                                banReasonField.style.display = 'none';
                                            }
                                        }
                                
                                        toggleReasonField();
                                
                                        userStatusSelect.addEventListener('change', function () {
                                            toggleReasonField();
                                        });
                                
                                        form.addEventListener('submit', function (event) {
                                            if (userStatusSelect.value === '3' && !document.getElementById('ban_reason').value.trim()) {
                                                event.preventDefault();
                                                alert('Please provide a reason for banning the user.');
                                            }
                                        });
                                    });
                                </script>
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
                                

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

