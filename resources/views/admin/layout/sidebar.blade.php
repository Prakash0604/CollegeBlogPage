@php
    // In your controller
    $menuItems = [
        [
            'name' => 'Posts',
            'route' => route('post.index'),
            'icon' => 'fab fa-simplybuilt',
        ],
        [
            'name' => 'Event',
            'route' => 'eventmanagement', // Set the actual route
            'icon' => 'fa fa-cog',
        ],
        [
            'name' => 'Send Feedback',
            'route' => '#', // Set the actual route
            'icon' => 'fa fa-pencil-alt',
        ],
        [
            'name' => 'Help',
            'route' => '#', // Set the actual route
            'icon' => 'fa fa-question-circle',
        ],
    ];

@endphp



<div id="sidebar" class="app-sidebar" data-bs-theme="dark">
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <!-- BEGIN menu -->
        <div class="menu">
            <div class="menu-profile">
                <a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile"
                    data-target="#appSidebarProfileMenu">
                    <div class="menu-profile-cover with-shadow"></div>
                    <div class="menu-profile-image">
                        <img src="{{ asset('admin/img/user/user-13.jpg') }}" alt="" />
                    </div>
                    <div class="menu-profile-info">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                Sean Ngu
                            </div>
                            <div class="menu-caret ms-auto"></div>
                        </div>
                        <small>Frontend developer</small>
                    </div>
                </a>
            </div>
            <div id="appSidebarProfileMenu" class="collapse">
                <div class="menu-item pt-5px">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon"><i class="fa fa-cog"></i></div>
                        <div class="menu-text">Settings</div>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon"><i class="fa fa-pencil-alt"></i></div>
                        <div class="menu-text"> Send Feedback</div>
                    </a>
                </div>
                <div class="menu-item pb-5px">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon"><i class="fa fa-question-circle"></i></div>
                        <div class="menu-text"> Helps</div>
                    </a>
                </div>
                <div class="menu-divider m-0"></div>
            </div>

            <div class="menu-item">
                <a href="{{ route('post.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fab fa-simplybuilt"></i>
                    </div>
                    <div class="menu-text"><i class="bi bi-stickies-fill"></i> Posts</div>
                </a>
            </div>

            <div class="menu-item">
                <a href="{{ route('faculty.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fab fa-simplybuilt"></i>
                    </div>
                    <div class="menu-text"><i class="bi bi-stickies-fill"></i> Degree</div>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('syllabus-content.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fab fa-simplybuilt"></i>
                    </div>
                    <div class="menu-text"><i class="bi bi-stickies-fill"></i> Syllabus Content</div>
                </a>
            </div>
        </div>
        <!-- END menu -->
    </div>
    <!-- END scrollbar -->
</div>
