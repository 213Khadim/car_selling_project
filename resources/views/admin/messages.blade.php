@extends('layouts.app')

@section('title', 'Messages - AutoDrive Admin')

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
                        <input type="text" placeholder="Search messages...">
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
                        <h1 class="page-title">Messages</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                            <span>/</span>
                            <span>Messages</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline" onclick="markAllRead()">
                            <i class="fas fa-check-double"></i> Mark All Read
                        </button>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon blue">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">24</div>
                            <div class="stat-card-label">Total Messages</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon orange">
                                <i class="fas fa-envelope-open"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">5</div>
                            <div class="stat-card-label">Unread</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon green">
                                <i class="fas fa-reply"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">19</div>
                            <div class="stat-card-label">Replied</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon purple">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-value">3</div>
                            <div class="stat-card-label">Today</div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body" style="padding: 0;">
                        <div class="message-list">
                            @foreach ([
                                ['sender' => 'Ahmad Khan', 'subject' => 'Inquiry about BMW M5', 'preview' => 'Hello, I am interested in the BMW M5 Competition listed on your website. Please share payment options...', 'time' => '2 hours ago', 'tags' => ['Car Inquiry', 'Unread']],
                                ['sender' => 'Mohammad Reza', 'subject' => 'Test Drive Request', 'preview' => 'I would like to schedule a test drive for Mercedes-AMG GT this weekend. Please share available slots...', 'time' => '5 hours ago', 'tags' => ['Test Drive', 'Unread']],
                                ['sender' => 'Sara Aziz', 'subject' => 'Financing Questions', 'preview' => 'Can you provide the finance details for the Toyota Land Cruiser? I need information about monthly installments...', 'time' => '1 day ago', 'tags' => ['Finance', 'Replied']],
                            ] as $message)
                                <div class="message-item {{ in_array('Unread', $message['tags']) ? 'unread' : '' }}" onclick="openMessageModal()">
                                    <div class="message-checkbox">
                                        <input type="checkbox" onclick="event.stopPropagation();">
                                    </div>
                                    <div class="message-avatar">
                                        <div class="user-avatar" style="width: 40px; height: 40px;">{{ strtoupper(substr($message['sender'], 0, 2)) }}</div>
                                    </div>
                                    <div class="message-content">
                                        <div class="message-header">
                                            <div class="message-sender">{{ $message['sender'] }}</div>
                                            <div class="message-time">{{ $message['time'] }}</div>
                                        </div>
                                        <div class="message-subject">{{ $message['subject'] }}</div>
                                        <div class="message-preview">{{ $message['preview'] }}</div>
                                        <div class="message-tags">
                                            @foreach ($message['tags'] as $tag)
                                                <span class="badge badge-primary">{{ $tag }}</span>
                                            @endforeach
                                        </div>
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
        function markAllRead() {
            alert('All messages marked as read.');
        }
        function openMessageModal() {
            alert('Message details modal would open here.');
        }
    </script>
    @endpush
@endsection