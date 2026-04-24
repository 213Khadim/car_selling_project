@extends('layouts.app')

@section('title', 'Customer Payments - AutoDrive Admin')

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
                        <input type="text" placeholder="Search payments...">
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
                        <h1 class="page-title">Customer Payments</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                            <span>/</span>
                            <span>Customer Payments</span>
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="openModal('paymentModal')">
                        <i class="fas fa-plus"></i> Add Payment
                    </button>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon green">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">$145,000</div>
                            <div class="stat-card-label">Total Paid</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon blue">
                                <i class="fas fa-credit-card"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">$32,500</div>
                            <div class="stat-card-label">Pending Payments</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon orange">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">$18,700</div>
                            <div class="stat-card-label">Overdue</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon purple">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">12</div>
                            <div class="stat-card-label">Recent Payments</div>
                        </div>
                    </div>
                </div>

                <div class="data-table-wrapper">
                    <div class="data-table-header">
                        <h3 class="data-table-title">Payment History</h3>
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
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#ORD-1023</td>
                                    <td>Amir Rahimi</td>
                                    <td>$18,000</td>
                                    <td>Credit Card</td>
                                    <td><span class="badge badge-success">Completed</span></td>
                                    <td>Apr 22, 2026</td>
                                </tr>
                                <tr>
                                    <td>#ORD-1018</td>
                                    <td>Sara Ahmadi</td>
                                    <td>$12,500</td>
                                    <td>Bank Transfer</td>
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    <td>Apr 20, 2026</td>
                                </tr>
                                <tr>
                                    <td>#ORD-1007</td>
                                    <td>Faisal Khan</td>
                                    <td>$24,400</td>
                                    <td>Cash</td>
                                    <td><span class="badge badge-success">Completed</span></td>
                                    <td>Apr 18, 2026</td>
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