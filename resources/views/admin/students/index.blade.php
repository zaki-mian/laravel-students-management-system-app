@extends('layouts.admin.main')

@section('title', 'Admin | Students')

@section('contents')

    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-3">Students</h1>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route('admin.student.create') }}" class="btn btn-outline-primary">Add Student</a>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (count($students) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Profile Picture</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->user->name }}</td>
                                        <td>{{ $student->user->email }}</td>
                                        <td> <img src="{{ asset('uploads/' . $student->user->profile_picture) }}" alt="Profile Picture" width="50px"></td>
                                        <td>
                                            <a href="{{ route('admin.student.edit', $student) }}"
                                                class="btn btn-primary">Edit</a>
                                            <a href="{{ route('admin.student.destroy', $student) }}"
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
