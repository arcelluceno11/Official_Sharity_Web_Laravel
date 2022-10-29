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

    <!--Pending Applications-->
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="row">
                <div class="col align-self-center">
                    <h6 class="m-0 font-weight-bold text-primary">Pending Charity Applications</h6>
                </div>

                <div class="col text-end">
                    <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                        data-bs-target="#addModal">
                        <i class="fa-solid fa-user-plus"></i><span class="ms-2"> Register New Charity
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Charity Name</th>
                            <th>Email</th>
                            <th>Appt. Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align:center;">1</td>
                            <td>Missionary of Children - Cebu City Chapter</td>
                            <td>moc.cebucity@gmail.com</td>
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
                            <td style="text-align:center;">2</td>
                            <td>Bukas Palad Foundation Inc.</td>
                            <td>bukaspalad@gmail.com</td>
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
                            <td style="text-align:center;">3</td>
                            <td>Youth for Youth Foundation</td>
                            <td>u4u.foundation@gmail.com</td>
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

    <!--Accepted Charities-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-0 font-weight-bold text-primary">Manage Charity Accounts</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Charity Name</th>
                            <th>Email</th>
                            <th>Est. Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align:center;">1</td>
                            <td>Missionary of Children - Cebu City Chapter</td>
                            <td>moc.cebucity@gmail.com</td>
                            <td>January 2010</td>
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
                            <td style="text-align:center;">2</td>
                            <td>Bukas Palad Foundation Inc.</td>
                            <td>bukaspalad@gmail.com</td>
                            <td>October 2001</td>
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
                            <td style="text-align:center;">3</td>
                            <td>Youth for Youth Foundation</td>
                            <td>u4u.foundation@gmail.com</td>
                            <td>July 2022</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Register New Charity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="text-center">
                            <img src="{{ asset('profile.JPG') }}" alt="..." class="img-thumbnail rounded-circle" id="image" style="width:200px; height:200px;">
                            <button type="submit" class="btn btn-success" style="margin-left:50px;">
                                <input class="form-control" type="file" id="formFile" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                            </button>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="form-group col">
                                <label class="form-label" for="">Charity Name</label>
                                <input type="text" name="charityName" class="form-control item"
                                    placeholder="Missionary of Childern - Cebu City Chapter">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Contact Person:</label>
                                <input type="text" name="contactName" class="form-control item"
                                    placeholder="Arcel V. Luceno">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Phone number:</label>
                                <input type="tel" name="phonenumber" class="form-control item"
                                    placeholder="+639 XX XXX XXXX">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Established Date:</label>
                                <input type="date" name="estDate" class="form-control item">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"
                                    name="address">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label for="inputCategory">Category</label>
                                <select class="form-select mt-2" aria-label="Default select example" name="category">
                                    <option selected>Choose Category...</option>
                                    <option value="1">Animals</option>
                                    <option value="2">Arts and Culture</option>
                                    <option value="3">Community Development</option>
                                    <option value="4">Education</option>
                                    <option value="5">Enviromental</option>
                                    <option value="6">Health</option>
                                    <option value="7">Human</option>
                                </select>
                            </div>
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


                        <div class="form-group row mt-3">
                            <div class="form-group col">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Documents:</label>
                                    <input class="form-control" type="file" id="formFile">
                                  </div>
                            </div>
                            <div class="form-group col">
                                <label class="form-label" for="">Appointment Date:</label>
                                <input type="datetime-local" name="apptDate" class="form-control item">
                            </div>
                            <div class="form-group col">
                                <label class="form-label" for="">Status:</label>
                                <select class="form-select" aria-label="Default select example" name="status">
                                    <option selected>Choose...</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Verified</option>
                                </select>

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
                                <label class="form-label" for="">Status:</label>
                                        <select class="form-select" aria-label="Default select example" name="status">
                                            <option selected>Choose...</option>
                                            <option value="1">Pending</option>
                                            <option value="2">Verified</option>
                                        </select>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Charity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="text-center">
                            <img src="{{ asset('profile.JPG') }}" alt="..." class="img-thumbnail rounded-circle" id="image" style="width:auto; height:200px;">
                            <button type="submit" class="btn btn-success" style="margin-left:50px;">
                                <input class="form-control" type="file" id="formFile" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                            </button>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="form-group col">
                                <label class="form-label" for="">Charity Name</label>
                                <input type="text" name="charityName" class="form-control item"
                                    placeholder="Missionary of Childern - Cebu City Chapter">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Contact Person:</label>
                                <input type="text" name="contactName" class="form-control item"
                                    placeholder="Arcel V. Luceno">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Phone number:</label>
                                <input type="tel" name="phonenumber" class="form-control item"
                                    placeholder="+639 XX XXX XXXX">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Established Date:</label>
                                <input type="date" name="estDate" class="form-control item">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"
                                    name="address">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-4">
                                <label for="inputCategory">Category</label>
                                <select class="form-select mt-2" aria-label="Default select example" name="category">
                                    <option selected>Choose Category...</option>
                                    <option value="1">Animals</option>
                                    <option value="2">Arts and Culture</option>
                                    <option value="3">Community Development</option>
                                    <option value="4">Education</option>
                                    <option value="5">Enviromental</option>
                                    <option value="6">Health</option>
                                    <option value="7">Human</option>
                                </select>
                            </div>
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


                        <div class="form-group row mt-3">
                            <div class="form-group col">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Documents:</label>
                                    <input class="form-control" type="file" id="formFile">
                                  </div>
                            </div>
                            <div class="form-group col">
                                <label class="form-label" for="">Established Date:</label>
                                <input type="month" name="apptDate" class="form-control item">
                            </div>
                            <div class="form-group col">
                                <label class="form-label" for="">Status:</label>
                                <select class="form-select" aria-label="Default select example" name="status">
                                    <option selected>Choose...</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Verified</option>
                                </select>

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
