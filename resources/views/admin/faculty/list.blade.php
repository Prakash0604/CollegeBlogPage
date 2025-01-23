@extends('admin.layout.main')
@section('content')
    <div class="container-fluid">
        <h3 class="text-center">{{ $title }}</h3>
        <button type="button" class="btn btn-primary" id="addFacultyBtn">
            Add Degree
        </button>
        @include('admin.faculty.modal')

        <div class="table-responsive mt-4 mb-4">
            <table class="table table-bordered table-striped " id="fetch-degree-data">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Title</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <script>
            let subjects=@json($subjects);
        </script>
    </div>
@endsection
