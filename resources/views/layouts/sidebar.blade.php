<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Home</li>
                @foreach (App\Helpers\AdminHelper::getAdminSidebarLinks() as $link)
                <li class="{{ request()->routeIs($link['route']) ? 'mm-active' : '' }}">
                    <a href="{{ route($link['route']) }}" class="waves-effect {{ request()->routeIs($link['route']) ? 'active' : '' }}">
                        <i class="{{ $link['icon'] }}"></i>
                        <span key="{{ $link['key'] }}">{{ $link['label'] }}</span>
                    </a>
                </li>
                @endforeach

                {{-- <li>
                    <a href="" class="waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-dashboards">View Users</span>
                    </a>
                </li>   
                <li>
                    <a href="" class="waves-effect">
                        <i class="bx bx-add-to-queue"></i>
                        <span key="t-dashboards">Add Categories</span>
                    </a>
                </li> --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
