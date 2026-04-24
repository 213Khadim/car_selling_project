@extends('layouts.app')

@section('title', 'Cars/Posts - AutoDrive Admin')

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
                        <input type="text" placeholder="Search cars/posts...">
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
                        <h1 class="page-title">Cars / Posts</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                            <span>/</span>
                            <span>Cars/Posts</span>
                        </div>
                    </div>
                    <a href="{{ url('/cars') }}" class="btn btn-outline" target="_blank">
                        <i class="fas fa-external-link-alt"></i> View Website
                    </a>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon green">
                                <i class="fas fa-globe"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">12</div>
                            <div class="stat-card-label">Published Cars</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon orange">
                                <i class="fas fa-eye-slash"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">8</div>
                            <div class="stat-card-label">Unpublished Cars</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon blue">
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">5</div>
                            <div class="stat-card-label">Featured Cars</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon purple">
                                <i class="fas fa-eye"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">2,450</div>
                            <div class="stat-card-label">Total Views</div>
                        </div>
                    </div>
                </div>

                <div class="data-table-wrapper">
                    <div class="data-table-header">
                        <h3 class="data-table-title">Website Inventory</h3>
                        <div class="data-table-actions">
                            <button class="btn btn-sm btn-success">
                                <i class="fas fa-globe"></i> Publish Selected
                            </button>
                            <button class="btn btn-sm btn-outline">
                                <i class="fas fa-eye-slash"></i> Unpublish
                            </button>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>Car</th>
                                    <th>Company</th>
                                    <th>Price</th>
                                    <th>Location</th>
                                    <th>Views</th>
                                    <th>Status</th>
                                    <th>Featured</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>BMW M5 Competition</td>
                                    <td>BMW</td>
                                    <td>$142,000</td>
                                    <td>Dubai</td>
                                    <td>424</td>
                                    <td><span class="badge badge-success">Published</span></td>
                                    <td><span class="badge badge-primary">Yes</span></td>
                                    <td>
                                        <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                        <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>Mercedes-AMG GT</td>
                                    <td>Mercedes</td>
                                    <td>$175,000</td>
                                    <td>Herat</td>
                                    <td>318</td>
                                    <td><span class="badge badge-warning">Draft</span></td>
                                    <td><span class="badge badge-primary">No</span></td>
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
    </script>
    @endpush
@endsection