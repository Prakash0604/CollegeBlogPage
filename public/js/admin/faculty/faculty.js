$(document).ready(function () {
    getData();
});

function getData() {
    $("#fetch-degree-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/faculty",
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
            },
            {
                data: "status",
                orderable: false,
                searchable: false,
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
                    url: "faculty/status/" + id,
                    type: "get",
                    success: function (res) {
                        if (res.status == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Success!",
                                text: "Status Changed Successfully!",
                                showConfirmButton: false,
                                timer: 1000,
                            });
                            checked.prop("disabled", false);
                            $("#fetch-degree-data")
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
    .off("click", "#addFacultyBtn")
    .on("click", "#addFacultyBtn", function () {
        // clear();
        $("#formModal").modal("show");
        $("#staticBackdropLabel").text("Add Degree");
        $(".addForm").attr("id", "storeFaculty");
        $("#storeFaculty")[0].reset();
        $("#createDegreeBtn").show();
        $("#updateDegreeBtn").hide();
    });

$(document)
    .off("submit", "#storeFaculty")
    .on("submit", "#storeFaculty", function (event) {
        event.preventDefault();
        let formdata = new FormData(this);
        $("#createDegreeBtn").prop("disabled", true);
        $.ajax({
            url: "/admin/faculty",
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Degree Created Successfully",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    $("#storeFaculty")[0].reset();
                    $("#formModal").modal("hide");
                    $("#fetch-degree-data").DataTable().destroy().clear();
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
                $("#createDegreeBtn").prop("disabled", false);
            },
        });
    });

$(document)
    .off("click", ".deleteDegreeBtn")
    .on("click", ".deleteDegreeBtn", function () {
        let dataUrl = $(this).attr("data-url");
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
                    url: dataUrl,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        if (response.status == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Degree Deleted Successfully",
                                showConfirmButton: false,
                                timer: 1000,
                            });
                            $("#fetch-degree-data")
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
    .off("click", ".editDegreeBtn")
    .on("click", ".editDegreeBtn", function () {
        let url = $(this).attr("data-url");
        $("#createDegreeBtn").hide();
        $("#updateDegreeBtn").show();
        $("#staticBackdropLabel").text("Update Degree");
        $(".addForm").attr("id", "updateDegree");
        $.ajax({
            method: "get",
            url: url,
            success: function (response) {
                if (response.status == true) {
                    console.log(response);
                    $("#formModal").modal("show");
                    $("#title").val(response.message.title);
                    $("#id").val(response.message.id);
                }
            },
        });
    });

$(document)
    .off("submit", "#updateDegree")
    .on("submit", "#updateDegree", function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let url = "/admin/faculty/" + id;
        let formdata = new FormData(this);
        formdata.append("_method", "PUT");
        $.ajax({
            method: "post",
            url: url,
            data: formdata,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Degree Updated Successfully",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    $("#fetch-degree-data").DataTable().destroy().clear();
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
    .off("click", ".assignSubjectBtn")
    .on("click", ".assignSubjectBtn", function () {
        $("#assignSubjectformModal").modal("show");
        $(".addForm").attr("id", "storeSubject");
        $("#storeSubject")[0].reset();
        $("#degree_id").val($(this).attr("data-id"));
        $("#assignCreateSubjectBtn").show();
        $("#assignUpdateSubjectBtn").hide();
    });

$(document)
    .off("submit", "#storeSubject")
    .on("submit", "#storeSubject", function (e) {
        e.preventDefault();
        let formdata = new FormData(this);
        $("#assignCreateSubjectBtn").prop("disabled", true);
        $.ajax({
            url: "/admin/faculty/batch/subject",
            method: "post",
            data: formdata,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Subject Added Successfully",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    $("#storeSubject")[0].reset();
                    $("#fetch-degree-data").DataTable().destroy().clear();
                    getData();
                    $("#assignSubjectformModal").modal("hide");
                }
            },
            error: function (xhr) {
                console.log(xhr);
                Swal.fire({
                    icon: "warning",
                    title: "Something went wrong!",
                });
            },
            complete: function () {
                $("#assignCreateSubjectBtn").prop("disabled", false);
            },
        });
    });

$(document).on("change", "#batch_type_id", function () {
    let data = $(this).val();
    $.ajax({
        url: "/admin/faculty/batch/type/" + data,
        type: "get",
        success: function (res) {
            let response = res.message;
            let html = ` <option value="">Select one</option>`;
            $("#semester_id").empty();
            $.each(response, function (id, data) {
                html += ` <option value="${data.id}">${data.title}</option>`;
            });
            $("#semester_id").append(html);
        },
    });
});

$(document).on("click", ".addMoreBtn", function () {
    let optionsHtml = `<option value="">Select one</option>`;
    $.each(subjects, function (id, data) {
        optionsHtml += `<option value="${data.id}">${data.title}</option>`;
    });
    let html = `
            <div class="row mt-2">
                <div class="col-md-8">
                    <label for="" class="form-label">Subject</label>
                    <select class="form-select subjects" name="subject_id[]" id="">
                        ${optionsHtml}
                    </select>
                </div>
                <div class="col-md-4 mt-4">
                    <button type="button" class="btn btn-primary addMoreBtn">Add More</button>
                    &nbsp;
                    <button type="button" class="btn btn-danger removeBtn">Remove</button>
                </div>
            </div>`;

    $(".appendMoreRow").append(html);
});

$(document).on("click", ".removeBtn", function () {
    $(this).closest(".row").remove();
});

function getSubject() {
    $("#view_degree_subject").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/admin/faculty/batch/subject/show",
            type: "POST",
            data: function (d) {
                d.semester_id = $("#view_semester_id").val();
                d.batch_type_id = $("#view_batch_type_id").val();
                d.degree_id = $("#view_degree_id").val();
                d.batch_id = $("#view_batch_id").val();
            },
        },
        order: [2, "asc"],
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "subject",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
        language: {
            emptyTable: "No subject has been assigned",
        },
    });
}
$(document)
    .off("click", ".viewSubjectBtn")
    .on("click", ".viewSubjectBtn", function () {
        let uid = $(this).attr("data-id");
        $("#view_degree_id").val(uid);
        $("#view_degree_subject tbody").empty();
        $("#viewSubjectformModal").modal("show");
    });

$(document).on("change", "#view_batch_type_id", function () {
    let data = $(this).val();
    $.ajax({
        url: "/admin/faculty/batch/type/" + data,
        type: "get",
        success: function (res) {
            let response = res.message;
            let html = ` <option value="">Select one</option>`;
            $("#view_semester_id").empty();
            $.each(response, function (id, data) {
                html += ` <option value="${data.id}">${data.title}</option>`;
            });
            $("#view_semester_id").append(html);
        },
    });
});

$(document)
    .off("change", "#view_semester_id")
    .on("change", "#view_semester_id", function () {
        let semester = $(this).val();
        let batch_type = $("#view_batch_type_id").val();
        let degree_id = $("#view_degree_id").val();
        let batch_id = $("#view_batch_id").val();
        $("#view_degree_subject tbody").empty();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/admin/faculty/batch/subject/show",
            type: "post",
            data: {
                semester_id: semester,
                batch_type_id: batch_type,
                degree_id: degree_id,
                batch_id: batch_id,
            },
            success: function (res) {
                console.log(res);
                if (res.recordsTotal > 0) {
                    $("#view_degree_subject").DataTable().destroy();
                    getSubject();
                } else {
                    $("#view_degree_subject").DataTable().destroy();
                    $("#view_degree_subject tbody").html(
                        `<tr><td colspan="3" class="text-center">No Subject Assigned</td></tr>`
                    );
                }
            },
            error: function (xhr) {
                console.log(xhr);
            },
        });
    });

$(document)
    .off("click", ".deleteDegreeSubjectBtn")
    .on("click", ".deleteDegreeSubjectBtn", function () {
        let dataUrl = $(this).attr("data-url");
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
                    url: dataUrl,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        if (response.status == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Subject Deleted Successfully",
                                showConfirmButton: false,
                                timer: 1000,
                            });
                            $("#view_degree_subject").DataTable().destroy();
                            getSubject();
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
