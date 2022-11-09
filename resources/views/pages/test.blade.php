@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Test')

<!-- Styles -->
@section('styles')

@stop

<!-- Content -->
@section('content')
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">FirstName</th>
                    <th scope="col">LastName 3</th>
                </tr>
            </thead>
            <tbody>
                @if ($test == null)
                    <tr>
                        <td class="text-center" colspan="3">No Data!</td>
                    </tr>
                @else
                    @foreach ($test as $item)
                        <tr>
                            <td>{{ $item['ID'] }}</td>
                            <td>{{ $item['firstname'] }}</td>
                            <td>{{ $item['lastname'] }}</td>
                            <td>
                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $item['ID'] }}">
                                    Launch
                                </button>
                            </td>
                            <td>
                                <form action="test/{{ $item['ID'] }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-primary">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>

    @if ($test == null)
    @else
        @foreach ($test as $item)
            <!-- Modal Body -->
            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
            <div class="modal fade" id="modal{{ $item['ID'] }}" tabindex="-1" data-bs-backdrop="static"
                data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">{{ $item['ID'] }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="test/{{ $item['ID'] }}" method="POST">
                            <div class="modal-body">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" value="{{ $item['firstname'] }}"
                                        aria-describedby="helpId" placeholder="First Name">
                                    <small id="helpId" class="form-text text-muted">Input First Name</small>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" value="{{ $item['lastname'] }}"
                                        aria-describedby="helpId" placeholder="Last Name">
                                    <small id="helpId" class="form-text text-muted">Input Last Name</small>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    @endif

    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
    </script>

    <form action="test" method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">First Name</label>
            <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="helpId"
                placeholder="First Name">
            <small id="helpId" class="form-text text-muted">Input First Name</small>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="helpId"
                placeholder="Last Name">
            <small id="helpId" class="form-text text-muted">Input Last Name</small>
        </div>
        <button type="submit" class="btn btn-primary">Add Person</button>
    </form>
@stop

<!-- Scripts -->
@section('scripts')

@stop
