@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Report List Transaction')

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
            <h3 class="text-dark mb-0">Transactions</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!--DataList of Transactions-->
        <div class="card shadow mt-5">
            <div class="card-header py-3">
                <div class="row">
                    <h6 class="m-0 font-weight-bold text-primary">Remitted Transactions</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>ID No.</th>
                                <th>Charity Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <th>10011</th>
                                <td>Missionary of Children - Cebu City Chapter</td>
                                <td>PHP 12,890.00</td>
                                <td>10/22/22 10:00 AM</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <th>10012</th>
                                <td>Bukas Palad Foundation Inc.</td>
                                <td>PHP 13,000.00</td>
                                <td>10/30/22 1:00 PM</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <th>10013</th>
                                <td>Youth for Youth Foundation</td>
                                <td>PHP 20,000.00</td>
                                <td>10/22/22 10:30 AM</td>
                            </tr>
                        </tbody>
                    </table>
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

    <script>
        $(document).ready(function() {
            $('table.display').DataTable();
        });
    </script>
@stop
