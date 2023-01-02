@php
    use App\Http\Helpers\FirebaseHelper;
@endphp

@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Manage Charity')

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
            Failed: Email already taken.
        </div>
    @enderror
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @enderror

    <!--Pending Applications-->
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="row">
                <div class="col align-self-center">
                    <h6 class="m-0 font-weight-bold text-primary">Pending Charity Applications</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tablePending" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Contact Name</th>
                            <th>Number</th>
                            <th>Email</th>
                            <th>Appointment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Appointments Today-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <div class="row">
                <div class="col align-self-center">
                    <h6 class="m-0 font-weight-bold text-primary">Appointments Today</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tableAppointment" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Contact Name</th>
                            <th>Number</th>
                            <th>Email</th>
                            <th>Appointment Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Listed Charity-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <div class="row">
                <div class="col align-self-center">
                    <h6 class="m-0 font-weight-bold text-primary">Listed Charity</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="tableListed" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Charity Name</th>
                            <th>Category</th>
                            <th>Account Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Edit Appointed Charity-->
    <div class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCharity" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group row mt-3">
                            <div class="text-center">
                                <img src="{{ asset('profile.JPG') }}" alt="..."
                                    class="img-thumbnail rounded-circle" id="charityPhoto"
                                    style="width:auto; height:200px;">
                                <button type="button" class="btn btn-success" style="margin-left:50px;">
                                    <input class="form-control" type="file" id="formFile" name="charityPhoto"
                                        onchange="document.getElementById('charityPhoto').src = window.URL.createObjectURL(this.files[0])" required>
                                </button>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <h5>Charity Details</h5>
                            <div class="form-group col">
                                <label class="form-label" for="">Charity Name</label>
                                <input type="text" name="charityName" class="form-control item" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="">Description</label>
                                <input type="text" name="charityDescription" class="form-control item" required>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label for="inputCategory">Category</label>
                                <select class="form-select mt-2" aria-label="Default select example"
                                    name="charityCategory" required>
                                    <option value="">Choose Category...</option>
                                    <option value="Animals">Animals</option>
                                    <option value="Arts and Culture">Arts and Culture</option>
                                    <option value="Community Development">Community Development</option>
                                    <option value="Education">Education</option>
                                    <option value="Environmental">Environmental</option>
                                    <option value="Health">Health</option>
                                    <option value="Human">Human</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Established Date:</label>
                                <input type="date" name="charityEst" class="form-control item" required>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="formFile">Documents:</label>
                                    <input class="form-control" type="file" id="formFile"
                                        name="charityDocuments"
                                        onchange="document.getElementById('charityDocuments').src = window.URL.createObjectURL(this.files[0])"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" id="inputAddress" name="charityAddress"
                                    required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mt-3">
                            <h5>Bank Details</h5>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Bank Number:</label>
                                <input type="number" name="bankNumber" class="form-control item" maxlength="12"
                                    required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputBankName">Bank Name</label>
                                <select class="form-select mt-2" aria-label="Default select example" name="bankName"
                                    required>
                                    <option value="">Choose...</option>
                                    <option value="Banco de Oro Inc">Banco de Oro Inc. (BDO)</option>
                                    <option value="Union Bank">UnionBank</option>
                                    <option value="RCBC">RCBC</option>
                                    <option value="Landbank Philippines">Landbank Philippines</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Bank Account Name:</label>
                                <input type="text" name="bankAccountName" class="form-control item" required>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Bank Phone Number:</label>
                                <input type="text" name="bankPhone" class="form-control item" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Bank Email:</label>
                                <input type="email" name="bankEmail" class="form-control item" required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mt-3">
                            <h5>Account Details</h5>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Account Email:</label>
                                <input type="email" name="accountEmail" class="form-control item" required>
                                @error('emailExist')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <h5>Application Details</h5>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Name:</label>
                                <input type="text" name="applicationName" class="form-control item"
                                    id="editapplicationName" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Phone number:</label>
                                <input type="text" name="applicationPhone" class="form-control item"
                                    id="editapplicationPhone" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Email:</label>
                                <input type="email" name="applicationEmail" class="form-control item"
                                    id="editapplicationEmail" readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Application Date:</label>
                                <input type="text" name="applicationDate" class="form-control item"
                                    id="editapplicationDate" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Status:</label>
                                <input type="text" name="status" class="form-control item" id="editstatus"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-target="#editWholeModal"
                            data-bs-toggle="modal">Back</button>
                        <button type="submit" class="btn btn-primary">Listed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reschedule Modal-->
    <div class="modal fade" id="reschedModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="reschedCharity" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Contact Person:</label>
                                <input type="text" name="applicationName" class="form-control item"
                                    id="reschedapplicationName" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Phone number:</label>
                                <input type="text" name="applicationPhone" class="form-control item"
                                    id="reschedapplicationPhone" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Email Address:</label>
                                <input type="email" name="applicationEmail" class="form-control item"
                                    id="reschedapplicationEmail" readonly>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Appointment Date:</label>
                                <input type="text" name="" class="form-control item"
                                    id="reschedapplicationDate" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">New Appointment Date:</label>
                                <input type="date" name="applicationDate" id="date"
                                    class="form-control item">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-target="#editWholeModal"
                            data-bs-toggle="modal">Back</button>
                        <button type="submit" class="btn btn-primary">Reschedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Manage Listed Charity-->
    <div class="modal fade" id="editListedModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="listedCharity" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('POST')
                        <div class="text-center">
                            <img alt="..." class="img-thumbnail rounded-circle" id="imagelisted"
                                style="width:300px; height:200px;">
                        </div>
                        <div class="form-group row mt-3">
                            <h5>Charity Details</h5>
                            <div class="form-group col">
                                <label class="form-label" for="">Charity Name</label>
                                <input type="text" name="charityName" class="form-control item"
                                    id="listedcharityName">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="">Description</label>
                                <input type="text" name="charityDescription" class="form-control item"
                                    id="listedcharityDescription">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-3">
                                <label for="inputCategory">Category</label>
                                <input type="text" name="charityCategory" class="form-control item"
                                    id="listedcharityCategory" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="">Established Date:</label>
                                <input type="text" name="charityEst" class="form-control item"
                                    id="listedcharityEst" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="inputAddress">Address</label>
                                <input type="text" name="charityAddress" class="form-control item"
                                    id="listedcharityAddress" readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mt-3">
                            <h5>Bank Details</h5>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Bank Name:</label>
                                <input type="text" name="bankName" class="form-control item"
                                    id="listedbankName" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Bank Number:</label>
                                <input type="number" name="bankNumber" class="form-control item"
                                    id="listedbankNumber" maxlength="12" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Account Name:</label>
                                <input type="text" name="bankAccountName" class="form-control item"
                                    id="listedbankAccountName" readonly>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Bank Phone Number:</label>
                                <input type="text" name="bankPhone" class="form-control item"
                                    id="listedbankPhone" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Bank Email:</label>
                                <input type="text" name="bankEmail" class="form-control item"
                                    id="listedbankEmail" readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mt-3">
                            <h5>Account Details:</h5>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Email Address:</label>
                                <input type="email" name="accountEmail" class="form-control item"
                                    id="listedaccountEmail" readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Registration Date:</label>
                                <input type="text" name="listedAt" class="form-control item" id="listedAt"
                                    readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Status:</label>
                                <select class="form-select" aria-label="Default select example" name="status"
                                    id="listedstatus" required>
                                    <option value="Listed">Listed</option>
                                    <option value="Disabled">Disabled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-target="#editWholeModal"
                            data-bs-toggle="modal">Back</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Remove Charity-->
    <div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-confirm modal-dialog-centered">
            <div class="modal-content">
                <form id="removeCharity" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header flex-column">
                        <div class="icon-box">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <h4 class="modal-title w-100" id="exampleModalLabel">Are you sure?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Do you really want to remove this Application? </p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
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
        const charities = ref(database, 'Charities/');
        onValue(charities, (snapshot) => {
            //Data
            const data = snapshot.val();

            //Pending Table
            var tablePending = $('#tablePending').DataTable();
            tablePending.clear().draw();
            //Tables
            for (var key in data) {
                const appt = new Date(data[key]['applicationDetails']['applicationDate']);
                const datetoday = new Date();
                //Pending Table
                if(data[key]['status'] == 'Pending' && appt.toLocaleDateString('en-US') != datetoday.toLocaleDateString('en-US') ){
                    tablePending.row.add([
                        data[key]['id'],
                        data[key]['applicationDetails']['applicationName'],
                        data[key]['applicationDetails']['applicationPhone'],
                        data[key]['applicationDetails']['applicationEmail'],
                        appt.toLocaleDateString('en-US'),
                    ]).node().id = data[key]['id'];
                    tablePending.draw(false);
                }
            }

            //Appointment Table
            var tableAppointment = $('#tableAppointment').DataTable();
            tableAppointment.clear().draw();
            //Tables
            for (var key in data) {
                const appt = new Date(data[key]['applicationDetails']['applicationDate']);
                const datetoday = new Date();
                //Pending Table
                if(data[key]['status'] == 'Pending' && appt.toLocaleDateString('en-US') == datetoday.toLocaleDateString('en-US')){
                    tableAppointment.row.add([
                        data[key]['id'],
                        data[key]['applicationDetails']['applicationName'],
                        data[key]['applicationDetails']['applicationPhone'],
                        data[key]['applicationDetails']['applicationEmail'],
                        appt.toLocaleDateString('en-US'),
                        `<button type="button" class="btnEditModal btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" class="btnReschedModal btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#reschedModal">
                                                <i class="fa-solid fa-calendar"></i>
                                            </button>
                                            <button type="button" class="btnRemoveModal btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#removeModal">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>`

                    ]).node().id = data[key]['id'];
                    tableAppointment.draw(false);
                }
            }

            $('.btnEditModal').click(function(){
                var x = $(this).closest('tr').attr('id');
                for (var key in data) {
                    if(data[key]['id'] == x){

                        const listed = new Date(data[key]['applicationDetails']['applicationDate']);
                        //Assign Values
                        $('#editapplicationName').val(data[key]['applicationDetails']['applicationName']);
                        $('#editapplicationEmail').val(data[key]['applicationDetails']['applicationEmail']);
                        $('#editapplicationPhone').val(data[key]['applicationDetails']['applicationPhone']);
                        $('#editapplicationDate').val(listed.toLocaleDateString('en-US'));
                        $('#editstatus').val(data[key]['status']);
                        //Modal Action
                        $('#editCharity').attr('action', 'charity/' + data[key]['id']);
                    }
                }
            });

            //New Appointment Modal
            $('.btnReschedModal').click(function(){
                var x = $(this).closest('tr').attr('id');
                for (var key in data) {
                    if(data[key]['id'] == x){

                        const listed = new Date(data[key]['applicationDetails']['applicationDate']);
                        //Assign Values
                        $('#reschedapplicationName').val(data[key]['applicationDetails']['applicationName']);
                        $('#reschedapplicationEmail').val(data[key]['applicationDetails']['applicationEmail']);
                        $('#reschedapplicationPhone').val(data[key]['applicationDetails']['applicationPhone']);
                        $('#reschedapplicationDate').val(listed.toLocaleDateString('en-US'));
                        //Modal Action
                        $('#reschedCharity').attr('action', 'charity/editApptDate/' + data[key]['id']);
                    }
                }
            });

            //Remove Modal
            $('.btnRemoveModal').click(function(){
                var x = $(this).closest('tr').attr('id');
                for (var key in data) {
                    if(data[key]['id'] == x){

                        $('#removeCharity').attr('action', 'charity/' + data[key]['id']);
                    }
                }
            });

            //Listed Table
            var tableListed = $('#tableListed').DataTable();
            tableListed.clear().draw();
            //Tables
            for (var key in data) {
                if(data[key]['status'] == 'Listed'){
                    tableListed.row.add([
                        data[key]['id'],
                        data[key]['charityDetails']['charityName'],
                        data[key]['charityDetails']['charityCategory'],
                        data[key]['accountDetails']['accountEmail'],
                        `<button type="button" class="btnListedModal btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editListedModal">
                            <i class="fa-regular fa-pen-to-square"></i></button>`
                    ]).node().id = data[key]['id'];
                    tableListed.draw(false);
                }
            }
            $('.btnListedModal').click(function(){
                var x = $(this).closest('tr').attr('id');
                for (var key in data) {
                    if(data[key]['id'] == x){

                        const listed = new Date(data[key]['listedAt']);
                        //Assign Values
                        //Charity Details
                        $('.listedID').val(data[key]['id']);
                        setImage('listed', data[key]['charityDetails']['charityPhoto']);
                        $('#listedcharityName').val(data[key]['charityDetails']['charityName']);
                        $('#listedcharityDescription').val(data[key]['charityDetails']['charityDescription']);
                        $('#listedcharityCategory').val(data[key]['charityDetails']['charityCategory']);
                        $('#listedcharityEst').val(data[key]['charityDetails']['charityEst']);
                        $('#listedcharityAddress').val(data[key]['charityDetails']['charityAddress']);
                        //Bank Details
                        $('#listedbankName').val(data[key]['bankDetails']['bankName']);
                        $('#listedbankNumber').val(data[key]['bankDetails']['bankNumber']);
                        $('#listedbankAccountName').val(data[key]['bankDetails']['bankAccountName']);
                        $('#listedbankEmail').val(data[key]['bankDetails']['bankEmail']);
                        $('#listedbankPhone').val(data[key]['bankDetails']['bankPhone']);
                        //Account Details
                        $('#listedaccountEmail').val(data[key]['accountDetails']['accountEmail']);
                        //Status
                        $('#listedAt').val(listed.toLocaleDateString('en-US'));
                        $('#listedstatus').val(data[key]['status']);
                        //Modal Action
                        $('#listedCharity').attr('action', 'charity/editListed/' + data[key]['id']);
                    }
                }
            });
        });

        </script>
@stop
