@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Report History')

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
            <h3 class="text-dark mb-0">History</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!--Overview-->
        <div class="d-sm-flex p-2">
            <h5 class="text-dark mb-0">Overview</h5>
        </div>
        <div class="row p-2">
            <div class="col-md-6 col-xl-6 mb-4">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Number of Donated Clothes:</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>102</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-6 mb-4">
                <div class="card shadow border-start-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total Number of Items Sold:</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>12</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Earnings-->
        <div class="d-sm-flex p-2">
            <h5 class="text-dark mb-0">Earnings</h5>
        </div>
        <div class="row p-2">
            <div class="col-md-6 col-xl-6 mb-4">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Earnings (This Month):</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>PHP 1,000.00</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-6 mb-4">
                <div class="card shadow border-start-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total Earnings (This Year)</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>PHP 12,000.00</span></div>
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
                        <div class="chart-area"><canvas  id="monthlyGraph" height="320" style="display: block; width: 572px; height: 320px;" width="572"></canvas></div>
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

        <!--Order/Donation History-->
        <div class="row">
            <!--Order History-->
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Order History</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Order No.</th>
                                        <th>Name</th>
                                        <th>Purchased</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <th>10011</th>
                                        <td>Paul Angelo Soltero</td>
                                        <td>12 items</td>
                                        <td>PHP 590.00</td>
                                        <td>10/22/22 10:00 AM</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <th>10011</th>
                                        <td>Paul Angelo Soltero</td>
                                        <td>12 items</td>
                                        <td>PHP 590.00</td>
                                        <td>10/22/22 10:00 AM</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <th>10011</th>
                                        <td>Paul Angelo Soltero</td>
                                        <td>12 items</td>
                                        <td>PHP 590.00</td>
                                        <td>10/22/22 10:00 AM</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--Donation History-->
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <div class="row">
                            <h6 class="m-0 font-weight-bold text-primary">Donation History</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>ID No.</th>
                                        <th>Donated by</th>
                                        <th>Donated to</th>
                                        <th>No. of Items</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>1001</td>
                                        <td>Pamela May Tañedo</td>
                                        <td>Youth for Youth Foundation</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>1002</td>
                                        <td>Arcel Luceno</td>
                                        <td>Bukas Palad Foundation Inc.</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>1003</td>
                                        <td>Paul Angelo Soltero</td>
                                        <td>Bukas Palad Foundation Inc.</td>
                                        <td>6</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <div>
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
        const annuallyGraph = new Chart(
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

