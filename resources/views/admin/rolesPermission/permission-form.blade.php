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
                            @php
                                $permission = $permissions->where('menu_id', $menu->id)->first();
                                // dd($permission);
                            @endphp
                            <tr>
                                <td>{{ $n++ }}</td>
                                <td>{{ $menu->title }}
                                    <input type="hidden" name="menu_id[]" value="{{ $menu->id }}">
                                </td>
                                <td>
                                    <div class="form-check form-switch d-flex">
                                        <input class="form-check-input mx-auto" type="checkbox"
                                            id="isinsert_{{ $permission->id }}"
                                            {{ isset($permission) && $permission->isinsert == 'Y' ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch d-flex">
                                        <input class="form-check-input mx-auto" type="checkbox"
                                            id="isedit_{{ $permission->id }}"
                                            {{ isset($permission) && $permission->isedit == 'Y' ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch d-flex">
                                        <input class="form-check-input mx-auto" type="checkbox"
                                            id="isupdate_{{ $permission->id }}"
                                            {{ isset($permission) && $permission->isupdate == 'Y' ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch d-flex">
                                        <input class="form-check-input mx-auto" type="checkbox"
                                            id="isdelete_{{ $permission->id }}"
                                            {{ isset($permission) && $permission->isdelete == 'Y' ? 'checked' : '' }}>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Menu Assign Yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('role.index') }}" class="btn btn-dark">Back</a>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".form-check-input").on("change", function() {
                let checked = $(this);
                if (checked.prop("checked")) {
                    checked.val("Y");
                } else {
                    checked.val("N");
                }
                let value = checked.val();
                let data_status = $(this).attr("id").split("_")[0];
                let data_id = $(this).attr("id").split("_")[1];
                console.log(data_status, data_id);
                $.ajax({
                    type: "post",
                    url: "/admin/permission/update/status",
                    data: {
                        "data_value": value,
                        "data_status": data_status,
                        "data_id": data_id,
                    },
                    success: function(res) {

                    }
                })
            })
        })
    </script>
@endsection
