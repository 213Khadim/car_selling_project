@extends('layouts.app')

@section('title', 'Cash Accounts - AutoDrive Admin')

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
    .search-bar {
        position: relative;
        display: flex;
        align-items: center;
    }
    .search-bar i {
        position: absolute;
        left: 0.75rem;
        color: var(--gray-400);
    }
    .search-bar input {
        padding: 0.5rem 0.75rem 0.5rem 2.5rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        width: 300px;
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
    .notification-dot {
        position: absolute;
        top: 0.25rem;
        right: 0.25rem;
        width: 8px;
        height: 8px;
        background: var(--danger);
        border-radius: 50%;
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
    .d-flex {
        display: flex;
    }
    .gap-2 {
        gap: 0.5rem;
    }
    .mb-3 {
        margin-bottom: 1rem;
    }
    .card {
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        overflow: hidden;
    }
    .card-body {
        padding: 1.5rem;
    }
    .data-table-wrapper {
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        overflow: hidden;
    }
    .data-table-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .data-table-title {
        font-size: 1.125rem;
        font-weight: 600;
    }
    .table-wrapper {
        overflow-x: auto;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table th,
    .table td {
        padding: 1rem 1.5rem;
        text-align: left;
        border-bottom: 1px solid var(--gray-200);
    }
    .table th {
        font-weight: 600;
        color: var(--gray-700);
        background: var(--gray-50);
    }
    .table tbody tr:hover {
        background: var(--gray-50);
    }
    .action-btn {
        background: none;
        border: none;
        padding: 0.5rem;
        border-radius: var(--radius);
        cursor: pointer;
        margin-right: 0.25rem;
        transition: var(--transition);
    }
    .action-btn.view {
        color: var(--primary);
    }
    .action-btn.view:hover {
        background: rgba(37, 99, 235, 0.1);
    }
    .action-btn.edit {
        color: var(--warning);
    }
    .action-btn.edit:hover {
        background: rgba(245, 158, 11, 0.1);
    }
    .action-btn.delete {
        color: var(--danger);
    }
    .action-btn.delete:hover {
        background: rgba(239, 68, 68, 0.1);
    }
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 2000;
    }
    .modal-overlay.show {
        display: flex;
    }
    .modal {
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-xl);
        max-width: 500px;
        max-height: 90vh;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .modal-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modal-header h3 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
    }
    .modal-close {
        background: none;
        border: none;
        padding: 0.5rem;
        border-radius: var(--radius);
        color: var(--gray-400);
        cursor: pointer;
        transition: var(--transition);
    }
    .modal-close:hover {
        background: var(--gray-100);
        color: var(--gray-600);
    }
    .modal-body {
        padding: 1.5rem;
        overflow-y: auto;
        flex: 1;
    }
    .modal-footer {
        padding: 1.5rem;
        border-top: 1px solid var(--gray-200);
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
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
    .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        background: var(--white);
        font-size: 1rem;
        transition: var(--transition);
    }
    .form-select:focus {
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
        .data-table-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
        .modal {
            max-width: 95vw;
            max-height: 95vh;
        }
        .modal-header,
        .modal-body,
        .modal-footer {
            padding: 1rem;
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
                    <div class="nav-section-title">Main</div>
                    <a href="{{ url('/admin/dashboard') }}" class="nav-item">
                        <i class="fas fa-th-large"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ url('/admin/cars') }}" class="nav-item">
                        <i class="fas fa-car"></i>
                        <span>Cars</span>
                    </a>
                    <a href="{{ url('/admin/sales') }}" class="nav-item">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Sales</span>
                    </a>
                    <a href="{{ url('/admin/customers') }}" class="nav-item">
                        <i class="fas fa-users"></i>
                        <span>Customers</span>
                    </a>
                </div>
                <div class="nav-section">
                    <div class="nav-section-title">Finance</div>
                    <a href="{{ url('/admin/cash-accounts') }}" class="nav-item active">
                        <i class="fas fa-wallet"></i>
                        <span>Cash Accounts</span>
                    </a>
                    <a href="{{ url('/admin/expenses') }}" class="nav-item">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Expenses</span>
                    </a>
                    <a href="{{ url('/admin/commissions') }}" class="nav-item">
                        <i class="fas fa-percentage"></i>
                        <span>Commissions</span>
                    </a>
                </div>
                <div class="nav-section">
                    <div class="nav-section-title">Reports</div>
                    <a href="{{ url('/admin/reports') }}" class="nav-item">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                    </a>
                </div>
                <div class="nav-section">
                    <div class="nav-section-title">Website</div>
                    <a href="{{ url('/admin/posts') }}" class="nav-item">
                        <i class="fas fa-newspaper"></i>
                        <span>Posts</span>
                    </a>
                    <a href="{{ url('/admin/gallery') }}" class="nav-item">
                        <i class="fas fa-images"></i>
                        <span>Gallery</span>
                    </a>
                    <a href="{{ url('/admin/messages') }}" class="nav-item">
                        <i class="fas fa-envelope"></i>
                        <span>Messages</span>
                    </a>
                </div>
                <div class="nav-section">
                    <div class="nav-section-title">Settings</div>
                    <a href="{{ url('/admin/settings') }}" class="nav-item">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
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
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search...">
                    </div>
                </div>
                <div class="top-bar-right">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                    </button>
                    <div class="user-menu">
                        <div class="user-avatar">AD</div>
                        <div class="user-info">
                            <div class="user-name">Admin User</div>
                            <div class="user-role">Administrator</div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="page-content">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Cash Accounts</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                            <span>/</span>
                            <span>Cash Accounts</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline" onclick="openModal('transferModal')">
                            <i class="fas fa-exchange-alt"></i> Transfer
                        </button>
                        <button class="btn btn-primary" onclick="openModal('accountModal')">
                            <i class="fas fa-plus"></i> Add Account
                        </button>
                    </div>
                </div>

                <!-- Total Balance Card -->
                <div class="card mb-3">
                    <div class="card-body" style="text-align: center; padding: 3rem;">
                        <p style="color: var(--gray-500); margin-bottom: 0.5rem;">Total Balance</p>
                        <h1 style="font-size: 3rem; color: var(--success);">$355,000</h1>
                        <p style="color: var(--gray-400); font-size: 0.875rem;">Across all accounts</p>
                    </div>
                </div>

                <!-- Accounts Table -->
                <div class="data-table-wrapper">
                    <div class="data-table-header">
                        <h3 class="data-table-title">All Accounts</h3>
                    </div>
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Account Name</th>
                                    <th>Type</th>
                                    <th>Balance</th>
                                    <th>Currency</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="cashAccountsTable">
                                <!-- Data loaded dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Add Account Modal -->
    <div class="modal-overlay" id="accountModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Add New Account</h3>
                <button class="modal-close" onclick="closeModal('accountModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label class="form-label">Account Name *</label>
                        <input type="text" class="form-input" placeholder="e.g. Main Account" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Account Type *</label>
                        <select class="form-select" required>
                            <option value="">Select Type</option>
                            <option value="bank">Bank Account</option>
                            <option value="cash">Cash</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Initial Balance ($)</label>
                        <input type="number" class="form-input" placeholder="0" value="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Currency</label>
                        <select class="form-select">
                            <option value="USD">USD - US Dollar</option>
                            <option value="EUR">EUR - Euro</option>
                            <option value="GBP">GBP - British Pound</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="closeModal('accountModal')">Cancel</button>
                <button class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Account
                </button>
            </div>
        </div>
    </div>

    <!-- Transfer Modal -->
    <div class="modal-overlay" id="transferModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Transfer Funds</h3>
                <button class="modal-close" onclick="closeModal('transferModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label class="form-label">From Account *</label>
                        <select class="form-select" required>
                            <option value="">Select Account</option>
                            <option value="1">Main Account - $250,000</option>
                            <option value="2">Petty Cash - $5,000</option>
                            <option value="3">Savings Account - $100,000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">To Account *</label>
                        <select class="form-select" required>
                            <option value="">Select Account</option>
                            <option value="1">Main Account - $250,000</option>
                            <option value="2">Petty Cash - $5,000</option>
                            <option value="3">Savings Account - $100,000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Amount ($) *</label>
                        <input type="number" class="form-input" placeholder="Enter amount" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-textarea" rows="2" placeholder="Transfer reason..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="closeModal('transferModal')">Cancel</button>
                <button class="btn btn-primary">
                    <i class="fas fa-exchange-alt"></i> Transfer
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            sidebar.classList.toggle('show');
            mainContent.classList.toggle('expanded');
        }

        function openModal(modalId) {
            document.getElementById(modalId).classList.add('show');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
        }

        // Load cash accounts data
        loadCashAccounts();
    </script>
    @endpush
@endsection