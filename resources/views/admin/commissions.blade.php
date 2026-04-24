@extends('layouts.app')

@section('title', 'Commissions - AutoDrive Admin')

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
                        <input type="text" placeholder="Search commissions...">
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
                        <h1 class="page-title">Commissions</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                            <span>/</span>
                            <span>Commissions</span>
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="openModal('commissionModal')">
                        <i class="fas fa-plus"></i> Add Commission
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
                            <div class="stat-card-value">$32,500</div>
                            <div class="stat-card-label">Total Commissions</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon blue">
                                <i class="fas fa-money-bill"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">AED 15,000</div>
                            <div class="stat-card-label">Local Commissions</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon orange">
                                <i class="fas fa-coins"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">AFN 250,000</div>
                            <div class="stat-card-label">Regional Earnings</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon purple">
                                <i class="fas fa-calendar-week"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">$5,200</div>
                            <div class="stat-card-label">This Week</div>
                        </div>
                    </div>
                </div>

                <div class="data-table-wrapper">
                    <div class="data-table-header">
                        <h3 class="data-table-title">Commission Records</h3>
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
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Currency</th>
                                    <th>Account</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#COM-001</td>
                                    <td>Weekly sales commission</td>
                                    <td>$5,200</td>
                                    <td><span class="badge badge-primary">USD</span></td>
                                    <td>Sales Commission</td>
                                    <td>Apr 20, 2026</td>
                                    <td>
                                        <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                        <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#COM-002</td>
                                    <td>Monthly partner commission</td>
                                    <td>$8,800</td>
                                    <td><span class="badge badge-primary">USD</span></td>
                                    <td>Partner Income</td>
                                    <td>Apr 15, 2026</td>
                                    <td>
                                        <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                        <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#COM-003</td>
                                    <td>Special incentive payout</td>
                                    <td>$3,600</td>
                                    <td><span class="badge badge-primary">USD</span></td>
                                    <td>Incentive</td>
                                    <td>Apr 10, 2026</td>
                                    <td>
                                        <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                        <button class="action-btn delete"><i class="fas fa-trash"></i></button>
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
        function openModal(id) {
            document.getElementById(id).classList.add('show');
        }
        function closeModal(id) {
            document.getElementById(id).classList.remove('show');
        }
    </script>
    @endpush
@endsection