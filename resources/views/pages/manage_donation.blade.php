@php
    use App\Http\Helpers\FirebaseHelper;
@endphp

@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Manage Donation')

<!-- Styles -->
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <style>
        table tr:not(:first-child) {
            cursor: pointer;
            transition: all .25s ease-in-out;
        }

        table tr:not(:first-child):hover {
            background-color: #ddd;
        }

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

        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }
    </style>
@stop

<!-- Content -->
@section('content')

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @enderror
    <!--Pending Donations-->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pending Donations</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tablePending" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>Donation ID</th>
                            <th>Donated By</th>
                            <th>Address</th>
                            <th>No. of Items</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    <tbody>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Accepted Donations -->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Accepted Donations</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tableAccepted" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>Task No.</th>
                            <th>Donation ID</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!--In Progress Donations -->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">In Progress Donations</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tableInProgress" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>Task ID</th>
                            <th>Donation ID</th>
                            <th>Status</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!--Received Donations -->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Received</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tableReceived" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>Task ID</th>
                            <th>Donation ID</th>
                            <th>Received</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!--Quality-Checked Donations-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-0 font-weight-bold text-primary">Quality Checked Donation</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>Donation ID</th>
                            <th>Donated By</th>
                            <th>Donated To</th>
                            <th>No. of Items</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks['data']['task_list'] as $task)
                            @if ($task['status'] == 'completed' && $donations != null)
                                @foreach ($donations as $donation)
                                    @if ($donation['id'] == $task['order_id'] && $donation['checked'] == true)
                                        <tr>
                                            <td>{{ $donation['id'] }}</td>
                                            <td>{{ $donation['donatedBy'] }}</td>
                                            <td>{{ $donation['donatedTo'] }}</td>
                                            <td>{{ $donation['noOfItem'] }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pending Donations Modal -->
    <div class="modal fade" id="pendingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <h4 class="modal-title w-100" id="exampleModalLabel">Accept this Donation?</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row mt-1">
                        <div class="form-group col-md-2">
                            <p><b>Donation ID:</b></p>
                        </div>
                        <div class="form-group col-md-5">
                            <p id="orderID"></p>
                        </div>
                        <div class="form-group col-md-2">
                            <p><b>Donation Created:</b></p>
                        </div>
                        <div class="form-group col-md-3">
                            <p id="orderDate"></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="form-group col-md-2">
                            <p><b>Donated By:</b></p>
                        </div>
                        <div class="form-group col-md-5">
                            <p id="purchasedName"></p>
                        </div>
                        <div class="form-group col-md-2">
                            <p><b>No. of Items:</b></p>
                        </div>
                        <div class="form-group col-md-3">
                            <p id="noItems"></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="form-group col-md-2">
                            <p><b>Address:</b></p>
                        </div>
                        <div class="form-group col-md-5">
                            <p id="purchasedAdress"></p>
                        </div>
                        <div class="form-group col-md-2">
                            <p><b>Type:</b></p>
                        </div>
                        <div class="form-group col-md-3">
                            <p id="type"></p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive " id="dataTable" role="grid"
                            aria-describedby="dataTable_info">
                            <table class="table table-hover table-bordered pt-3 display" id="tablePendingModal"
                                style="">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Sex</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-">
                    <form id="actionAccept" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success text-light">Accept</button>
                    </form>
                    <form id="actionReject" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger text-light">Reject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Accepted Donations Modal -->
    <div class="modal fade" id="acceptedModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="assignedDriver" method="POST">
                @csrf
                @method('POST')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Assign Driver</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="embed-responsive">
                            <iframe id="acceptedShareUrl"
                                style="height:200px;width:100%;border:none;overflow:hidden;"></iframe>
                        </div>
                        <div class="form-group row mt-1">
                            <div class="form-group col-md-2">
                                <p><b>Donation ID:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="acceptedOrderID"></p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Donation Created:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p id="acceptedOrderDate"></p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Donated By:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="acceptedDonateName"></p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>No. of Items:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p id="acceptedNoItems"></p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Address:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="acceptedDonateAddress">
                                </p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Type:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p id="acceptedType"></p>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <div class="form-group col-md-2">
                                <p><b>Driver's ID No.:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <input type="text" class="form-control" id="driverID" name="driverID">
                            </div>
                        </div>
                        <div class="card shadow mt-3">
                            <div class="card-body">
                                <div class="table-responsive " id="dataTable" role="grid"
                                    aria-describedby="dataTable_info">
                                    <table class="table table-hover table-bordered pt-3 display"
                                        id="tableAcceptedModal" style="">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnAssign" class="btn btn-primary driver">Assign</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- In Progress Donations Modal -->
    <div class="modal fade" id="inProgressModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inProgressTitle">
                        In Progress
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="embed-responsive">
                            <iframe id="inProgressShareUrl"
                                style="height:200px;width:100%;border:none;overflow:hidden;"></iframe>
                        </div>
                        <div class="form-group row mt-1">
                            <div class="form-group col-md-2">
                                <p><b>Donation ID:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="inProgressOrderID"></p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Donation Created:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p id="inProgressOrderDate"></p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Donated By:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="inProgressDonatedName"></p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>No. of Items:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p id="inProgressNoItems"></p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Address:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="inProgressDonatedAdress">
                                </p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Type:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p id="inProgressType"></p>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <div class="form-group col-md-2">
                                <p><b>Delivery Driver:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="inProgressDriver"></p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive " id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table table-hover table-bordered pt-3 display" id="tableInProgressModal"
                                    style="">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No.</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Sex</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Received Donations Modal-->
    <div class="modal fade" id="receivedModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="receiveAction" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- <form action="donation/qualityCheckedBulk/" method="POST"> -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="embed-responsive">
                            <iframe id="receivedShareUrl"
                                style="height:200px;width:100%;border:none;overflow:hidden;"></iframe>
                        </div>
                        <div class="form-group row mt-1">
                            <div class="form-group col-md-2">
                                <p><b>Donation ID:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="receivedOrderID"></p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Donation Created:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p id="receivedOrderDate">
                                </p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Donated By:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="receivedDonatedName"></p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>No. of Items:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p id="receivedNoItems"></p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Address:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="receivedDonatedAdress">
                                </p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Type:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p id="receivedType"></p>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <div class="form-group col-md-2">
                                <p><b>Delivery Driver:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="receivedDriver"></p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive " id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
                                    <a id="receivedAddItem" class="btn btn-primary">Add Item</a>
                                </div>
                                <table id="tableReceiveModalPiece"
                                    class="table table-hover table-bordered pt-3 display">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No.</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                                <table id="tableReceiveModalBulk"
                                    class="table table-hover table-bordered pt-3 display">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Color</th>
                                            <th>Sex</th>
                                            <th>Size</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary receive">Quality Checked</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Pending Donations Toast -->
    <div class="toast-container">
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toastPending" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Donations</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    A New Donation Order Placed!
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
    <script type="module">
        //Initialize Firebase
        import {
            initializeApp
        } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js';
        import {
            getDatabase,
            ref,
            onValue
        } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-database.js';
        import {
            setImage
        } from './js/firebasehelper.js';
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

        //Initialize Tables
        var tablePending = $('#tablePending').DataTable();
        var tableAccepted = $('#tableAccepted').DataTable();
        var tableInProgress = $('#tableInProgress').DataTable();
        var tableReceived = $('#tableReceived').DataTable();

        //Read Donations
        const donations = ref(database, 'Donations/');
        onValue(donations, (snapshot) => {
            //Data
            const data = snapshot.val();

            //Clear Tables
            tablePending.clear().draw();
            tableAccepted.clear().draw();
            tableInProgress.clear().draw();
            tableReceived.clear().draw();

            //Tables
            for (var key in data) {

                //Pending Table
                if (data[key]['status'] == 'Pending') {
                    tablePending.row.add([
                        data[key]['id'],
                        data[key]['contactAddress']['name'],
                        data[key]['contactAddress']['address'],
                        data[key]['noOfItem'],
                        data[key]['type'],
                        `<button type="button" class="pendingModal btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#pendingModal">
                                                <i class="fa-solid fa-check text-light"></i>
                        </button>
                        `
                    ]).node().id = data[key]['id'];
                    tablePending.draw(false);

                    //Show Toast
                    new bootstrap.Toast($('#toastPending')).show();
                }

                //Accepted Table
                if (data[key]['status'] == 'Accepted') {

                    //Get Request
                    $.ajax({
                        url: 'https://api.teliver.xyz/v1/task/list?apikey=3a9bdbc5f2214fe2b0b60797cb535d07',
                        type: 'GET',
                        dataType: 'json',
                        success: function(responseData) {
                            tableAccepted.clear().draw();
                            for (var task in responseData['data']['task_list']) {
                                if (responseData['data']['task_list'][task]['status'] == 'created') {
                                    for (var key in data) {
                                        if (data[key]['id'] == responseData['data']['task_list'][task][
                                                'order_id'
                                            ]) {
                                            //Modal Action
                                            tableAccepted.row.add([
                                                responseData['data']['task_list'][task][
                                                    'task_id'
                                                ],
                                                responseData['data']['task_list'][task][
                                                    'order_id'
                                                ],
                                                responseData['data']['task_list'][task][
                                                    'updated_at'
                                                ],
                                                `<button type="button" class="acceptedModal btn btn-primary btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#acceptedModal">
                                                            <i class="fa-solid fa-truck"></i>
                                                </button>
                                                `
                                            ]).node().id = responseData['data']['task_list'][task][
                                                'order_id'
                                            ];
                                            tableAccepted.draw(false);
                                        }
                                    }
                                }
                            }
                        }
                    });

                    //Show Toast
                    //new bootstrap.Toast($('#toastPending')).show();
                }

                //In Progress Table
                if (data[key]['status'] == 'Assigned' || data[key]['status'] == 'Picked Up' || data[key][
                        'status'
                    ] == 'On the Way') {

                    //Get Request
                    $.ajax({
                        url: 'https://api.teliver.xyz/v1/task/list?apikey=3a9bdbc5f2214fe2b0b60797cb535d07',
                        type: 'GET',
                        dataType: 'json',
                        success: function(responseData) {
                            tableInProgress.clear().draw();
                            for (var task in responseData['data']['task_list']) {
                                if ((responseData['data']['task_list'][task]['status'] ==
                                        'in_progress') ||
                                    (responseData['data']['task_list'][task]['status'] == 'assigned')) {

                                    for (var key in data) {
                                        if (data[key]['id'] == responseData['data']['task_list'][task][
                                                'order_id'
                                            ] && (data[key]['status'] == 'Assigned' || data[key][
                                                'status'
                                            ] == 'Picked Up' || data[key][
                                                'status'
                                            ] == 'On the Way')) {
                                            tableInProgress.row.add([
                                                responseData['data']['task_list'][task][
                                                    'task_id'
                                                ],
                                                responseData['data']['task_list'][task][
                                                    'order_id'
                                                ],
                                                data[key]['status'],
                                                responseData['data']['task_list'][task][
                                                    'updated_at'
                                                ],
                                                `<button type="button" class="inProgressModal btn btn-primary btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#inProgressModal">
                                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                            </button>
                                        `
                                            ]).node().id = responseData['data']['task_list'][task][
                                                'order_id'
                                            ];
                                            tableInProgress.draw(false);
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

                //Receive Table
                if (data[key]['status'] == 'Complete') {

                    //Get Request
                    $.ajax({
                        url: 'https://api.teliver.xyz/v1/task/list?apikey=3a9bdbc5f2214fe2b0b60797cb535d07',
                        type: 'GET',
                        dataType: 'json',
                        success: function(responseData) {
                            tableReceived.clear().draw();
                            for (var task in responseData['data']['task_list']) {
                                if (responseData['data']['task_list'][task]['status'] == 'completed') {
                                    for (var key in data) {
                                        if (data[key]['id'] == responseData['data']['task_list'][task][
                                                'order_id'
                                            ] && data[key]['checked'] == false && data[key]['status'] == 'Complete') {
                                            tableReceived.row.add([
                                                responseData['data']['task_list'][task][
                                                    'task_id'
                                                ],
                                                responseData['data']['task_list'][task][
                                                    'order_id'
                                                ],
                                                responseData['data']['task_list'][task][
                                                    'updated_at'
                                                ],
                                                `<button type="button" class="receivedModal btn btn-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#receivedModal">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>`
                                            ]).node().id = responseData['data']['task_list'][task][
                                                'order_id'
                                            ];
                                            tableReceived.draw(false);
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

            }

            //Pending Modal
            $(document).on('click', '.pendingModal', function() {
                var x = $(this).closest('tr').attr('id');

                for (var key in data) {
                    if (data[key]['id'] == x) {
                        //Date Format
                        var dateFormat = new Date(data[key]['donatedAt']);

                        //Assign Values
                        $('#orderID').text(data[key]['id']);
                        $('#orderDate').text(dateFormat.toLocaleDateString() + ' ' + dateFormat
                            .toLocaleTimeString());
                        $('#purchasedName').text(data[key]['contactAddress']['name']);
                        $('#noItems').text(data[key]['noOfItem']);
                        $('#purchasedAdress').text(data[key]['contactAddress']['address']);
                        $('#type').text(data[key]['type']);

                        //Item Table
                        if (data[key]['type'] == 'By Piece') {
                            //Initialize Table
                            var tablePendingModal = $('#tablePendingModal').DataTable();
                            tablePendingModal.clear().draw();

                            for (var i = 0; i < data[key]['items'].length; i++) {
                                //Item Image
                                setImage(data[key]['items'][i]['id'], data[key]['items'][i][
                                    'image'
                                ]);

                                //Table Row
                                tablePendingModal.row.add([
                                    data[key]['items'][i]['id'] + 1,
                                    '<img id="image' + data[key]['items'][i]['id'] +
                                    '" class="img-thumbnail" id="image" style="width:100px; height:100px;">',
                                    data[key]['items'][i]['category'],
                                    data[key]['items'][i]['sex'],
                                    data[key]['items'][i]['color'],
                                    data[key]['items'][i]['size'],
                                ]).node().id = data[key]['items'][i]['id'];
                                tablePendingModal.draw(false);
                            }
                        }

                        //Modal Action
                        $('#actionAccept').attr('action', '/donation/acceptDonation/' + data[
                            key]['id']);
                        $('#actionReject').attr('action', '/donation/rejectDonation/' + data[
                            key]['id']);
                    }
                }
            });
            //Accepted Modal
            $(document).on('click', '.acceptedModal', function() {

                var x = $(this).closest('tr').attr('id');

                for (var key in data) {
                    if (data[key]['id'] == x) {
                        ////Date Format
                        var dateFormat = new Date(data[key]['donatedAt']);

                        //Assign Values
                        $('#acceptedShareUrl').attr('src', data[key]['shareUrl']);
                        $('#acceptedOrderID').text(data[key]['id']);
                        $('#acceptedOrderDate').text(dateFormat.toLocaleDateString() + ' ' + dateFormat
                            .toLocaleTimeString());
                        $('#acceptedDonateName').text(data[key]['contactAddress']['name']);
                        $('#acceptedNoItems').text(data[key]['noOfItem']);
                        $('#acceptedDonateAddress').text(data[key]['contactAddress']['address']);
                        $('#acceptedType').text(data[key]['type']);

                        //Driver Table
                        var tableAcceptedModal = $('#tableAcceptedModal').DataTable();

                        const drivers = ref(database, 'Drivers/');
                        onValue(drivers, (snapshot) => {
                            //Data
                            const data = snapshot.val();

                            //Clear Table
                            tableAcceptedModal.clear().draw();

                            for (var key in data) {

                                if (data[key]['status'] == 'Available') {
                                    //Table Row
                                    tableAcceptedModal.row.add([
                                        data[key]['code'],
                                        data[key]['firstName'] + ' ' + data[key]
                                        ['lastName']
                                    ]).node().id = data[key]['code'];
                                    tableAcceptedModal.draw(false);
                                }
                            }

                        });

                        //Get Task ID
                        $.ajax({
                            url: 'https://api.teliver.xyz/v1/task/list?apikey=3a9bdbc5f2214fe2b0b60797cb535d07',
                            type: 'GET',
                            dataType: 'json',
                            success: function(responseData) {
                                for (var task in responseData['data']['task_list']) {
                                    if (responseData['data']['task_list'][task]['status'] ==
                                        'created') {
                                        for (var key in data) {
                                            if (data[key]['id'] == responseData['data'][
                                                    'task_list'
                                                ][task]['order_id']) {
                                                //Modal Action
                                                $('#assignedDriver').attr('action',
                                                    'donation/assignDriver/' + responseData[
                                                        'data'][
                                                        'task_list'
                                                    ][task]['task_id']);
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
                }
            });
            //In Progress Modal
            $(document).on('click', '.inProgressModal', function() {

                var x = $(this).closest('tr').attr('id');

                for (var key in data) {
                    if (data[key]['id'] == x) {
                        ////Date Format
                        var dateFormat = new Date(data[key]['donatedAt']);

                        //Assign Values
                        $('#inProgressShareUrl').attr('src', data[key]['shareUrl']);
                        $('#inProgressOrderID').text(data[key]['id']);
                        $('#inProgressOrderDate').text(dateFormat.toLocaleDateString() + ' ' + dateFormat
                            .toLocaleTimeString());
                        $('#inProgressDonatedName').text(data[key]['contactAddress']['name']);
                        $('#inProgressNoItems').text(data[key]['noOfItem']);
                        $('#inProgressDonatedAdress').text(data[key]['contactAddress']['address']);
                        $('#inProgressType').text(data[key]['type']);

                        //Items Table
                        if (data[key]['type'] == 'By Piece') {
                            //Initialize Table
                            var tableInProgressModal = $('#tableInProgressModal').DataTable();
                            tableInProgressModal.clear().draw();

                            for (var i = 0; i < data[key]['items'].length; i++) {
                                //Item Image
                                setImage(data[key]['items'][i]['id'], data[key]['items'][i][
                                    'image'
                                ]);

                                //Table Row
                                tableInProgressModal.row.add([
                                    parseInt(data[key]['items'][i]['id'], 10) + 1,
                                    '<img id="image' + data[key]['items'][i]['id'] +
                                    '" class="img-thumbnail" id="image" style="width:100px; height:100px;">',
                                    data[key]['items'][i]['category'],
                                    data[key]['items'][i]['sex'],
                                    data[key]['items'][i]['color'],
                                    data[key]['items'][i]['size'],
                                ]).node().id = data[key]['items'][i]['id'];
                                tableInProgressModal.draw(false);
                            }
                        }
                    }
                }
            });
            //Receive Modal
            $(document).on('click', '.receivedModal', function() {

                var x = $(this).closest('tr').attr('id');

                //Initialize Button Quality Checked
                $('button.receive').prop('disabled', true);

                for (var key in data) {
                    if (data[key]['id'] == x) {
                        ////Date Format
                        var dateFormat = new Date(data[key]['donatedAt']);

                        //Assign Values
                        $('#receivedShareUrl').attr('src', data[key]['shareUrl']);
                        $('#receivedOrderID').text(data[key]['id']);
                        $('#receivedOrderDate').text(dateFormat.toLocaleDateString() + ' ' + dateFormat
                            .toLocaleTimeString());
                        $('#receivedDonatedName').text(data[key]['contactAddress']['name']);
                        $('#receivedNoItems').text(data[key]['noOfItem']);
                        $('#receivedDonatedAdress').text(data[key]['contactAddress']['address']);
                        $('#receivedType').text(data[key]['type']);

                        //Items Table
                        if (data[key]['type'] == 'By Piece') {
                            //Initialize Table
                            $('#receivedAddItem').hide();
                            $('#tableReceiveModalBulk').parents('div.dataTables_wrapper').first().hide();
                            $('#tableReceiveModalPiece').parents('div.dataTables_wrapper').first().show();

                            var tableReceiveModalPiece = $('#tableReceiveModalPiece').DataTable();
                            tableReceiveModalPiece.clear().draw();

                            for (var i = 0; i < data[key]['items'].length; i++) {
                                //Item Image
                                setImage(data[key]['items'][i]['id'], data[key]['items'][i][
                                    'image'
                                ]);

                                //Table Row
                                tableReceiveModalPiece.row.add([
                                    parseInt(data[key]['items'][i]['id']) + 1,
                                    '<img id="image' + data[key]['items'][i]['id'] +
                                    '" class="img-thumbnail" id="image" style="width:100px; height:100px;">',
                                    `
                                    <div class="form-check form-check-inline">
                                        <input class="radio form-check-input" type="radio" name="status` + data[key][
                                        'items'
                                    ][i]['id'] + parseInt(i + 1) + `" id="radioStatus" value="Accepted" required>
                                        <label class="form-check-label">Accept</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="radio form-check-input" type="radio" name="status` + data[key][
                                        'items'
                                    ][i]['id'] + parseInt(i + 1) + `" id="radioStatus" value="Rejected" required>
                                        <label class="form-check-label">Reject</label>
                                    </div>
                                    `
                                ]).node().id = data[key]['items'][i]['id'];
                                tableReceiveModalPiece.draw(false);
                            }

                            //Quality Checked Button
                            var num = 1;
                            $("input.radio").each(function() {
                                var name = $(this).attr('name');

                                $('input[name=' + name + ']').click(function() {
                                    if ($("input.radio").length == num) {
                                        $('button.receive').prop('disabled', false);
                                    }
                                    num++;
                                });

                            });

                            //Action
                            $('#receiveAction').attr('action', 'donation/qualityCheckedPiece/' + x);

                        } else {
                            //Initialize Table
                            $('#tableReceiveModalPiece').parents('div.dataTables_wrapper').first().hide();
                            $('#tableReceiveModalBulk').parents('div.dataTables_wrapper').first().show();
                            $('#receivedAddItem').show();

                            var tableReceiveModalBulk = $('#tableReceiveModalBulk').DataTable();
                            tableReceiveModalBulk.clear().draw();

                            var num = 1;
                            $('#receivedAddItem').on('click', function() {
                                $('button.receive').prop('disabled', false);

                                tableReceiveModalBulk.row.add([
                                    `
                                    <div class="text-center">
                                        <img src="{{ asset('image-holder.png') }}" alt="..." class="img-thumbnail rounded-circle"
                                            id="image` + num + `" style="width:150px; height:150px;">
                                        <button type="button" class="btn btn-success">
                                            <input class="form-control" type="file" id="formFile" name="photo` + num + `"
                                                onchange="document.getElementById('image` + num + `').src = window.URL.createObjectURL(this.files[0])" required>
                                        </button>
                                    </div>
                                    `,
                                    `<select class="form-select form-select" name="category` +
                                    num + `" required>
                                        <option disabled selected value="">Choose Category</option>
                                        <option value="Jacket and Hoodies">Jacket and Hoodies</option>
                                        <option value="Shirts and Blouses">Shirts and Blouses</option>
                                        <option value="Pants and Jeans">Pants and Jeans</option>
                                    </select>`,
                                    `<select class="form-select form-select" name="color` +
                                    num + `" required>
                                        <option disabled selected value="">Choose Color</option>
                                        <option value="White">White</option>
                                        <option value="Black">Black</option>
                                        <option value="Red">Red</option>
                                        <option value="Orange">Orange</option>
                                        <option value="Yellow">Yellow</option>
                                        <option value="Green">Green</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Violet">Violet</option>
                                    </select>`,
                                    `<select class="form-select form-select" name="sex` +
                                    num + `" required>
                                        <option disabled selected value="">Choose Sex</option>
                                        <option value="Men">Men</option>
                                        <option value="Women">Women</option>
                                        <option value="Unisex">Unisex</option>
                                    </select>`,
                                    `<select class="form-select form-select" name="size` +
                                    num + `" required>
                                        <option disabled selected value="">Choose Size</option>
                                        <option value="Extra Small">Extra Small</option>
                                        <option value="Small">Small</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Large">Large</option>
                                        <option value="Extra Large">Extra Large</option>
                                        <option value="Double Extra Large">Double Extra Large</option>
                                    </select>`,
                                    `
                                    <button type="button" class="delete btn btn-danger btn-sm">
                                            <i class="fa-solid fa-square-xmark"></i>
                                    </button>
                                    `
                                ]).draw(false);

                                num++;
                            });


                            $('#tableReceiveModalBulk tbody').on('click', 'button.delete', function() {
                                tableReceiveModalBulk.row($(this).parents('tr')).remove().draw();

                                if (tableReceiveModalBulk.data().rows().count() == 0) {
                                    $('button.receive').prop('disabled', true);
                                }
                            });

                            //Action
                            $('#receiveAction').attr('action', 'donation/qualityCheckedBulk/' + x);
                        }
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            //Datatables
            $('table.display').DataTable();

            //Driver Assignment
            $('button.driver').prop('disabled', true);
            $('#tableAcceptedModal').on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    $('button.driver').prop('disabled', true);
                    $('#driverID').val('');
                } else {
                    $('table.driver tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $('button.driver').prop('disabled', false);
                    $('#driverID').val($(this).closest('tr').attr('id'));
                }
            });

            //Received Donations
            //Bulk
            var bulk = $('#tableModalReceiveBulk').DataTable();

        });
    </script>
@stop
