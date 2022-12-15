@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Report List Transaction')

<!-- Styles -->
@section('styles')
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <style>
    </style>
@stop

<!-- Content -->
@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @enderror
        <!--Total Numbers-->
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Transactions</h3>
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
                    <table class="table table-hover table-bordered pt-3 display" id="listTransaction" style="">
                        <thead class="thead-light">
                            <tr>
                                <th>ID No.</th>
                                <th>Charity Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
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
    <script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js">
    </script>

    <script>
        //Datatables
        $(document).ready(function() {
            $('table.display').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

    <!--Total and List-->
    <script type="module">
        //Initialize Firebase
        import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js';
        import { getDatabase, ref, onValue } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-database.js';
        import { setImage } from './js/firebasehelper.js';
        const firebaseConfig = {
            apiKey: "AIzaSyDrQnBzhOFfjrIqmOUabkt14wvx-LVnzug",
            authDomain: "sharity-f983e.firebaseapp.com",
            databaseURL: "https://sharity-f983e-default-rtdb.firebaseio.com",
            projectId: "sharity-f983e",
            storageBucket: "sharity-f983e.appspot.com",
            messagingSenderId: "599803730946",
            appId: "1:599803730946:web:e7ebe55992577653831b1b",
            measurementId: "G-2NTKV2NYYB"
        };

        const app = initializeApp(firebaseConfig);
        const database = getDatabase(app);

        //Read Charities
        const transaction = ref(database, 'Transaction/');


        onValue(transaction, (snapshot) => {
            //Data
            const data = snapshot.val();

            //List Table
            var listTransaction = $('#listTransaction').DataTable();
            listTransaction.clear().draw();

            for (var key in data) {
                //List Table
                const date = new Date(data[key]['remittedDate']);
                    listTransaction.row.add([
                        data[key]['id'],
                        data[key]['charityID'],
                        data[key]['remittedAmount'],
                        date.toLocaleDateString('en-US')
                    ]).node().id = data[key]['id'];
                    listTransaction.draw(false);

            }
        });

    </script>
@stop
