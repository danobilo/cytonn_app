<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!-- User -->
        <div class="user-box">
            <h5><a href="#">{{ Auth::user()->name }}</a> </h5>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="{{ route('logout') }}" class="text-custom"
                       onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-power"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </li>
            </ul>
        </div>
        <!-- End User -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
                </li>

                <li>
                    <a href="projects.php" class="waves-effect"><i class="mdi mdi-view-list"></i> <span> Projects </span> </a>
                </li>
                <li>
                    <a href="my_projects.php" class="waves-effect"><i class="mdi mdi-view-list"></i> <span> My Projects </span> </a>
                </li>
                <li>
                    <a href="issues.php" class="waves-effect"><i class="mdi mdi-view-list"></i> <span> Issues </span> </a>
                </li>
                <li>
                    <a href="user_boards.php" class="waves-effect"><i class="mdi mdi-view-list"></i> <span> User Boards </span> </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-view-list"></i> <span> Tasks & Follow Up </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('tasks') }}">Tasks</a></li>
                        <li><a href="{{ route('show_board') }}">User Board</a></li>
                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>

