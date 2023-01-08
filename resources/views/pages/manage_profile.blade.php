@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Manage Profile')

<!-- Styles -->
@section('styles')

@stop

<!-- Content -->
@section('content')
    @php
        use App\Http\Helpers\FirebaseHelper;

        $fullName = explode(' ', $admin['name']);
    @endphp
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @enderror
    <div class="container-fluid align-middle">
        <h3 class="text-dark mb-4 mt-5">Profile</h3>
        <div class="row mb-3">
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-body text-center shadow">
                        <img id="profilePhoto" class="rounded-circle mb-3 mt-4"
                            src="{{ FirebaseHelper::getLink($admin['photo']) }}"
                            style="width:200px; height:200px;  object-fit: cover; object-position: center;">
                        <div class="mb-3">
                            <input class="form-control" type="file" id="formFile" name="photo"
                                onchange="document.getElementById('profilePhoto').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <form action="profile/{{ $admin['id'] }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="col">
                            <div class="card shadow mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email">
                                                    <strong>Email</strong></label>
                                                <input class="form-control" type="email" id="email"
                                                    placeholder="Email" name="email" value="{{ $admin['email'] }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="password">
                                                    <strong>Password</strong></label>
                                                <input class="form-control" type="password" id="password"
                                                    placeholder="Password" name="password"
                                                    value="{{ $admin['password'] }}" required>
                                                <input type="checkbox" onclick="myFunction()"> <span
                                                    style="font-size:15px">Show Password</span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="firstName">
                                                    <strong>First Name</strong></label>
                                                <input class="form-control" type="text" id="firstName"
                                                    placeholder="First Name" name="firstName"
                                                    value="{{ $fullName[0] }}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="lastName">
                                                    <strong>Last Name</strong></label>
                                                <input class="form-control" type="text" id="lastName"
                                                    placeholder="Last Name" name="lastName" value="{{ $fullName[1] }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row-reverse">
                                <button class="btn btn-primary btn-sm" type="submit">Save Settings</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

<!-- Scripts -->
@section('scripts')
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@stop
