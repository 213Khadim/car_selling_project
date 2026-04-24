@extends('layouts.app')

@section('title', 'Admin Dashboard - AutoDrive')

@push('styles')
    @include('admin.admin-styles')
    <style>
        .stats-grid {
        display: flex;
        min-height: 100vh;
        background: var(--gray-50);
    }
        .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
    .stat-card-change {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.875rem;
        font-weight: 600;
    }
    .stat-card-change.positive {
        color: var(--success);
    }
    .stat-card-change.negative {
        color: var(--danger);
    }
    .chart-container {
        background: var(--white);
        padding: 1.5rem;
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
    }
    .chart-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }
    .chart-title {
        font-size: 1.125rem;
        font-weight: 600;
    }
    .form-select {
        padding: 0.5rem 0.75rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        background: var(--white);
    }
    .chart-placeholder {
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray-400);
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
    </style>
@endpush

@section('content')
    <div class="admin-layout">
        @include('admin.sidebar')
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
                        <span class="notification-dot"></span>
                    </button>
                    <div class="user-menu">
                        <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                        <div class="user-info">
                            <div class="user-name">{{ auth()->user()->name }}</div>
                            <div class="user-role">Administrator</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn btn-outline btn-sm">Logout</button>
                    </form>
                </div>
            </header>

            <div class="page-content">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Dashboard</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                            <span>/</span>
                            <span>Dashboard</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline">
                            <i class="fas fa-download"></i> Export
                        </button>
                        <a href="{{ url('/admin/cars') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Car
                        </a>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon blue">
                                <i class="fas fa-car"></i>
                            </div>
                        </div>
                        <div class="stat-card-value">{{ $stats['total_cars'] }}</div>
                        <div class="stat-card-label">Total Cars</div>
                        <div class="stat-card-change positive">
                            <i class="fas fa-arrow-up"></i> 12% from last month
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon green">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="stat-card-value">${{ number_format($stats['total_sales'], 0) }}</div>
                        <div class="stat-card-label">Total Sales</div>
                        <div class="stat-card-change positive">
                            <i class="fas fa-arrow-up"></i> 8% from last month
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon orange">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="stat-card-value">{{ $stats['total_customers'] }}</div>
                        <div class="stat-card-label">Total Customers</div>
                        <div class="stat-card-change positive">
                            <i class="fas fa-arrow-up"></i> 5% from last month
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon red">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                        </div>
                        <div class="stat-card-value">${{ number_format($stats['total_expenses'], 0) }}</div>
                        <div class="stat-card-label">Total Expenses</div>
                        <div class="stat-card-change negative">
                            <i class="fas fa-arrow-down"></i> 3% from last month
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3 class="chart-title">Sales Overview</h3>
                            <select class="form-select" style="width: auto;">
                                <option>Last 7 Days</option>
                                <option>Last 30 Days</option>
                                <option>Last Year</option>
                            </select>
                        </div>
                        <div class="chart-placeholder">
                            <div style="text-align: center;">
                                <i class="fas fa-chart-line" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                                <p>Sales Chart Visualization</p>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3 class="chart-title">Cars by Status</h3>
                        </div>
                        <div class="chart-placeholder">
                            <div style="text-align: center;">
                                <i class="fas fa-chart-pie" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                                <p>Status Distribution</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Sales Table -->
                <div class="data-table-wrapper">
                    <div class="data-table-header">
                        <h3 class="data-table-title">Recent Sales</h3>
                        <a href="{{ url('/admin/sales') }}" class="btn btn-sm btn-outline">View All</a>
                    </div>
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Car</th>
                                    <th>Customer</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recent_sales as $sale)
                                <tr>
                                    <td>{{ $sale->car->name ?? 'N/A' }}</td>
                                    <td>{{ $sale->customer->name ?? 'N/A' }}</td>
                                    <td>${{ number_format($sale->sale_price, 0) }}</td>
                                    <td>{{ $sale->sale_date->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $sale->payment_status === 'paid' ? 'success' : ($sale->payment_status === 'partial' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($sale->payment_status) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="text-center" style="padding:2rem;color:var(--gray-400);">No sales recorded yet.</td></tr>
                                @endforelse
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
    </script>
    @endpush
@endsection