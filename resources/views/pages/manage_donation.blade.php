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

    <!--Pending Donations-->
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
                            <th>Address</th>
                            <th>No. of Items</th>
                            <th>Type</th>
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
                                    <td>Canada</td>
                                    <td>10</td>
                                    <td>Drop-off</td>
                                    <td><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#acceptModal">
                                            <i class="fa-solid fa-check text-light"></i>
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

    <!--Waiting for Driver Assignment-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Waiting for Driver's Assignment</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>ID No.</th>
                            <th>Donated by</th>
                            <th>Address</th>
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
                                            data-bs-target="#driverModal">
                                            <i class="fa-solid fa-truck"></i>
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

    <!--In Progress -->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">In Progress</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>ID No.</th>
                            <th>Donated by</th>
                            <th>Driver</th>
                            <th>No. of Items</th>
                            <th>Status</th>
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
                                    <td>Arcel Luceno</td>
                                    <td>10</td>
                                    <td>On the Way</td>
                                    <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#viewModal">
                                            <i class="fa-sharp fa-solid fa-eye"></i>
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

    <!--Received Donations -->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Received</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>ID No.</th>
                            <th>Donated by</th>
                            <th>Driver</th>
                            <th>No. of Items</th>
                            <th>Received Date</th>
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
                                    <td>Arcel Luceno</td>
                                    <td>10</td>
                                    <td>10/22/22 10:50:58 AM</td>
                                    <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editWholeModal{{ $donate['id'] }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
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

    <!--Quality-Checked Donations-->
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
                                    data-bs-target="#viewCModal">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
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
                                    data-bs-target="#viewCModal">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
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
                                    data-bs-target="#viewCModal">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Accept Modal - Modal for Pending Donation -->
    <div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-confirm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box " style="border: 3px solid #1cc88a;">
                        <i class="fa-solid fa-check  text-success"></i>
                    </div>
                    <h4 class="modal-title w-100" id="exampleModalLabel">Are you sure?</h4>

                </div>
                <div class="modal-body">
                    <p>Have you received already the donated clothes? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success text-light">Accept</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Driver Modal - Modal for Waiting for Assignment-->
    <div class="modal fade" id="driverModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Driver</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d31391.57433512359!2d123.95270045000001!3d10.42579715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1667039419823!5m2!1sen!2sph"
                            onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));'
                            style="height:200px;width:100%;border:none;overflow:hidden;"></iframe>
                    </div>
                    <div class="form-group row mt-1">
                        <div class="form-group col-md-2">
                            <p><b>Donation ID:</b></p>
                        </div>
                        <div class="form-group col-md-5">
                            <p name="orderID">11900005</p>
                        </div>
                        <div class="form-group col-md-2">
                            <p><b>Donation Created:</b></p>
                        </div>
                        <div class="form-group col-md-3">
                            <p name="orderDate">10/29/22 10:50:59 AM</p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="form-group col-md-2">
                            <p><b>Donated By:</b></p>
                        </div>
                        <div class="form-group col-md-5">
                            <p name="purchasedName">Paul Angelo Soltero</p>
                        </div>
                        <div class="form-group col-md-2">
                            <p><b>No. of Items:</b></p>
                        </div>
                        <div class="form-group col-md-3">
                            <p name="noItems">12 items</p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="form-group col-md-2">
                            <p><b>Address:</b></p>
                        </div>
                        <div class="form-group col-md-5">
                            <p name="purchasedAdress">Brgy. Casili, Consolacion, Cebu 6001, Philippines</p>
                        </div>
                        <div class="form-group col-md-2">
                            <p><b>Type:</b></p>
                        </div>
                        <div class="form-group col-md-3">
                            <p name="type">By Piece</p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="form-group col-md-2">
                            <p><b>Driver's ID No.:</b></p>
                        </div>
                        <div class="form-group col-md-5">
                            <fieldset disabled>
                                <input type="text" class="form-control" id="driverID" name="driverID">
                            </fieldset>
                        </div>
                        <div class="form-group col-md-2">
                            <p><b>Driver's Name:</b></p>
                        </div>
                        <div class="form-group col-md-3">
                            <fieldset disabled>
                                <input type="text" class="form-control" id="driverName" name="driverName">
                            </fieldset>
                        </div>
                    </div>
                    <div class="card shadow mt-3">
                        <div class="card-body">
                            <div class="table-responsive " id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table table-hover table-bordered pt-3 display" id="table"
                                    style="">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No.</th>
                                            <th>ID Number</th>
                                            <th>Name</th>
                                            <th>Current No. of Orders</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <th>119002</th>
                                            <td>Arcel Luceno</td>
                                            <td>8 / 10</td>
                                            <td>Available</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <th>119003</th>
                                            <td>Paul Angelo</td>
                                            <td>10 / 10</td>
                                            <td>Unavailable</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Modal - In Progress-->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="embed-responsive">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d31391.57433512359!2d123.95270045000001!3d10.42579715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1667039419823!5m2!1sen!2sph"
                                onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));'
                                style="height:200px;width:100%;border:none;overflow:hidden;"></iframe>
                        </div>
                        <div class="form-group row mt-1">
                            <div class="form-group col-md-2">
                                <p><b>Donation ID:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="orderID">11900005</p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Donation Created:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="orderDate">10/29/22 10:50:59 AM</p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Donated By:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="purchasedName">Paul Angelo Soltero</p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>No. of Items:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="noItems">12 items</p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Address:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="purchasedAdress">Brgy. Casili, Consolacion, Cebu 6001, Philippines</p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Type:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="type">By Piece</p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Delivery Driver:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="deliveryDriver">Arcel Luceno</p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Pickup Date:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="pickupDate">10/22/22 10:50:60 AM</p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Received Date:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="receivedDate">10/22/22 10:50:60 AM</p>
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
                                            <th>Sex</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <th>Versace Shirt</th>
                                            <td>Top & Blouse</td>
                                            <td>Unisex</td>
                                            <td>White</td>
                                            <td>XL</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <th>Versace Shirt</th>
                                            <td>Top & Blouse</td>
                                            <td>Unisex</td>
                                            <td>White</td>
                                            <td>XL</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Donation (As Whole) Modal -Received Donations-->
    @foreach ($donations as $donate)
        @if ($donate['status'] == 'Cancelled')
            <!-- Edit Donation (As Whole) Modal -Received Donations-->
            <div class="modal fade" id="editWholeModal{{ $donate['id'] }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="embed-responsive">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d31391.57433512359!2d123.95270045000001!3d10.42579715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1667039419823!5m2!1sen!2sph"
                                    onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));'
                                    style="height:200px;width:100%;border:none;overflow:hidden;"></iframe>
                            </div>
                            <div class="form-group row mt-1">
                                <div class="form-group col-md-2">
                                    <p><b>Donation ID:</b></p>
                                </div>
                                <div class="form-group col-md-5">
                                    <p name="orderID">11900005</p>
                                </div>
                                <div class="form-group col-md-2">
                                    <p><b>Donation Created:</b></p>
                                </div>
                                <div class="form-group col-md-3">
                                    <p name="orderDate">10/29/22 10:50:59 AM</p>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="form-group col-md-2">
                                    <p><b>Donated By:</b></p>
                                </div>
                                <div class="form-group col-md-5">
                                    <p name="purchasedName">Paul Angelo Soltero</p>
                                </div>
                                <div class="form-group col-md-2">
                                    <p><b>No. of Items:</b></p>
                                </div>
                                <div class="form-group col-md-3">
                                    <p name="noItems">12 items</p>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="form-group col-md-2">
                                    <p><b>Address:</b></p>
                                </div>
                                <div class="form-group col-md-5">
                                    <p name="purchasedAdress">Brgy. Casili, Consolacion, Cebu 6001, Philippines</p>
                                </div>
                                <div class="form-group col-md-2">
                                    <p><b>Type:</b></p>
                                </div>
                                <div class="form-group col-md-3">
                                    <p name="type">By Piece</p>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="form-group col-md-2">
                                    <p><b>Delivery Driver:</b></p>
                                </div>
                                <div class="form-group col-md-5">
                                    <p name="deliveryDriver">Arcel Luceno</p>
                                </div>
                                <div class="form-group col-md-2">
                                    <p><b>Pickup Date:</b></p>
                                </div>
                                <div class="form-group col-md-3">
                                    <p name="pickupDate">10/22/22 10:50:60 AM</p>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="form-group col-md-2">
                                    <p><b>Received Date:</b></p>
                                </div>
                                <div class="form-group col-md-5">
                                    <p name="receivedDate">10/22/22 10:50:60 AM</p>
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
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
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

            <!-- Add Donation (Individual) Modal -Received Donations - By Bulk-->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group row mt-3">
                                    <div class="form-group col-md-3 text-center">
                                        <div class="col">
                                            <img src="profile.JPG" alt="..." class="img-thumbnail"
                                                style="width:250px; height:auto;">
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-success mt-4">
                                                <input class="form-control form-control-sm" type="file"
                                                    id="formFileSm"
                                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                            </button>
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
                                            <div class="form-group col-md-4">
                                                <label for="inputStatus">Status</label>
                                                <select class="form-select mt-2" aria-label="Default select example"
                                                    name="status">
                                                    <option selected>Choose Status...</option>
                                                    <option value="1">Accepted</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#editWholeModal{{ $donate['id'] }}">Back</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Individual Modal - Received Donations - By Piece -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group row mt-3">
                                    <div class="form-group col-md-3 text-center">
                                        <div class="col">
                                            <img src="profile.JPG" alt="..." class="img-thumbnail"
                                                style="width:250px; height:auto;">
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-success mt-4">
                                                <input class="form-control form-control-sm" type="file"
                                                    id="formFileSm"
                                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-9">
                                        <div class="form-group row mt-3">
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="">ID No:</label>
                                                <fieldset disabled>
                                                    <input type="text" name="idno" class="form-control item"
                                                        placeholder="1001">
                                                </fieldset>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="">Donated by:</label>
                                                <fieldset disabled>
                                                    <input type="text" name="donatedby" class="form-control item"
                                                        placeholder="1001">
                                                </fieldset>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="">Donated to:</label>
                                                <fieldset disabled>
                                                    <input type="text" name="donatedto" class="form-control item"
                                                        placeholder="1001">
                                                </fieldset>
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
                                            <div class="form-group col-md-4">
                                                <label for="inputStatus">Status</label>
                                                <select class="form-select mt-2" aria-label="Default select example"
                                                    name="status">
                                                    <option selected>Choose Status...</option>
                                                    <option value="1">Accepted</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#editWholeModal{{ $donate['id'] }}">Back</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <!-- View Complete Modal - Quality-checked Donations-->
    <div class="modal fade" id="viewCModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="embed-responsive">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d31391.57433512359!2d123.95270045000001!3d10.42579715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1667039419823!5m2!1sen!2sph"
                                onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));'
                                style="height:200px;width:100%;border:none;overflow:hidden;"></iframe>
                        </div>
                        <div class="form-group row mt-1">
                            <div class="form-group col-md-2">
                                <p><b>Donation ID:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="orderID">11900005</p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Donation Created:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="orderDate">10/29/22 10:50:59 AM</p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Donated By:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="purchasedName">Paul Angelo Soltero</p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>No. of Items:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="noItems">12 items</p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Address:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="purchasedAdress">Brgy. Casili, Consolacion, Cebu 6001, Philippines</p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Type:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="type">By Piece</p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Delivery Driver:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="deliveryDriver">Arcel Luceno</p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Pickup Date:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="pickupDate">10/22/22 10:50:60 AM</p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Received Date:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="receivedDate">10/22/22 10:50:60 AM</p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Complete Date:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="completeDate">10/22/22 10:50:60 AM</p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Quality-Checked Date:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="qualityDate">10/22/22 10:50:60 AM</p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Checked By:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="checkedBy">Pamela May Tanedo</p>
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
                                            <th>Sex</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <th>Versace Shirt</th>
                                            <td>Top & Blouse</td>
                                            <td>Unisex</td>
                                            <td>White</td>
                                            <td>XL</td>
                                            <td>PHP 500.00</td>
                                            <td>Accepted</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <th>Versace Shirt</th>
                                            <td>Top & Blouse</td>
                                            <td>Unisex</td>
                                            <td>White</td>
                                            <td>XL</td>
                                            <td>PHP 0.00</td>
                                            <td>Rejected</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
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

    <!--Display data from selected row above the table -->
    <script>
        //Display data from selected row above the table
        var table = document.getElementById('table');

        for (var i = 1; i < table.rows.length; i++) {
            table.rows[i].onclick = function() {
                //rIndex = this.rowIndex;
                document.getElementById("driverID").value = this.cells[1].innerHTML;
                document.getElementById("driverName").value = this.cells[2].innerHTML;
            };
        }

        $(document).ready(function() {
            var table = $('#table').DataTable();

            $('#table tbody').on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

        });
    </script>
@stop
