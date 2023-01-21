<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('admin.dashbaord') }}">
            <span class="align-middle">Admin Panel</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.dashbaord') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span
                        class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.students') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Students</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.courses') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Courses</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.registrations') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Registrations</span>
                </a>
            </li>

        </ul>

    </div>
</nav>