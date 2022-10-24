@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Manage Admin')

<!-- Styles -->
@section('styles')

@stop

<!-- Content -->
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manage Admin Accounts</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="10px">No.</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Surname</th>
                            <th>Status</th>
                            <th width="95px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm">Edit</a>
                                <a href="#deleteModal" class="btn btn-danger btn-sm" data-toggle="modal">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop

<!-- Scripts -->
@section('scripts')

@stop
