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
                                <p><b>Order ID:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p id="orderID"></p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Order Created:</b></p>
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
                                    data-bs-target="#viewCModal">
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
                                    data-bs-target="#viewCModal">
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
                                    data-bs-target="#viewCModal">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                    <div class="embed-responsive">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d31391.57433512359!2d123.95270045000001!3d10.42579715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1667039419823!5m2!1sen!2sph"
                            onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));'
                            style="height:200px;width:100%;border:none;overflow:hidden;"></iframe>
                    </div>
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
                            <p><b>Payment Method:</b></p>
                        </div>
                        <div class="form-group col-md-5">
                            <p name="paymentMethod">Cash on Deliver</p>
                        </div>
                        <div class="form-group col-md-2">
                            <p><b>Proof of Payment:</b></p>
                        </div>
                        <div class="form-group col-md-3">
                            <p name="paymentProof"><a href="">gt.sharitylink</a></p>
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

    <!-- View Modal - In progress -->
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
                                <p><b>Payment Method:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="paymentMethod">Cash on Deliver</p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Proof of Payment:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="paymentProof"><a href="">gt.sharitylink</a></p>
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
                                <p><b>Delivered Date:</b></p>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Modal - Complete Orders -->
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
                                <p><b>Payment Method:</b></p>
                            </div>
                            <div class="form-group col-md-5">
                                <p name="paymentMethod">Cash on Deliver</p>
                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Proof of Payment:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="paymentProof"><a href="">gt.sharitylink</a></p>
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
                                <p><b>Delivered Date:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="deliveredDate">10/22/22 10:50:60 AM</p>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="form-group col-md-2">

                            </div>
                            <div class="form-group col-md-5">

                            </div>
                            <div class="form-group col-md-2">
                                <p><b>Completed Date:</b></p>
                            </div>
                            <div class="form-group col-md-3">
                                <p name="completedDate">10/22/22 11:05:60 AM</p>
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
        import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js';
        import { getDatabase, ref, onValue } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-database.js';
        import { setImage, setLink } from './js/firebasehelper.js';
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

        //Read Purchases
        const purchases = ref(database, 'Purchases/');
        onValue(purchases, (snapshot) => {
            //Data
            const data = snapshot.val();

            //Initialize Tables
            var tablePending = $('#tablePending').DataTable();
            tablePending.clear().draw();

            //Tables
            for (var key in data) {

                //Pending Table
                if(data[key]['status'] == 'Pending'){
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
            }

            //Pending Modal
            $('.pendingModal').click(function(){
                var x = $(this).closest('tr').attr('id');

                for (var key in data) {
                    if(data[key]['id'] == x){
                        ////Date Format
                        var dateFormat = new Date(data[key]['purchaseAt']);

                        //Assign Values
                        $('#orderID').text(data[key]['id']);
                        $('#orderDate').text(dateFormat.toLocaleDateString() + ' ' + dateFormat.toLocaleTimeString());
                        $('#purchasedName').text(data[key]['contactAddress']['name']);
                        $('#noOfProduct').text(data[key]['noOfProduct']);
                        $('#purchasedAdress').text(data[key]['contactAddress']['address']);
                        $('#totalAmount').text(data[key]['total']);
                        $('#paymentMethod').text(data[key]['modeOfPayment']);
                        $('#totalAmount').text('P ' + data[key]['total']);

                        if(data[key]['paymentProof'] == 'none'){
                            $('#paymentProof').text(data[key]['paymentProof']);
                        } else {
                            setLink('#paymentProof', data[key]['paymentProof']);
                            $('#paymentProof').text('Click Here');
                        }

                        //Products
                        var tablePendingModal = $('#tablePendingModal').DataTable();
                        tablePendingModal.clear().draw();
                        for(var i = 0; i < data[key]['products'].length; i++ ){
                            //Item Image
                            setImage(data[key]['products'][i]['id'], data[key]['products'][i]['image']);

                            //Table Row
                            tablePendingModal.row.add([
                                data[key]['products'][i]['id'],
                                '<img id="image'+ data[key]['products'][i]['id'] + '" class="img-thumbnail" id="image" style="width:250px; height:300px;">',
                                'P ' + data[key]['products'][i]['price'],
                            ]).node().id = data[key]['products'][i]['id'];
                            tablePendingModal.draw(false);
                        }

                        //Modal Action
                        $('#actionAccept').attr('action', '/purchase/acceptPurchase/' + data[key]['id']);
                        //$('#actionReject').attr('action', '/donation/rejectDonation/' + data[key]['id']);
                    }
                }
            });

        });

        //Modals



    </script>
@stop
