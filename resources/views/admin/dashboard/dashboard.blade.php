@extends('admin.layout.main')
@section('content')
    <div class="container-fluid">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
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
        <h1 class="page-header">Dashboard <small>header small text goes here...</small></h1>
        <!-- END page-header -->

        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-blue">
                    <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                    <div class="stats-info">
                        <h4>TOTAL VISITORS</h4>
                        <p>3,291,922</p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- END col-3 -->
            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-info">
                    <div class="stats-icon"><i class="fa fa-link"></i></div>
                    <div class="stats-info">
                        <h4>BOUNCE RATE</h4>
                        <p>20.44%</p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- END col-3 -->
            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-orange">
                    <div class="stats-icon"><i class="fa fa-users"></i></div>
                    <div class="stats-info">
                        <h4>UNIQUE VISITORS</h4>
                        <p>1,291,922</p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- END col-3 -->
            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-red">
                    <div class="stats-icon"><i class="fa fa-clock"></i></div>
                    <div class="stats-info">
                        <h4>AVG TIME ON SITE</h4>
                        <p>00:12:23</p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- END col-3 -->
        </div>
        <!-- END row -->

        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-8 -->
            <div class="col-xl-12">
              
                <!-- BEGIN tabs -->
                <ul class="nav nav-tabs nav-tabs-inverse nav-justified" data-sortable-id="index-2">
                    <li class="nav-item"><a href="#latest-post" data-bs-toggle="tab" class="nav-link active"><i
                                class="fa fa-camera fa-lg me-5px"></i> <span class="d-none d-md-inline">Latest
                                Post</span></a></li>
                    <li class="nav-item"><a href="#purchase" data-bs-toggle="tab" class="nav-link"><i
                                class="fa fa-archive fa-lg me-5px"></i> <span class="d-none d-md-inline">Purchase</span></a>
                    </li>
                    <li class="nav-item"><a href="#email" data-bs-toggle="tab" class="nav-link"><i
                                class="fa fa-envelope fa-lg me-5px"></i> <span class="d-none d-md-inline">Email</span></a>
                    </li>
                </ul>
                <div class="tab-content panel rounded-0 rounded-bottom mb-20px" data-sortable-id="index-3">
                    <div class="tab-pane fade active show" id="latest-post">
                        <div class="h-300px p-3" data-scrollbar="true">
                            <div class="d-sm-flex">
                                <a href="javascript:;" class="w-sm-200px">
                                    <img class="mw-100 rounded" src="{{ asset('admin/img/gallery/gallery-1.jpg') }}" alt="" />
                                </a>
                                <div class="flex-1 ps-sm-3 pt-3 pt-sm-0">
                                    <h5>Aenean viverra arcu nec pellentesque ultrices. In erat purus, adipiscing nec
                                        lacinia at, ornare ac eros.</h5>
                                    Nullam at risus metus. Quisque nisl purus, pulvinar ut mauris vel, elementum
                                    suscipit eros. Praesent ornare ante massa, egestas pellentesque orci convallis
                                    ut. Curabitur consequat convallis est, id luctus mauris lacinia vel. Nullam
                                    tristique lobortis mauris, ultricies fermentum lacus bibendum id. Proin non ante
                                    tortor. Suspendisse pulvinar ornare tellus nec pulvinar. Nam pellentesque
                                    accumsan mi, non pellentesque sem convallis sed. Quisque rutrum erat id auctor
                                    gravida.
                                </div>
                            </div>
                           
                            <hr class="bg-gray-500" />
                            <div class="d-sm-flex">
                                <a href="javascript:;" class="w-sm-200px">
                                    <img class="mw-100 rounded" src="{{ asset('admin/img/gallery/gallery-8.jpg') }}"
                                        alt="" />
                                </a>
                                <div class="flex-1 ps-sm-3 pt-3 pt-sm-0">
                                    <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor
                                        accumsan rutrum.</h5>
                                    Fusce augue diam, vestibulum a mattis sit amet, vehicula eu ipsum. Vestibulum eu
                                    mi nec purus tempor consequat. Vestibulum porta non mi quis cursus. Fusce
                                    vulputate cursus magna, tincidunt sodales ipsum lobortis tincidunt. Mauris quis
                                    lorem ligula. Morbi placerat est nec pharetra placerat. Ut laoreet nunc accumsan
                                    orci aliquam accumsan. Maecenas volutpat dolor vitae sapien ultricies fringilla.
                                    Suspendisse vitae orci sed nibh ultrices tristique. Aenean in ante eget urna
                                    semper imperdiet. Pellentesque sagittis a nulla at scelerisque.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="purchase">
                        <div class="h-300px" data-scrollbar="true">
                            <table class="table table-panel mb-0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th class="hidden-sm text-center">Product</th>
                                        <th></th>
                                        <th>Amount</th>
                                        <th>User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold text-muted">13/02/2024</td>
                                        <td class="hidden-sm text-center">
                                            <a href="javascript:;">
                                                <img src="{{ asset('admin/img/product/product-1.png') }}" alt=""
                                                    width="32px" />
                                            </a>
                                        </td>
                                        <td class="text-nowrap">
                                            <h6><a href="javascript:;" class="text-dark text-decoration-none">Nunc
                                                    eleifend lorem eu velit eleifend, <br />eget faucibus nibh
                                                    placerat.</a></h6>
                                        </td>
                                        <td class="text-blue fw-bold">$349.00</td>
                                        <td class="text-nowrap"><a href="javascript:;"
                                                class="text-dark text-decoration-none">Derick Wong</a></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-muted">13/02/2024</td>
                                        <td class="hidden-sm text-center">
                                            <a href="javascript:;">
                                                <img src="{{ asset('admin/img/product/product-2.png') }}" alt=""
                                                    width="32px" />
                                            </a>
                                        </td>
                                        <td class="text-nowrap">
                                            <h6><a href="javascript:;" class="text-dark text-decoration-none">Nunc
                                                    eleifend lorem eu velit eleifend, <br />eget faucibus nibh
                                                    placerat.</a></h6>
                                        </td>
                                        <td class="text-blue fw-bold">$399.00</td>
                                        <td class="text-nowrap"><a href="javascript:;"
                                                class="text-dark text-decoration-none">Derick Wong</a></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-muted">13/02/2024</td>
                                        <td class="hidden-sm text-center">
                                            <a href="javascript:;">
                                                <img src="{{ asset('admin/img/product/product-3.png') }}" alt=""
                                                    width="32px" />
                                            </a>
                                        </td>
                                        <td class="text-nowrap">
                                            <h6><a href="javascript:;" class="text-dark text-decoration-none">Nunc
                                                    eleifend lorem eu velit eleifend, <br />eget faucibus nibh
                                                    placerat.</a></h6>
                                        </td>
                                        <td class="text-blue fw-bold">$499.00</td>
                                        <td class="text-nowrap"><a href="javascript:;"
                                                class="text-dark text-decoration-none">Derick Wong</a></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-muted">13/02/2024</td>
                                        <td class="hidden-sm text-center">
                                            <a href="javascript:;">
                                                <img src="{{ asset('admin/img/product/product-4.png') }}" alt=""
                                                    width="32px" />
                                            </a>
                                        </td>
                                        <td class="text-nowrap">
                                            <h6><a href="javascript:;" class="text-dark text-decoration-none">Nunc
                                                    eleifend lorem eu velit eleifend, <br />eget faucibus nibh
                                                    placerat.</a></h6>
                                        </td>
                                        <td class="text-blue fw-bold">$230.00</td>
                                        <td class="text-nowrap"><a href="javascript:;"
                                                class="text-dark text-decoration-none">Derick Wong</a></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-muted">13/02/2024</td>
                                        <td class="hidden-sm text-center">
                                            <a href="javascript:;">
                                                <img src="{{ asset('admin/img/product/product-5.png') }}" alt=""
                                                    width="32px" />
                                            </a>
                                        </td>
                                        <td class="text-nowrap">
                                            <h6><a href="javascript:;" class="text-dark text-decoration-none">Nunc
                                                    eleifend lorem eu velit eleifend, <br />eget faucibus nibh
                                                    placerat.</a></h6>
                                        </td>
                                        <td class="text-blue fw-bold">$500.00</td>
                                        <td class="text-nowrap"><a href="javascript:;"
                                                class="text-dark text-decoration-none">Derick Wong</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="email">
                        <div class="h-300px p-3" data-scrollbar="true">
                            <div class="d-flex">
                                <a class="w-60px" href="javascript:;">
                                    <img src="{{ asset('admin/img/user/user-1.jpg') }}" alt=""
                                        class="mw-100 rounded-pill" />
                                </a>
                                <div class="flex-1 ps-3">
                                    <a href="javascript:;" class="text-dark text-decoration-none">
                                        <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h5>
                                    </a>
                                    <p class="mb-5px">
                                        Aenean mollis arcu sed turpis accumsan dignissim. Etiam vel tortor at risus
                                        tristique convallis. Donec adipiscing euismod arcu id euismod. Suspendisse
                                        potenti. Aliquam lacinia sapien ac urna placerat, eu interdum mauris
                                        viverra.
                                    </p>
                                    <span class="text-muted fs-11px fw-bold">Received on 04/16/2024, 12.39pm</span>
                                </div>
                            </div>
                            <hr class="bg-gray-500" />
                            <div class="d-flex">
                                <a class="w-60px" href="javascript:;">
                                    <img src="{{ asset('admin/img/user/user-2.jpg') }}" alt=""
                                        class="mw-100 rounded-pill" />
                                </a>
                                <div class="flex-1 ps-3">
                                    <a href="javascript:;" class="text-dark text-decoration-none">
                                        <h5>Praesent et sem porta leo tempus tincidunt eleifend et arcu.</h5>
                                    </a>
                                    <p class="mb-5px">
                                        Proin adipiscing dui nulla. Duis pharetra vel sem ac adipiscing. Vestibulum
                                        ut porta leo. Pellentesque orci neque, tempor ornare purus nec, fringilla
                                        venenatis elit. Duis at est non nisl dapibus lacinia.
                                    </p>
                                    <span class="text-muted fs-11px fw-bold">Received on 04/16/2024, 12.39pm</span>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <!-- END tabs -->

                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="index-5">
                    <div class="panel-heading">
                        <h4 class="panel-title">Message</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                                    class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i
                                    class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning"
                                data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i
                                    class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <div class="panel-body p-0">
                        <div class="h-300px p-3" data-scrollbar="true">
                            <hr class="bg-gray-500" />
                            <div class="d-flex">
                                <a href="javascript:;" class="w-60px">
                                    <img src="{{ asset('admin/img/user/user-7.jpg') }}" alt=""
                                        class="mw-100 rounded-pill" />
                                </a>
                                <div class="flex-1 ps-3">
                                    <h5>John Doe</h5>
                                    <p>Morbi molestie lorem quis accumsan elementum. Morbi condimentum nisl iaculis,
                                        laoreet risus sed, porta neque. Proin mi leo, dapibus at ligula a, aliquam
                                        consectetur metus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control bg-light" placeholder="Enter message" />
                                <button class="btn btn-primary" type="button"><i class="fa fa-pencil-alt"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END panel -->
            </div>
        
        </div>
        <!-- END row -->
    </div>
@endsection
