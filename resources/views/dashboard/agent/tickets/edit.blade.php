
@extends('.layouts.main')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <!-- Start Content-->
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
                    <h4 class="page-title">Create a user here </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Add a new user</h4>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{ route('agent_ticket.update', $ticket->id) }}" method="POST" id="updateTicketForm" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') <!-- Use PUT method for updating -->
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select id="statu" class="form-select @error('status') is-invalid @enderror" name="status">
                                                    <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                                    <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="on_hold" {{ $ticket->status == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                                                    <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                    <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                                    <option value="wrong_category" {{ $ticket->status == 'wrong_category' ? 'selected' : '' }}>Wrong Category</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="priority" class="form-label">Priority</label>
                                                <select id="priority" class="form-select @error('priority') is-invalid @enderror" name="priority">
                                                    <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                                                    <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                                    <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
                                                </select>
                                                @error('priority')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                
                                      
                                        <div class="mb-3" id="motifContainer" style="display: none;">
                                            <label for="motif" class="form-label">Explanation</label>
                                            <textarea id="motif" class="form-control @error('motif') is-invalid @enderror" name="motif" rows="4" placeholder="Ticket Description">{{ old('motif') }}</textarea>
                                            @error('motif')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        

                                    </div>
                                    <button type="submit" id="submitButton" class="btn btn-primary">Update</button>
                                </form>
                                
                                
                                
                                


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
         const roleSelect = document.getElementById('statu');
        const departmentInput = document.getElementById('motifContainer');
    
        roleSelect.addEventListener('change', function() {
            if (this.value === 'wrong_category') {
                departmentInput.style.display = 'block';
            } else {
                departmentInput.style.display = 'none';
            }
        });
    </script>

@endsection

