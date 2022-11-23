@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Manage Donor')

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

    <!--Data Table-->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manage Donor/Shopper Accounts</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                    <thead class="thead-light">
                        <tr>

                            <th>No.</th>
                            <th style="width:100px;">ID</th>
                            <th>Email Address</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($manage_donor == null)
                            <tr>
                                <td class="text-center" colspan="3">No Data!</td>
                            </tr>
                        @else
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($manage_donor as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ $item['email'] }}</td>
                                    <td>{{ $item['firstName'] }}</td>
                                    <td>{{ $item['lastName'] }}</td>
                                    <td>{{ $item['status'] }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#viewModal{{ $item['id'] }}">
                                            <i class="fa-solid fa-eye"></i>
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

    <div class="card-body">
        <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
            <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                <thead class="thead-light">
                    <tr>

                        <th>No.</th>
                        <th>Address</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($manage_contact == null)
                        <tr>
                            <td class="text-center" colspan="3">No Data!</td>
                        </tr>
                    @else
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($manage_contact as $contact)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $contact['address'] }}</td>
                                <td>{{ $contact['name'] }}</td>
                                <td>{{ $contact['phone'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!--Modal-->
    @if ($manage_donor == null)
    @else
        @foreach ($manage_donor as $item)
            <!-- Modal Body -->
            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
            <div class="modal fade" id="viewModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">View Account</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="donor/{{ $item['id'] }}" method="POST">
                            <div class="modal-body">
                                @csrf
                                @method('PUT')
                                <div class="text-center">
                                    <img src="{{ asset('profile.JPG') }}" alt="..."
                                        class="img-thumbnail rounded-circle" id="image"
                                        style="width:auto; height:200px;">
                                </div>
                                <div class="form-group row mt-5">
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">First Name:</label>
                                        <input type="text" name="firstName" id="firstName"
                                            value="{{ $item['firstName'] }}" class="form-control item" disabled readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Last Name:</label>
                                        <input type="text" name="lastName" id="lastName"
                                            value="{{ $item['lastName'] }}" class="form-control item" disabled readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputSex">Sex</label>
                                        <select class="form-select mt-2"disabled readonly>
                                            <option value="Male"
                                                @php if($item['sex'] == 'Male') echo 'selected = "selected"'; @endphp>
                                                Male
                                            </option>
                                            <option value="Female"
                                                @php if($item['sex'] == 'Female') echo 'selected = "selected"'; @endphp>
                                                Female
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="form-group col-md-5">
                                        <label class="form-label" for="">Email Address:</label>
                                        <input type="text" name="email" id="email" value="{{ $item['email'] }}"
                                            class="form-control item" disabled readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Contact Number:</label>
                                        <input type="tel" name="phone" id="phone" value="{{ $item['phone'] }}"
                                            class="form-control item" disabled readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="">Date of Birth:</label>
                                        <input type="date" name="dob" id="dob" value="{{ $item['dob'] }}"
                                            class="form-control item" disabled readonly>
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="">Date of Registration:</label>
                                        <input type="datetime-local" name="dor" id="dor"
                                            value="{{ $item['dor'] }}" class="form-control item" disabled readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="">Status:</label>
                                        <input type="text" name="status" id="status"
                                            value="{{ $item['status'] }}" class="form-control item" disabled readonly>
                                    </div>
                                </div>
                            </div>

                            <!--Data Table - Contact Address-->
                            <div class="card-body">
                                <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                                    <table class="table table-hover table-bordered pt-3 display" id="example" style="">
                                        <thead class="thead-light">
                                            <tr>

                                                <th>No.</th>
                                                <th>Address</th>
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($manage_contact as $contact )
                                                @if($contact['ownerID'] == $item['id'])
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $contact['address'] }}</td>
                                                        <td>{{ $contact['name'] }}</td>
                                                        <td>{{ $contact['phone'] }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <!-- Delete Modal -->
    @if ($manage_donor == null)
    @else
        @foreach ($manage_donor as $item)
            <!-- Modal Body -->
            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
            <div class="modal fade" id="deleteModal{{ $item['id'] }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                            <!--Virtual Delete-->
                            <form action="donor/{{ $item['id'] }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
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
        $('table.display').DataTable();
    });
</script>
@stop
