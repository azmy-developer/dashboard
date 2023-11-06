<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-users"></i>
                            <span key="t-multi-level">Employees</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">

                                <li><a href="{{route('dashboard.employee.index')}}">Employees</a></li>


                        </ul>
                    </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-users"></i>
                        <span key="t-multi-level">Department</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">

                        <li><a href="{{route('dashboard.department.index')}}">Department</a></li>


                    </ul>
                </li>

            @can('tasks')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-users"></i>
                        <span key="t-multi-level">Task</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">

                        <li><a href="{{route('dashboard.task.index')}}">Task</a></li>


                    </ul>
                </li>
            @endcan

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
