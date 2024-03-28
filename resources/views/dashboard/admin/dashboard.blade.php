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

@endsection
