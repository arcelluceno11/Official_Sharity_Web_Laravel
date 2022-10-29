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

    <!--Pending Orders-->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pending Orders</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Order No.</th>
                            <th>Name</th>
                            <th>Purchased</th>
                            <th>Address</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <th>10011</th>
                            <td>Paul Angelo Soltero</td>
                            <td>12 items</td>
                            <td>near Yenyen Store, Casili, Consolacion, Cebu</td>
                            <td>PHP 590.00</td>
                            <td>10/22/22 10:00 AM</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <th>10011</th>
                            <td>Paul Angelo Soltero</td>
                            <td>12 items</td>
                            <td>near Yenyen Store, Casili, Consolacion, Cebu</td>
                            <td>PHP 590.00</td>
                            <td>10/22/22 10:00 AM</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <th>10011</th>
                            <td>Paul Angelo Soltero</td>
                            <td>12 items</td>
                            <td>near Yenyen Store, Casili, Consolacion, Cebu</td>
                            <td>PHP 590.00</td>
                            <td>10/22/22 10:00 AM</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Accepted Orders-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Accepted Orders</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Order No.</th>
                            <th>Name</th>
                            <th>Purchased</th>
                            <th>Address</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <th>10011</th>
                            <td>Paul Angelo Soltero</td>
                            <td>12 items</td>
                            <td>near Yenyen Store, Casili, Consolacion, Cebu</td>
                            <td>PHP 590.00</td>
                            <td>10/22/22 10:00 AM</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#driverModal">
                                    <i class="fa-solid fa-truck"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <th>10011</th>
                            <td>Paul Angelo Soltero</td>
                            <td>12 items</td>
                            <td>near Yenyen Store, Casili, Consolacion, Cebu</td>
                            <td>PHP 590.00</td>
                            <td>10/22/22 10:00 AM</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#driverModal">
                                    <i class="fa-solid fa-truck"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <th>10011</th>
                            <td>Paul Angelo Soltero</td>
                            <td>12 items</td>
                            <td>near Yenyen Store, Casili, Consolacion, Cebu</td>
                            <td>PHP 590.00</td>
                            <td>10/22/22 10:00 AM</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#driverModal">
                                    <i class="fa-solid fa-truck"></i>
                                </button>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--In Progress Orders-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">In Progress Orders</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Order No.</th>
                            <th>Name</th>
                            <th>Purchased</th>
                            <th>Driver</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <th>10011</th>
                            <td>Paul Angelo Soltero</td>
                            <td>12 items</td>
                            <td>Arcel Luceno</td>
                            <td>PHP 590.00</td>
                            <td>On the Way</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewModal">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <th>10011</th>
                            <td>Paul Angelo Soltero</td>
                            <td>12 items</td>
                            <td>Arcel Luceno</td>
                            <td>PHP 590.00</td>
                            <td>Delivered</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewModal">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <th>10011</th>
                            <td>Paul Angelo Soltero</td>
                            <td>12 items</td>
                            <td>Arcel Luceno</td>
                            <td>PHP 590.00</td>
                            <td>Assigned</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewModal">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Complete Orders-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Complete Orders</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Order No.</th>
                            <th>Name</th>
                            <th>Purchased</th>
                            <th>Delivered By</th>
                            <th>Total</th>
                            <th>Delivered Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <th>10011</th>
                            <td>Paul Angelo Soltero</td>
                            <td>12 items</td>
                            <td>Arcel Luceno</td>
                            <td>PHP 590.00</td>
                            <td>10/22/22 10:00 AM</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewModal">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <th>10011</th>
                            <td>Paul Angelo Soltero</td>
                            <td>12 items</td>
                            <td>Arcel Luceno</td>
                            <td>PHP 590.00</td>
                            <td>10/22/22 10:00 AM</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewModal">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <th>10011</th>
                            <td>Paul Angelo Soltero</td>
                            <td>12 items</td>
                            <td>Arcel Luceno</td>
                            <td>PHP 590.00</td>
                            <td>10/22/22 10:00 AM</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewModal">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Purchase</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row mt-1">
                            <div class="form-group col-md-2">
                                <p><b>Order ID:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="orderID">11900005</p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Order Created:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="orderDate">10/29/22 10:50:59 AM</p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Purchased By:</b></p>
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
                                <p><b>Total Amount:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="totalAmount">PHP 590.00</p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">

                            </div>
                            <div class="form-group col-md-5">

                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Payment Method:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="paymentMethod">Cash on Deliver</p>
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
                                            <th>Product ID</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <th>119002</th>
                                            <td><img src="{{ asset('profile.JPG') }}" alt="..."
                                                    class="img-thumbnail" style="width:auto; height:150px;"></td>
                                            <td>Versace Shirt</td>
                                            <td>Category</td>
                                            <td>P100.00</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="button" class="btn btn-danger">Reject</button>
                    <button type="button" class="btn btn-success">Accept</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row mt-1">
                            <div class="form-group col-md-2">
                                <p><b>Order ID:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="orderID">11900005</p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Order Created:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="orderDate">10/29/22 10:50:59 AM</p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Purchased By:</b></p>
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
                                <p><b>Total Amount:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="totalAmount">PHP 590.00</p>
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
                                <p><b>Payment Method:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="paymentMethod">Cash on Deliver</p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">
                                <p><b>Delivered Date:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="deliveredDate">10/22/22 10:50:60 AM</p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Complete Date:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="deliveredDate">10/22/22 10:50:60 AM</p>
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
                                            <th>Product ID</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <th>119002</th>
                                            <td><img src="{{ asset('profile.JPG') }}" alt="..."
                                                    class="img-thumbnail" style="width:auto; height:150px;"></td>
                                            <td>Versace Shirt</td>
                                            <td>Category</td>
                                            <td>P100.00</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                    <div class="embed-responsive w-100">
                        <iframe class="embed-responsive-item"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d31391.57433512359!2d123.95270045000001!3d10.42579715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1667039419823!5m2!1sen!2sph"
                            style="width:100px;"></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Driver Modal -->
    <div class="modal fade" id="driverModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Driver</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row ">
                        <div class="form-group col-md-2">
                            <p><b>Driver's ID No.:</b></p>
                        </div>
                        <div class="form-group col-md-5">
                            <p name="driverID">DXV102</p>
                        </div>
                        <div class="form-group col-md-2">
                            <p><b>Driver's Name:</b></p>
                        </div>
                        <div class="form-group col-md-3">
                            <p name="driverName">Arcel Luceno</p>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive " id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table table-hover table-bordered pt-3 display" id="example"
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
                                            <td>8</td>
                                            <td>Available</td>
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
            $('table.display').DataTable();
        });
    </script>
@stop
