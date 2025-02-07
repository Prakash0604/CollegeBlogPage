@extends('admin.layout.main')
@section('content')
    <div class="container-fluid">
        <button type="button" class="btn btn-primary" id="addEventBtn">
            <i class="bi bi-plus-lg"></i>  Add Event
          </button>
          @include('admin.event.eventmodal')

          <div
            class="table-responsive mt-4 mb-4"
          >
{{-- form  --}}
          @include('admin.event.create_event')
            <table
                class="table table-bordered table-striped "
                id="fetch-post-data"
            >
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Type</th>
                        <th scope="col">Visibility</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
          </div>


    </div>
@endsection
