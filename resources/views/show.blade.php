
@extends('.layouts.main')

@section('content')

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
                                Delete Account
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
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card p-0">
                <div class="card-body p-0">
                    <div class="profile-content">
                        <ul class="nav nav-underline nav-justified gap-0">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" data-bs-target="#aboutme" type="button" role="tab" aria-controls="home" aria-selected="true" href="#aboutme">Profile</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" data-bs-target="#edit-profile" type="button" role="tab" aria-controls="home" aria-selected="true" href="#edit-profile">Personal Info</a></li>
                            <li class="nav-item"><a class="nav-link " data-bs-toggle="tab" data-bs-target="#my_requests" type="button" role="tab" aria-controls="home" aria-selected="true" href="#my_requests">My Reservations</a></li>
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
                            {{-- <div id="my_requests" class="tab-pane">
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Event</th>
                                                    <th>Local</th>
                                                    <th>Date</th>
                                                    <th>status</th>
                                                    <th>Number Of tickets</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                 <tbody>
                                                     @foreach($reservations as $index => $reservation)
                                                    <tr>
                                                        <td>{{ $reservation->id }}</td>
                                                        <td>{{ $reservation->title }}</td> 
                                                        <td>{{ $reservation->location }}</td> 
                                                        <td>{{ \Carbon\Carbon::parse($reservation->date)->format('D, M j, Y') }}</td> 
                                                        <td>
                                                            @if ($reservation->pivot->status === '0')
                                                                <span class="badge bg-info-subtle text-info">Pending</span>
                                                            @elseif ($reservation->pivot->status === '1')
                                                                <span class="badge bg-warning-subtle text-warning">Approved</span>
                                                            @elseif ($reservation->pivot->status === '2')
                                                                <span class="badge bg-pink-subtle text-pink ">Refused</span>
                                                            @else
                                                                <span class="badge bg-warning">Unknown Status</span>
                                                            @endif
                                                        </td>
                                                        <td>{{$reservation->pivot->num_tickets}}</td> 
                                                        <td>
                                                            <a href="{{ route('eventDetails', $reservation->id) }}" class="btn btn-sm btn-info">View Details</a>
                                                        
                                                            @if ($reservation->pivot->status == 1)
                                                            <a href="{{ route('getTicket', ['reservationId' => $reservation->id]) }}" class="btn btn-sm btn-warning">Get My Ticket</a>

                                                        @endif 
                                                        <form action="{{route('cancelReservation', $reservation->id)}}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                                                        </form>                                                           
                                                        </td>
                                                       
                                                    </tr>
                                                    @endforeach
                                                </tbody> 
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
</div>

@endsection

