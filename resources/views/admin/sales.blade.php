@extends('layouts.app')

@section('title', 'Sales Management - AutoDrive Admin')

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
                        <input type="text" placeholder="Search...">
                    </div>
                </div>
                <div class="top-bar-right">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-dot"></span>
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
                        <h1 class="page-title">Sales Management</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                            <span>/</span>
                            <span>Sales</span>
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="openModal('saleModal')">
                        <i class="fas fa-plus"></i> Record New Sale
                    </button>
                </div>

                <!-- Stats -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon green">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value" id="totalSales">$650,000</div>
                            <div class="stat-card-label">Total Sales</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon blue">
                                <i class="fas fa-receipt"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">4</div>
                            <div class="stat-card-label">Completed Sales</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon orange">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">1</div>
                            <div class="stat-card-label">Pending Sales</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon red">
                                <i class="fas fa-percentage"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value" id="totalCommissions">$32,500</div>
                            <div class="stat-card-label">Total Commissions</div>
                        </div>
                    </div>
                </div>

                <!-- Sales Table -->
                <div class="data-table-wrapper">
                    <div class="data-table-header">
                        <h3 class="data-table-title">All Sales</h3>
                        <div class="data-table-actions">
                            <select class="form-select" style="width: auto;">
                                <option value="">All Status</option>
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            <button class="btn btn-sm btn-outline">
                                <i class="fas fa-download"></i> Export
                            </button>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sale ID</th>
                                    <th>Car</th>
                                    <th>Customer</th>
                                    <th>Price</th>
                                    <th>Commission</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="adminSalesTable">
                                <!-- Data loaded dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Add Sale Modal -->
    <div class="modal-overlay" id="saleModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Record New Sale</h3>
                <button class="modal-close" onclick="closeModal('saleModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="saleForm">
                    <div class="form-group">
                        <label class="form-label">Select Car *</label>
                        <select class="form-select" required>
                            <option value="">Choose a car</option>
                            <option value="1">BMW M5 Competition - $125,000</option>
                            <option value="2">Mercedes-AMG GT - $165,000</option>
                            <option value="4">Audi RS7 Sportback - $145,000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Select Customer *</label>
                        <select class="form-select" required>
                            <option value="">Choose a customer</option>
                            <option value="1">John Smith</option>
                            <option value="2">Sarah Johnson</option>
                            <option value="3">Michael Brown</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sale Price ($) *</label>
                        <input type="number" class="form-input" placeholder="125000" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Commission Rate (%)</label>
                        <input type="number" class="form-input" placeholder="5" value="5">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sale Date *</label>
                        <input type="date" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Payment Method</label>
                        <select class="form-select">
                            <option value="cash">Cash</option>
                            <option value="financing">Financing</option>
                            <option value="bank_transfer">Bank Transfer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Notes</label>
                        <textarea class="form-textarea" rows="3" placeholder="Additional notes..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="closeModal('saleModal')">Cancel</button>
                <button class="btn btn-primary">
                    <i class="fas fa-save"></i> Record Sale
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

        // Load sales data
        loadAdminSales();
    </script>
    @endpush
@endsection