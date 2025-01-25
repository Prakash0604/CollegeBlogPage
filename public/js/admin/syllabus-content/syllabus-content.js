$(document).ready(function () {});

$(document)
    .off("click", "#addSyllabusBtn")
    .on("click", "#addSyllabusBtn", function () {
        $("#formModal").modal("show");
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
            console.log(res);
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
    let id = $(this).val();
    $("#semester_id").empty();
    $.ajax({
        url: "/admin/syllabus/get/type/semester/" + id,
        type: "get",
        success: function (res) {
            console.log(res);
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
            console.log(res);
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
            }else{
                Swal.fire({
                    icon: "info",
                    title: res.message,
                });
            }
        },
        error:function(xhr){
            if(xhr.status == false){
                Swal.fire({
                    icon: "warning",
                    title: xhr.message,
                });
            }
        }
    });
});
