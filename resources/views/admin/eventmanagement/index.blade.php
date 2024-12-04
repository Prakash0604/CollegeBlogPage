@extends('admin.layout.main')

@section('content')
    <div class="container-fluid">
        <!-- Button to trigger modal for adding an event -->
        <button type="button" class="btn btn-primary" id="addEventBtn">
            Add Event
        </button>

        @include('admin.eventmanagement.eventmodal') <!-- Include the modal for event creation -->

        <div class="table-responsive mt-4 mb-4">
            <!-- Table for displaying event data -->
            <table class="table table-bordered table-striped" id="fetch-event-data">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Type</th>
                        <th scope="col">Location</th>
                        <th scope="col">Visibility</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic content will be loaded here by DataTables -->
                </tbody>
            </table>
        </div>
    </div>
@endsection



@section('extraCs')
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
