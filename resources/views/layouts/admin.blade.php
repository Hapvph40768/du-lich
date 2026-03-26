<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .admin-layout {
            display: flex;
            min-height: 100vh;
            background-color: var(--bg-light);
        }
        .sidebar {
            width: 250px;
            background-color: #ffffff;
            border-right: 1px solid var(--glass-border);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }
        .sidebar-brand {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .nav-item {
            display: block;
            padding: 0.75rem 1rem;
            color: var(--text-main);
            text-decoration: none;
            border-radius: var(--radius-md);
            margin-bottom: 0.25rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .nav-item:hover, .nav-item.active {
            background-color: rgba(79, 70, 229, 0.1);
            color: var(--primary-color);
        }
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }
        .topbar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 2rem;
        }
        .logout-btn {
            background: transparent;
            border: none;
            color: var(--danger);
            font-weight: 500;
            cursor: pointer;
            padding: 0.5rem 1rem;
        }
        .logout-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                TourAdmin VN
            </div>
            
            <nav style="flex: 1;">
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Bảng Điều Khiển</a>
                <a href="{{ route('admin.locations.index') }}" class="nav-item {{ request()->routeIs('admin.locations.*') ? 'active' : '' }}">Khu Vực</a>
                <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Danh Mục</a>
                <a href="{{ route('admin.tours.index') }}" class="nav-item {{ request()->routeIs('admin.tours.*') ? 'active' : '' }}">Quản Lý Tour</a>
                <a href="{{ route('admin.bookings.index') }}" class="nav-item {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">Đơn Đặt Hành Trình</a>
                <a href="{{ route('admin.payments.index') }}" class="nav-item {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">Quản Lý Thanh Toán</a>
                <a href="{{ route('admin.coupons.index') }}" class="nav-item {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">Mã Giảm Giá</a>
                <a href="{{ route('admin.blogs.index') }}" class="nav-item {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">Quản Lý Bài Viết</a>
                <a href="{{ route('admin.tickets.index') }}" class="nav-item {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}">Hỗ Trợ Khách Hàng</a>
            </nav>

            <form method="POST" action="{{ route('logout') }}" style="margin-top: auto;">
                @csrf
                <button type="submit" class="logout-btn">Đăng xuất</button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="topbar">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <span style="font-weight: 500;">{{ auth()->user()->name }}</span>
                    <div style="width: 36px; height: 36px; border-radius: 50%; background-color: var(--primary-color); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
