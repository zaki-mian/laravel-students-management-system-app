@extends('layouts.admin.main')

@section('title', 'Admin | Registrations')

@section('contents')

    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-3">Registrations</h1>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route('admin.registration.create') }}" class="btn btn-outline-primary">Add Registration</a>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('partials.alerts')

                    @if (count($registrations) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Student Name</th>
                                    <th>Course Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($registrations as $registration)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $registration->student->user->name }}</td>
                                        <td>{{ $registration->course->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.registration.edit', $registration) }}"
                                                class="btn btn-primary">Edit</a>
                                            <a href="{{ route('admin.registration.destroy', $registration) }}"
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger" role="alert">
                            No Record Found
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

