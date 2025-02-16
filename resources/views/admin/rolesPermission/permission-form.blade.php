@extends('admin.layout.main')

@section('content')
    <div class="container-fluid">
        <form action="" method="POST">
            @csrf
            @method('POST') <!-- Change method as required -->

            <div class="table-responsive mt-4 mb-4">
                <table class="table table-bordered table-striped" id="fetch-role-data">
                    <thead>
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col" class="text-center">Title</th>
                            <th scope="col" class="text-center">Create</th>
                            <th scope="col" class="text-center">Edit</th>
                            <th scope="col" class="text-center">Update</th>
                            <th scope="col" class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n=1; @endphp
                        @forelse ($menus as $menu)
                            <tr>
                                <td>{{ $n++ }}</td>
                                <td>{{ $menu->title }}
                                    <input type="hidden" name="menu_id[]" value="{{ $menu->id }}">
                                </td>
                                <td>
                                    <div class="form-check form-switch d-flex">
                                        <input class="form-check-input mx-auto" type="checkbox"
                                            name="isinsert[{{ $menu->id }}]" value="1">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch d-flex">
                                        <input class="form-check-input mx-auto" type="checkbox"
                                            name="isedit[{{ $menu->id }}]" value="1">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch d-flex">
                                        <input class="form-check-input mx-auto" type="checkbox"
                                            name="isupdate[{{ $menu->id }}]" value="1">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch d-flex">
                                        <input class="form-check-input mx-auto" type="checkbox"
                                            name="isdelete[{{ $menu->id }}]" value="1">
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No data found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
@endsection
