@php
    use App\Http\Helpers\FirebaseHelper;
@endphp

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
                <table class="table table-hover table-bordered pt-3 display" id="tablePending" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>Donation ID</th>
                            <th>Donated By</th>
                            <th>Address</th>
                            <th>No. of Items</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    <tbody>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Pending Donations Modal -->
    <div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <h4 class="modal-title w-100" id="exampleModalLabel">Accept this Donation?</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row mt-1">
                        <div class="form-group col-md-2">
                            <p><b>Donation ID:</b></p>
                        </div>
                        <div class="form-group col-md-5">
                            <p id="orderID"></p>
                        </div>
                        <div class="form-group col-md-2">
                            <p><b>Donation Created:</b></p>
                        </div>
                        <div class="form-group col-md-3">
                            <p id="orderDate"></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="form-group col-md-2">
                            <p><b>Donated By:</b></p>
                        </div>
                        <div class="form-group col-md-5">
                            <p id="purchasedName"></p>
                        </div>
                        <div class="form-group col-md-2">
                            <p><b>No. of Items:</b></p>
                        </div>
                        <div class="form-group col-md-3">
                            <p id="noItems"></p>
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
                            <p><b>Type:</b></p>
                        </div>
                        <div class="form-group col-md-3">
                            <p id="type"></p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table table-hover table-bordered pt-3 display" id="tablePendingModal"
                                style="">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Sex</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-">
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

    <!-- Pending Donations Toast -->
    <div class="toast-container">
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toastPending" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Donations</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    A New Donation Order Placed!
                </div>
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
                            <th>Task No.</th>
                            <th>Donation ID</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks['data']['task_list'] as $task)
                            @if ($task['status'] == 'created' && $donations != null)
                                @foreach ($donations as $donation)
                                    @if ($donation['id'] == $task['order_id'])
                                        <tr>
                                            <td>{{ $task['task_id'] }}</td>
                                            <td>{{ $task['order_id'] }}</td>
                                            <td>{{ date('D d/m/y h:i:s A', strtotime($task['updated_at'])) }}</td>
                                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#driverModal{{ $task['task_id'] }}">
                                                    <i class="fa-solid fa-truck"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
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
                            <th>Task ID</th>
                            <th>Donation ID</th>
                            <th>Status</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks['data']['task_list'] as $task)
                            @if ($task['status'] == 'in_progress' || ($task['status'] == 'assigned' && $donations != null))
                                @foreach ($donations as $donation)
                                    @if ($donation['id'] == $task['order_id'])
                                        <tr>
                                            <td>{{ $task['task_id'] }}</td>
                                            <td>{{ $task['order_id'] }}</td>
                                            <td>{{ $task['status'] }}</td>
                                            <td>{{ date('D d/m/y h:i:s A', strtotime($task['updated_at'])) }}</td>
                                            <td><button type="button" class="btn btn-primary btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#viewModal{{ $task['task_id'] }}">
                                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
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
                            <th>Task ID</th>
                            <th>Donation ID</th>
                            <th>Received</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks['data']['task_list'] as $task)
                            @if ($task['status'] == 'completed' && $donations != null)
                                @foreach ($donations as $donation)
                                    @if ($donation['id'] == $task['order_id'] && $donation['checked'] == false)
                                        <tr>
                                            <td>{{ $task['task_id'] }}</td>
                                            <td>{{ $task['order_id'] }}</td>
                                            <td>{{ date('D d/m/y h:i:s A', strtotime($task['updated_at'])) }}</td>
                                            <td><button type="button" class="btn btn-primary btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editWholeModal{{ $task['task_id'] }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
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
                <h6 class="m-0 font-weight-bold text-primary">Quality Checked Donation</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>Donation ID</th>
                            <th>Donated By</th>
                            <th>Donated To</th>
                            <th>No. of Items</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks['data']['task_list'] as $task)
                            @if ($task['status'] == 'completed' && $donations != null)
                                @foreach ($donations as $donation)
                                    @if ($donation['id'] == $task['order_id'] && $donation['checked'] == true)
                                        <tr>
                                            <td>{{ $donation['id'] }}</td>
                                            <td>{{ $donation['donatedBy'] }}</td>
                                            <td>{{ $donation['donatedTo'] }}</td>
                                            <td>{{ $donation['noOfItem'] }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Driver Modal - Modal for Waiting for Assignment-->
    @if ($tasks != null)
        @foreach ($tasks['data']['task_list'] as $task)
            @if ($task['status'] == 'created' && $donations != null)
                @foreach ($donations as $donation)
                    @if ($donation['id'] == $task['order_id'])
                        <div class="modal fade" id="driverModal{{ $task['task_id'] }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <form action="donation/assignDriver/{{ $task['task_id'] }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Assign Driver</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="embed-responsive">
                                                <iframe src="{{ $donation['shareUrl'] }}"
                                                    onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));'
                                                    style="height:200px;width:100%;border:none;overflow:hidden;"></iframe>
                                            </div>
                                            <div class="form-group row mt-1">
                                                <div class="form-group col-md-2">
                                                    <p><b>Donation ID:</b></p>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <p name="orderID">{{ $donation['id'] }}</p>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <p><b>Donation Created:</b></p>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <p name="orderDate">
                                                        {{ date('m/d/Y h:i:s', ($donation['donatedAt'] + 28800000) / 1000) }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <div class="form-group col-md-2">
                                                    <p><b>Donated By:</b></p>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <p name="purchasedName">{{ $donation['contactAddress']['name'] }}</p>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <p><b>No. of Items:</b></p>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <p name="noItems">{{ $donation['noOfItem'] }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <div class="form-group col-md-2">
                                                    <p><b>Address:</b></p>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <p name="purchasedAdress">{{ $donation['contactAddress']['address'] }}
                                                    </p>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <p><b>Type:</b></p>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <p name="type">{{ $donation['type'] }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group row d-none">
                                                <div class="form-group col-md-2">
                                                    <p><b>Driver's ID No.:</b></p>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <input type="text" class="form-control" id="driverID"
                                                        name="driverID">
                                                </div>
                                            </div>
                                            <div class="card shadow mt-3">
                                                <div class="card-body">
                                                    <div class="table-responsive " id="dataTable" role="grid"
                                                        aria-describedby="dataTable_info">
                                                        <table class="table table-hover table-bordered pt-3 display driver"
                                                            id="table" style="">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Code</th>
                                                                    <th>Name</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if ($drivers != null)
                                                                    @foreach ($drivers as $driver)
                                                                        <tr>
                                                                            <th class="code">{{ $driver['code'] }}</th>
                                                                            <th>{{ $driver['firstName'] }}
                                                                                {{ $driver['middleName'] }}
                                                                                {{ $driver['lastName'] }}</th>
                                                                            <th>{{ $driver['status'] }}</th>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="btnAssign"
                                                class="btn btn-primary driver">Assign</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        @endforeach
    @endif

    <!-- View Modal - In Progress-->
    @if ($tasks != null)
        @foreach ($tasks['data']['task_list'] as $task)
            @if ($task['status'] == 'in_progress' || ($task['status'] == 'assigned' && $donations != null))
                @foreach ($donations as $donation)
                    @if ($donation['id'] == $task['order_id'])
                        <div class="modal fade" id="viewModal{{ $task['task_id'] }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">View Order:
                                            {{ $task['order_id'] }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="embed-responsive">
                                                <iframe src="{{ $donation['shareUrl'] }}"
                                                    onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));'
                                                    style="height:200px;width:100%;border:none;overflow:hidden;"></iframe>
                                            </div>
                                            <div class="form-group row mt-1">
                                                <div class="form-group col-md-2">
                                                    <p><b>Donation ID:</b></p>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <p name="orderID">{{ $donation['id'] }}</p>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <p><b>Donation Created:</b></p>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <p name="orderDate">
                                                        {{ date('m/d/Y H:i:s', $donation['donatedAt'] / 1000) }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <div class="form-group col-md-2">
                                                    <p><b>Donated By:</b></p>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <p name="purchasedName">{{ $donate['contactAddress']['name'] }}</p>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <p><b>No. of Items:</b></p>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <p name="noItems">{{ $donate['noOfItem'] }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <div class="form-group col-md-2">
                                                    <p><b>Address:</b></p>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <p name="purchasedAdress">{{ $donation['contactAddress']['address'] }}
                                                    </p>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <p><b>Type:</b></p>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <p name="type">{{ $donation['type'] }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <div class="form-group col-md-2">
                                                    <p><b>Delivery Driver:</b></p>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <p name="deliveryDriver">{{ $donation['pickUpBy'] }}</p>
                                                </div>
                                            </div>
                                            @if ($donation['type'] == 'By Piece')
                                                <div class="card-body">
                                                    <div class="table-responsive " id="dataTable" role="grid"
                                                        aria-describedby="dataTable_info">
                                                        <table class="table table-hover table-bordered pt-3 display"
                                                            id="example" style="">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>Image</th>
                                                                    <th>Category</th>
                                                                    <th>Sex</th>
                                                                    <th>Color</th>
                                                                    <th>Size</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $num = 1;
                                                                @endphp
                                                                @foreach ($donation['items'] as $item)
                                                                    <tr>
                                                                        <td>{{ $num++ }}</td>
                                                                        <td>
                                                                            <img src="{{ FirebaseHelper::getLink($item['image']) }}"
                                                                                alt="..." class="img-thumbnail"
                                                                                id="image"
                                                                                style="width:100px; height:100px;">
                                                                        </td>
                                                                        <td>{{ $item['category'] }}</td>
                                                                        <td>{{ $item['sex'] }}</td>
                                                                        <td>{{ $item['color'] }}</td>
                                                                        <td>{{ $item['size'] }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endif
                                        </form>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Back</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        @endforeach
    @endif

    <!-- Edit Donation (As Whole) Modal -Received Donations-->
    @if ($tasks != null)
        @foreach ($tasks['data']['task_list'] as $task)
            @if ($task['status'] == 'completed' && $donations != null)
                @foreach ($donations as $donation)
                    @if ($donation['id'] == $task['order_id'] && $donation['checked'] == false)
                        <div class="modal fade" id="editWholeModal{{ $task['task_id'] }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                @if ($donation['type'] == 'By Piece')
                                    <form action="donation/qualityCheckedPiece/{{ $donation['id'] }}" method="POST">
                                        @csrf
                                        @method('POST')
                                    @else
                                        <form action="donation/qualityCheckedBulk/{{ $donation['id'] }}" method="POST">
                                            @csrf
                                            @method('POST')
                                @endif
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="embed-responsive">
                                            <iframe src="{{ $donation['shareUrl'] }}"
                                                onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));'
                                                style="height:200px;width:100%;border:none;overflow:hidden;"></iframe>
                                        </div>
                                        <div class="form-group row mt-1">
                                            <div class="form-group col-md-2">
                                                <p><b>Donation ID:</b></p>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <p name="orderID">{{ $donation['id'] }}</p>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <p><b>Donation Created:</b></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <p name="orderDate">
                                                    {{ date('m/d/Y H:i:s', $donation['donatedAt'] / 1000) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <div class="form-group col-md-2">
                                                <p><b>Donated By:</b></p>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <p name="purchasedName">{{ $donation['contactAddress']['name'] }}</p>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <p><b>No. of Items:</b></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <p name="noItems">{{ $donation['noOfItem'] }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <div class="form-group col-md-2">
                                                <p><b>Address:</b></p>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <p name="purchasedAdress">{{ $donation['contactAddress']['address'] }}
                                                </p>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <p><b>Type:</b></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <p name="type">{{ $donation['type'] }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <div class="form-group col-md-2">
                                                <p><b>Delivery Driver:</b></p>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <p name="deliveryDriver">{{ $donation['pickUpBy'] }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <div class="form-group col-md-2">
                                                <p><b>Received Date:</b></p>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <p name="receivedDate">{{ $task['updated_at'] }}</p>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive " id="dataTable" role="grid"
                                                aria-describedby="dataTable_info">
                                                @if ($donation['type'] == 'By Piece')
                                                    <table id="tableModalReceivePiece"
                                                        class="table table-hover table-bordered pt-3 display">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Image</th>
                                                                <th>Category</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $num = 1;
                                                            @endphp
                                                            @foreach ($donation['items'] as $item)
                                                                <tr>
                                                                    <td>{{ $num }}</td>
                                                                    <td>
                                                                        <img src="{{ FirebaseHelper::getLink($item['image']) }}"
                                                                            alt="..." class="img-thumbnail"
                                                                            id="image"
                                                                            style="width:100px; height:100px;">
                                                                    </td>
                                                                    <td>{{ $item['category'] }}</td>
                                                                    <td>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input radio"
                                                                                type="radio"
                                                                                name="status{{ $item['id'] }}{{ $num }}"
                                                                                id="radioStatus" value="Accepted">
                                                                            <label class="form-check-label">Accept</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input radio"
                                                                                type="radio"
                                                                                name="status{{ $item['id'] }}{{ $num++ }}"
                                                                                id="radioStatus" value="Rejected">
                                                                            <label class="form-check-label">Reject</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
                                                        <a id="addItem" class="btn btn-primary">Add Item</a>
                                                    </div>
                                                    <table id="tableModalReceiveBulk"
                                                        class="table table-hover table-bordered pt-3 display bulk">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Category</th>
                                                                <th>Color</th>
                                                                <th>Sex</th>
                                                                <th>Size</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary receive">Quality
                                            Checked</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        @endforeach
    @endif

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
            //Datatables
            $('table.display').DataTable();

            //Driver Assignment
            $('button.driver').prop('disabled', true);
            $('table.driver').on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    $('button.driver').prop('disabled', true);
                    $('#driverID').val('');
                } else {
                    $('table.driver tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $('button.driver').prop('disabled', false);
                    $('#driverID').val($('table.driver tr.selected th.code').text());
                }
            });

            //Received Donations
            $('button.receive').prop('disabled', true);
            //Piece
            var num = 0;
            $("input.radio").each(function() {
                var name = $(this).attr('name');
                $('input[name=' + name + ']').click(function() {
                    if ($("input.radio").length - 2 == num) {
                        $('button.receive').prop('disabled', false);
                    }
                    num++;
                });
            });
            //Bulk
            var bulk = $('#tableModalReceiveBulk').DataTable();
            var num = 1;
            $('#addItem').on('click', function() {
                $('button.receive').prop('disabled', false);

                bulk.row.add([
                    num,
                    `<select class="form-select form-select" name="category` + num + `">
                        <option selected>Choose Category</option>
                        <option value="Jacket and Hoodies">Jacket and Hoodies</option>
                        <option value="Shirts and Blouses">Shirts and Blouses</option>
                        <option value="Pants and Jeans">Pants and Jeans</option>
                    </select>`,
                    `<select class="form-select form-select" name="color` + num + `">
                        <option selected>Choose Color</option>
                        <option value="White">White</option>
                        <option value="Black">Black</option>
                        <option value="Red">Red</option>
                        <option value="Orange">Orange</option>
                        <option value="Yellow">Yellow</option>
                        <option value="Green">Green</option>
                        <option value="Blue">Blue</option>
                        <option value="Violet">Violet</option>
                    </select>`,
                    `<select class="form-select form-select" name="sex` + num + `">
                        <option selected>Choose Sex</option>
                        <option value="Men">Men</option>
                        <option value="Women">Women</option>
                        <option value="Unisex">Unisex</option>
                    </select>`,
                    `<select class="form-select form-select" name="size` + num + `">
                        <option selected>Choose Size</option>
                        <option value="Extra Small">Extra Small</option>
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Large">Large</option>
                        <option value="Extra Large">Extra Large</option>
                        <option value="Double Extra Large">Double Extra Large</option>
                    </select>`,
                ]).draw(false);

                num++;
            });
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

        //Read Donations
        const donations = ref(database, 'Donations/');
        onValue(donations, (snapshot) => {
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
                        data[key]['noOfItem'],
                        data[key]['type'],
                        `<button type="button" class="btnPendingModal btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#acceptModal">
                                                <i class="fa-solid fa-check text-light"></i>
                        </button>
                        `
                    ]).node().id = data[key]['id'];
                    tablePending.draw(false);

                    //Show Toast
                    new bootstrap.Toast($('#toastPending')).show();
                }
            }

            //Pending Modal
            $('.btnPendingModal').click(function(){
                var x = $(this).closest('tr').attr('id');

                for (var key in data) {
                    if(data[key]['id'] == x){
                        ////Date Format
                        var dateFormat = new Date(data[key]['donatedAt']);

                        //Assign Values
                        $('#orderID').text(data[key]['id']);
                        $('#orderDate').text(dateFormat.toLocaleDateString() + ' ' + dateFormat.toLocaleTimeString());
                        $('#purchasedName').text(data[key]['contactAddress']['name']);
                        $('#noItems').text(data[key]['noOfItem']);
                        $('#purchasedAdress').text(data[key]['contactAddress']['address']);
                        $('#type').text(data[key]['type']);

                        //Item Table
                        if(data[key]['type'] == 'By Piece'){
                            var tablePendingModal = $('#tablePendingModal').DataTable();
                            tablePendingModal.clear().draw();

                            for(var i = 0; i < data[key]['items'].length; i++ ){
                                //Item Image
                                setImage(data[key]['items'][i]['id'], data[key]['items'][i]['image']);

                                //Table Row
                                tablePendingModal.row.add([
                                    data[key]['items'][i]['id'] + 1,
                                    '<img id="image'+ data[key]['items'][i]['id'] + '" class="img-thumbnail" id="image" style="width:100px; height:100px;">',
                                    data[key]['items'][i]['category'],
                                    data[key]['items'][i]['sex'],
                                    data[key]['items'][i]['color'],
                                    data[key]['items'][i]['size'],
                                ]).node().id = data[key]['items'][i]['id'];
                                tablePendingModal.draw(false);
                            }
                        }

                        //Modal Action
                        $('#actionAccept').attr('action', '/donation/acceptDonation/' + data[key]['id']);
                        $('#actionReject').attr('action', '/donation/rejectDonation/' + data[key]['id']);
                    }
                }
            });

        });

        //Modals



    </script>


@stop
