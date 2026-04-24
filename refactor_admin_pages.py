#!/usr/bin/env python3
import re
import os

# Change to project directory
os.chdir(r'c:\laragon\www\Khadim\Car\laravel_car_project')

# Files to refactor
files = [
    'resources/views/admin/cars.blade.php',
    'resources/views/admin/sales.blade.php',
    'resources/views/admin/customers.blade.php'
]

# Map files to titles
titles = {
    'cars': 'Cars Management - AutoDrive Admin',
    'sales': 'Sales Management - AutoDrive Admin',
    'customers': 'Customers - AutoDrive Admin'
}

for file_path in files:
    # Determine title
    file_type = 'cars' if 'cars' in file_path else 'sales' if 'sales' in file_path else 'customers'
    title = titles[file_type]
    
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Find where the page-content div starts
    page_start = content.find('<div class="page-content">')
    
    if page_start > 0:
        # Extract everything from page-content onwards
        page_content = content[page_start:]
        
        # Create new version with shared partials
        new_content = f'''@extends('layouts.app')

@section('title', '{title}')

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

            ''' + page_content
        
        # Keep only up to the final @endsection if it exists
        if '@endsection' in new_content:
            last_endsection = new_content.rfind('@endsection')
            new_content = new_content[:last_endsection] + '@endsection'
        
        with open(file_path, 'w', encoding='utf-8') as f:
            f.write(new_content)
        
        print(f'Refactored: {file_path}')

print('Done!')
