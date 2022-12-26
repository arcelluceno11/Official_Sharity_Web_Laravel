@php
    use App\Http\Helpers\FirebaseHelper;
@endphp

@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Manage Product')

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
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @enderror

    <!--Pending Products-->
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="row">
                <div class="col align-self-center">
                    <h6 class="m-0 font-weight-bold text-primary">Pending Products</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tablePending" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>ID Number</th>
                            <th>Donated By:</th>
                            <th>Donated To:</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pending Product Toast -->
    <div class="toast-container">
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toastPendingProduct" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Products</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    A New Pending Product!
                </div>
            </div>
        </div>
    </div>

    <!--Listed Products-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listed Products</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tableListed" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>ID Number</th>
                            <th>Category</th>
                            <th>Donated By:</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Sold Products-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sold Products</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tableSold" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>ID Number</th>
                            <th>Category</th>
                            <th>Donated By:</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Edit Pending Products Modal-->
    <div class="modal fade" id="editPending" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="pendingProduct" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group row mt-3">
                            <div class="text-center">
                                <img alt="..." class="img-thumbnail" id="imagePendingView"
                                    style="width:200px; height:200px;">
                                <button type="button" class="btn btn-success">
                                    <input class="pendingImage form-control" type="file" id="pendingImage"
                                        name="image"
                                        onchange="document.getElementById('imagePendingView').src = window.URL.createObjectURL(this.files[0])">
                                </button>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="">ID No:</label>
                                    <input type="text" name="id" class="pendingID form-control item"
                                        id="pendingID" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="">Donated by:</label>
                                    <input type="text" name="donatedby" class="form-control item"
                                        id="pendingDonatedBy" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="">Donated to:</label>
                                    <input type="text" name="donatedTo" class="form-control item"
                                        id="pendingDonatedTo" readonly>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="form-group col-md-3">
                                    <label for="">Category</label>
                                    <select class="form-select" aria-label="Default select example" name="category" id="pendingCategory" required>
                                        <option value="Jacket and Hoodies">Jacket and Hoodies</option>
                                        <option value="Shirts and Blouses">Shirts and Blouses</option>
                                        <option value="Bottom Apparel">Bottom Apparel</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Color</label>
                                    <select class="form-select" aria-label="Default select example" name="color" id="pendingColor" required>
                                        <option value="White">White</option>
                                        <option value="Black">Black</option>
                                        <option value="Red">Red</option>
                                        <option value="Orange">Orange</option>
                                        <option value="Yellow">Yellow</option>
                                        <option value="Green">Green</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Violet">Violet</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Sex</label>
                                    <select class="form-select" aria-label="Default select example" name="sex" id="pendingSex" required>
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                        <option value="Unisex">Unisex</option>
                                    </select>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Size</label>
                                    <select class="form-select" aria-label="Default select example" name="size" id="pendingSize" required>
                                        <option value="Extra Small">Extra Small</option>
                                        <option value="Small">Small</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Large">Large</option>
                                        <option value="Extra Large">Extra Large</option>
                                        <option value="Double Extra Large">Double Extra Large</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mt-3 mb-5">
                                <div class="form-group col-md-3">
                                    <label class="form-label" for="">Price</label>
                                    <input type="text" class="form-control" name="price" id="pendingPrice"
                                        aria-describedby="helpId" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-label" for="">Status:</label>
                                    <input type="text" class="form-control" name="status" id="pendingStatus"
                                        aria-describedby="helpId" readonly>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-target="#editWholeModal"
                                    data-bs-toggle="modal">Back</button>
                                <button type="submit" class="btn btn-primary">Listed</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--View Products Modal-->
    <div class="modal fade" id="viewModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="viewID modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="">
                    <div class="modal-body">
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-3 text-center">
                                <div class="col">
                                    <img alt="..." class="viewImage img-thumbnail" id="imageView"
                                        style="width:auto; height:300px;">
                                </div>
                            </div>
                            <div class="form-group col-md-9">
                                <div class="form-group row mt-3">
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">ID No:</label>
                                        <p class="viewID"></p>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Donated by:</label>
                                        <p id="viewdonatedBy"></p>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Donated to:</label>
                                        <p id="viewdonatedTo"></p>
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="form-group col-md-3">
                                        <label for="">Category</label>
                                        <p id="viewcategory"></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="i">Color</label>
                                        <p id="viewcolor"></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Sex</label>
                                        <p id="viewsex"></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Size</label>
                                        <p id="viewsize"></p>
                                    </div>
                                </div>
                                <div class="form-group row mt-3 mb-5">
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="">Price</label>
                                        <p id="viewPrice"></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="">Status:</label>
                                        <p id="viewstatus"></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="">Listed At:</label>
                                        <p id="viewlistedAt"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-target="#editWholeModal"
                            data-bs-toggle="modal">Back</button>
                    </div>
                </form>
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

        //Read Products
        const products = ref(database, 'Products/');

        //Get Charity data
        var resultCharities;
        const charity = ref(database, 'Charities/');
        onValue(charity, (snapshot) => {
            const data = snapshot.val();

            resultCharities = data;
        });

        //Get Charity data
        var resultDonors;
        const donors = ref(database, 'User/DonorShopper/');
        onValue(donors, (snapshot) => {
            const data = snapshot.val();

            resultDonors = data;
        });

        onValue(products, (snapshot) => {
            //Data
            const data = snapshot.val();

            //Pending Table
            var tablePending = $('#tablePending').DataTable();
            tablePending.clear().draw();

            for (var key in data) {
                for (var keyCharities in resultCharities){
                    for (var keyDonors in resultDonors){
                        if(data[key]['status'] == 'Pending' && resultCharities[keyCharities]['id'] == data[key]['donatedTo'] &&  resultDonors[keyDonors]['id'] == data[key]['donatedBy']){

                        tablePending.row.add([
                            data[key]['id'],
                            resultDonors[keyDonors]['firstName']+' '+resultDonors[keyDonors]['lastName'],
                            resultCharities[keyCharities]['charityDetails']['charityName'],
                            `<button type="button" class="btnEditPending btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editPending">
                                <i class="fa-regular fa-pen-to-square"></i></button>`
                        ]).node().id = data[key]['id'];
                        tablePending.draw(false);

                        //Show Pending Toast
                        new bootstrap.Toast($('#toastPendingProduct')).show();
                        }

                    }
                }
            }
            //Pending Modal
            $('.btnEditPending').click(function(){
                var x = $(this).closest('tr').attr('id');
                for (var key in data) {
                    for (var keyDonors in resultDonors){
                        for (var keyCharities in resultCharities){
                            if(data[key]['id'] == x && resultCharities[keyCharities]['id'] == data[key]['donatedTo'] &&  resultDonors[keyDonors]['id'] == data[key]['donatedBy']){

                                //Assign Values
                                $('.pendingID').val(data[key]['id']);
                                $('#pendingDonatedBy').val(resultDonors[keyDonors]['firstName']+' '+resultDonors[keyDonors]['lastName']);
                                $('#pendingDonatedTo').val(resultCharities[keyCharities]['charityDetails']['charityName']);
                                $('#pendingCategory').val(data[key]['category']);
                                $('#pendingSize').val(data[key]['size']);
                                $('#pendingColor').val(data[key]['color']);
                                $('#pendingSex').val(data[key]['sex']);
                                $('#pendingPrice').val(data[key]['price']);
                                $('#pendingStatus').val(data[key]['status']);

                                setImage('PendingView', data[key]['image']);

                                //Modal Action
                                $('#pendingProduct').attr('action', 'product/' + data[key]['id']);
                            }

                        }
                    }
                }
            });

            //Initialize Tables
            var tableListed = $('#tableListed').DataTable();
            tableListed.clear().draw();
            //Tables
            for (var key in data) {
                for (var keyCharities in resultCharities){
                    for (var keyDonors in resultDonors){
                        if(data[key]['status'] == 'Listed' && resultCharities[keyCharities]['id'] == data[key]['donatedTo'] &&  resultDonors[keyDonors]['id'] == data[key]['donatedBy']){
                            tableListed.row.add([
                                data[key]['id'],
                                resultDonors[keyDonors]['firstName']+' '+resultDonors[keyDonors]['lastName'],
                                resultCharities[keyCharities]['charityDetails']['charityName'],
                                data[key]['price'],
                                `<button type="button" class="btnViewModal btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewModal">
                                    <i class="fa-regular fa-eye"></i></button>`
                            ]).node().id = data[key]['id'];
                            tableListed.draw(false);
                        }
                    }
                }
            }

            //Initialize Tables
            var tableSold = $('#tableSold').DataTable();
            tableSold.clear().draw();
            //Tables
            for (var key in data) {
                for (var keyCharities in resultCharities){
                    for (var keyDonors in resultDonors){
                        if(data[key]['status'] == 'Sold' && resultCharities[keyCharities]['id'] == data[key]['donatedTo'] &&  resultDonors[keyDonors]['id'] == data[key]['donatedBy']){
                            tableSold.row.add([
                                data[key]['id'],
                                data[key]['category'],
                                resultDonors[keyDonors]['firstName']+' '+resultDonors[keyDonors]['lastName'],
                                data[key]['price'],
                                `<button type="button" class="btnViewModal btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewModal">
                                    <i class="fa-regular fa fa-eye"></i></button>`
                            ]).node().id = data[key]['id'];
                            tableSold.draw(false);
                        }
                    }
                }
            }

            //View Products Listed and Sold Modal
            $('.btnViewModal').click(function(){
                var x = $(this).closest('tr').attr('id');
                for (var key in data) {
                    for (var keyDonors in resultDonors){
                        for (var keyCharities in resultCharities){
                            if(data[key]['id'] == x && resultCharities[keyCharities]['id'] == data[key]['donatedTo'] &&  resultDonors[keyDonors]['id'] == data[key]['donatedBy']){

                                const listed = new Date(data[key]['listedAt']);
                                //Assign Values
                                $('.viewID').text(data[key]['id']);
                                $('#viewdonatedBy').text(resultDonors[keyDonors]['firstName']+' '+resultDonors[keyDonors]['lastName']);
                                $('#viewdonatedTo').text(resultCharities[keyCharities]['charityDetails']['charityName']);
                                $('#viewcategory').text(data[key]['category']);
                                $('#viewcolor').text(data[key]['color']);
                                $('#viewsize').text(data[key]['size']);
                                $('#viewsex').text(data[key]['sex']);
                                $('#viewPrice').text(data[key]['price']);
                                $('#viewstatus').text(data[key]['status']);
                                $('#viewlistedAt').text(listed.toLocaleDateString('en-US'));
                                $('#viewimage').text(data[key]['image']);

                                setImage('View', data[key]['image']);
                            }
                        }

                    }
                }
            });
        });

    </script>
@stop
