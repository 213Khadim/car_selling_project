@extends('layouts.app')

@section('title', 'Dashboard - AutoDrive')

@push('styles')
<style>
    .admin-layout {
        display: flex;
        min-height: 100vh;
        background: var(--gray-50);
    }
    .sidebar {
        width: 280px;
        background: var(--white);
        border-right: 1px solid var(--gray-200);
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 1000;
        transition: var(--transition);
    }
    .sidebar.collapsed {
        transform: translateX(-100%);
    }
    .sidebar-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--gray-200);
    }
    .sidebar-logo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--primary);
        text-decoration: none;
    }
    .sidebar-logo i {
        font-size: 1.5rem;
    }
    .sidebar-nav {
        flex: 1;
        padding: 1rem 0;
        overflow-y: auto;
    }
    .nav-section {
        margin-bottom: 1.5rem;
    }
    .nav-section-title {
        padding: 0.5rem 1.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .nav-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1.5rem;
        color: var(--gray-600);
        text-decoration: none;
        transition: var(--transition);
        position: relative;
    }
    .nav-item:hover {
        background: var(--gray-50);
        color: var(--gray-900);
    }
    .nav-item.active {
        background: var(--primary);
        color: var(--white);
    }
    .nav-item.active:hover {
        background: var(--primary-dark);
    }
    .nav-item i {
        width: 20px;
        text-align: center;
    }
    .main-content {
        flex: 1;
        margin-left: 280px;
        transition: var(--transition);
    }
    .main-content.expanded {
        margin-left: 0;
    }
    .top-bar {
        background: var(--white);
        border-bottom: 1px solid var(--gray-200);
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 100;
    }
    .top-bar-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .sidebar-toggle {
        background: none;
        border: none;
        padding: 0.5rem;
        border-radius: var(--radius);
        color: var(--gray-600);
        cursor: pointer;
        transition: var(--transition);
    }
    .sidebar-toggle:hover {
        background: var(--gray-100);
    }
    .top-bar-right {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .notification-btn {
        position: relative;
        background: none;
        border: none;
        padding: 0.5rem;
        border-radius: var(--radius);
        color: var(--gray-600);
        cursor: pointer;
    }
    .user-menu {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: var(--radius);
        transition: var(--transition);
    }
    .user-menu:hover {
        background: var(--gray-50);
    }
    .user-avatar {
        width: 32px;
        height: 32px;
        background: var(--primary);
        color: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }
    .user-info {
        display: flex;
        flex-direction: column;
    }
    .user-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--gray-900);
    }
    .user-role {
        font-size: 0.75rem;
        color: var(--gray-500);
    }
    .page-content {
        padding: 1.5rem;
    }
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
    }
    .page-title {
        font-size: 1.875rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--gray-500);
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: var(--white);
        padding: 1.5rem;
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
    }
    .stat-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    .stat-card-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
    }
    .stat-card-icon.blue {
        background: var(--primary);
    }
    .stat-card-icon.green {
        background: var(--success);
    }
    .stat-card-icon.orange {
        background: var(--warning);
    }
    .stat-card-icon.red {
        background: var(--danger);
    }
    .stat-card-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 0.25rem;
    }
    .stat-card-label {
        color: var(--gray-600);
        margin-bottom: 0.5rem;
    }
    .card {
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        overflow: hidden;
    }
    .card-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--gray-200);
    }
    .card-body {
        padding: 1.5rem;
    }
    .car-card {
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        transition: var(--transition);
    }
    .car-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    .car-image {
        position: relative;
        overflow: hidden;
    }
    .car-badge {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--white);
    }
    .car-badge.new {
        background: var(--success);
    }
    .car-info {
        padding: 1.5rem;
    }
    .car-title {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--gray-900);
    }
    .car-subtitle {
        color: var(--gray-600);
        margin-bottom: 1rem;
    }
    .car-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .car-price {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--primary);
    }
    .badge {
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .badge-success {
        background: var(--success);
        color: var(--white);
    }
    .badge-danger {
        background: var(--danger);
        color: var(--white);
    }
    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
    .d-flex {
        display: flex;
    }
    .justify-between {
        justify-content: space-between;
    }
    .align-center {
        align-items: center;
    }
    .mt-3 {
        margin-top: 1.5rem;
    }
    @media (max-width: 1024px) {
        .sidebar {
            transform: translateX(-100%);
        }
        .main-content {
            margin-left: 0;
        }
        .sidebar.show {
            transform: translateX(0);
        }
    }
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="{{ url('/') }}" class="sidebar-logo">
                    <i class="fas fa-car-side"></i>
                    <span>AutoDrive</span>
                </a>
            </div>
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Menu</div>
                    <a href="{{ url('/user/dashboard') }}" class="nav-item active">
                        <i class="fas fa-th-large"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ url('/cars') }}" class="nav-item">
                        <i class="fas fa-car"></i>
                        <span>Browse Cars</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fas fa-shopping-bag"></i>
                        <span>My Purchases</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fas fa-heart"></i>
                        <span>Favorites</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fas fa-credit-card"></i>
                        <span>Payments</span>
                    </a>
                </div>
                <div class="nav-section">
                    <div class="nav-section-title">Account</div>
                    <a href="{{ url('/user/profile') }}" class="nav-item">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="nav-item" style="width:100%;background:none;border:none;cursor:pointer;text-align:left;">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <header class="top-bar">
                <div class="top-bar-left">
                    <button class="sidebar-toggle" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="top-bar-right">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                    </button>
                    <div class="user-menu">
                        <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                        <div class="user-info">
                            <div class="user-name">{{ auth()->user()->name }}</div>
                            <div class="user-role">Customer</div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="page-content">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Welcome back, {{ auth()->user()->name }}!</h1>
                        <div class="breadcrumb">
                            <span>Here's an overview of your account</span>
                        </div>
                    </div>
                    <a href="{{ url('/cars') }}" class="btn btn-primary">
                        <i class="fas fa-car"></i> Browse Cars
                    </a>
                </div>

                <!-- Stats Grid -->
                <div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon blue">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                        </div>
                        <div class="stat-card-value">2</div>
                        <div class="stat-card-label">Total Purchases</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon green">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="stat-card-value">$285,000</div>
                        <div class="stat-card-label">Total Spent</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon orange">
                                <i class="fas fa-heart"></i>
                            </div>
                        </div>
                        <div class="stat-card-value">5</div>
                        <div class="stat-card-label">Saved Cars</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon red">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="stat-card-value">1</div>
                        <div class="stat-card-label">Pending Payments</div>
                    </div>
                </div>

                <!-- Recent Activity & Recommended -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <!-- Recent Purchases -->
                    <div class="card">
                        <div class="card-header d-flex justify-between align-center">
                            <h3>Recent Purchases</h3>
                            <a href="#" class="btn btn-sm btn-outline">View All</a>
                        </div>
                        <div class="card-body">
                            <div style="display: flex; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid var(--gray-100);">
                                <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?w=100" alt="BMW M5" style="width: 80px; height: 60px; object-fit: cover; border-radius: var(--radius);">
                                <div style="flex: 1;">
                                    <h4 style="font-size: 0.9375rem; margin-bottom: 0.25rem;">BMW M5 Competition</h4>
                                    <p style="font-size: 0.8125rem; color: var(--gray-500);">Purchased on Mar 15, 2024</p>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-weight: 600; color: var(--primary);">$125,000</div>
                                    <span class="badge badge-success">Completed</span>
                                </div>
                            </div>
                            <div style="display: flex; gap: 1rem; padding: 1rem 0;">
                                <img src="https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=100" alt="Mercedes" style="width: 80px; height: 60px; object-fit: cover; border-radius: var(--radius);">
                                <div style="flex: 1;">
                                    <h4 style="font-size: 0.9375rem; margin-bottom: 0.25rem;">Mercedes-AMG GT</h4>
                                    <p style="font-size: 0.8125rem; color: var(--gray-500);">Purchased on Feb 28, 2024</p>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-weight: 600; color: var(--primary);">$160,000</div>
                                    <span class="badge badge-success">Completed</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Saved Cars -->
                    <div class="card">
                        <div class="card-header d-flex justify-between align-center">
                            <h3>Saved Cars</h3>
                            <a href="#" class="btn btn-sm btn-outline">View All</a>
                        </div>
                        <div class="card-body">
                            <div style="display: flex; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid var(--gray-100);">
                                <img src="https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=100" alt="Porsche" style="width: 80px; height: 60px; object-fit: cover; border-radius: var(--radius);">
                                <div style="flex: 1;">
                                    <h4 style="font-size: 0.9375rem; margin-bottom: 0.25rem;">Porsche 911 Turbo S</h4>
                                    <p style="font-size: 0.8125rem; color: var(--gray-500);">2023 • Coupe • Petrol</p>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-weight: 600; color: var(--primary);">$215,000</div>
                                    <span class="badge badge-danger">Sold</span>
                                </div>
                            </div>
                            <div style="display: flex; gap: 1rem; padding: 1rem 0;">
                                <img src="https://images.unsplash.com/photo-1606016159991-dfe4f2746ad5?w=100" alt="Range Rover" style="width: 80px; height: 60px; object-fit: cover; border-radius: var(--radius);">
                                <div style="flex: 1;">
                                    <h4 style="font-size: 0.9375rem; margin-bottom: 0.25rem;">Range Rover Sport</h4>
                                    <p style="font-size: 0.8125rem; color: var(--gray-500);">2024 • SUV • Diesel</p>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-weight: 600; color: var(--primary);">$135,000</div>
                                    <span class="badge badge-success">Available</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recommended Cars -->
                <div class="card mt-3">
                    <div class="card-header d-flex justify-between align-center">
                        <h3>Recommended For You</h3>
                        <a href="{{ url('/cars') }}" class="btn btn-sm btn-outline">Browse All</a>
                    </div>
                    <div class="card-body">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                            <div class="car-card">
                                <div class="car-image" style="height: 180px;">
                                    <img src="https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=400" alt="Audi RS7" style="width: 100%; height: 100%; object-fit: cover;">
                                    <span class="car-badge new">New</span>
                                </div>
                                <div class="car-info">
                                    <h3 class="car-title">Audi RS7 Sportback</h3>
                                    <p class="car-subtitle">2024 Model • Quattro</p>
                                    <div class="car-footer">
                                        <span class="car-price">$145,000</span>
                                        <a href="{{ url('/car-detail/4') }}" class="btn btn-sm btn-primary">View</a>
                                    </div>
                                </div>
                            </div>
                            <div class="car-card">
                                <div class="car-image" style="height: 180px;">
                                    <img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?w=400" alt="Tesla Model S" style="width: 100%; height: 100%; object-fit: cover;">
                                    <span class="car-badge new">Electric</span>
                                </div>
                                <div class="car-info">
                                    <h3 class="car-title">Tesla Model S Plaid</h3>
                                    <p class="car-subtitle">2024 Model • AWD</p>
                                    <div class="car-footer">
                                        <span class="car-price">$109,000</span>
                                        <a href="{{ url('/car-detail/6') }}" class="btn btn-sm btn-primary">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @push('scripts')
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            sidebar.classList.toggle('show');
            mainContent.classList.toggle('expanded');
        }
    </script>
    @endpush
@endsection