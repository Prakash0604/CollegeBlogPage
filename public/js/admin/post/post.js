$(document).ready(function () {
    $(".description").summernote({
        height: 400
    });

    var table = $("#fetch-post-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/post",
        order: [1, 'asc'],
        columns: [
            {
                data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false
            }, {
                data: "title", name: "title"
            }, {
                data: "description", name: "description"
            }, {
                data: "type", name: "type"
            }, {
                data: "visibility", name: "visibility"
            }, {
                data: "action", name: "action", orderable: false, searchable: false
            }
        ]
    });

    function clear() {
        $(".warnmessage").text("");
        $(".description").summernote("code", "");
    }

    $(document).on("click", "#addPostBtn", function () {
        clear();
        $("#formModal").modal("show");
        $(".createPostBtn").show();
        $(".updatePostBtn").hide();
        $("#postAdd")[0].reset();
    });


    $(document).on("submit", "#postAdd", function (event) {
        event.preventDefault();
        let formdata = new FormData(this);
        $(".createPostBtn").prop("disabled", true);
        $.ajax({
            url: "/admin/post",
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status == 200) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Post Created Successfully",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    table.draw();
                    $("#postAdd")[0].reset();
                    $("#formModal").modal("hide");
                }
            },
            error: function (xhr) {
                console.log(xhr);
                if (xhr.status == 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (data, message) {
                        $("#" + data + "-error").text(message[0]);
                    });
                }
                // $(".createPostBtn").prop("disabled",false);

            },
            complete: function () {
                $(".createPostBtn").prop("disabled", false);
            }
        })
    })
})