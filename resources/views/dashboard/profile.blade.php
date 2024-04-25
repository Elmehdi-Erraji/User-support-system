@extends('layouts.main')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="profile-bg-picture" style="background-image:url('assets/images/bg-profile.jpg')">
                    <span class="picture-bg-overlay"></span>
                    <!-- overlay -->
                </div>
                <!-- meta -->
                <div class="profile-user-box">
                    <div class="row">
                        <div class="col-sm-6">
                            @if (Auth::user()->getFirstMedia('avatars'))
                                <div class="profile-user-img"><img src="{{ Auth::user()->getFirstMedia('avatars')->getUrl() }}" alt="" class="avatar-lg rounded-circle"></div>
                            @else
                                <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                            @endif

                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex justify-content-end align-items-center gap-2">
                                <button type="button" class="btn btn-info" id="edit-profile-button">
                                    <i class="ri-settings-2-line align-text-bottom me-1 fs-16 lh-1"></i>
                                    Edit Profile
                                </button>
                                <button type="button" class="btn btn-soft-danger" id="delete-account-button" data-bs-toggle="modal" data-bs-target="#login-modal">
                                    <i class="ri-delete-bin-line align-text-bottom me-1 fs-16 lh-1"></i>
                                    Delete Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ meta -->
            </div>
        </div>



        <div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <form id="delete-account-form" action="{{ route('profile.destroy',Auth::user()->id) }}" method="POST" class="ps-3 pe-3">
                            @csrf
                            @method('DELETE')
                            <div class="mb-3">
                                <label for="password1" class="form-label">Password</label>
                                <input class="form-control" type="password" required id="password1" name="password" placeholder="Enter your password">
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn rounded-pill btn-primary" type="submit">Delete account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card p-0">
                    <div class="card-body p-0">
                        <div class="profile-content">
                            <ul class="nav nav-underline nav-justified gap-0">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" data-bs-target="#aboutme" type="button" role="tab" aria-controls="home" aria-selected="true" href="#aboutme">Profile</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" data-bs-target="#edit-profile" type="button" role="tab" aria-controls="home" aria-selected="true" href="#edit-profile">Personal Info</a></li>
                                <li class="nav-item"><a class="nav-link " data-bs-toggle="tab" data-bs-target="#my_requests" type="button" role="tab" aria-controls="home" aria-selected="true" href="#my_requests">Password ...</a></li>
                            </ul>

                            <div class="tab-content m-0 p-4">
                                <div class="tab-pane active" id="aboutme" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    <div class="profile-desk">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2 class="text-uppercase fs-24 text-dark">{{ $user->name }} {{ $user->last_name }}</h2>
                                                
                                                <div class="mt-4">
                                                    <h4 class="fs-20 text-dark">Contact Information</h4>
                                                    <p class="text-muted fs-16"><strong>Email:</strong> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                                                </div>
                                                
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="edit-profile" class="tab-pane">
                                    <div id="edit-profile" class="tab-pane">
                                        <div class="user-profile-content">
                                            <form action="{{ route('profile.update',$user->id) }}" method="POST" id="profileForm" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="user_id" value="{{$user->id}}" >
                                                <div class="row row-cols-sm-2 row-cols-1">
                                                    <div class="mb-2">
                                                        <label class="form-label" for="fullName">Name </label>
                                                        <input type="text" value="{{ $user->name }}" id="name" name="name" class="form-control">
                                                    </div>
                                                   
                                                    <div class="mb-3">
                                                        <label class="form-label" for="email">Email</label>
                                                        <input type="email" value="{{ $user->email }}" id="email" name="email" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="email">Phone</label>
                                                        <input type="" value="{{ $user->phone }}" id="email" name="phone" class="form-control">
                                                    </div>

                                                    <div class="col-sm-12 mb-3">
                                                        <label class="form-label" for="profileImage">Profile Image</label>
                                                        <input type="file" id="profileImage" name="avatar" class="form-control">
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="submit"><i class="ri-save-line me-1 fs-16 lh-1"></i> Save</button>
                                            </form>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div id="my_requests" class="tab-pane">
                                    <div class="row m-t-10">
                                        <!-- Password Change Form (Left Side) -->
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Change Password</h4>
                                                    <form action="{{ route('profile.password.update') }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="current_password" class="form-label">Current Password</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                                                                <div class="input-group-text" data-password="false">
                                                                    <span class="password-eye"></span>
                                                                </div>
                                                                @error('current_password')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="new_password" class="form-label">New Password</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required>
                                                                <div class="input-group-text" data-password="false">
                                                                    <span class="password-eye"></span>
                                                                </div>
                                                                @error('new_password')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password" required>
                                                                <div class="input-group-text" data-password="false">
                                                                    <span class="password-eye"></span>
                                                                </div>
                                                                @error('confirm_password')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="card" style="background-color: orange;">
                                                <div class="card-body" style="color: white;">
                                                    <h4 class="card-title">Password Requirements</h4>
                                                    <ul>
                                                        <li>Password must be at least 8 characters long</li>
                                                        <li>Password must contain at least one uppercase letter</li>
                                                        <li>Password must contain at least one lowercase letter</li>
                                                        <li>Password must contain at least one number</li>
                                                        <li>Password must contain at least one special character</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
   @if (Session::has('success'))
    <script>
        console.log("SweetAlert initialization script executed!");
        Swal.fire("Success", "{{ Session::get('success') }}", 'success');
    </script>
@elseif (Session::has('error'))
    <script>
        console.log("SweetAlert initialization script executed!");
        Swal.fire("Error", "{{ Session::get('error') }}", 'error');
    </script>

@elseif (Session::has('warnning'))
<script>
    console.log("SweetAlert initialization script executed!");
    Swal.fire("Info", "{{ Session::get('warnning') }}", 'warning');
</script>
@endif
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("edit-profile-button").addEventListener("click", function() {
                document.querySelector('a[href="#edit-profile"]').click();
            });
        });
    </script>
@endsection
