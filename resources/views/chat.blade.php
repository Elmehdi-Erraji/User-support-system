@extends('layouts.main')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid">
   

 
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Velonic</a></li>
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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
                            <button type="button" class="btn btn-primary rounded-start-0"><i class="ri-search-line fs-16"></i></button>
                        </div>
                    </div>
        
                    <div class="card-body contact-list">
                        <div class="d-flex align-items-center contact" style="cursor: pointer;">
                            <img class="avatar-md rounded-circle bx-s me-3" src="assets/images/users/avatar-2.jpg" alt="">
                            <div>
                                <h5 class="fs-16 my-1">Jonathan Smith</h5>
                                <p class="text-muted fs-14 mb-1">Graphics Designer</p>
                            </div>
                            <span class="badge bg-warning ms-auto">Online</span>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        
            <div class="col-xl-8 chat-container">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="card-widgets">
                                <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                                <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false" aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                                <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                            </div>
                            <h5 class="header-title mb-0">Chat</h5>
                        </div>
        
                        <div id="yearly-sales-collapse" class="collapse show">
                            <div class="chat-conversation mt-2">
                                <div class="card-body py-0 mb-3" data-simplebar style="height: 322px;">
                                    <ul class="conversation-list">
                                        <!-- Chat conversation list goes here -->
                                    </ul>
                                </div>
                                <div class="card-body pt-0">
                                    <form class="needs-validation" novalidate name="chat-form" id="chat-form">
                                        <div class="row align-items-start">
                                            <div class="col">
                                                <input type="text" class="form-control chat-input" placeholder="Enter your text" required>
                                                <div class="invalid-feedback">
                                                    Please enter your message
                                                </div>
                                            </div>
                                            <div class="col-auto d-grid">
                                                <button type="submit" class="btn btn-danger chat-send waves-effect waves-light">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
   
    </div>
</div>


@endsection

