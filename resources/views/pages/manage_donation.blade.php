@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Manage Donation')

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

    <!--Pending Applications-->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pending Donations</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>ID No.</th>
                            <th>Donated by</th>
                            <th>Donated to</th>
                            <th>No. of Items</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $num = 1;
                        @endphp

                        @foreach ($donations as $donate)
                            @if ($donate['status'] == 'Cancelled')
                                <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>{{ $donate['id'] }}</td>
                                    <td>Pamela May Tañedo</td>
                                    <td>Youth for Youth Foundation</td>
                                    <td>10</td>
                                    <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editWholeModal{{ $donate['id'] }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Products Sold-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-0 font-weight-bold text-primary">Quality-checked Donation</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>ID No.</th>
                            <th>Donated by</th>
                            <th>Donated to</th>
                            <th>No. of Items</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>1001</td>
                            <td>Pamela May Tañedo</td>
                            <td>Youth for Youth Foundation</td>
                            <td>10</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editWholeModal">
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
                            <td>1002</td>
                            <td>Arcel Luceno</td>
                            <td>Bukas Palad Foundation Inc.</td>
                            <td>2</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editWholeModal">
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
                            <td>1003</td>
                            <td>Paul Angelo Soltero</td>
                            <td>Bukas Palad Foundation Inc.</td>
                            <td>6</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editWholeModal">
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

    <!-- Edit Donation (As Whole) Modal -->
    @foreach ($donations as $donate)
        @if ($donate['status'] == 'Cancelled')
            <div class="modal fade" id="editWholeModal{{ $donate['id'] }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <div class="form-group row">
                                        <div class="form-group col-md-2">
                                            <label class="form-label" for="">ID No: {{ $donate['id'] }}</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="form-label" for="">Donated by: Pamela May</label>
                                        </div>
                                        <div class="form-group col-md-7">
                                            <label class="form-label" for="">Donated to: Youth for Youth
                                                Foundation</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive " id="dataTable" role="grid"
                                        aria-describedby="dataTable_info">
                                        <table class="table table-hover table-bordered pt-3 display" id="example"
                                            style="">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($donate['type'] == 'By Piece')
                                                    @foreach ($donate['items'] as $item)
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Versace Shirt</td>
                                                            <td>{{ $item['category'] }}</td>
                                                            <td>P100.00</td>
                                                            <td>Accepted</td>
                                                            <td><button type="button" class="btn btn-primary btn-sm"
                                                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                                data-bs-target="#addModal">Add New Donations</button>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <!-- Add Donation (Individual) Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-3 text-center">
                                <div class="col">
                                    <img src="profile.JPG" alt="..." class="img-thumbnail w-75 p-1">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-success mt-3">Change
                                        Photo</button>
                                </div>
                            </div>
                            <div class="form-group col-md-9">
                                <div class="form-group row mt-3">
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">ID No:</label>
                                        <input type="text" name="idno" class="form-control item"
                                            placeholder="1001">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Donated by:</label>
                                        <input type="text" name="donatedby" class="form-control item"
                                            placeholder="1001">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Donated to:</label>
                                        <input type="text" name="donatedto" class="form-control item"
                                            placeholder="1001">
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Title:</label>
                                        <input type="text" name="title" class="form-control item"
                                            placeholder="Gucci Shirt">
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label class="form-label" for="">Description:</label>
                                        <input type="text" name="description" class="form-control item"
                                            placeholder="Description">
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="form-group col-md-3">
                                        <label for="inputSex">Category</label>
                                        <select class="form-select mt-2" aria-label="Default select example"
                                            name="category">
                                            <option selected>Choose...</option>
                                            <option value="1">Category1</option>
                                            <option value="2">Category2</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputSex">Sex</label>
                                        <select class="form-select mt-2" aria-label="Default select example"
                                            name="sex">
                                            <option selected>Choose...</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="">Color:</label>
                                        <input type="text" name="red" class="form-control item"
                                            placeholder="Red">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputSex">Size</label>
                                        <select class="form-select mt-2" aria-label="Default select example"
                                            name="sex">
                                            <option selected>Choose...</option>
                                            <option value="1">Size1</option>
                                            <option value="2">Size2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mt-3 mb-5">
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Price:</label>
                                        <input type="text" name="price" class="form-control item"
                                            placeholder="PHP 000.00">
                                    </div>
                                </div>
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

    <!-- Edit Individual Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row mt-3">
                            <div class="form-group col-md-3 text-center">
                                <div class="col">
                                    <img src="profile.JPG" alt="..." class="img-thumbnail w-75 p-1">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-success mt-3">Change
                                        Photo</button>
                                </div>
                            </div>
                            <div class="form-group col-md-9">
                                <div class="form-group row mt-3">
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">ID No:</label>
                                        <input type="text" name="idno" class="form-control item"
                                            placeholder="1001">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Donated by:</label>
                                        <input type="text" name="donatedby" class="form-control item"
                                            placeholder="1001">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Donated to:</label>
                                        <input type="text" name="donatedto" class="form-control item"
                                            placeholder="1001">
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Title:</label>
                                        <input type="text" name="title" class="form-control item"
                                            placeholder="Gucci Shirt">
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label class="form-label" for="">Description:</label>
                                        <input type="text" name="description" class="form-control item"
                                            placeholder="Description">
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="form-group col-md-3">
                                        <label for="inputSex">Category</label>
                                        <select class="form-select mt-2" aria-label="Default select example"
                                            name="category">
                                            <option selected>Choose...</option>
                                            <option value="1">Category1</option>
                                            <option value="2">Category2</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputSex">Sex</label>
                                        <select class="form-select mt-2" aria-label="Default select example"
                                            name="sex">
                                            <option selected>Choose...</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="">Color:</label>
                                        <input type="text" name="red" class="form-control item"
                                            placeholder="Red">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputSex">Size</label>
                                        <select class="form-select mt-2" aria-label="Default select example"
                                            name="sex">
                                            <option selected>Choose...</option>
                                            <option value="1">Size1</option>
                                            <option value="2">Size2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mt-3 mb-5">
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Price:</label>
                                        <input type="text" name="price" class="form-control item"
                                            placeholder="PHP 000.00">
                                    </div>
                                </div>
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
            $('table.display').DataTable();
        });
    </script>
@stop
