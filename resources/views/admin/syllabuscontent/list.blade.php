@extends('admin.layout.main')
@section('content')
    <div class="container-fluid">
        <button type="button" class="btn btn-primary" id="addSyllabusBtn">
            Add Syllabus
          </button>
          @include('admin.syllabuscontent.modal')
          <div
            class="table-responsive mt-4 mb-4"
          >
            <table
                class="table table-bordered table-striped "
                id="fetch-syllabus-data"
            >
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Faculty</th>
                        <th scope="col">Batch</th>
                        <th scope="col">Type</th>
                        <th scope="col">Semester/Year</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
          </div>


    </div>
@endsection
