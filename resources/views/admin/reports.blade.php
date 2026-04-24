@extends('layouts.app')

@section('title', 'Reports - AutoDrive Admin')

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
    .d-flex {
        display: flex;
    }
    .gap-2 {
        gap: 0.5rem;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        padding: 1.5rem;
    }
    .stat-card-label {
        font-size: 0.875rem;
        color: var(--gray-500);
        margin-bottom: 0.5rem;
    }
    .stat-card-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 0.25rem;
    }
    .stat-card-change {
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    .stat-card-change.positive {
        color: var(--success);
    }
    .stat-card-change.negative {
        color: var(--danger);
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
    .report-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .report-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }
    .report-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 2rem;
    }
    .report-icon.blue {
        background: rgba(37, 99, 235, 0.1);
        color: var(--primary);
    }
    .report-icon.green {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }
    .report-icon.success {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }
    .report-icon.danger {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }
    .report-icon.warning {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }
    .report-icon.purple {
        background: rgba(124, 58, 237, 0.1);
        color: #7c3aed;
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
    .badge {
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .badge-primary {
        background: var(--primary);
        color: var(--white);
    }
    .badge-warning {
        background: var(--warning);
        color: var(--white);
    }
    .badge-danger {
        background: var(--danger);
        color: var(--white);
    }
    .form-group {
        margin-bottom: 1.5rem;
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
                    <a href="{{ url('/admin/customer-payments') }}" class="nav-item">
                        <i class="fas fa-credit-card"></i>
                        <span>Customer Payments</span>
                    </a>
                    <a href="{{ url('/admin/customers') }}" class="nav-item">
                        <i class="fas fa-users"></i>
                        <span>Customers</span>
                    </a>
                </div>
                <div class="nav-section">
                    <div class="nav-section-title">Finance</div>
                    <a href="{{ url('/admin/cash-accounts') }}" class="nav-item">
                        <i class="fas fa-wallet"></i>
                        <span>Cash Accounts</span>
                    </a>
                    <a href="{{ url('/admin/cash-transfer') }}" class="nav-item">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Cash Transfer</span>
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
                    <a href="{{ url('/admin/reports') }}" class="nav-item active">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                    </a>
                </div>
                <div class="nav-section">
                    <div class="nav-section-title">Website</div>
                    <a href="{{ url('/admin/posts') }}" class="nav-item">
                        <i class="fas fa-newspaper"></i>
                        <span>Cars/Posts</span>
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
                </div>
                <div class="top-bar-right">
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
                        <h1 class="page-title">Reports</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                            <span>/</span>
                            <span>Reports</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <div class="form-group" style="margin-bottom: 0;">
                            <select class="form-select" style="width: auto;">
                                <option>This Month</option>
                                <option>Last Month</option>
                                <option>This Quarter</option>
                                <option>This Year</option>
                                <option>Custom Range</option>
                            </select>
                        </div>
                        <button class="btn btn-primary">
                            <i class="fas fa-download"></i> Export All
                        </button>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-label">Total Revenue</div>
                        <div class="stat-card-value" style="color: var(--success);">$650,000</div>
                        <div class="stat-card-change positive">
                            <i class="fas fa-arrow-up"></i> 12% from last month
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-label">Total Expenses</div>
                        <div class="stat-card-value" style="color: var(--danger);">$42,700</div>
                        <div class="stat-card-change negative">
                            <i class="fas fa-arrow-down"></i> 3% from last month
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-label">Net Profit</div>
                        <div class="stat-card-value" style="color: var(--success);">$607,300</div>
                        <div class="stat-card-change positive">
                            <i class="fas fa-arrow-up"></i> 15% from last month
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-label">Total Commissions</div>
                        <div class="stat-card-value">$32,500</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-label">Cars Sold</div>
                        <div class="stat-card-value">12</div>
                    </div>
                </div>

                <!-- Report Cards -->
                <h3 style="margin-bottom: 1.5rem; color: var(--gray-700);">Available Reports</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                    <!-- Cars Report -->
                    <div class="card report-card">
                        <div class="card-body" style="text-align: center; padding: 2rem;">
                            <div class="report-icon blue">
                                <i class="fas fa-car"></i>
                            </div>
                            <h3 style="margin-bottom: 0.5rem;">Cars Report</h3>
                            <p style="color: var(--gray-500); margin-bottom: 1.5rem; font-size: 0.875rem;">Inventory status by location, sales breakdown, and vehicle tracking</p>
                            <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                <button class="btn btn-sm btn-outline" onclick="generateReport('cars_location')">
                                    <i class="fas fa-map-marker-alt"></i> By Location
                                </button>
                                <button class="btn btn-sm btn-outline" onclick="generateReport('cars_status')">
                                    <i class="fas fa-tag"></i> By Status
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sales Report -->
                    <div class="card report-card">
                        <div class="card-body" style="text-align: center; padding: 2rem;">
                            <div class="report-icon green">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <h3 style="margin-bottom: 0.5rem;">Sales Report</h3>
                            <p style="color: var(--gray-500); margin-bottom: 1.5rem; font-size: 0.875rem;">Sales transactions, revenue analysis, and customer details</p>
                            <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                <button class="btn btn-sm btn-outline" onclick="generateReport('sales_summary')">
                                    <i class="fas fa-chart-line"></i> Summary
                                </button>
                                <button class="btn btn-sm btn-outline" onclick="generateReport('sales_detailed')">
                                    <i class="fas fa-list"></i> Detailed
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Income Report -->
                    <div class="card report-card">
                        <div class="card-body" style="text-align: center; padding: 2rem;">
                            <div class="report-icon success">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <h3 style="margin-bottom: 0.5rem;">Income Report</h3>
                            <p style="color: var(--gray-500); margin-bottom: 1.5rem; font-size: 0.875rem;">Revenue from sales, commissions, and payment tracking</p>
                            <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                <button class="btn btn-sm btn-outline" onclick="generateReport('income_monthly')">
                                    <i class="fas fa-calendar"></i> Monthly
                                </button>
                                <button class="btn btn-sm btn-outline" onclick="generateReport('income_yearly')">
                                    <i class="fas fa-calendar-alt"></i> Yearly
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Expense Report -->
                    <div class="card report-card">
                        <div class="card-body" style="text-align: center; padding: 2rem;">
                            <div class="report-icon danger">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <h3 style="margin-bottom: 0.5rem;">Expense Report</h3>
                            <p style="color: var(--gray-500); margin-bottom: 1.5rem; font-size: 0.875rem;">Expense breakdown by category for tax and auditing</p>
                            <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                <button class="btn btn-sm btn-outline" onclick="generateReport('expense_category')">
                                    <i class="fas fa-tags"></i> By Category
                                </button>
                                <button class="btn btn-sm btn-outline" onclick="generateReport('expense_monthly')">
                                    <i class="fas fa-calendar"></i> Monthly
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Commission Report -->
                    <div class="card report-card">
                        <div class="card-body" style="text-align: center; padding: 2rem;">
                            <div class="report-icon purple">
                                <i class="fas fa-percentage"></i>
                            </div>
                            <h3 style="margin-bottom: 0.5rem;">Commission Report</h3>
                            <p style="color: var(--gray-500); margin-bottom: 1.5rem; font-size: 0.875rem;">Commission earnings by week, month, and by agent</p>
                            <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                <button class="btn btn-sm btn-outline" onclick="generateReport('commission_weekly')">
                                    <i class="fas fa-calendar-week"></i> Weekly
                                </button>
                                <button class="btn btn-sm btn-outline" onclick="generateReport('commission_all')">
                                    <i class="fas fa-list-alt"></i> All
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Balance Sheet -->
                    <div class="card report-card">
                        <div class="card-body" style="text-align: center; padding: 2rem;">
                            <div class="report-icon warning">
                                <i class="fas fa-balance-scale"></i>
                            </div>
                            <h3 style="margin-bottom: 0.5rem;">Balance Sheet</h3>
                            <p style="color: var(--gray-500); margin-bottom: 1.5rem; font-size: 0.875rem;">Complete financial overview, assets, liabilities, and profit/loss</p>
                            <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                <button class="btn btn-sm btn-primary" onclick="generateReport('balance_sheet')">
                                    <i class="fas fa-file-alt"></i> Generate Report
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Generated Reports -->
                <div class="data-table-wrapper">
                    <div class="data-table-header">
                        <h3 class="data-table-title">Recently Generated Reports</h3>
                    </div>
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Report Name</th>
                                    <th>Type</th>
                                    <th>Date Range</th>
                                    <th>Generated On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="fas fa-file-pdf" style="color: var(--danger); margin-right: 0.5rem;"></i> Balance Sheet - January 2024</td>
                                    <td><span class="badge badge-warning">Balance Sheet</span></td>
                                    <td>Jan 1 - Jan 31, 2024</td>
                                    <td>Jan 31, 2024</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline"><i class="fas fa-download"></i> Download</button>
                                        <button class="btn btn-sm btn-outline"><i class="fas fa-eye"></i> View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-file-excel" style="color: var(--success); margin-right: 0.5rem;"></i> Cars Report - By Location</td>
                                    <td><span class="badge badge-primary">Cars Report</span></td>
                                    <td>All Time</td>
                                    <td>Jan 28, 2024</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline"><i class="fas fa-download"></i> Download</button>
                                        <button class="btn btn-sm btn-outline"><i class="fas fa-eye"></i> View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-file-pdf" style="color: var(--danger); margin-right: 0.5rem;"></i> Expense Report - December 2023</td>
                                    <td><span class="badge badge-danger">Expense Report</span></td>
                                    <td>Dec 1 - Dec 31, 2023</td>
                                    <td>Jan 2, 2024</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline"><i class="fas fa-download"></i> Download</button>
                                        <button class="btn btn-sm btn-outline"><i class="fas fa-eye"></i> View</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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

        function generateReport(type) {
            const reportNames = {
                'cars_location': 'Cars Report by Location',
                'cars_status': 'Cars Report by Status',
                'sales_summary': 'Sales Summary Report',
                'sales_detailed': 'Detailed Sales Report',
                'income_monthly': 'Monthly Income Report',
                'income_yearly': 'Yearly Income Report',
                'expense_category': 'Expense Report by Category',
                'expense_monthly': 'Monthly Expense Report',
                'commission_weekly': 'Weekly Commission Report',
                'commission_all': 'All Commissions Report',
                'balance_sheet': 'Balance Sheet'
            };

            alert(`Generating: ${reportNames[type]}\n\nThis will create a downloadable PDF/Excel report.`);
        }
    </script>
    @endpush
@endsection