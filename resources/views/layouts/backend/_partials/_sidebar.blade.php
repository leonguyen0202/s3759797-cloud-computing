<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Assignment 1</li>
                <li>
                    <a href="{{route('bigquery.index')}}" {!!
                        set_full_request_class(['dashboard/big-query'], "class='mm-active'" ) !!}>
                        <i class="metismenu-icon pe-7s-server"></i>
                        Big Query
                    </a>
                </li>
                <li {!! set_full_request_class(['dashboard/employee', 'dashboard/employee/frequency'], "class='mm-active'" ) !!}>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        Employees
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul {!! set_full_request_class(['dashboard/employee', 'dashboard/employee/frequency'], "class='mm-show'" ) !!}>
                        <li>
                            <a href="{{route('employee.index')}}" {!! set_full_request_class(['dashboard/employee'], "class='mm-active'" ) !!}>
                                <i class="metismenu-icon"></i>
                                List
                            </a>
                        </li>
                        <li>
                            <a href="{{route('employee.frequency')}}" {!! set_full_request_class(['dashboard/employee/frequency'], "class='mm-active'" ) !!}>
                                <i class="metismenu-icon"></i>
                                Frequency
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>