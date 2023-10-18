<div class="sidebar" id="btn">
    <div class="top">
        <div class="logo">
            <i class='bx bxs-dashboard bx-flip-horizontal'></i>
            <span>Admin dashboard</span>
        </div>
        <i class="bx bx-menu" id="btn"></i>
    </div>
    <div class="user">
        <img src="{{ asset('backend/assets/image/user.jpg') }}" alt="user image" class="user-img">
        <div>
            <p class="admin-name">Name Surname</p>
            <p>Admin</p>
        </div>
    </div>
    <ul>
        <li>
            <a href="#">
                <i class="bx bxs-grid-alt"></i>
                <span class="nav-item">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="#">
                <i class="bx bxs-grid-alt"></i>
                <span class="nav-item">Products</span>
            </a>
            <span class="tooltip">Products</span>
        </li>
        <li>
            <a href="#">
                <i class="bx bxs-grid-alt"></i>
                <span class="nav-item">Categories</span>
            </a>
            <span class="tooltip">Categories</span>
        </li>
        <li>
            <a href="#">
                <i class="bx bx-body"></i>
                <span class="nav-item">Customers</span>
            </a>
            <span class="tooltip">Customers</span>
        </li>
        <li>
            <a href="#">
                <i class="bx bx-cog"></i>
                <span class="nav-item">Settings</span>
            </a>
            <span class="tooltip">Settings</span>
        </li>
        <li>
            <a href="{{ route('admin.logout') }}">
                <i class="bx bx-log-out"></i>
                <span class="nav-item">Logout</span>
            </a>
            <span class="tooltip">Logout</span>
        </li>
    </ul>
</div>
