@extends('admin.layout.main')
@section('content')
    <div class="container-fluid">
        <button type="button" class="btn btn-primary" id="addMenuBtn">
            <i class="bi bi-plus-lg"></i>  Add Menu
          </button>
          @include('admin.menu.modal')

          <div
            class="table-responsive mt-4 mb-4"
          >
            <table
                class="table table-bordered table-striped "
                id="fetch-menu-data"
            >
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Title</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Redirect</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
          </div>


    </div>
@endsection
