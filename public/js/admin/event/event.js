$(document).ready(function () {
    getData();
    $(".description").summernote({
        height: 400,
    });
});

function getData() {
    $("#fetch-event-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/event",  // Change URL for events
        order: [2, "asc"],
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "image",
                name: "image",
                orderable: false,
                searchable: false,
            },
            {
                data: "title",
                name: "title",
            },
            {
                data: "description",
                name: "description",
            },
            {
                data: "type",
                name: "type",
            },
            {
                data: "visibility",
                name: "visibility",
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
    $(".description").summernote("code", "");
    $("select").removeClass("is-invalid");
    $("input").removeClass("is-invalid");
    $(".appendImage").html("");
}

$(document).on("click", "#addEventBtn", function () {
    clear();
    $("#formModal").modal("show");
    $("#staticBackdropLabel").text("Add Event");
    $(".addForm").attr("id", "eventAdd");
    $("#eventAdd")[0].reset();
    $("#createEventBtn").show();
    $("#updateEventBtn").hide();
});

$(document)
    .off("submit", "#eventAdd")
    .on("submit", "#eventAdd", function (event) {
        event.preventDefault();
        let formdata = new FormData(this);
        $("#createEventBtn").prop("disabled", true);
        $.ajax({
            url: "/admin/event",  // Change URL for events
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status == 200) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Event Created Successfully",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    $("#eventAdd")[0].reset();
                    $("#formModal").modal("hide");
                    $("#fetch-event-data").DataTable().destroy().clear();
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
            },
            complete: function () {
                $("#createEventBtn").prop("disabled", false);
            },
        });
    });

$(document)
    .off("click", ".deleteEventBtn")
    .on("click", ".deleteEventBtn", function () {
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
                    url: "/admin/event/" + id,  // Change URL for events
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        if (response.status == 200) {
                            Swal.fire({
                                icon: "success",
                                title: "Event Deleted Successfully",
                                showConfirmButton: false,
                                timer: 1000,
                            });
                            $("#fetch-event-data").DataTable().destroy().clear();
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
    .off("click", ".editEventBtn")
    .on("click", ".editEventBtn", function () {
        clear();
        let url = $(this).attr("data-url");
        $("#createEventBtn").hide();
        $("#updateEventBtn").show();
        $("#staticBackdropLabel").text("Update Event");
        $(".addForm").attr("id", "updateEvent");
        $(".appendImage").html("");
        $.ajax({
            method: "get",
            url: url,
            success: function (response) {
                if (response.status == true) {
                    $("#formModal").modal("show");
                    console.log(response);
                    $("#title").val(response.message.title);
                    $("#description").summernote(
                        "code",
                        response.message.description
                    );
                    $("#type").val(response.message.type);
                    $("#visibility").val(response.message.visibility);
                    $("#id").val(response.message.id);
                    let attachment = response.message.attachment;
                    if (attachment.length > 0) {
                        attachment.forEach((image) => {
                            let img = image.image;
                            let html = `<div class="row"> <img src="/storage/${img}" width="80" height="60" alt="" srcset="" class="mr-2 ml-2">
                             &nbsp;<button class="btn btn-danger deletImageBtn" type="button" data-id="${image.id}">Remove</button></div>`;
                            $(".appendImage").append(html);
                        });
                    }
                }
            },
        });
    });

$(document)
    .off("click", ".deletImageBtn")
    .on("click", ".deletImageBtn", function (e) {
        e.preventDefault();
        let uid = $(this).attr("data-id");
        let button = $(this);

        $.ajax({
            url: "event/image/delete/" + uid,  // Change URL for events
            type: "get",
            success: function (response) {
                if (response.status == true) {
                    Swal.fire({
                        icon: "success",
                        text: "Image Removed Successfully",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    button.closest(".row").remove();
                    $("#fetch-event-data").DataTable().destroy().clear();
                    getData();
                }
            },
        });
    });

$(document).off("submit", "#updateEvent").on("submit", "#updateEvent", function (e) {
    e.preventDefault();
    let id = $("#id").val();
    let url = "/admin/event/" + id;  // Change URL for events
    let formdata = new FormData(this);
    formdata.append("_method", "PUT");
    $.ajax({
        method: "post",
        url: url,
        data: formdata,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 200) {
                Swal.fire({
                    icon: "success",
                    title: "Event Updated Successfully",
                    showConfirmButton: false,
                    timer: 1000,
                });

                $("#fetch-event-data").DataTable().destroy().clear();
                getData();
                $("#formModal").modal("hide");
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Something went wrong!",
                });
            }
        },
    });
});

$(document)
    .off("click", ".imageListPopup")
    .on("click", ".imageListPopup", function () {
        let url = $(this).attr("data-url");
        $(".carousel-inner").empty();
        $.ajax({
            url: url,
            type: "get",
            success: function (response) {
                if (response.status == true) {
                    $("#imageCrousalModal").modal("show");
                    let images = response.message.attachment;
                    $.each(images, function (index, data) {
                        let html = `<div class="carousel-item ${index == 0 ? 'active' : ''}">
                                  <img src="/storage/${data.image}" class="d-block w-100" alt="...">
                              </div>`;
                        $(".carousel-inner").append(html);
                    });
                }
            },
        });
    });
