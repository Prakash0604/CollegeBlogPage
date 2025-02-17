$(document).ready(function () {
    $("#menu_id").select2({
        placeholder: "Select an option",
        dropdownParent: $("#assignMenuModal"),
    });

    $(".openAssignMenuModal").click(function () {
        $("#roleAdd")[0].reset();
        $("#assignMenuModal").modal("show");
    });
    getData();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function getData() {
    $("#fetch-role-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/role",
        order: [2, "asc"],
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "title",
                name: "title",
            }
           ,{
                data: "status",
                name: "status",
            },
            {
                data: "permission",
                name: "permission",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
}

function clear() {
    $(".warnmessage").text("");
    $("input").val("");
    $("input").removeClass("is-invalid");
}

$(document).on("click", "#addRoleBtn", function () {
    clear();
    $("#formModal").modal("show");
    $("#staticBackdropLabel").text("Add Role");
    $(".addForm").attr("id", "storeRole");
    $("#storeRole")[0].reset();
    $("#createRoleBtn").show();
    $("#updateRoleBtn").hide();
});

$(document)
    .off("submit", "#storeRole")
    .on("submit", "#storeRole", function (event) {
        event.preventDefault();
        let formdata = new FormData(this);
        $("#createRoleBtn").prop("disabled", true);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "role",
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Created!",
                        text: "Role Created Successfully",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    $("#storeRole")[0].reset();
                    $("#formModal").modal("hide");
                    $("#fetch-role-data").DataTable().destroy().clear();
                    getData();
                }
            },
            error: function (xhr) {
                console.log(xhr);
                if (xhr.status == 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (data, message) {
                        $("#" + data).addClass("is-invalid");
                        $("#" + data + "-error").text(message[0]);
                    });
                }
                // $(".createPostBtn").prop("disabled",false);
            },
            complete: function () {
                $("#createRoleBtn").prop("disabled", false);
            },
        });
    });

    $(document)
    .off("click", ".statusToggle")
    .on("click", ".statusToggle", function (e) {
        let id = $(this).attr("data-id");
        let checked = $(this);
        checked.prop("disabled", true);
        Swal.fire({
            icon: "warning",
            title: "Are you sure ?",
            text: "You wan't to change status!",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes, Change it!",
            cancelButtonColor: "#d33",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "role/status/" + id,
                    type: "get",
                    success: function (res) {
                        if (res.status == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Changed!",
                                text: "Status Changed Successfully!",
                                showConfirmButton: false,
                                timer: 1000,
                            });
                            checked.prop("disabled", false);
                            $("#fetch-role-data")
                                .Datatable()
                                .clear()
                                .destroy();
                            getData();
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Warning!",
                                text: "Something went wrong!",
                            });
                            checked.prop("disabled", false);
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr);
                        Swal.fire({
                            icon: "warning",
                            title: "Warning!",
                            text: "Something went wrong!",
                        });
                        checked.prop("disabled", false);
                    },
                    complete: function () {
                        checked.prop("disabled", false);
                    },
                });
            } else {
                checked.prop("disabled", false);
                checked.prop("checked", !checked.prop("checked"));
            }
        });
    });

$(document)
    .off("click", ".deleteRoleBtn")
    .on("click", ".deleteRoleBtn", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            icon: "warning",
            title: "Are you sure ?",
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes, Delete it!",
            cancelButtonColor: "#d33",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/admin/role/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        if (response.status == true) {
                            Swal.fire({
                                icon: "success",
                                title:"Deleted!",
                                text: "Role Deleted Successfully",
                                showConfirmButton: false,
                                timer: 1000,
                            });
                            $("#fetch-role-data").DataTable().destroy().clear();
                            getData();
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Something went wrong!",
                            });
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr);
                    },
                });
            }
        });
    });

$(document)
    .off("click", ".editRoleBtn")
    .on("click", ".editRoleBtn", function () {
        clear();
        let url = $(this).attr("data-url");
        $("#createRoleBtn").hide();
        $("#updateRoleBtn").show();
        $("#staticBackdropLabel").text("Update Role");
        $(".addForm").attr("id", "updateRole");
        $.ajax({
            method: "get",
            url: url,
            success: function (response) {
                if (response.status == true) {
                    $("#formModal").modal("show");
                    console.log(response);
                    $("#title").val(response.message.title);
                    $("#id").val(response.message.id);
                }
            },
        });
    });

    $(document).off("submit","#updateRole").on("submit","#updateRole",function(e){
        e.preventDefault();
        let id=$("#id").val();
        let url="/admin/role/"+id;
        let formdata=new FormData(this);
        formdata.append("_method","PUT");
        $.ajax({
            method:"post",
            url:url,
            data:formdata,
            contentType:false,
            processData:false,
            success:function(response){
                if (response.status == true) {

                    Swal.fire({
                        icon: "success",
                        title: "Updated!",
                        text: "Role Updated Successfully",
                        showConfirmButton: false,
                        timer: 1000,
                    });

                    $("#fetch-role-data").DataTable().destroy().clear();
                    getData();
                    $("#formModal").modal("hide");
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Something went wrong!",
                    });
                }
            }
        })
    })


    $(document)
    .off("click", ".assignMenuBtn")
    .on("click", ".assignMenuBtn", function () {
        let dataid=$(this).attr("data-id");
        $("#menu_id").empty();
        $.ajax({
            url:"role/already/assigned/data/"+dataid,
            data:"get",
            success:function(respose){
                $.each(respose.message,function(index,data){
                    let html=`<option value="${data.id}">${data.title}</option>`;
                    $("#menu_id").append(html);
                })
            }
        })
        $("#assignMenuModal").modal("show");
        $("#role_id").val($(this).attr("data-id"));
        $(".addMenu").attr("id", "storeMenus");
        $("#storeMenus")[0].reset();
        // $("#createMenuBtn").show();
        // $("#updateMenuBtn").hide();
    });

$(document)
    .off("submit", "#storeMenus")
    .on("submit", "#storeMenus", function (e) {
        e.preventDefault();
        let menu_id = $("#menu_id").val();
        let role_id = $("#role_id").val();
        let dataUrl = "role/menu/access";
        $.ajax({
            type: "post",
            url: dataUrl,
            data: {
                menu_id: menu_id,
                role_id: role_id,
            },
            success: function (res) {
                if (res.status == true) {
                    Swal.fire({
                        icon:"success",
                        title:"Saved",
                        text:"Menu Saved Successfully!",
                        showConfirmButton:false,
                        timer:1000
                    });
                    $("#assignMenuModal").modal("hide");
                   $("#fetch-role-data").DataTable().destroy().clear();
                   getData();
                }
            },
        });
    });
