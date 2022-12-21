@php
    use App\Http\Helpers\FirebaseHelper;
@endphp


@extends('layouts.index')

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

    @if ($errors->any())
        <div class="alert alert-warning" role="alert">
            {{ $errors->first() }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @enderror

    <!--Reviews-->
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="row">
                <div class="col align-self-center">
                    <h6 class="m-0 font-weight-bold text-primary">List of Reviews</h6>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tableReviews" style="">

                    <thead class="thead-light">
                        <tr>
                            <th>ID.</th>
                            <th>Purchase ID</th>
                            <th>Comment</th>
                            <th>Rate</th>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
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

    <!--Export-->
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

        //Read Reviews
        const reviews = ref(database, 'Reviews/Purchases');
        onValue(reviews, (snapshot) => {

        //Data
        const data = snapshot.val();

        //Initialize Tables
        var tableReviews = $('#tableReviews').DataTable();
        tableReviews.clear().draw();

        //Tables
        for (var key in data) {
            tableReviews.row.add([
                data[key]['id'],
                data[key]['purchaseID'],
                data[key]['comment'],
                data[key]['rate']
            ]).node().id = data[key]['id'];
            tableReviews.draw(false);

        }
    });
    </script>
@stop
