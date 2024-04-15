

@extends('layouts.auth')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-lg-10">
                <div class="card overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-block p-2">
                            <img src="{{ asset('assets/images/support.jpg') }}" alt="" class="img-fluid rounded h-100">
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column h-100">

                                <div class="p-4 my-auto">
                                    <h4 class="fs-20">Sign In</h4>
                                    <p class="text-muted mb-3">Enter your email address and password to access account.</p>

                                    <form method="POST" action="{{route('register')}}">
                                        @csrf
                                    
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Enter your name" value="{{ old('name') }}" required autofocus autocomplete="name">
                                            @error('name')
                                            <span class="error-message">{{ $message }}</span> 
                                            @enderror
                                        </div>
                                    
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email address</label>
                                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="Enter your email" value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                            <span class="error-message">{{ $message }}</span> 
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input class="form-control @error('phone') is-invalid @enderror" type="tel" name="phone" id="phone" placeholder="Enter your phone number" value="{{ old('phone') }}" required autocomplete="phone">
                                            @error('phone')
                                                <span class="error-message">{{ $message }}</span> 
                                            @enderror
                                        </div>
                                    
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Enter your password" required autocomplete="new-password">
                                            @error('password')
                                            <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    
                                        <!-- Confirm Password -->
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required autocomplete="new-password">
                                        </div>
                                        <div class="mb-0 text-start">
                                            <button class="btn btn-soft-primary w-100" type="submit"><i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Register</span> </button>
                                        </div>
                                    
                                        <div class="text-center mt-4">
                                            <p class="text-muted fs-16">Sign up with</p>
                                            <div class="d-flex gap-2 justify-content-center mt-3">
                                                <a href="#" class="btn btn-soft-primary"><i class="ri-facebook-circle-fill"></i></a>
                                                <a href="#" class="btn btn-soft-danger"><i class="ri-google-fill"></i></a>
                                                <a href="#" class="btn btn-soft-info"><i class="ri-twitter-fill"></i></a>
                                                <a href="#" class="btn btn-soft-dark"><i class="ri-github-fill"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                    
                                    

                                    <!-- end form-->
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <p class="text-dark-emphasis">Already registered? <a href="{{ route('login') }}" class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Log in</b></a></p>
               <p class="text-dark-emphasis"> Go back  <a href="{{ route('home') }}" class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Home</b></a></p>

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    

<footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            <script>
                document.write(new Date().getFullYear())
            </script> © Mehdi
        </span>
</footer>

@endsection
