@extends('layouts.admin.main')

@section('title', 'Admin | Add Registration')

@section('contents')
    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-3">Add Registration</h1>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route('admin.registrations') }}" class="btn btn-outline-primary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('partials.alerts')

                    <form action="{{ route('admin.registration.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="student">Students</label>
                            <select class="form-select @error('student') is-invalid @enderror" name="student" id="student">
                                <option value="" selected hidden disabled>Please select the student</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}" {{ $student->id == old('student') ?  "selected" : "" }}>{{ $student->user->name }}</option>
                                @endforeach
                            </select>

                            @error('student')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="course">Courses</label>
                            <select class="form-select @error('course') is-invalid @enderror" name="course" id="course">
                                <option value="" selected hidden disabled>Please select the course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" {{ $course->id == old('course') ?  "selected" : "" }}>{{ $course->name }}</option>
                                @endforeach
                            </select>

                            @error('course')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="submit" value="Submit" class="btn btn-primary" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
