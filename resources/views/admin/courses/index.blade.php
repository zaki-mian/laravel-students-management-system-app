@extends('layouts.admin.main')

@section('title', 'Admin | Courses')

@section('contents')

    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-3">Courses</h1>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route('admin.course.create') }}" class="btn btn-outline-primary">Add Course</a>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('partials.alerts')

                    @if (count($courses) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $course->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.course.edit', $course) }}"
                                                class="btn btn-primary">Edit</a>
                                            <a href="{{ route('admin.course.destroy', $course) }}"
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
