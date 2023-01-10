@php
    use App\Http\Helpers\FirebaseHelper;
@endphp


@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Manage Transaction')

<!-- Styles -->
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <style>
        .modal-confirm {
            color: #636363;
            width: 400px;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            text-align: center;
            font-size: 14px;
        }

        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }

        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }

        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }

        .modal-confirm .modal-body {
            color: #999;
        }

        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            padding: 10px 15px 25px;
        }

        .modal-confirm .modal-footer a {
            color: #999;
        }

        .modal-confirm .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f15e5e;
        }

        .modal-confirm .icon-box i {
            color: #f15e5e;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }

        .modal-confirm .btn,
        .modal-confirm .btn:active {
            color: #fff;
            border-radius: 4px;
            background: #60c7c1;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            border-radius: 3px;
            margin: 0 5px;
        }

        .modal-confirm .btn-secondary {
            background: #c1c1c1;
        }

        .modal-confirm .btn-secondary:hover,
        .modal-confirm .btn-secondary:focus {
            background: #a8a8a8;
        }

        .modal-confirm .btn-danger {
            background: #f15e5e;
        }

        .modal-confirm .btn-danger:hover,
        .modal-confirm .btn-danger:focus {
            background: #ee3535;
        }

        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }
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


    <div class="row">
        <div class="col">
            <!--Non-Remittable-->
            <div class="card shadow" style="vertical-align: top;">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Non-Remittable</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table table-hover table-bordered pt-3 display" id="tableNonRemittable" style="">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width:30px;">No.</th>
                                    <th>Charity Name</th>
                                    <th style="width:150px;">Current Money</th>
                                </tr>
                            <tbody>
                            </tbody>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <!--Remittable-->
            <div class="card shadow" style="ertical-align: top;">
                <div class="card-header py-3">
                    <div class="row">
                        <h6 class="m-0 font-weight-bold text-primary">Remittable</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table table-hover table-bordered pt-3 display" id="tableRemittable" style="">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width:30px;">No.</th>
                                    <th>Charity Name</th>
                                    <th style="width:150px;">Current Money</th>
                                    <th style="width:50px;">Action</th>
                                </tr>
                            <tbody>
                            </tbody>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!--Remitted-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-0 font-weight-bold text-primary">Remitted</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tableRemitted" style="">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:30px;">No.</th>
                            <th>Charity Name</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    <tbody>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <!--Remittable Modal-->
    <div class="modal fade" id="remitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createTransaction" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="{{ asset('defaultImage.png') }}" alt="..." id="imageProof"
                                class="image img-thumbnail " style="width:500px; height:300px; object-fit: cover;">
                            <button type="button" class="btn btn-success" style="margin-left:50px;">
                                <input class="form-control" type="file" id="formFile" name="photoProof"
                                    onchange="document.getElementById('imageProof').src = window.URL.createObjectURL(this.files[0])"
                                    required>
                            </button>
                        </div>
                        <div class="form-group row mt-5">
                            <div class="form-group row ">
                                <div class="form-group col d-none">
                                    <label class="form-label " for="">Charity ID:</label>
                                    <input type="text" name="charityID" id="charityID" class="form-control item"
                                        readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="form-group col-md-8">
                                    <label class="form-label" for="">Charity Name:</label>
                                    <input type="text" name="charityName" id="charityName" class="form-control item"
                                        readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="">Remitted Amount:</label>
                                    <input type="number" name="remittedAmount" id="remittedAmount"
                                        class="remittedAmount form-control item" min="0" oninput="validity.valid||(value='');" required>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Transaction</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Remitted Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <div class="text-center">
                                <img alt="..." class="viewImage img-thumbnail" id="imageView"
                                    style="width:500px; height:300px; object-fit: cover;">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group row mt-3">
                                <div class="form-group col-md">
                                    <label class="form-label" for="">Charity Name:</label>
                                    <input type="text" name="charityName" class="charityName form-control item"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="">Remitted Amount:</label>
                                    <input type="text" name="remittedAmount"
                                        class="remittedAmount form-control item" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="">Remitted Date:</label>
                                    <input type="text" name="remittedDate" class="remittedDate form-control item"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="form-group col-md">
                                    <label class="form-label" for="">Processed by:</label>
                                    <input type="text" name="adminName" class="adminName form-control item"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop

<!-- Scripts -->
@section('scripts')
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js">
    </script>

    <script>
        //Datatables
        $(document).ready(function() {
            $('table.display').DataTable();
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

        //Read Charity Remitted
        var resultCharities;
        const charity = ref(database, 'Charities/');
        onValue(charity, (snapshot) => {
            const data = snapshot.val();

            resultCharities = data;
        });

        //Read Admin
        var resultAdmins;
        const admin = ref(database, 'Admins/');
        onValue(admin, (snapshot) => {
            const data = snapshot.val();

            resultAdmins = data;
        });

        //Read Charities
        const charities = ref(database, 'Charities/');
        onValue(charities, (snapshot) => {

        //Data
        const data = snapshot.val();

        //Initialize Tables
        var tableRemittable = $('#tableRemittable').DataTable();
        var tableNonRemittable = $('#tableNonRemittable').DataTable();
        tableNonRemittable.clear().draw();
        tableRemittable.clear().draw();

        //Tables
        var i=1, j=1;
        for (var key in data) {

            if(data[key]['charityDetails'] != null && data[key]['transactionDetails'] != null)
            {
                //Check if Current Money of the Charity is less than 10000
                if(data[key]['transactionDetails']['nonRemitted'] < 10000) {
                    tableNonRemittable.row.add([
                    i++,
                    data[key]['charityDetails']['charityName'],
                    'PHP ' + (data[key]['transactionDetails']['nonRemitted']).toLocaleString('en-US')
                    ]).node().id = data[key]['id'];
                    tableNonRemittable.draw(false);
                }
                else {
                    tableRemittable.row.add([
                        j++,
                        data[key]['charityDetails']['charityName'],
                        'PHP ' + (data[key]['transactionDetails']['nonRemitted']).toLocaleString('en-US'),
                        `
                        <button type="button" class="btnRemitModal btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#remitModal">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>
                        `
                    ]).node().id = data[key]['id'];
                    tableRemittable.draw(false);
                }

            }
        }

        //Modals
        $('.btnRemitModal').click(function(){
            var x = $(this).closest('tr').attr('id');

            for(var key in data){
                if (data[key]['id'] == x) {

                    //Assign Values
                    $('#charityID').val(data[key]['id']);
                    $('#charityName').val(data[key]['charityDetails']['charityName']);
                    $('#remittedAmount').val(data[key]['transactionDetails']['nonRemitted']);

                    //ModalAction
                    $('createTransaction').attr('action','transaction/' + data[key]['id']);
                }
            }
        });
    });

    //Read Charities
    const transaction = ref(database, 'Transaction/');
    onValue(transaction, (snapshot) => {

        //Data
        const data = snapshot.val();

        //Initialize Tables
        var tableRemitted = $('#tableRemitted').DataTable();
        tableRemitted.clear().draw();

        //Tables
        var k = 1;

        for (var key in data) {

            for (var keyCharities in resultCharities)
            {
                if(resultCharities[keyCharities]['id'] == data[key]['charityID'])
                {
                    const remitted = new Date(data[key]['remittedDate']);

                    tableRemitted.row.add([
                        k++,
                        resultCharities[keyCharities]['charityDetails']['charityName'],
                        'PHP ' + (data[key]['remittedAmount']).toLocaleString('en-US'),
                        remitted.toLocaleString('en-us'),
                        `
                        <button type="button" class="btnViewModal btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal">
                        <i class="fa-solid fa-eye"></i>
                        </button>
                        `
                    ]).node().id = data[key]['id'];
                    tableRemitted.draw(false);
                }
            }
        }

        //Modals
        $('.btnViewModal').click(function(){
            var x = $(this).closest('tr').attr('id');

            for(var key in data){
                for (var keyCharities in resultCharities)
                {
                    for(var keyAdmins in resultAdmins)
                    {
                        if(resultCharities[keyCharities]['id'] == data[key]['charityID'])
                        {
                            const remitted = new Date(data[key]['remittedDate']);

                            $('.charityName').val(resultCharities[keyCharities]['charityDetails']['charityName']);
                            ($('.remittedAmount').val('PHP ' + data[key]['remittedAmount'])).toLocaleString('en-US');
                            $('.remittedDate').val(remitted.toLocaleString('en-US'));
                            $('.adminName').val(resultAdmins[keyAdmins]['name']);
                            $('.viewImage').text(data[key]['remittedProof']);

                            setImage('View', data[key]['remittedProof']);
                        }
                    }
                }
            }
        });
    });


    </script>
@stop
