@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Report Sales')

<!-- Styles -->
@section('styles')
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <style>
    </style>
@stop

<!-- Content -->
@section('content')
        <!--Total Numbers-->
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Sales</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!--Overview-->
        <div class="d-sm-flex p-2">
            <h5 class="text-dark mb-0">Overview</h5>
        </div>
        <div class="row p-2">
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Number of Orders:</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>102</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-start-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total Number of Items:</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>12</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-start-info py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Total Number of Sold Items</span></div>
                                <div class="row g-0 align-items-center">
                                    <div class="col-auto">
                                        <div class="text-dark fw-bold h5 mb-0 me-3"><span>12</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Earnings-->
        <div class="d-sm-flex p-2">
            <h5 class="text-dark mb-0">Overview Profits</h5>
        </div>
        <div class="row p-2">
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Profits:</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>PHP 123,000.00</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-start-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total Profits (This Month)</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>PHP 12,000.00</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-start-info py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Total Profits(This Year)</span></div>
                                <div class="row g-0 align-items-center">
                                    <div class="col-auto">
                                        <div class="text-dark fw-bold h5 mb-0 me-3"><span>PHP 50,000.00</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Chart-->
        <div class="row p-2">
            <div class="col-lg-6 col-xl-6">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0">Monthly Profit Graph</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area"><canvas id="monthlyGraph" height="320" style="display: block; width: 572px; height: 320px;" width="572"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0">Annually Profit Graph</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area"><canvas id="annuallyGraph" height="320" style="display: block; width: 572px; height: 320px;" width="572"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
@stop

<!-- Scripts -->
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

    <!--Annually Graph-->
    <script>
       const labels = [
         '2022',
         '2023',
         '2024',
         '2025',
         '2026',
         '2027',
       ];

       const data = {
         labels: labels,
         datasets: [{
           label: 'My First dataset',
           backgroundColor: 'rgb(255, 99, 132)',
           borderColor: 'rgb(255, 99, 132)',
           data: [25, 0, 0, 0, 0, 0, 0],
         }]
       };

       const config = {
         type: 'line',
         data: data,
         options: {}
       };
     </script>

   <script>
       const anuallyGraph = new Chart(
       document.getElementById('annuallyGraph'),
       config
       );
   </script>

<!--Monthly Graph-->
   <script>
       const ctx = document.getElementById('monthlyGraph').getContext('2d');
       const monthlyGraph = new Chart(ctx, {
           type: 'bar',
           data: {
               labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
               datasets: [{
                   label: '# of Votes',
                   data: [12, 19, 3, 5, 2, 3],
                   backgroundColor: [
                       'rgba(255, 99, 132, 0.2)',
                       'rgba(54, 162, 235, 0.2)',
                       'rgba(255, 206, 86, 0.2)',
                       'rgba(75, 192, 192, 0.2)',
                       'rgba(153, 102, 255, 0.2)',
                       'rgba(255, 159, 64, 0.2)'
                   ],
                   borderColor: [
                       'rgba(255, 99, 132, 1)',
                       'rgba(54, 162, 235, 1)',
                       'rgba(255, 206, 86, 1)',
                       'rgba(75, 192, 192, 1)',
                       'rgba(153, 102, 255, 1)',
                       'rgba(255, 159, 64, 1)'
                   ],
                   borderWidth: 1
               }]
           },
           options: {
               scales: {
                   y: {
                       beginAtZero: true
                   }
               }
           }
       });
       </script>

    <script>
        $(document).ready(function() {
            $('table.display').DataTable();
        });
    </script>
@stop
