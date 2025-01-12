
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
                                        <h4 class="fs-20">Reset Password</h4>
                                        <p class="text-muted mb-3">Enter your email address and password to access account.</p>
                                        <form method="POST" action="{{ route('password.update') }}" class="mt-4">
                                            @csrf
                                            <input type="hidden" name="reset_token" value="{{ $token }}">
                                            
                                            <div class="mb-3">
                                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{old('email', $email)}}" placeholder="Enter your email" required autofocus />
                                                @error('email')
                                                <span class="error-message">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Enter your password" required autocomplete="new-password" />
                                                @error('password')
                                                <span class="error-message">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                                <input id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Confirm your password" required autocomplete="new-password" />
                                                @error('password_confirmation')
                                                <span class="error-message">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                            <div class="text-start">
                                                <button class="btn btn-soft-primary w-100" type="submit"><i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">{{ __('Reset Password') }}</span> </button>
                                            </div>
                                        </form>
                                        
                                        
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-dark-emphasis">Don't have an account? <a href="{{ route('register') }}" class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Sign up</b></a></p>
                    <p class="text-dark-emphasis"> Go back <a href="{{ route('home') }}" class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Home</b></a></p>
                </div> 
            </div>
        </div>

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            <script>
                document.write(new Date().getFullYear())
            </script> © Mehdi
        </span>
    </footer>

    @endsection