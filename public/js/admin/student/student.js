$(document).ready(function(){
    getData();
});

function getData() {
    $("#fetch-student-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "student",
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
                data: "full_name",
            },
            {
                data: "username",
            },
            {
                data: "email",
            },
            {
                data: "address",
            },
            {
                data: "batch",
            },
             {
                data: "status",
                fetch:function(data){
                    if(data == 'active'){
                        return `<span class="badge badge-success">Active</span>`;
                    }else{
                        return `<span class="badge badge-danger">Blocked</span>`;
                    }
                }
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
$(document).off("click","#addStudentBtn").on("click","#addStudentBtn",function(){
    $("#formModal").modal("show");
    $(".addForm").attr("id","storeStudent");
    $("#storeStudent")[0].reset();
    $("#createStudentBtn").show();
    $("#updateStudentBtn").hide();
})
$(document).on("change", "#batch_type_id", function () {
    let data = $(this).val();
    $.ajax({
        url: "/admin/faculty/batch/type/" + data,
        type: "get",
        success: function (res) {
            let response = res.message;
            let html = ` <option value="">Select one</option>`;
            $("#year_semester_id").empty();
            $.each(response, function (id, data) {
                html += ` <option value="${data.id}">${data.title}</option>`;
            });
            $("#year_semester_id").append(html);
        },
    });
});

$(document).off("submit","#storeStudent").on("submit","#storeStudent",function(e){
    e.preventDefault();
    let formdata=new FormData(this);
    let dataUrl=$("#storeStudent").attr("action");
    $("#createStudentBtn").prop("disabled",true);
    $.ajax({
        type:"post",
        url:dataUrl,
        data:formdata,
        contentType:false,
        processData:false,
        success:function(response){
            if(response.status == true){
                console.log(response);
                Swal.fire({
                    icon:"success",
                    title:"Created!",
                    text:"Student Created Successfully!",
                    showConfirmButton:false,
                    timer:1000
                });
                $("#storeStudent")[0].reset();
                $(".formModal").modal("show");
            }else{
                Swal.fire({
                    icon:"error",
                    title:"Warning!",
                    text:"Something went wrong!",

                });
            }
        },
        error:function(xhr){
            console.log(xhr);

            if(xhr.status == 422){
                let errors=xhr.responseJSON.errors;
                $.each(errors,function(data,message){
                    $("#"+data+"-error").text(message[0]);
                })
            }
        },
        complete:function(){
            $("#createStudentBtn").prop("disabled",false);
        }
    })
})
