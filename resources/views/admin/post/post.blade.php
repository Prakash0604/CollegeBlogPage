@extends('admin.layout.main')
@section('content')
    <div class="container-fluid">
        <button type="button" class="btn btn-primary" id="addPostBtn">
<<<<<<< HEAD
            Add Post
        </button>
        @include('admin.post.postmodal')
=======
            <i class="bi bi-plus-lg"></i>  Add Post
          </button>
          @include('admin.post.postmodal')
>>>>>>> 49ff76adce12c9e8563b5bb3cda3fa7db1a416f8

        <div class="table-responsive mt-4 mb-4">
            <table class="table table-bordered table-striped " id="fetch-post-data">
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
<<<<<<< HEAD
        </div>
=======
          </div>
>>>>>>> 49ff76adce12c9e8563b5bb3cda3fa7db1a416f8


    </div>
@endsection
