@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Manage Admin')

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

    <!-- Admin Table -->
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="row">
                <div class="col align-self-center">
                    <h6 class="m-0 font-weight-bold text-primary">Manage Admin Accounts</h6>
                </div>

                <div class="col text-end">
                    <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                        data-bs-target="#addModal">
                        <i class="fa-solid fa-user-plus"></i><span class="ms-2"> Add Admin Account
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3" id="tableAdmins" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Email Address</th>
                            <th>Full Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Admin Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form action="admin" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="{{ asset('image-holder.png') }}" alt="..."
                                class="img-thumbnail rounded-circle" id="image" style="width:150px; height:150px;  object-fit: cover; object-position: center;">
                            <button class="btn btn-success" style="margin-left:50px;">
                                <input class="form-control" type="file" id="formFile" name="photo"
                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])" required>
                            </button>r
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">First Name:</label>
                                <input type="text" name="firstname" class="form-control item" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Last Name:</label>
                                <input type="text" name="lastname" class="form-control item" required>
                            </div>
                        </div>
                        <div class="form-group row mt-3 mb-5">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Email Address:</label>
                                <input type="email" name="email" class="form-control item" required>
                                @error('emailExist')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Password:</label>
                                <input type="password" name="password" class="form-control item" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="actionEdit" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="{{ asset('image-holder.png') }}" alt="..."
                                class="img-thumbnail rounded-circle" id="imageEditAdmin"
                                style="width:150px; height:150px;  object-fit: cover; object-position: center;">
                            <button class="btn btn-success" style="margin-left:50px;">
                                <input class="form-control" type="file" id="formFile" name="photo"
                                    onchange="document.getElementById('imageEditAdmin').src = window.URL.createObjectURL(this.files[0])">
                            </button>
                            @error('photo')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group row mt-3 text-center">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">First Name:</label>
                                <input id="editFirstName" type="text" name="firstname" class="form-control item">
                                @error('firstname')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Last Name:</label>
                                <input id="editLastName" type="text" name="lastname" class="form-control item">
                                @error('lastname')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3 mb-5 text-center">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Email Address:</label>
                                <input id="editEmail" type="email" name="email" class="form-control item">
                                @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                @error('emailExist')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Password:</label>
                                <input id="editPassword" type="password" name="password" class="form-control item">
                                @error('password')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-confirm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <h4 class="modal-title w-100" id="exampleModalLabel">Are you sure?</h4>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <form id="actionDelete" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
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
        $(document).ready(function() {
            $('#tableAdmins').DataTable();
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

        //Get Current Admin ID Logged In
        var adminID = '{{ Session::get('adminID') }}';

        //Initialize Table
        var tableAdmins = $('#tableAdmins').DataTable();

        const admins = ref(database, 'Admins/');
        onValue(admins, (snapshot) => {
            //Data
            const data = snapshot.val();

            //Clear Table
            tableAdmins.clear().draw();

            //Tables
            for (var key in data) {

                //Admin
                if(data[key]['id'] != adminID){
                    tableAdmins.row.add([
                    data[key]['id'],
                    data[key]['email'],
                    data[key]['name'],
                    `
                    <button type="button" class="editModal btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button type="button" class="deleteModal btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                         <i class="fa-solid fa-trash-can"></i>
                    </button>
                    `
                ]).node().id = data[key]['id'];
                tableAdmins.draw(false);
                }

            }

            //Edit Modal
            $(document).on('click', '.editModal', function() {
                var x = $(this).closest('tr').attr('id');

                for (var key in data) {
                    if (data[key]['id'] == x) {
                        var name = data[key]['name'].split(/[ ]+/);

                        //Assign Values
                        setImage('EditAdmin', data[key]['photo']);
                        $('#editFirstName').val(name[0]);
                        $('#editLastName').val(name[1]);
                        $('#editEmail').val(data[key]['email']);
                        $('#editPassword').val(data[key]['password']);

                        //Modal Action
                        $('#actionEdit').attr('action', 'admin/' + data[key]['id']);
                    }
                }
            });

            //Delete Modal
            $(document).on('click', '.deleteModal', function() {
                var x = $(this).closest('tr').attr('id');

                for (var key in data) {
                    if (data[key]['id'] == x) {

                        //Modal Action
                        $('#actionDelete').attr('action', 'admin/' + data[key]['id']);
                    }
                }
            });
        });
    </script>
@stop
