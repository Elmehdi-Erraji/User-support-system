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
                            Do you have a question about your subscription, a recent order, products, shipping or you want to suggest a new magazine? Here you can find some helpful answers to frequently asked questions (FAQ).
                        </p>

                        <button type="button" class="btn btn-success mt-2"><i class="ri-mail-line me-1"></i> Email us your question</button>
                        <button type="button" class="btn btn-info mt-2 ms-1"><i class="ri-twitter-line me-1"></i> Send us a tweet</button>
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
                                                              
                            </div> 
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

