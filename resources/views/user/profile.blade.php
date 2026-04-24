@extends('layouts.app')

@section('title', 'Profile - AutoDrive')

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
    .breadcrumb a {
        color: var(--gray-500);
        text-decoration: none;
    }
    .breadcrumb a:hover {
        color: var(--gray-700);
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
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--gray-800);
    }
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        font-size: 1rem;
        transition: var(--transition);
    }
    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    .form-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        font-size: 1rem;
        transition: var(--transition);
        resize: vertical;
    }
    .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    .mb-3 {
        margin-bottom: 1.5rem;
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
                    <a href="{{ url('/user/dashboard') }}" class="nav-item">
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
                    <a href="{{ url('/user/profile') }}" class="nav-item active">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                    <a href="#" class="nav-item" onclick="logout('user')">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
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
                    <div class="user-menu">
                        <div class="user-avatar">JD</div>
                        <div class="user-info">
                            <div class="user-name">John Doe</div>
                            <div class="user-role">Customer</div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="page-content">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">My Profile</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/user/dashboard') }}">Dashboard</a>
                            <span>/</span>
                            <span>Profile</span>
                        </div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 300px 1fr; gap: 2rem;">
                    <!-- Profile Card -->
                    <div class="card">
                        <div class="card-body" style="text-align: center; padding: 2rem;">
                            <div style="width: 120px; height: 120px; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; background: var(--gradient); border-radius: 50%; font-size: 2.5rem; font-weight: 700; color: white;">
                                JD
                            </div>
                            <h3 style="margin-bottom: 0.25rem;">John Doe</h3>
                            <p style="color: var(--gray-500); margin-bottom: 1.5rem;">john.doe@example.com</p>
                            <div style="display: flex; justify-content: center; gap: 2rem; padding: 1.5rem 0; border-top: 1px solid var(--gray-100); border-bottom: 1px solid var(--gray-100); margin-bottom: 1.5rem;">
                                <div>
                                    <div style="font-size: 1.5rem; font-weight: 700; color: var(--gray-800);">2</div>
                                    <div style="font-size: 0.8125rem; color: var(--gray-500);">Purchases</div>
                                </div>
                                <div>
                                    <div style="font-size: 1.5rem; font-weight: 700; color: var(--gray-800);">5</div>
                                    <div style="font-size: 0.8125rem; color: var(--gray-500);">Saved</div>
                                </div>
                            </div>
                            <p style="font-size: 0.875rem; color: var(--gray-500);">
                                Member since January 2024
                            </p>
                        </div>
                    </div>

                    <!-- Profile Settings -->
                    <div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3><i class="fas fa-user" style="margin-right: 0.5rem;"></i> Personal Information</h3>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                                        <div class="form-group">
                                            <label class="form-label">First Name</label>
                                            <input type="text" class="form-input" value="John">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" class="form-input" value="Doe">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-input" value="john.doe@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Phone Number</label>
                                            <input type="tel" class="form-input" value="+1 (555) 123-4567">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Address</label>
                                        <textarea class="form-textarea" rows="2">123 Main Street, New York, NY 10001</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fas fa-lock" style="margin-right: 0.5rem;"></i> Change Password</h3>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-input" placeholder="Enter current password">
                                    </div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                                        <div class="form-group">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-input" placeholder="Enter new password">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-input" placeholder="Confirm new password">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </form>
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

        function logout(type) {
            // Simple logout - redirect to login
            window.location.href = '{{ url("/user/login") }}';
        }
    </script>
    @endpush
@endsection