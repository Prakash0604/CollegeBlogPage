$(document).ready(function () {
    getData();
});

function getData() {
    $("#fetch-event-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "event",
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
                data: "description",
                name: "description",
            },
            {
                data: "type",
                name: "type",
            },
            {
                data: "start_date",
                name: "start_date",
            },
            {
                data: "end_date",
                name: "end_date",
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
    // $(".description").summernote("code", "");
    $("select").removeClass("is-invalid");
    $("input").removeClass("is-invalid");
    $(".appendImage").html("");
}

$(document).on("click", "#addEventBtnToggle", function () {
    clear();
    $("#createEventModal").modal("show");
    // $("#staticBackdropLabel").text("Add Event");
    // $(".addForm").attr("id", "eventAdd");
    // $("#eventAdd")[0].reset();
    $("#saveEventBtn").show();
    $("#updateEventBtn").hide();
});

$(document)
    .off("submit", "#storeEvent")
    .on("submit", "#storeEvent", function (e) {
        e.preventDefault();
        let formdata = new FormData(this);
        $(".eventDate").each(function () {
            formdata.append("eventDate[]", $(this).val());
        });

        $(".eventStartTime").each(function () {
            formdata.append("eventStarttime[]", $(this).val());
        });

        $(".eventEndTime").each(function () {
            formdata.append("eventendTime[]", $(this).val());
        });

        $(".eventDescription").each(function () {
            formdata.append("eventDescription[]", $(this).val());
        });
        $("#saveEventBtn").prop("disabled", true);
        $.ajax({
            url: "event",
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Event Created Successfully",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    $("#storeEvent")[0].reset();
                    $("#createEventModal").modal("hide");
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
                $("#saveEventBtn").prop("disabled", false);
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
                    url: "/admin/event/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        if (response.status == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Event Deleted Successfully",
                                showConfirmButton: false,
                                timer: 1000,
                            });
                            $("#fetch-event-data")
                                .DataTable()
                                .destroy()
                                .clear();
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
        // clear();
        $(".fetchSheduleDate").empty();

        let url = $(this).attr("data-url");
        $("#saveEventBtn").hide();
        $("#updateEventBtn").show();
        // $("#staticBackdropLabel").text("Update Event");
        $(".addForm").attr("id", "updateEvent");
        $(".appendImage").html("");
        $.ajax({
            method: "get",
            url: url,
            success: function (response) {
                if (response.status == true) {
                    $("#createEventModal").modal("show");
                    console.log(response);
                    $("#event_title").val(response.event.title);
                    $("#event_description").val(response.event.description);
                    $("#eventColor").val(response.event.color);
                    let sheduled = response.event.event_sheduled;
                    if (
                        response.event.type != null &&
                        response.event.type == "range"
                    ) {
                        $("#rangeToggle")
                            .prop("checked", true)
                            .trigger("change");
                        $("#event_start_date").val(response.event.start_date);
                        $("#event_end_date").val(response.event.end_date);
                        $("#applyDateRange").trigger("click");
                        $("#updateSheduleDate").removeClass("d-none");
                        let html = "";
                        $.each(sheduled, function (index, data) {
                            html = ` <tr>
                        <td>${data.date}</td>
                        <td>${data.start_time}</td>
                        <td>${data.end_time}</td>
                        <td>${data.description}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger mx-1 editremoveSchedule"  data-id="${data.id}" style="cursor:pointer;">Delete</button>
                        </td>
                    </tr>`;
                            $(".fetchSheduleDate").append(html);
                        });
                    } else {
                        $("#individualToggle")
                            .prop("checked", true)
                            .trigger("change");
                        $.each(sheduled, function (index, data) {
                            html = ` <tr>
                            <td>${data.date}</td>
                            <td>${data.start_time}</td>
                            <td>${data.end_time}</td>
                            <td>${data.description}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger mx-1 editremoveSchedule" data-id="${data.id}"  style="cursor:pointer;">Delete</button>
                            </td>
                        </tr>`;
                            $(".fetchSheduleDate").append(html);
                        });
                        // $("#")
                    }
                    // $("#description").summernote(
                    //     "code",
                    //     response.message.description
                    // );
                    // $("#type").val(response.message.type);
                    // $("#visibility").val(response.message.visibility);
                    // $("#id").val(response.message.id);
                    // let attachment = response.message.attachment;
                    // if (attachment.length > 0) {
                    //     attachment.forEach((image) => {
                    //         let img = image.image;
                    //         let html = `<div class="row"> <img src="/storage/${img}" width="80" height="60" alt="" srcset="" class="mr-2 ml-2">
                    //          &nbsp;<button class="btn btn-danger deletImageBtn" type="button" data-id="${image.id}">Remove</button></div>`;
                    //         $(".appendImage").append(html);
                    //     });
                    // }
                }
            },
        });
    });

$(document)
    .off("click", ".editremoveSchedule")
    .on("click", ".editremoveSchedule", function () {
        let id = $(this).attr("data-id");
        btnClick=$(this);
        $.ajax({
            type: "get",
            url: "event/sheduled/delete/" + id,
            success: function (response) {
                if (response.status == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Deleted!",
                        text: "Schedule Deleted Successfully!",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    btnClick.closest('tr').remove();
                    $("#fetch-event-data").DataTable().destroy().clear();
                    getData();
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Warning",
                        text: "Something went wrong!",
                    });
                }
            },
        });
    });
$(document)
    .off("submit", "#updateEvent")
    .on("submit", "#updateEvent", function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let url = "/admin/event/" + id; // Change URL for events
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
