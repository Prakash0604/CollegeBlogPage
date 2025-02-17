@extends('admin.layout.main')
@section('content')
    <div class="container-fluid">
        <h3 class="text-center">{{ $title }}</h3>
        @if ($access['isinsert'] == 'Y')
        <button type="button" class="btn btn-primary" id="addStudentBtn">
            <i class="bi bi-plus-lg"></i> Add Student
        </button>
        @endif
        @include('admin.student.modal')

        <div class="table-responsive mt-4 mb-4">
            <table class="table table-bordered table-striped " id="fetch-student-data">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Batch</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
