@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Manage Donor')

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

    <!--Data Table-->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manage Donor/Shopper Accounts</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tableDonorShopper" style="">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:100px;">ID</th>
                            <th>Email Address</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    <tbody>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!--Modal-->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="{{ asset('profile.JPG') }}" alt="..." class="img-thumbnail rounded-circle"
                            id="image" style="width:auto; height:200px;">
                    </div>
                    <div class="form-group row mt-5">

                        <div class="form-group col-md-4">
                            <label class="form-label" for="">First Name:</label>
                            <input type="text" name="firstName" id="firstName" class="form-control item" disabled
                                readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="">Last Name:</label>
                            <input type="text" name="lastName" id="lastName" class="form-control item" disabled
                                readonly>
                        </div>
                        <div class="form-group col-md-4 ">
                            <label for="inputSex">Sex</label>
                            <input type="text" name="sex" id="sex" class="form-control item mt-2" disabled
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <div class="form-group col-md-5">
                            <label class="form-label" for="">Email Address:</label>
                            <input type="text" name="email" id="email" class="form-control item" disabled readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="">Contact Number:</label>
                            <input type="tel" name="phone" id="phone" class="form-control item" disabled readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="">Date of Birth:</label>
                            <input type="text" name="dob" id="dob" class="form-control item" disabled readonly>
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <div class="form-group col-md-3">
                            <label class="form-label" for="">Status:</label>
                            <input type="text" name="status" id="status" class="form-control item" disabled readonly>
                        </div>
                    </div>
                </div>

                <!--Data Table - Contact Address-->
                <div class="card-body">
                    <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table table-hover table-bordered pt-3 display" id="tableDonorShopperModal"
                            style="">
                            <thead class="thead-light">
                                <tr>
                                    <th>No.</th>
                                    <th>Address</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--Toast-->
    <div class="toast-container">
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toastDonorShopper" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Donors and Shoppers</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    The Donor/Shopper Table was refreshed!
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

    //Read DonorShopper
    const donors = ref(database, 'User/DonorShopper/');
    onValue(donors, (snapshot) => {
        //Data
        const data = snapshot.val();

        //Initialize Tables
        var tableDonorShopper = $('#tableDonorShopper').DataTable();
        tableDonorShopper.clear().draw();

        //Tables
        for (var key in data) {

            tableDonorShopper.row.add([
                data[key]['id'],
                data[key]['email'],
                data[key]['firstName'],
                data[key]['lastName'],
                data[key]['status'],
                `
                <button type="button" class="btnDonorShopperModal btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal">
                    <i class="fa-solid fa-eye"></i>
                </button>
                `
            ]).node().id = data[key]['id'];
            tableDonorShopper.draw(false);

            //Show Toast
            new bootstrap.Toast($('#toastDonorShopper')).show();
        }

        //Modals
        $('.btnDonorShopperModal').click(function(){
            var x = $(this).closest('tr').attr('id');

            for(var key in data){
                if (data[key]['id'] == x) {

                    //Assign Values
                    $('#firstName').val(data[key]['firstName']);
                    $('#lastName').val(data[key]['lastName']);
                    $('#sex').val(data[key]['sex']);
                    $('#email').val(data[key]['email']);
                    $('#phone').val(data[key]['phone']);
                    $('#dob').val(data[key]['dob']);
                    $('#sex').val(data[key]['sex']);
                    $('#status').val(data[key]['status']);

                    const addresses = ref(database, 'ContactAddresses/');
                    onValue(addresses, (snapshot) => {

                        //Data
                        const dataAddress = snapshot.val();

                        var tableDonorShopperModal = $('#tableDonorShopperModal').DataTable();
                        tableDonorShopperModal.clear().draw();
                        var i = 1;

                        for(var key in dataAddress)
                        {
                            if(dataAddress[key]['ownerID'] == x){
                                tableDonorShopperModal.row.add([
                                    i++,
                                    dataAddress[key]['address'],
                                    dataAddress[key]['name'],
                                    dataAddress[key]['phone']
                                ]).node().id = dataAddress[key]['ownerID'];
                                tableDonorShopperModal.draw(false);
                            }
                        }
                    })


                }
            }
        })
    });


    </script>
@stop
