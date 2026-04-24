@extends('layouts.app')

@section('title', 'Gallery - AutoDrive Admin')

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
                        <input type="text" placeholder="Search gallery...">
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
                        <h1 class="page-title">Gallery</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                            <span>/</span>
                            <span>Gallery</span>
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="openModal('uploadModal')">
                        <i class="fas fa-cloud-upload-alt"></i> Upload Images
                    </button>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon blue">
                                <i class="fas fa-images"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">48</div>
                            <div class="stat-card-label">Total Images</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon green">
                                <i class="fas fa-car"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">32</div>
                            <div class="stat-card-label">Car Photos</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon orange">
                                <i class="fas fa-building"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">10</div>
                            <div class="stat-card-label">Showroom Photos</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon purple">
                                <i class="fas fa-hdd"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">256 MB</div>
                            <div class="stat-card-label">Storage Used</div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="gallery-grid">
                            @foreach (range(1, 8) as $item)
                                <div class="gallery-item">
                                    <div class="gallery-image">
                                        <i class="fas fa-car" style="font-size: 2rem; color: var(--gray-400);"></i>
                                    </div>
                                    <div class="gallery-overlay">
                                        <div class="gallery-actions">
                                            <button class="gallery-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="gallery-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="gallery-btn delete" title="Delete"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                    <div class="gallery-info">
                                        <div class="gallery-name">gallery-image-{{ $item }}.jpg</div>
                                        <div class="gallery-meta">2.4 MB - Apr {{ 20 - $item }}, 2026</div>
                                    </div>
                                </div>
                            @endforeach
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
        function openModal(id) {
            document.getElementById(id).classList.add('show');
        }
    </script>
    @endpush
@endsection