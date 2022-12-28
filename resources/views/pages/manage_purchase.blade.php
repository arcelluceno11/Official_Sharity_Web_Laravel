@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Manage Purchase')

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

    <!--Pending Purchases-->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pending Purchases</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tablePending" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>Purchase ID</th>
                            <th>Purchase By</th>
                            <th>Address</th>
                            <th>No. of Products</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!--Accepted Purchases-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Accepted Purchases</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tableAccepted" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>Task No.</th>
                            <th>Purchases ID</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!--In Progress Purchases-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">In Progress Purchases</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tableInProgress" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>Task ID</th>
                            <th>Purchases ID</th>
                            <th>Status</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Complete Purchases -->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Complete Purchases</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tableComplete" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>Task ID</th>
                            <th>Purchase ID</th>
                            <th>Completed</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Pending Purchases Modal -->
    <div class="modal fade" id="pendingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pending Purchase</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row mt-1">
                            <div class="form-group col-md-2">
                                <p><b>Purchase ID:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="orderID"></p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Purchase Created:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p id="orderDate"></p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Purchased By:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="purchasedName"></p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>No. of Products:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p id="noOfProduct"></p>
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
                                <p><b>Total Amount:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p id="totalAmount"></p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Payment Method:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="paymentMethod"></p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Proof of Payment:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p><a id="paymentProof" target="_blank"></a></p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-hover table-bordered pt-3 display" id="tablePendingModal"
                                    style="">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
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

    <!-- Accepted Purchases Modal -->
    <div class="modal fade" id="acceptedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="assignedDriver" method="POST">
                @csrf
                @method('POST')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Assign Driver</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="embed-responsive">
                            <iframe id="acceptedShareUrl"
                                style="height:200px;width:100%;border:none;overflow:hidden;"></iframe>
                        </div>
                        <div class="form-group row mt-1">
                            <div class="form-group col-md-2">
                                <p><b>Purchase ID:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="acceptedOrderID"></p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Purchase Created:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p id="acceptedOrderDate"></p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Purchase By:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="acceptedPurchaseName"></p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>No. of Products:</b></p>
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
                                <p id="acceptedPurchaseAddress">
                                </p>
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
                                    <table class="table table-hover table-bordered pt-3 display" id="tableAcceptedModal"
                                        style="">
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

    <!-- In Progress Purchases Modal -->
    <div class="modal fade" id="inProgressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <p><b>Purchase ID:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="inProgressOrderID"></p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Purchase Created:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p id="inProgressOrderDate"></p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Purchase By:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="inProgressPurchaseName"></p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>No. of Products:</b></p>
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
                                <p id="inProgressPurchaseAdress">
                                </p>
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
                                            <th>ID</th>
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

    <!-- Complete Purchases Modal -->
    <div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive">
                        <iframe id="completeShareUrl"
                            style="height:200px;width:100%;border:none;overflow:hidden;"></iframe>
                    </div>
                    <div class="form-group row mt-1">
                        <div class="form-group col-md-2">
                            <p><b>Purchase ID:</b></p>
                        </div>
                        <div class="form-group col-md-5">
                            <p id="completeOrderID"></p>
                        </div>
                        <div class="form-group col-md-2">
                            <p><b>Purchase Created:</b></p>
                        </div>
                        <div class="form-group col-md-3">
                            <p id="completeOrderDate">
                            </p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="form-group col-md-2">
                            <p><b>Purchase By:</b></p>
                        </div>
                        <div class="form-group col-md-5">
                            <p id="completePurchaseName"></p>
                        </div>
                        <div class="form-group col-md-2">
                            <p><b>No. of Products:</b></p>
                        </div>
                        <div class="form-group col-md-3">
                            <p id="completeNoProducts"></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="form-group col-md-2">
                            <p><b>Address:</b></p>
                        </div>
                        <div class="form-group col-md-5">
                            <p id="completePurchaseAdress">
                            </p>
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
                        <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table id="tableCompleteModal" class="table table-hover table-bordered pt-3 display">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@stop

<!-- Scripts -->
@section('scripts')
    <script type="text/javascript" cphharset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js">
    </script>
    <script>
        $(document).ready(function() {
            //Datatables
            $('table.display').DataTable();
        });
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
            setImage,
            setLink
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
        var tableComplete = $('#tableComplete').DataTable();

        //Read Purchases
        const purchases = ref(database, 'Purchases/');
        onValue(purchases, (snapshot) => {
            //Data
            const data = snapshot.val();

            //Clear Tables
            tablePending.clear().draw();
            tableAccepted.clear().draw();
            tableInProgress.clear().draw();
            tableComplete.clear().draw();

            //Tables
            for (var key in data) {

                //Pending Table
                if (data[key]['status'] == 'Pending') {
                    tablePending.row.add([
                        data[key]['id'],
                        data[key]['contactAddress']['name'],
                        data[key]['contactAddress']['address'],
                        data[key]['noOfProduct'],
                        `<button type="button" class="pendingModal btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#pendingModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                         </button>
                        `
                    ]).node().id = data[key]['id'];
                    tablePending.draw(false);

                    //Show Toast
                    //new bootstrap.Toast($('#toastPending')).show();
                }

                //Accepted Table
                if (data[key]['status'] == 'Accepted') {

                    //Get Request
                    $.ajax({
                        url: 'https://api.teliver.xyz/v1/task/list?apikey=ec7fb302ced044b69063bddaa48fa9c0',
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
                if (data[key]['status'] == 'Assigned' || data[key]['status'] == 'Delivered' || data[key][
                        'status'
                    ] == 'On the Way') {

                    //Get Request
                    $.ajax({
                        url: 'https://api.teliver.xyz/v1/task/list?apikey=ec7fb302ced044b69063bddaa48fa9c0',
                        type: 'GET',
                        dataType: 'json',
                        success: function(responseData) {
                            tableInProgress.clear().draw();
                            for (var task in responseData['data']['task_list']) {
                                if ((responseData['data']['task_list'][task]['status'] ==
                                        'in_progress') ||
                                    (responseData['data']['task_list'][task]['status'] == 'assigned') ||
                                    (responseData['data']['task_list'][task]['status'] == 'completed')) {
                                    for (var key in data) {
                                        if (data[key]['id'] == responseData['data']['task_list'][task][
                                                'order_id'
                                            ] && (data[key]['status'] == 'Assigned' || data[key][
                                                'status'] == 'Delivered' || data[key][
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

                //Complete Table
                if (data[key]['status'] == 'Complete') {

                    //Get Request
                    $.ajax({
                        url: 'https://api.teliver.xyz/v1/task/list?apikey=ec7fb302ced044b69063bddaa48fa9c0',
                        type: 'GET',
                        dataType: 'json',
                        success: function(responseData) {
                            tableComplete.clear().draw();
                            for (var task in responseData['data']['task_list']) {
                                if (responseData['data']['task_list'][task]['status'] == 'completed') {
                                    for (var key in data) {
                                        if (data[key]['id'] == responseData['data']['task_list'][task][
                                                'order_id'
                                            ] && data[key]['status'] == "Complete") {
                                            tableComplete.row.add([
                                                responseData['data']['task_list'][task][
                                                    'task_id'
                                                ],
                                                responseData['data']['task_list'][task][
                                                    'order_id'
                                                ],
                                                responseData['data']['task_list'][task][
                                                    'updated_at'
                                                ],
                                                `<button type="button" class="completeModal btn btn-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#completeModal">
                                                        <i class="fa-sharp fa-solid fa-eye"></i>
                                                    </button>`
                                            ]).node().id = responseData['data']['task_list'][task][
                                                'order_id'
                                            ];
                                            tableComplete.draw(false);
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            }

            //Pending Modal
            $('.pendingModal').click(function() {
                var x = $(this).closest('tr').attr('id');

                for (var key in data) {
                    if (data[key]['id'] == x) {
                        ////Date Format
                        var dateFormat = new Date(data[key]['purchaseAt']);

                        //Assign Values
                        $('#orderID').text(data[key]['id']);
                        $('#orderDate').text(dateFormat.toLocaleDateString() + ' ' + dateFormat
                            .toLocaleTimeString());
                        $('#purchasedName').text(data[key]['contactAddress']['name']);
                        $('#noOfProduct').text(data[key]['noOfProduct']);
                        $('#purchasedAdress').text(data[key]['contactAddress']['address']);
                        $('#totalAmount').text(data[key]['total']);
                        $('#paymentMethod').text(data[key]['modeOfPayment']);
                        $('#totalAmount').text('P ' + data[key]['total']);

                        if (data[key]['paymentProof'] == 'none') {
                            $('#paymentProof').text(data[key]['paymentProof']);
                        } else {
                            setLink('#paymentProof', data[key]['paymentProof']);
                            $('#paymentProof').text('Click Here');
                        }

                        //Products
                        var tablePendingModal = $('#tablePendingModal').DataTable();
                        tablePendingModal.clear().draw();
                        for (var i = 0; i < data[key]['products'].length; i++) {
                            //Item Image
                            setImage(data[key]['products'][i]['id'], data[key]['products'][i]['image']);

                            //Table Row
                            tablePendingModal.row.add([
                                data[key]['products'][i]['id'],
                                '<img id="image' + data[key]['products'][i]['id'] +
                                '" class="img-thumbnail" id="image" style="width:250px; height:300px;">',
                                'P ' + data[key]['products'][i]['price'],
                            ]).node().id = data[key]['products'][i]['id'];
                            tablePendingModal.draw(false);
                        }

                        //Modal Action
                        $('#actionAccept').attr('action', '/purchase/acceptPurchase/' + data[key]['id']);
                        $('#actionReject').attr('action', '/purchase/rejectDonation/' + data[key]['id']);
                    }
                }
            });
            //Accepted Modal
            $(document).on('click', '.acceptedModal', function() {

                var x = $(this).closest('tr').attr('id');

                for (var key in data) {
                    if (data[key]['id'] == x) {
                        ////Date Format
                        var dateFormat = new Date(data[key]['purchaseAt']);

                        //Assign Values
                        $('#acceptedShareUrl').attr('src', data[key]['shareUrl']);
                        $('#acceptedOrderID').text(data[key]['id']);
                        $('#acceptedOrderDate').text(dateFormat.toLocaleDateString() + ' ' + dateFormat
                            .toLocaleTimeString());
                        $('#acceptedPurchaseName').text(data[key]['contactAddress']['name']);
                        $('#acceptedNoItems').text(data[key]['noOfProduct']);
                        $('#acceptedPurchaseAddress').text(data[key]['contactAddress']['address']);

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
                            url: 'https://api.teliver.xyz/v1/task/list?apikey=ec7fb302ced044b69063bddaa48fa9c0',
                            type: 'GET',
                            dataType: 'json',
                            success: function(responseData) {
                                for (var task in responseData['data']['task_list']) {
                                    if (responseData['data']['task_list'][task]['status'] ==
                                        'created' && x == responseData['data']['task_list'][task]['order_id']) {
                                                //Modal Action
                                                $('#assignedDriver').attr('action',
                                                    'purchase/assignDriver/' + responseData[
                                                        'data'][
                                                        'task_list'
                                                    ][task]['task_id']);
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
                        var dateFormat = new Date(data[key]['purchaseAt']);

                        //Assign Values
                        $('#inProgressShareUrl').attr('src', data[key]['shareUrl']);
                        $('#inProgressOrderID').text(data[key]['id']);
                        $('#inProgressOrderDate').text(dateFormat.toLocaleDateString() + ' ' + dateFormat
                            .toLocaleTimeString());
                        $('#inProgressPurchaseName').text(data[key]['contactAddress']['name']);
                        $('#inProgressNoItems').text(data[key]['noOfProduct']);
                        $('#inProgressPurchaseAdress').text(data[key]['contactAddress']['address']);

                        //Initialize Products Table
                        var tableInProgressModal = $('#tableInProgressModal').DataTable();
                        tableInProgressModal.clear().draw();

                        for (var i = 0; i < data[key]['products'].length; i++) {
                            //Item Image
                            setImage(data[key]['products'][i]['id'], data[key]['products'][i][
                                'image'
                            ]);

                            //Table Row
                            tableInProgressModal.row.add([
                                data[key]['products'][i]['id'],
                                '<img id="image' + data[key]['products'][i]['id'] +
                                '" class="img-thumbnail" id="image" style="width:100px; height:100px;">',
                                data[key]['products'][i]['category'],
                                data[key]['products'][i]['sex'],
                                data[key]['products'][i]['color'],
                                data[key]['products'][i]['size'],
                            ]).node().id = data[key]['products'][i]['id'];
                            tableInProgressModal.draw(false);
                        }
                    }
                }
            });
            //Complete Modal
            $(document).on('click', '.completeModal', function() {

                var x = $(this).closest('tr').attr('id');

                for (var key in data) {
                    if (data[key]['id'] == x) {
                        ////Date Format
                        var dateFormat = new Date(data[key]['purchaseAt']);

                        //Assign Values
                        $('#completeShareUrl').attr('src', data[key]['shareUrl']);
                        $('#completeOrderID').text(data[key]['id']);
                        $('#completeOrderDate').text(dateFormat.toLocaleDateString() + ' ' + dateFormat
                            .toLocaleTimeString());
                        $('#completePurchaseName').text(data[key]['contactAddress']['name']);
                        $('#completeNoProducts').text(data[key]['noOfProduct']);
                        $('#completePurchaseAdress').text(data[key]['contactAddress']['address']);

                        //Initialize Table Modal
                        var tableCompleteModal = $('#tableCompleteModal').DataTable();
                        tableCompleteModal.clear().draw();

                        for (var i = 0; i < data[key]['products'].length; i++) {
                            //Item Image
                            setImage(data[key]['products'][i]['id'], data[key]['products'][i][
                                'image'
                            ]);

                            //Table Row
                            tableCompleteModal.row.add([
                                data[key]['products'][i]['id'],
                                '<img id="image' + data[key]['products'][i]['id'] +
                                '" class="img-thumbnail" id="image" style="width:100px; height:100px;">',
                                data[key]['products'][i]['price']
                            ]).node().id = data[key]['products'][i]['id'];
                            tableCompleteModal.draw(false);
                        }
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
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

        });
    </script>
@stop
