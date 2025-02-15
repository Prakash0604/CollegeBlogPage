$(document).ready(function () {
    getData();
});

function getData() {
    $("#fetch-menu-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/menu",
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
            },
            {
                data: "icon",
                name: "icon",
            },
            {
                data: "redirect",
                name: "redirect",
            },{
                data: "status",
                name: "status",
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
}

$(document).on("click", "#addMenuBtn", function () {
    clear();
    $("#formModal").modal("show");
    $("#staticBackdropLabel").text("Add Menu");
    $(".addForm").attr("id", "storeMenu");
    $("#storeMenu")[0].reset();
    $("#createMenuBtn").show();
    $("#updateMenuBtn").hide();
});

$(document)
    .off("submit", "#storeMenu")
    .on("submit", "#storeMenu", function (event) {
        event.preventDefault();
        let formdata = new FormData(this);
        $("#createMenuBtn").prop("disabled", true);
        $.ajax({
            url: "/admin/menu",
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Created!",
                        text: "Menu Created Successfully",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    $("#storeMenu")[0].reset();
                    $("#formModal").modal("hide");
                    $("#fetch-menu-data").DataTable().destroy().clear();
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
                $("#createMenuBtn").prop("disabled", false);
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
                    url: "menu/status/" + id,
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
                            $("#fetch-menu-data")
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
    .off("click", ".deleteMenuBtn")
    .on("click", ".deleteMenuBtn", function () {
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
                    url: "/admin/menu/" + id,
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
                                text: "Menu Deleted Successfully",
                                showConfirmButton: false,
                                timer: 1000,
                            });
                            $("#fetch-menu-data").DataTable().destroy().clear();
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
    .off("click", ".editMenuBtn")
    .on("click", ".editMenuBtn", function () {
        clear();
        let url = $(this).attr("data-url");
        $("#createMenuBtn").hide();
        $("#updateMenuBtn").show();
        $("#staticBackdropLabel").text("Update Menu");
        $(".addForm").attr("id", "updateMenu");
        $.ajax({
            method: "get",
            url: url,
            success: function (response) {
                if (response.status == true) {
                    $("#formModal").modal("show");
                    console.log(response);
                    $("#title").val(response.message.title);
                    $("#icon").val(response.message.icon);
                    $("#redirect").val(response.message.redirect);
                    $("#id").val(response.message.id);
                }
            },
        });
    });

    $(document).off("submit","#updateMenu").on("submit","#updateMenu",function(e){
        e.preventDefault();
        let id=$("#id").val();
        let url="/admin/menu/"+id;
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
                        text: "Post Updated Successfully",
                        showConfirmButton: false,
                        timer: 1000,
                    });

                    $("#fetch-menu-data").DataTable().destroy().clear();
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

