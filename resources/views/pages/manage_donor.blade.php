@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Manage Admin')

<!-- Styles -->
@section('styles')
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
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
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manage Donor/Shopper Accounts</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Email Address</th>
                            <th>Full Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>arcelPet</td>
                            <td>arcel@gmail.com</td>
                            <td>Arcel V. Luceno</td>
                            <td>Unverified</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>pamPet</td>
                            <td>pamela.may@gmail.com</td>
                            <td>Pamela May Z. Tanedo</td>
                            <td>Verified</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>paulPet</td>
                            <td>paul.angelo@gmail.com</td>
                            <td>Paul Angelo F. Soltero</td>
                            <td>Unverified</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="text-center">
                            <img src="{{ asset('profile.JPG') }}" alt="..." class="img-thumbnail"
                                style="width:200px; height:200px;">
                            <button type="submit" class="btn btn-success" style="margin-left:50px;">Add Photo</button>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">First Name:</label>
                                <input type="text" name="fname" class="form-control item" placeholder="Arcel">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Middle Name:</label>
                                <input type="text" name="mname" class="form-control item" placeholder="V">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Last Name:</label>
                                <input type="text" name="lname" class="form-control item" placeholder="Luceno">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-3">
                                <label class="form-label" for="">Username:</label>
                                <input type="text" name="username" class="form-control item" placeholder="petLover">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="">Phone number:</label>
                                <input type="tel" name="phonenumber" class="form-control item"
                                    placeholder="+639 XX XXX XXXX">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSex">Sex</label>
                                <select class="form-select mt-2" aria-label="Default select example" name="sex">
                                    <option selected>Choose...</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="">Date of Birth:</label>
                                <input type="date" name="dob" class="form-control item">
                            </div>

                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-10">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"
                                    name="address">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputStatus">Status</label>
                                <fieldset disabled>
                                    <input type="text" class="form-control" id="inputStatus" placeholder="Unverified"
                                        name="status">
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row mt-3 mb-5">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Email Address:</label>
                                <input type="email" name="email" class="form-control item"
                                    placeholder="arcel@gmail.com">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Password:</label>
                                <input type="password" name="password" class="form-control item">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Registration Date:</label>
                                <fieldset disabled>
                                    <input type="datetime-local" name="dateofReg" class="form-control item">
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="text-center">
                            <img src="{{ asset('profile.JPG') }}" alt="..." class="img-thumbnail"
                                style="width:200px; height:200px;">
                            <button type="submit" class="btn btn-success" style="margin-left:50px;">Add Photo</button>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">First Name:</label>
                                <input type="text" name="fname" class="form-control item" placeholder="Arcel">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Middle Name:</label>
                                <input type="text" name="mname" class="form-control item" placeholder="V">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Last Name:</label>
                                <input type="text" name="lname" class="form-control item" placeholder="Luceno">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-3">
                                <label class="form-label" for="">Username:</label>
                                <input type="text" name="username" class="form-control item" placeholder="petLover">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="">Phone number:</label>
                                <input type="tel" name="phonenumber" class="form-control item"
                                    placeholder="+639 XX XXX XXXX">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSex">Sex</label>
                                <select class="form-select mt-2" aria-label="Default select example" name="sex">
                                    <option selected>Choose...</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="">Date of Birth:</label>
                                <input type="date" name="dob" class="form-control item">
                            </div>

                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-10">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"
                                    name="address">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputStatus">Status</label>
                                <fieldset disabled>
                                    <input type="text" class="form-control" id="inputStatus" placeholder="Unverified"
                                        name="status">
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row mt-3 mb-5">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Email Address:</label>
                                <input type="email" name="email" class="form-control item"
                                    placeholder="arcel@gmail.com">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Password:</label>
                                <input type="password" name="password" class="form-control item">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Registration Date:</label>
                                <fieldset disabled>
                                    <input type="datetime-local" name="dateofReg" class="form-control item">
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
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
            $('#example').DataTable();
        });
    </script>
@stop
