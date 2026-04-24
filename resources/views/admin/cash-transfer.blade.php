@extends('layouts.app')

@section('title', 'Cash Transfer - AutoDrive Admin')

@push('styles')
    @include('admin.admin-styles')
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
                        <input type="text" placeholder="Search transfers...">
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
                        <h1 class="page-title">Cash Transfer</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                            <span>/</span>
                            <span>Cash Transfer</span>
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="openModal('transferModal')">
                        <i class="fas fa-exchange-alt"></i> Transfer Funds
                    </button>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon green">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">$355,000</div>
                            <div class="stat-card-label">Total Balance</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon blue">
                                <i class="fas fa-university"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">3</div>
                            <div class="stat-card-label">Active Accounts</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon orange">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">24</div>
                            <div class="stat-card-label">Transfers</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon purple">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">$45,000</div>
                            <div class="stat-card-label">Today</div>
                        </div>
                    </div>
                </div>

                <div class="data-table-wrapper">
                    <div class="data-table-header">
                        <h3 class="data-table-title">Recent Transfers</h3>
                        <div class="data-table-actions">
                            <button class="btn btn-sm btn-outline">
                                <i class="fas fa-download"></i> Export
                            </button>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Amount</th>
                                    <th>Currency</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Main Account</td>
                                    <td>Petty Cash</td>
                                    <td>$5,000</td>
                                    <td>USD</td>
                                    <td>Apr 22, 2026</td>
                                    <td><span class="badge badge-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>Savings Account</td>
                                    <td>Main Account</td>
                                    <td>$12,000</td>
                                    <td>USD</td>
                                    <td>Apr 20, 2026</td>
                                    <td><span class="badge badge-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>Main Account</td>
                                    <td>Marketing Fund</td>
                                    <td>$8,500</td>
                                    <td>USD</td>
                                    <td>Apr 18, 2026</td>
                                    <td><span class="badge badge-warning">Pending</span></td>
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
        function openModal(id) {
            document.getElementById(id).classList.add('show');
        }
    </script>
    @endpush
@endsection