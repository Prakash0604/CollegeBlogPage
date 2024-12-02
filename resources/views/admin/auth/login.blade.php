<!DOCTYPE html>
<html lang="en">

@include('admin.layout.header')

<body>
    <div class="container">
        <div id="app" class="app">
            <!-- BEGIN login -->
            <div class="login login-v2 fw-bold">
                <!-- BEGIN login-cover -->
                <div class="login-cover">
                    <div class="login-cover-img" style="background-image: url({{ asset('images/login-bg-13.jpg') }})" data-id="login-cover-image"></div>
                    <div class="login-cover-bg"></div>
                </div>
                <!-- END login-cover -->

                <!-- BEGIN login-container -->
                <div class="login-container">
                    <!-- BEGIN login-header -->
                    <div class="login-header">
                        <div class="brand">
                            <div class="d-flex align-items-center">
                                <span class="logo"></span> <b>College</b> Blog App
                            </div>
                            <small>Simple & easy way to manage</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    <!-- END login-header -->

                    <!-- BEGIN login-content -->
                    <div class="login-content">
                        @if (session()->has('message'))
                            <div
                                class="alert alert-success alert-dismissible fade show"
                                role="alert"
                            >
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"
                                ></button>
                            
                                <strong>{{ session()->get('message') }}</strong> 
                            </div>
                        @endif
                         @if (session()->has('error'))
                            <div
                                class="alert alert-danger alert-dismissible fade show"
                                role="alert"
                            >
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"
                                ></button>
                            
                                <strong>{{ session()->get('error') }}</strong> 
                            </div>
                        @endif
                        <form  method="post">
                            <div class="form-floating mb-20px">
                                @csrf
                                <input type="text" name="email" class="form-control fs-13px h-45px border-0 @error('email') is-invalid @enderror"
                                    placeholder="Email Address" id="emailAddress"  value="{{ old('email') }}"/>
                                <label for="emailAddress" class="d-flex align-items-center text-gray-600 fs-13px">Email
                                    Address</label>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="form-floating mb-20px">
                                <input type="password" name="password" class="form-control fs-13px h-45px border-0  @error('password') is-invalid @enderror"
                                    placeholder="Password" />
                                <label for="emailAddress"
                                    class="d-flex align-items-center text-gray-600 fs-13px">Password</label>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="mb-20px">
                                <button type="submit" class="btn btn-theme d-block w-100 h-45px btn-lg">Log me
                                    in</button>
                            </div>
                        </form>
                    </div>
                    <!-- END login-content -->
                </div>
                <!-- END login-container -->
            </div>
            <!-- END login -->
        </div>
    </div>
    <!-- END #app -->

    @include('admin.layout.footer-script')

</body>

</html>
