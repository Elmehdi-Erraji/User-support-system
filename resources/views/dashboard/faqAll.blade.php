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
                        <form id="searchForm">
                            @csrf 
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm me-2" placeholder="Search for faq's" name="search_query" id="searchQuery">
                                <button class="btn bg-white" type="button" data-bs-toggle="modal" data-bs-target="#filterModal">
                                    <i class="ri-filter-line"></i> 
                                </button>
                                <button type="submit" class="btn btn-primary ms-2" id="searchButton">Search</button>
                            </div>
                            
                            <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered  ">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-light">
                                            <h5 class="modal-title" id="filterModalLabel">Filters</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="categoryFilter" class="form-label">Category:</label>
                                                <select id="categoryFilter" class="form-select" name="category">
                                                    <option value="null">Any</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                                            <button type="button" class="btn btn-secondary" id="resetFilters">Reset</button>
                                        </div>
                                    </div>
                                </div>
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

                    <div class="row justify-content-center mt-4" >
                        <div class="col-10">
                            <div class="row" id="resultContainer">
                                @foreach ($faqs as $faq)
                                <div class="col-md-4" >
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
@if (Session::has('success'))
                                <script>
                                    console.log("SweetAlert initialization script executed!");
                                    Swal.fire("Success", "{{ Session::get('success') }}", 'success');
                                </script>
                            @endif
<script>
    document.getElementById('resetFilters').addEventListener('click', function() {
    document.getElementById('categoryFilter').value = 'null';
});
</script>




<script>

document.addEventListener('DOMContentLoaded', function() {
    const resultContainer = document.getElementById('resultContainer');

    function fetchSearchResults() {
        const searchValue = document.getElementById('searchQuery').value;
        const categoryValue = document.getElementById('categoryFilter').value;

        fetch('{{ route('FaqHome.search') }}', {
            method: 'POST',
            body: JSON.stringify({
                search_query: searchValue,
                category: categoryValue
            }),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
    const resultContainer = document.getElementById('resultContainer');
    resultContainer.innerHTML = '';

    if (data.length === 0) {
        resultContainer.innerHTML = '<p class="text-center">No FAQs found</p>';
    } else {
        data.forEach(faq => {
            const colDiv = document.createElement('div');
            colDiv.classList.add('col-md-4');

            const faqDiv = document.createElement('div');

            const questionBoxDiv = document.createElement('div');
            questionBoxDiv.classList.add('faq-question-q-box');
            questionBoxDiv.textContent = 'Q.';

            const questionHeader = document.createElement('h4');
            questionHeader.classList.add('faq-question');
            questionHeader.dataset.wowDelay = '.1s';
            questionHeader.textContent = faq.question;

            const answerParagraph = document.createElement('p');
            answerParagraph.classList.add('faq-answer', 'mb-4');
            const answerLink = document.createElement('a');
            answerLink.href = '';
            answerLink.classList.add('btn-secondary');
            answerLink.textContent = 'View the answer to this question';
            answerLink.dataset.bsToggle = 'modal';
            answerLink.dataset.bsTarget = '#scrollable-modal-' + faq.id;

            answerParagraph.appendChild(answerLink);
            faqDiv.appendChild(questionBoxDiv);
            faqDiv.appendChild(questionHeader);
            faqDiv.appendChild(answerParagraph);
            colDiv.appendChild(faqDiv);

            const modalDiv = document.createElement('div');
            modalDiv.classList.add('modal', 'fade');
            modalDiv.id = 'scrollable-modal-' + faq.id;
            modalDiv.tabIndex = '-1';
            modalDiv.role = 'dialog';
            modalDiv.setAttribute('aria-labelledby', 'scrollableModalTitle');
            modalDiv.setAttribute('aria-hidden', 'true');

            const modalDialogDiv = document.createElement('div');
            modalDialogDiv.classList.add('modal-dialog', 'modal-dialog-scrollable');
            modalDialogDiv.setAttribute('role', 'document');

            const modalContentDiv = document.createElement('div');
            modalContentDiv.classList.add('modal-content');

            const modalHeaderDiv = document.createElement('div');
            modalHeaderDiv.classList.add('modal-header');

            const modalTitle = document.createElement('h5');
            modalTitle.classList.add('modal-title');
            modalTitle.textContent = faq.question;

            const closeButton = document.createElement('button');
            closeButton.type = 'button';
            closeButton.classList.add('btn-close');
            closeButton.setAttribute('data-bs-dismiss', 'modal');
            closeButton.setAttribute('aria-label', 'Close');

            modalHeaderDiv.appendChild(modalTitle);
            modalHeaderDiv.appendChild(closeButton);

            const modalBodyDiv = document.createElement('div');
            modalBodyDiv.classList.add('modal-body');
            modalBodyDiv.textContent = faq.answer;

            const modalFooterDiv = document.createElement('div');
            modalFooterDiv.classList.add('modal-footer');

            const closeButton2 = document.createElement('button');
            closeButton2.type = 'button';
            closeButton2.classList.add('btn', 'btn-secondary');
            closeButton2.setAttribute('data-bs-dismiss', 'modal');
            closeButton2.textContent = 'Close';

            modalFooterDiv.appendChild(closeButton2);

            modalContentDiv.appendChild(modalHeaderDiv);
            modalContentDiv.appendChild(modalBodyDiv);
            modalContentDiv.appendChild(modalFooterDiv);

            modalDialogDiv.appendChild(modalContentDiv);

            modalDiv.appendChild(modalDialogDiv);

            resultContainer.appendChild(colDiv);
            document.body.appendChild(modalDiv);
        });
    }
})

        .catch(error => {
            console.error('Error:', error);
        });
    }

    const searchForm = document.getElementById('searchForm');
    searchForm.addEventListener('submit', function(event) {
        event.preventDefault(); 
        fetchSearchResults();
    });

    document.getElementById('searchButton').addEventListener('click', function() {
        fetchSearchResults();
    });

    // Add event listener for the reset button in the filter modal
    document.getElementById('resetFilters').addEventListener('click', function(event) {
        document.getElementById('searchQuery').value = ''; // Reset search query input
        document.getElementById('categoryFilter').value = 'null'; // Reset category filter input
        fetchSearchResults(); // Fetch results again with reset filters
    });
});


</script>
@endsection

