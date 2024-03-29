@extends('layouts.main')

@section('content')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Velonic</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">FAQ</li>
                    </ol>
                </div>
                <h4 class="page-title">FAQ</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="mb-4 text-center">
                        <h3 class="">Frequently Asked Questions</h3>
                        <p class="text-muted mt-3">
                            Do you have questions regarding technical issues, sales inquiries, or billing concerns? Here, you'll find helpful answers to common questions about our products and services."
                        </p>
            
                        <!-- Search form with categories filter -->
                        <form action="#" method="GET" class="mt-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for FAQs" name="search_query">
                                <div class="input-group-append" style="width:20%">
                                    <select class="form-select" name="category">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                        
                        
                        
                        <!-- Buttons for contacting support -->
                        <a href="{{ route('ticket.create') }}" class="btn btn-success mt-2 me-1">
                            <i class="ri-mail-line me-1"></i> Create a ticket
                        </a>                        
                        <a href="https://twitter.com" target="_blank" class="btn btn-info mt-2">
                            <i class="ri-twitter-line me-1"></i> Leave a review on Twitter
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">

                    <div class="row justify-content-center mt-4">
                        <div class="col-10">
                            <div class="row">
                                @foreach ($faqs as $faq)
                                <div class="col-md-4">
                                    <div>
                                        <div class="faq-question-q-box">Q.</div>
                                        <h4 class="faq-question" data-wow-delay=".1s">{{$faq->question}}</h4>
                                        <p class="faq-answer mb-4"> <a href="" class=" btn-secondary"  data-bs-toggle="modal" data-bs-target="#scrollable-modal">Viwe the answer to this question</a></p>
                                    </div>
                                </div> 
                                <div class="modal fade" id="scrollable-modal" tabindex="-1" role="dialog"
                                            aria-labelledby="scrollableModalTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="scrollableModalTitle">{{$faq->question}}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{$faq->answer}}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                                <div class="pagination">
                                    {{ $faqs->links() }}
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

