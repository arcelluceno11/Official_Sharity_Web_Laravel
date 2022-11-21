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
    <div id="pendingModal"></div>

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
                                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
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
                                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
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

    <!-- Accept Modal - Modal for Pending Donation -->
    @if ($donations != null)
        @foreach ($donations as $donate)
            @if ($donate['status'] == 'Pending')
                <div class="modal fade" id="acceptModal{{ $donate['id'] }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <p name="orderID">{{ $donate['id'] }}</p>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <p><b>Donation Created:</b></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <p name="orderDate">
                                            {{ date('m/d/Y h:i:s', ($donate['donatedAt'] + 28800000) / 1000) }}</p>
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
                                        <p name="purchasedAdress">{{ $donate['contactAddress']['address'] }}
                                        </p>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <p><b>Type:</b></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <p name="type">{{ $donate['type'] }}</p>
                                    </div>
                                </div>
                                @if ($donate['type'] == 'By Piece')
                                    <div class="card-body">
                                        <div class="table-responsive " id="dataTable" role="grid"
                                            aria-describedby="dataTable_info">
                                            <table class="table table-hover table-bordered pt-3 display" id="example"
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
                                                <tbody>
                                                    @php
                                                        $num = 1;
                                                    @endphp
                                                    @foreach ($donate['items'] as $item)
                                                        <tr>
                                                            <td>{{ $num++ }}</td>
                                                            <td>
                                                                <img src="{{ FirebaseHelper::getLink($item['image']) }}"
                                                                    alt="..." class="img-thumbnail" id="image"
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
                            </div>
                            <div class="modal-footer justify-content-">
                                <form action="/donation/acceptDonation/{{ $donate['id'] }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success text-light">Accept</button>
                                </form>
                                <form action="/donation/rejectDonation/{{ $donate['id'] }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger text-light">Reject</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

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
                                                    <p name="purchasedName">{{ $donate['contactAddress']['name'] }}</p>
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


    <!-- Add Donation (Individual) Modal -Received Donations - By Bulk-->
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
                                    <img src="profile.JPG" alt="..." class="img-thumbnail"
                                        style="width:250px; height:auto;">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-success mt-4">
                                        <input class="form-control form-control-sm" type="file" id="formFileSm"
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
                        data-bs-target="#editWholeModal">Back</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Individual Modal - Received Donations - By Piece -->
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
                                    <img src="profile.JPG" alt="..." class="img-thumbnail"
                                        style="width:250px; height:auto;">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-success mt-4">
                                        <input class="form-control form-control-sm" type="file" id="formFileSm"
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
                        data-bs-target="#editWholeModal">Back</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

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

        //Donations
        const donations = ref(database, 'Donations/');
        onValue(donations, (snapshot) => {
            const data = snapshot.val();

            var tablePending = $('#tablePending').DataTable();
            tablePending.clear().draw();

            for (var key in data) {

                if(data[key]['status'] == 'Pending'){
                    tablePending.row.add([
                        data[key]['id'],
                        data[key]['contactAddress']['name'],
                        data[key]['contactAddress']['address'],
                        data[key]['noOfItem'],
                        data[key]['type'],
                        `<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#acceptModal`+ data[key]['id'] +`">
                                                <i class="fa-solid fa-check text-light"></i>
                        </button>
                        `
                    ]).draw(false);
                }

            }
        });
    </script>


@stop
