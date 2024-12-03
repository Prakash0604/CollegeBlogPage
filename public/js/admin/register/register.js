$(document).ready(function () {
    Swal.fire({
        title: "Enter you Password",
        inputPlaceholder: "Enter your password",
        html: `
           <input id="swal-input2"  type="password" placeholder="Enter the Password" class=" swal2-input">
         `,
        showCancelButton: true,
        confirmButtonColor: "#3085d3",
        confirmButtonText: "Access",
    }).then((result) => {
        if (result.isConfirmed) {
            let password = $("#swal-input2").val();
            $.ajax({
                method: "post",
                url: "/auth/password",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "password": password
                },
                success: function (response) {
                    console.log(response);
                    if (response.status == 301) {
                        window.location.href = '/'
                    }
                }
            })
        } else {
            window.location.href = "/";
        }
    })
});