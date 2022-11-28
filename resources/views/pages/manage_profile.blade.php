@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Manage Profile')

<!-- Styles -->
@section('styles')

@stop

<!-- Content -->
@section('content')
    <div class="container-fluid align-middle">
        <h3 class="text-dark mb-4 mt-5">Profile</h3>
        <div class="row mb-3">
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4"
                            src="assets/img/dogs/image2.jpeg" width="160" height="160">
                        <div class="mb-3"><button class="btn btn-primary btn-sm" type="button">Change Photo</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col">
                        <div class="card shadow mb-3">
                            <div class="card-body">
                                <form class="p-3">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"
                                                    for="username"><strong>Username</strong></label><input
                                                    class="form-control" type="text" id="username"
                                                    placeholder="user.name" name="username" required></div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Email
                                                        Address</strong></label><input class="form-control" type="email"
                                                    id="email" placeholder="user@example.com" name="email" required></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="first_name"><strong>First
                                                        Name</strong></label><input class="form-control" type="text"
                                                    id="first_name" placeholder="John" name="first_name" required></div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="last_name"><strong>Last
                                                        Name</strong></label><input class="form-control" type="text"
                                                    id="last_name" placeholder="Doe" name="last_name" required></div>
                                        </div>
                                    </div>
                                    <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">Save
                                            Settings</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop

    <!-- Scripts -->
    @section('scripts')

    @stop
