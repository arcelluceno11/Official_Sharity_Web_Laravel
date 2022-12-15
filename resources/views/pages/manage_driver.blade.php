@php
    use App\Http\Helpers\FirebaseHelper;
@endphp

@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Manage Driver')

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
    <!-- Driver Table -->
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="row">
                <div class="col align-self-center">
                    <h6 class="m-0 font-weight-bold text-primary">Manage Driver Accounts</h6>
                </div>

                <div class="col text-end">
                    <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                        data-bs-target="#addModal">
                        <i class="fa-solid fa-user-plus"></i><span class="ms-2"> Add Driver Account
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3" id="example" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>Code</th>
                            <th>Full Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($drivers == null)
                            <tr>
                                <td class="text-center" colspan="6">No Drivers!</td>
                            </tr>
                        @else
                            @foreach ($drivers as $driver)
                                <tr>
                                    <td>{{ $driver['code'] }}</td>
                                    <td>{{ $driver['firstName'] }} {{ $driver['lastName'] }}</td>
                                    <td>{{ $driver['status'] }}</td>
                                    <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $driver['code'] }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $driver['code'] }}">
                                            <i class="fa-solid fa-square-xmark"></i>
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

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="driver" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="{{ asset('profile.JPG') }}" alt="..." class="img-thumbnail rounded-circle"
                                id="image" style="width:auto; height:200px;">
                            <button type="button" class="btn btn-success" style="margin-left:50px;">
                                <input class="form-control" type="file" id="formFile" name="photo"
                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                            </button>
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
                                <label class="form-label" for="">Phone number:</label>
                                <input type="tel" name="phone" class="form-control item"
                                    placeholder="+639 XX XXX XXXX">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSex">Sex:</label>
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
                        <div class="form-group row mt-3 mb-5">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="inputAddress">Contact Address:</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"
                                    name="contactAddress">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Email Address:</label>
                                <input type="email" name="email" class="form-control item"
                                    placeholder="sample@gmail.com">
                            </div>
                        </div>

                        <h5 class="mb-4" style="margin-top: 50px;">Vehicle Information (Not scope of the system)</h5>
                        <div class="form-group row mb-5 mt-0">
                            <div class="form-group col-md-4 ">
                                <label class="form-label" for="">License Number:</label>
                                <input type="email" name="licenseNum" class="form-control item"
                                    placeholder=" I-LUV-Y04">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Expiration Date:</label>
                                <input type="password" name="expDate" class="form-control item">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Document File:</label>
                                <input type="file" name="licenseDoc" class="form-control item">
                            </div>
                        </div>
                        <div class="form-group row mb-5" style="margin-top:-35px;">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Plate Number:</label>
                                <input type="email" name="plateNum" class="form-control item"
                                    placeholder=" I-LUV-Y04">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Renewal Date:</label>
                                <input type="password" name="renDate" class="form-control item">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="">Document File:</label>
                                <input type="file" name="vehicleDoc" class="form-control item">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    @if ($drivers == null)
    @else
        @foreach ($drivers as $driver)
            <div class="modal fade" id="editModal{{ $driver['code'] }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form action="driver/{{ $driver['code'] }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <img src="{{ FirebaseHelper::getLink($driver['photo']) }}" alt="..."
                                        class="img-thumbnail rounded-circle" id="image"
                                        style="width:auto; height:200px;">
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">First Name:</label>
                                        <input type="text" name="fname" value="{{ $driver['firstName'] }}"
                                            class="form-control item" placeholder="First Name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Middle Name:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Last Name:</label>
                                        <input type="text" name="lname" value="{{ $driver['lastName'] }}"
                                            class="form-control item" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="">Phone number:</label>
                                        <input type="tel" name="phone" value="{{ $driver['phone'] }}"
                                            class="form-control item" placeholder="+639 XX XXX XXXX">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputSex">Sex</label>
                                        <select class="form-select mt-2" aria-label="Default select example"
                                            name="sex">
                                            @if ($driver['sex'] == 'Male')
                                                <option>Choose...</option>
                                                <option value="Male" selected>Male</option>
                                                <option value="Female">Female</option>
                                            @else
                                                <option>Choose...</option>
                                                <option value="Male">Male</option>
                                                <option value="Female" selected>Female</option>
                                            @endif

                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="">Date of Birth:</label>
                                        <input type="date" name="dob" class="form-control item"
                                            value="{{ date('Y-m-d', strtotime($driver['dob'])) }}">
                                    </div>

                                </div>
                                <div class="form-group row mt-3">
                                    <div class="form-group col-md-10">
                                        <label for="inputAddress">Address</label>
                                        <input type="text" class="form-control" id="inputAddress"
                                            value="{{ $driver['contactAddress'] }}" placeholder="1234 Main St"
                                            name="contactAddress">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputStatus">Status</label>
                                        <fieldset disabled>
                                            <input type="text" class="form-control" id="inputStatus"
                                                value="{{ $driver['status'] }}" placeholder="Unverified" name="status">
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="form-group row mt-3 mb-5">
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Email Address:</label>
                                        <fieldset disabled>
                                            <input type="email" name="email" class="form-control item"
                                                value="{{ $driver['email'] }}" placeholder="sample@gmail.com">
                                        </fieldset>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Registered At:</label>
                                        <fieldset disabled>
                                            <input type="datetime-local" name="dateofReg" class="form-control item"
                                                value="{{ $driver['registeredAt'] }}">
                                        </fieldset>
                                    </div>
                                </div>

                                <h5 class="mb-4" style="margin-top: 50px;">Vehicle Information (Not scope of the system)
                                </h5>
                                <div class="form-group row mb-5 mt-0">
                                    <div class="form-group col-md-4 ">
                                        <label class="form-label" for="">License Number:</label>
                                        <input type="email" name="licenseNum" class="form-control item"
                                            placeholder=" I-LUV-Y04">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Expiration Date:</label>
                                        <input type="password" name="expDate" class="form-control item">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Document File:</label>
                                        <input type="file" name="licenseDoc" class="form-control item">
                                    </div>
                                </div>

                                <div class="form-group row mb-5" style="margin-top:-35px;">
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Plate Number:</label>
                                        <input type="email" name="plateNum" class="form-control item"
                                            placeholder=" I-LUV-Y04">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Renewal Date:</label>
                                        <input type="password" name="renDate" class="form-control item">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Document File:</label>
                                        <input type="file" name="vehicleDoc" class="form-control item">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <!-- Delete Modal -->
    @if ($drivers == null)
    @else
        @foreach ($drivers as $driver)
            <div class="modal fade" id="deleteModal{{ $driver['code'] }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-confirm modal-dialog-centered">
                    <div class="modal-content">
                        <form action="driver/{{ $driver['code'] }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header flex-column">
                                <div class="icon-box">
                                    <i class="fa-solid fa-xmark"></i>
                                </div>
                                <h4 class="modal-title w-100" id="exampleModalLabel">Are you sure?</h4>

                            </div>
                            <div class="modal-body">
                                <p>Do you really want to disable this driver? </p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
            $('#example').DataTable();
        });
    </script>
@stop
