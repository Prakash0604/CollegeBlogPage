$(document).ready(function () {
    getData();
    $("textarea").summernote({
        height: 200,
    });
});

function getData() {
    $("#fetch-syllabus-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/syllabus-content",
        columns: [
            {
                data: "DT_RowIndex",
                searchable: false,
                orderable: false,
            },
            {
                data: "faculty",
            },
            {
                data: "batch",
            },
            {
                data: "type",
            },
            {
                data: "semester",
            },
            {
                data: "subject",
            },
            {
                data: "action",
                searchable: false,
                orderable: false,
            },
        ],
    });
}
$(document)
    .off("click", "#addSyllabusBtn")
    .on("click", "#addSyllabusBtn", function () {
        $("#formModal").modal("show");
        $(".addForm").attr("id", "storeSyllabus");
        $("#storeSyllabus")[0].reset();
        $("#createSyllabusBtn").show();
        $("#updateSyllabusBtn").hide();
    });

// On click event for faculty id to generate batch id
$(document).on("change", "#faculty_id", function () {
    let id = $(this).val();
    $("#batch_id").empty();
    $.ajax({
        url: "/admin/syllabus/get/batch/" + id,
        type: "get",
        success: function (res) {
            // console.log(res);
            if (res.status == true) {
                let html = `<option value="">Select one</option>`;
                if (res.message.length > 0) {
                    $.each(res.message, function (index, data) {
                        html += ` <option value="${data.batch.id}">${data.batch.title}</option>`;
                    });
                } else {
                    $("#batch_id").empty();
                    html = `<option value="">No data found</option>`;
                }
                $("#batch_id").empty().append(html);
            }
        },
    });
});

// On click event for batch id to generate type

$(document).on("change", "#batch_id", function () {
    let id = $(this).val();
    $("#semester_id").empty();
    $.ajax({
        url: "/admin/syllabus/get/batch-type/" + id,
        type: "get",
        success: function (res) {
            // console.log(res);
            if (res.status == true) {
                let html = `<option value="">Select one</option>`;
                if (res.message.length > 0) {
                    $.each(res.message, function (index, data) {
                        html += ` <option value="${data.year_semester.id}">${data.year_semester.title}</option>`;
                    });
                } else {
                    $("#semester_id").empty();
                    html = `<option value="">No data found</option>`;
                }
                $("#semester_id").empty().append(html);
            }
        },
    });
});

$(document).on("change", "#batch_type_id", function () {
    let batch_type_id = $(this).val();
    $("#semester_id").empty();
    let batch_id = $("#batch_id").val();
    let degree_id = $("#faculty_id").val();
    $("#subject_id").empty();
    $.ajax({
        url: "/admin/syllabus/get/type/semester/",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "post",
        data: {
            batch_type_id: batch_type_id,
            batch_id: batch_id,
            degree_id: degree_id,
        },
        success: function (res) {
            // console.log(res);
            if (res.status == true) {
                let html = `<option value="">Select one</option>`;
                if (res.message.length > 0) {
                    $.each(res.message, function (index, data) {
                        html += ` <option value="${data.year_semester.id}">${data.year_semester.title}</option>`;
                    });
                } else {
                    $("#semester_id").empty();
                    html = `<option value="">No data found</option>`;
                }
                $("#semester_id").empty().append(html);
            } else {
                Swal.fire({
                    icon: "info",
                    text: "Please select all the fields",
                });
            }
        },
    });
});

$(document).on("change", "#semester_id", function () {
    // let id = $(this).val();
    $("#subject_id").empty();
    let degree_id = $("#faculty_id").val();
    let batch_id = $("#batch_id").val();
    let batch_type_id = $("#batch_type_id").val();
    let year_semester_id = $("#semester_id").val();

    $.ajax({
        url: "/admin/syllabus/get/type/semester/subject",
        type: "post",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            degree_id: degree_id,
            batch_id: batch_id,
            batch_type_id: batch_type_id,
            year_semester_id: year_semester_id,
        },
        success: function (res) {
            // console.log(res);
            if (res.status == true) {
                let html = `<option value="">Select one</option>`;
                if (res.message.length > 0) {
                    $.each(res.message, function (index, data) {
                        $.each(
                            data.degree_subject,
                            function (subIndex, subjectData) {
                                html += `<option value="${subjectData.subject_id}">${subjectData.subject.title}</option>`;
                            }
                        );
                    });
                } else {
                    $("#subject_id").empty();
                    html = `<option value="">No data found</option>`;
                }
                $("#subject_id").empty().append(html);
            } else {
                Swal.fire({
                    icon: "info",
                    title: res.message,
                });
            }
        },
        error: function (xhr) {
            if (xhr.status == false) {
                Swal.fire({
                    icon: "warning",
                    title: xhr.message,
                });
            }
        },
    });
});

$(document).on("change", "#hasChapter", function () {
    if ($("#hasChapter").prop("checked")) {
        $("#accordionExample").removeClass("d-none");
        $("#hasChapter").val("Y");
        $("#title").prop("disabled", true);
        $("#description").prop("disabled", true);
        $("#file").prop("disabled", true);
        $("#visibility").prop("disabled", true);
        $(".chapter_name").prop("disabled", false);
        $(".chapter_title").prop("disabled", false);
        $(".chapter_description").prop("disabled", false);
        $(".singleSyllabus").addClass("d-none");
    } else {
        $("#title").prop("disabled", false);
        $("#description").prop("disabled", false);
        $("#file").prop("disabled", false);
        $("#visibility").prop("disabled", false);
        $(".chapter_name").prop("disabled", true);
        $(".chapter_title").prop("disabled", true);
        $(".chapter_description").prop("disabled", true);

        $("#accordionExample").addClass("d-none");
        $("#hasChapter").val("N");
        $(".singleSyllabus").removeClass("d-none");
    }
});

$(document).on("click", ".addMoreChapter", function () {
    console.log("clicked");
    let html = ` <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Chapter Name: <span class="text-danger">*</span></label>
                                    <input type="hidden" name="id" id="id">
                                        <input type="text" name="chapter_name[]" id="chapter_name" class="form-control" placeholder=""  aria-describedby="helpId" />
                                            <small id="title-error" class="text-danger warnmessage"></small>
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">Title: <span class="text-danger">*</span></label>
                                    <input type="hidden" name="id" id="id">
                                        <input type="text" name="chapter_title[]" id="chapter_title" class="form-control" placeholder="" aria-describedby="helpId" />
                                            <small id="title-error" class="text-danger warnmessage"></small>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Description<span  class="text-danger">*</span></label>
                                    <textarea class="form-control description" name="chapter_description[]" id="chapter_description" rows="3"></textarea>
                                        <small id="description-error" class="text-danger warnmessage"></small>
                            </div>
                            <div class="mb-3">
                            <a href="javascript:void(0);" class="btn btn-primary float-right addMoreChapter">Add More</a>
                            <a href="javascript:void(0);" class="btn btn-danger float-right removeChapter">Remove</a>
                            </div>
                </div>
                               `;

    $(".appendSyllabusChapter").append(html);

    $(".description")
        .not(".summernote-initialized")
        .addClass("summernote-initialized")
        .summernote({
            height: 200,
        });
});

$(document).on("click", ".removeChapter", function () {
    $(this).closest(".row").remove();
});

$(document)
    .off("submit", "#storeSyllabus")
    .on("submit", "#storeSyllabus", function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "/admin/syllabus-content",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                if (response.status == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Created!",
                        text: "Syllabus Created Successfully",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    $("#formModal").modal("hide");
                    $("#storeSyllabus")[0].reset();
                    $("#fetch-syllabus-data").DataTable().destroy().clear();
                    getData();
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Warning!",
                        text: "Something went wrong!",
                    });
                }
            },
        });
    });

$(document)
    .off("click", ".viewSyllabusBtn")
    .on("click", ".viewSyllabusBtn", function () {
        $(".showSyllabusSubject tbody").empty();
        let dataUrl = $(this).attr("data-url");
        $.ajax({
            url: dataUrl,
            type: "get",
            success: function (response) {
                console.log(response);
                if (response.status === true) {
                    $("#viewSyllabusModal").modal("show");
                    $("#viewFaculty").text(response.message.degree.title);
                    $("#viewBatch").text(response.message.batch.title);
                    $("#viewBatchType").text(response.message.batch_type.title);
                    $("#viewSemester").text(
                        response.message.year_semester.title
                    );
                    $("#viewSubject").text(response.message.subject.title);
                    if (response.message.file !== null) {
                        $("#viewFile").html(
                            `<a href="/storage/${response.message.file}" target="_blank">file</a>`
                        );
                    } else {
                        $("#viewFile").html("");
                    }
                    if (response.message.hasChapter == "Y") {
                        $(".showSubjectifN").addClass("d-none");
                        $(".showSyllabusSubject").removeClass("d-none");
                        let subject = response.message.syllabus_subject;
                        let html = "";
                        $.each(subject, function (index, data) {
                            let html = `<tr>
                                      <td>${index + 1}</td>
                                      <td>${data.chapter_name}</td>
                                      <td>${data.chapter_title}</td>
                                      <td>${data.chapter_description}</td>
                                  </tr>`;
                            $(".showSyllabusSubject tbody").append(html);
                        });
                    } else {
                        $(".showSyllabusSubject").addClass("d-none");
                        $(".showSubjectifN").removeClass("d-none");
                        $(".showTitle").text(response.message.title);
                        $("#showDescription").summernote("disable");
                        $("#showDescription").summernote(
                            "code",
                            response.message.description
                        );
                    }
                }
            },
        });
    });

$(document)
    .off("click", ".editSyllabusBtn")
    .on("click", ".editSyllabusBtn", function () {
        $("#formModal").modal("show");
        $("#createSyllabusBtn").hide();
        $("#updateSyllabusBtn").show();
        $(".addForm").attr("id", "updateSyllabus");
        let dataUrl = $(this).attr("data-url");
        resetModalContent();
        $.ajax({
            url: dataUrl,
            type: "get",
            success: function (response) {
                if (response.status) {
                    console.log(response);
                    $("#faculty_id")
                        .val(response.message.degree_id)
                        .trigger("change");
                    setTimeout(() => {
                        $("#batch_id")
                            .val(response.message.batch_id)
                            .trigger("change");
                    }, 400);
                    setTimeout(() => {
                        $("#batch_type_id")
                            .val(response.message.batch_type_id)
                            .trigger("change");
                    }, 600);
                    setTimeout(() => {
                        $("#semester_id")
                            .val(response.message.year_semester_id)
                            .trigger("change");
                    }, 900);
                    setTimeout(() => {
                        $("#subject_id")
                            .val(response.message.subject_id)
                            .trigger("change");
                    }, 1000);

                    $("#hasChapter").val(response.message.hasChapter);
                    if (response.message.hasChapter === "Y") {
                        $("#hasChapter")
                            .prop("checked", true)
                            .trigger("change");
                        $(".accordion-collapse").addClass("show");

                        $(".appendSyllabusChapter").empty();
                        let subjects = response.message.syllabus_subject;
                        $.each(subjects, function (index, data) {
                            let html = `
                                <div class="row chapter-row" id="chapter_row_${index}">
                                    <div class="col-md-6">
                                        <label for="chapter_name_${index}" class="form-label">
                                            Chapter Name: <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="chapter_name[]" id="chapter_name_${index}"
                                               class="form-control" value="${data.chapter_name}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="chapter_title_${index}" class="form-label">
                                            Title: <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="chapter_title[]" id="chapter_title_${index}"
                                               class="form-control" value="${data.chapter_title}" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="chapter_description_${index}" class="form-label">
                                            Description <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control summernote" name="chapter_description[]"
                                                  id="chapter_description_${index}" rows="3">${data.chapter_description}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <a href="javascript:void(0);" class="btn btn-primary float-right addMoreChapter">
                                            Add More
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger float-right removeChapter">
                                            Remove
                                        </a>
                                    </div>
                                </div>`;
                            $(".appendSyllabusChapter").append(html);
                        });

                        $(".summernote").summernote({
                            height: 200,
                        });
                    } else {
                        $("#hasChapter")
                            .prop("checked", false)
                            .trigger("change");
                        $(".accordion-collapse").removeClass("show");
                        $(".appendSyllabusChapter").empty();

                        $("#title").val(response.message.title);
                        $("#description").summernote(
                            "code",
                            response.message.description
                        );
                        $("#visibility").val(response.message.visibility);
                        if (response.message.file != null) {
                            $(".appendFile").html(
                                `<img src="/storage/${response.message.file}" width="100" height="100" alt="File Preview">`
                            );
                        } else {
                            $(".appendFile").html("");
                        }
                    }
                } else {
                    alert("Failed to fetch syllabus data. Please try again.");
                }
            },
            error: function (xhr) {
                console.error("An error occurred:", xhr.responseText);
                alert("An error occurred while processing the request.");
            },
        });
    });

// Function to reset modal content
function resetModalContent() {
    $("#formModal").find("input, select, textarea").val("").trigger("change");
    $(".appendSyllabusChapter").empty();
    $(".appendFile").html("");

    if ($("#description").hasClass("summernote-initialized")) {
        $("#description").summernote("destroy").val("");
    }
    $(".summernote").summernote("destroy");
}

$(document)
    .off("submit", "#updateSyllabus")
    .on("submit", "#updateSyllabus", function (e) {
        e.preventDefault();
        let formdata = new FormData(this);

        $.ajax({

        });
    });

$(document)
    .off("click", ".deleteSyllabusBtn")
    .on("click", ".deleteSyllabusBtn", function () {
        let url = $(this).attr("data-url");
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
                    url: url,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        if (response.status == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Syllabus Deleted Successfully",
                                showConfirmButton: false,
                                timer: 1000,
                            });
                            $("#fetch-syllabus-data")
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
