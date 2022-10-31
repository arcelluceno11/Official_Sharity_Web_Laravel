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

    <!--Non-Remittable-->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Non-Remittable</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>ID No.</th>
                            <th>Charity Name</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <th>10011</th>
                            <td>Missionary of Children - Cebu City Chapter</td>
                            <td>PHP 9,890.00</td>
                            <td>10/22/22 10:00 AM</td>
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
                            <th>10012</th>
                            <td>Bukas Palad Foundation Inc.</td>
                            <td>PHP 5,000.00</td>
                            <td>10/30/22 1:00 PM</td>
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
                            <th>10013</th>
                            <td>Youth for Youth Foundation</td>
                            <td>PHP 7,000.00</td>
                            <td>10/22/22 10:30 AM</td>
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

    <!--Remittable-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-0 font-weight-bold text-primary">Remittable</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>ID No.</th>
                            <th>Charity Name</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <th>10011</th>
                            <td>Missionary of Children - Cebu City Chapter</td>
                            <td>PHP 12,890.00</td>
                            <td>10/22/22 10:00 AM</td>
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
                            <th>10012</th>
                            <td>Bukas Palad Foundation Inc.</td>
                            <td>PHP 13,000.00</td>
                            <td>10/30/22 1:00 PM</td>
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
                            <th>10013</th>
                            <td>Youth for Youth Foundation</td>
                            <td>PHP 20,000.00</td>
                            <td>10/22/22 10:30 AM</td>
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

    <!--Remitted-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-0 font-weight-bold text-primary">Remitted</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>ID No.</th>
                            <th>Charity Name</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <th>10011</th>
                            <td>Missionary of Children - Cebu City Chapter</td>
                            <td>PHP 12,890.00</td>
                            <td>10/22/22 10:00 AM</td>
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
                            <th>10012</th>
                            <td>Bukas Palad Foundation Inc.</td>
                            <td>PHP 13,000.00</td>
                            <td>10/30/22 1:00 PM</td>
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
                            <th>10013</th>
                            <td>Youth for Youth Foundation</td>
                            <td>PHP 20,000.00</td>
                            <td>10/22/22 10:30 AM</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="text-center">
                            <img src="{{ asset('profile.JPG') }}" alt="..." class="img-thumbnail"
                                style="width:500px; height:300px;">
                            <button type="submit" class="btn btn-success" style="margin-left:50px;">Add Photo</button>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col">
                                <fieldset disabled>
                                    <label class="form-label" for="">Charity Name:</label>
                                    <input type="text" name="amount" class="form-control item"
                                        placeholder="Bukas Palad Inc.">
                                </fieldset>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="form-group col-md-3">
                                <fieldset disabled>
                                    <label class="form-label" for="">Remitted Amount:</label>
                                    <input type="text" name="amount" class="form-control item"
                                        placeholder="PHP 9,999.00">
                                </fieldset>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="">Processed by:</label>
                                <input type="text" name="admin" class="form-control item"
                                    placeholder="Pamela May Tañedo">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="">Remitted Date:</label>
                                <input type="date" name="estDate" class="form-control item">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSex">Status</label>
                                <select class="form-select" aria-label="Default select example" name="sex">
                                    <option selected>Choose...</option>
                                    <option value="1">Status1</option>
                                    <option value="2">Status2</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label for="inputBankName">Bank Name</label>
                                <fieldset disabled>
                                    <select class="form-select mt-2" aria-label="Default select example" name="bankName">
                                        <option selected>Choose...</option>
                                        <option value="1">Banco de Oro Inc. (BDO)</option>
                                        <option value="2">UnionBank</option>
                                        <option value="3">RCBC</option>
                                        <option value="4">Landbank Philippines</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Account Number:</label>
                                <fieldset disabled>
                                    <input type="number" name="dob" class="form-control item" maxlength="12">
                                </fieldset>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-target="#editWholeModal"
                        data-bs-toggle="modal">Back</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="text-center">
                            <img src="{{ asset('profile.JPG') }}" alt="..." class="img-thumbnail"
                                style="width:500px; height:300px;">
                            <button type="submit" class="btn btn-success" style="margin-left:50px;">Add Photo</button>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col">
                                <fieldset disabled>
                                    <label class="form-label" for="">Charity Name:</label>
                                    <input type="text" name="amount" class="form-control item"
                                        placeholder="Bukas Palad Inc.">
                                </fieldset>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="form-group col-md-3">
                                <fieldset disabled>
                                    <label class="form-label" for="">Remitted Amount:</label>
                                    <input type="text" name="amount" class="form-control item"
                                        placeholder="PHP 9,999.00">
                                </fieldset>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="">Processed by:</label>
                                <input type="text" name="admin" class="form-control item"
                                    placeholder="Pamela May Tañedo">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="">Remitted Date:</label>
                                <input type="date" name="estDate" class="form-control item">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSex">Status</label>
                                <select class="form-select" aria-label="Default select example" name="sex">
                                    <option selected>Choose...</option>
                                    <option value="1">Status1</option>
                                    <option value="2">Status2</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label for="inputBankName">Bank Name</label>
                                <fieldset disabled>
                                    <select class="form-select mt-2" aria-label="Default select example" name="bankName">
                                        <option selected>Choose...</option>
                                        <option value="1">Banco de Oro Inc. (BDO)</option>
                                        <option value="2">UnionBank</option>
                                        <option value="3">RCBC</option>
                                        <option value="4">Landbank Philippines</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Account Number:</label>
                                <fieldset disabled>
                                    <input type="number" name="dob" class="form-control item" maxlength="12">
                                </fieldset>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-target="#editWholeModal"
                        data-bs-toggle="modal">Back</button>
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
@stop
