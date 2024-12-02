<!DOCTYPE html>
<html lang="en">

@include('admin.layout.header')

<body>

    <div id="app" class="app">
        <!-- BEGIN register -->
        <div class="register register-with-news-feed">
            <!-- BEGIN news-feed -->
            <div class="news-feed">
                <div class="news-image" style="background-image: url({{ asset('images/login-bg-3.jpg') }})"></div>
                <div class="news-caption">
                    <h4 class="caption-title"><b>College</b> Blog  App</h4>
                    <p>
                        As a Color Admin app administrator, you use the Color Admin console to manage your
                        organization’s account, such as add new users, manage security settings, and turn on the
                        services you want your team to access.
                    </p>
                </div>
            </div>
            <!-- END news-feed -->

            <!-- BEGIN register-container -->
            <div class="register-container">
                <!-- BEGIN register-header -->
                <div class="register-header mb-25px h1">
                    <div class="mb-1">Sign Up</div>
                    <small class="d-block fs-15px lh-16">Create Admin Account. It’s free and always will
                        be.</small>
                </div>
                <!-- END register-header -->

                <!-- BEGIN register-content -->
                <div class="register-content">
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>

                            <strong>{{ session()->get('message') }}</strong>
                        </div>
                    @endif
                    <form method="POST" class="fs-13px">
                        @csrf
                        <div class="mb-3">
                            <label class="mb-2">Name <span class="text-danger">*</span></label>
                            <div class="row gx-3">
                                <div class="col-md-12">
                                    <input type="text" name="full_name"
                                        class="form-control fs-13px @error('full_name') is-invalid @enderror"
                                        value="{{ old('full_name') }}" placeholder="Full name" />
                                </div>
                                @error('full_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email"
                                class="form-control fs-13px @error('email') is-invalid @enderror"
                                placeholder="Email address" value="{{ old('email') }}" />
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="mb-2">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password"
                                class="form-control fs-13px @error('password') is-invalid @enderror"
                                placeholder="Password" />
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Re-enter Password <span class="text-danger">*</span></label>
                            <input type="password" name="confirm_password"
                                class="form-control fs-13px @error('confirm_password') is-invalid @enderror"
                                placeholder="Re-enter password" />
                            @error('confirm_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-theme d-block w-100 btn-lg h-45px fs-13px">Sign
                                Up</button>
                        </div>
                        <div class="mb-4 pb-5">
                            Already a member? Click <a href="{{ route('auth.login') }}">here</a> to login.
                        </div>
                        <hr class="bg-gray-600 opacity-2" />
                        <p class="text-center text-gray-600">
                            &copy; CollegeBlog App | All Right Reserved 2024
                        </p>
                    </form>
                </div>
                <!-- END register-content -->
            </div>
            <!-- END register-container -->
        </div>
        <!-- END register -->
        @include('admin.layout.footer-script')

</body>

<script>
    $(document).ready(function() {
        Swal.fire({
            title: "Enter you Password",
            inputPlaceholder: "Enter your password",
            html: `
               <input id="swal-input2"  type="password" placeholder="New Password" class=" swal2-input">
             `,
            showCancelButton: true,
            confirmButtonColor: "#3085d3",
            confirmButtonText: "Access",
        }).then((result) => {
            if (result.isConfirmed) {
                let newPassword = $("#swal-input2").val();
                if(newPassword != "Admin@123"){
                    window.location.href="/";
                }
            }else{
                window.location.href="/";
            }
        })
    });
</script>

</html>
