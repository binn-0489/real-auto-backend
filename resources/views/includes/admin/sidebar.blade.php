<div class="sidebar-wrapper">
    <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul
            class="nav sidebar-menu flex-column"
            data-lte-toggle="treeview"
            role="navigation"
            aria-label="Main navigation"
            data-accordion="false"
            id="navigation"
        >
            <li class="nav-header">ADMIN PANEL</li>

            <li class="nav-item">
                <a href="{{ route('admin.ad.index') }}" class="nav-link">
                    <i class="nav-icon bi bi-ui-checks-grid"></i>
                    <p>
                        Ads
                        <span class="nav-badge badge text-bg-secondary me-3">{{ $adsCount }}</span>
                    </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('admin.ad.create') }}" class="nav-link">
                    <i class="nav-icon bi bi-pencil-square"></i>
                    <p>
                        Create ad
                    </p>
                </a>
            </li>

        </ul>
        <!--end::Sidebar Menu-->
    </nav>
</div>
