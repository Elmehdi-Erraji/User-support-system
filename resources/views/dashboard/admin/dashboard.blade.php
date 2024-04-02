@extends('layouts.main')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid">
   

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

    <div class="row">
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-primary">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-group-2-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Tickets">Users</h6>
                    <h2 class="my-2">{{ $totalUsers }}</h2>
                </div>
            </div>
        </div>
    
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-purple">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-user-star-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Agents">Agents</h6>
                    <h2 class="my-2">{{ $totalAgents }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-info">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-user-3-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Clients">Clients</h6>
                    <h2 class="my-2">{{ $totalClients }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-pink">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-ticket-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Users">Tickets</h6>
                    <h2 class="my-2">{{ $totalTickets }}</h2>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Tickets created by day</h4>
    
                    <div dir="ltr">
                        <div class="mt-3 chartjs-chart" style="height: 320px;">
                            <canvas id="ticketsByDayChart"></canvas>
                        </div>
                    </div>
    
                    <!-- Button to direct admin to tickets list -->
                    <div class="text-center mt-4">
                        <a href="{{ route('ticket.index') }}" class="btn btn-primary">View More Details</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Tickets by status</h4>
    
                    <div dir="ltr">
                        <div class="mt-3 chartjs-chart" style="height: 320px;">
                            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                        </div>
                    </div>
    
                    <!-- Button to direct admin to tickets list -->
                    <div class="text-center mt-4">
                        <a href="{{ route('ticket.index') }}" class="btn btn-primary">View More Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Tickets by Category</h4>
    
                    <div dir="ltr">
                        <div class="mt-3 chartjs-chart" style="height: 320px;">
                            <canvas id="ticketsByCategoryChart"></canvas>
                        </div>
                    </div>
    
                    <!-- Button to direct admin to tickets list -->
                    <div class="text-center mt-4">
                        <a href="{{ route('ticket.index') }}" class="btn btn-primary">View More Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    {{-- <div id="right-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-right">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h4 class="mt-0">Text in a modal</h4>
                        <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="col-md-3 col-sm-6" style="display: none">
        <div class="text-center p-1 pb-3 p-sm-3">
            <p>Info Example</p>
            <button type="button" class="btn btn-info btn-sm" id="toastr-one">Click
                me</button>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Jquery Toast</h4>
                    <p class="text-muted mb-0">Toasts based notifications can be used to to show
                        important alerts or information to users.
                    </p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- end col-->
                        <div class="col-md-3 col-sm-6">
                            <div class="text-center p-1 pb-3 p-sm-3">
                                <p>Warning Example</p>
                                <button type="button" class="btn btn-warning btn-sm"
                                    id="toastr-two">Click me</button>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-md-3 col-sm-6">
                            <div class="text-center p-1 pb-3 p-sm-3">
                                <p>Success Example</p>
                                <button type="button" class="btn btn-success btn-sm"
                                    id="toastr-three">Click me</button>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-md-3 col-sm-6">
                            <div class="text-center p-1 pb-3 p-sm-3">
                                <p>Danger Example</p>
                                <button type="button" class="btn btn-danger btn-sm"
                                    id="toastr-four">Click me</button>
                            </div>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->

                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="text-center p-1 pb-3 p-sm-3">
                                <p>The text can be an array</p>
                                <button type="button" class="btn btn-light btn-sm"
                                    id="toastr-five">Click me</button>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-md-3 col-sm-6">
                            <div class="text-center p-1 pb-3 p-sm-3">
                                <p>Put some HTML in the text</p>
                                <button type="button" class="btn btn-light btn-sm" id="toastr-six">Click
                                    me</button>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-md-3 col-sm-6">
                            <div class="text-center p-1 pb-3 p-sm-3">
                                <p>Making them sticky</p>
                                <button type="button" class="btn btn-light btn-sm"
                                    id="toastr-seven">Click me</button>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-md-3 col-sm-6">
                            <div class="text-center p-1 pb-3 p-sm-3">
                                <p>Fade transitions</p>
                                <button type="button" class="btn btn-light btn-sm"
                                    id="toastr-eight">Click me</button>
                            </div>
                        </div> 
                    </div>
                   

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> --}}
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    var xValues = ['open', 'in_progress', 'on_hold', 'resolved', 'closed', 'wrong_category'];
    var yValues = {!! $ticketStatusesJson !!};
    var barColors = [
      "#b91d47",
      "#00aba9",
      "#2b5797",
      "#e8c3b9",
      "#1e7145",
      "#ff5733"
    ];

    new Chart("myChart", {
      type: "pie",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        title: {
          display: true,
        },
        legend: {
          position: 'left',
          labels: {
            boxWidth: 15, 
            padding: 15, 
            usePointStyle: true 
          }
        }
      }
    });
</script>

<script>
    var ctx = document.getElementById('ticketsByDayChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! $ticketCreationDatesJson !!}, // Array of ticket creation dates
            datasets: [{
                label: 'Tickets',
                data: {!! $ticketsCreatedCountJson !!}, 
                backgroundColor: 'rgba(54, 162, 235, 0.2)', 
                borderColor: 'rgba(54, 162, 235, 1)', 
                borderWidth: 1,
                fill: false 
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'time', 
                    time: {
                        unit: 'day' 
                    }
                },
                y: {
                    beginAtZero: true 
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Tickets Created by Day'
                }
            }
        }
    });
</script>
<script>
    var categories = {!! $categoriesJson !!};
    var ticketCounts = {!! $ticketCountsJson !!};

    var ctx = document.getElementById('ticketsByCategoryChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: categories,
            datasets: [{
                label: ' ',
                data: ticketCounts,
                backgroundColor: [
                    '#3bc0c3',
                    '#4489e4',
                    '#d03f3f',
                    '#716cb0',
                    '#1e7145',
                    '#ff5733'
                ],
                borderColor: 'rgba(255, 255, 255, 0.5)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'right'
            },
            title: {
                display: true,
                text: ''
            }
        }
    });
</script>

@endsection

