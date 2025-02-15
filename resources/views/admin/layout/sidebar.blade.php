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
                <a href="#settingsMenu" class="menu-link" data-bs-toggle="collapse">
                    <div class="menu-icon">
                        <i class="bi bi-gear"></i> <!-- Settings Icon -->
                    </div>
                    <div class="menu-text">Settings</div>
                </a>
                <div class="collapse" id="settingsMenu">
                    <div class="menu-sub">
                        <a href="{{ route('menu.index') }}" class="menu-link">
                            <div class="menu-icon">
                                <i class="bi bi-list"></i>
                            </div>
                            <div class="menu-text">Menu</div>
                        </a>
                        <a href="{{ url('/menu-permission') }}" class="menu-link">
                            <div class="menu-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <div class="menu-text">Menu Permission</div>
                        </a>
                    </div>
                </div>
            </div>


            @foreach ($globalMenus as $menu)
            <div class="menu-item">
                <a href="{{ $menu->redirect }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="{{ $menu->icon }}"></i>
                    </div>
                    <div class="menu-text">{{ $menu->title }}</div>
                </a>
            </div>
            @endforeach
        </div>
        <!-- END menu -->
    </div>
    <!-- END scrollbar -->


</div>
