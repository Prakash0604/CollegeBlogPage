@extends('admin.layout.main')
@section('content')
    <div class="container-fluid">
        <button type="button" class="btn btn-primary" id="addRoleBtn">
            <i class="bi bi-plus-lg"></i>  Add Role
          </button>
          @include('admin.rolesPermission.modal')

          <div
            class="table-responsive mt-4 mb-4"
          >
            <table
                class="table table-bordered table-striped "
                id="fetch-role-data"
            >
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Title</th>
                        <th scope="col">Status</th>
                        <th scope="col">Permission</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
          </div>
    </div>
@endsection
