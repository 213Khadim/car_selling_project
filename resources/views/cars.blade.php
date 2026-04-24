@extends('layouts.app')
@php use Illuminate\Support\Facades\Storage; @endphp

@section('title', 'Cars - AutoDrive')
@section('page', 'cars')

@section('content')
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <a href="{{ url('/') }}" class="logo">
                    <i class="fas fa-car-side"></i>
                    <span>AutoDrive</span>
                </a>
                <ul class="nav-links">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/cars') }}" class="active">Cars</a></li>
                    <li><a href="{{ url('/brands') }}">Brands</a></li>
                    <li><a href="{{ url('/posts') }}">Posts</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
                <div class="nav-actions">
                    @auth
                    @if(auth()->user()->isAdmin())
                    <a href="{{ url('/admin/dashboard') }}" class="btn btn-outline">Admin Panel</a>
                    @else
                    <a href="{{ url('/user/dashboard') }}" class="btn btn-outline">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">@csrf<button type="submit" class="btn btn-primary">Logout</button></form>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    @endauth
                </div>
                <button class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </nav>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-hero" style="padding: 150px 0 80px; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
        <div class="container">
            <div class="section-header" style="margin-bottom: 0;">
                <span class="section-badge">Our Inventory</span>
                <h1>Browse Our <span class="gradient-text">Cars</span></h1>
                <p>Find your perfect vehicle from our extensive collection</p>
            </div>
        </div>
    </section>

    <!-- Filters & Cars -->
    <section class="section" style="padding-top: 3rem;">
        <div class="container">
            <!-- Filters -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('cars') }}">
                    <div class="filters-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: end;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Search</label>
                            <input type="text" name="search" class="form-input" placeholder="Search cars..." value="{{ request('search') }}">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Car Type</label>
                            <select name="type" class="form-select">
                                <option value="">All Types</option>
                                @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Brand</label>
                            <select name="company" class="form-select">
                                <option value="">All Brands</option>
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ request('company') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Max Price</label>
                            <input type="number" name="max_price" class="form-input" placeholder="e.g. 100000" value="{{ request('max_price') }}">
                        </div>
                        <div class="d-flex gap-1">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Search
                            </button>
                            <a href="{{ route('cars') }}" class="btn btn-outline">
                                <i class="fas fa-times"></i> Clear
                            </a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <!-- Cars Grid -->
            <div class="cars-grid">
                @forelse($cars as $car)
                <div class="car-card">
                    <div class="car-image">
                        @if($car->image)
                        <img src="{{ Storage::url($car->image) }}" alt="{{ $car->name }}" style="width:100%;height:200px;object-fit:cover;">
                        @else
                        <div style="width:100%;height:200px;background:var(--gray-100);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-car" style="font-size:3rem;color:var(--gray-300);"></i>
                        </div>
                        @endif
                        <div class="car-badge">{{ $car->status_label }}</div>
                    </div>
                    <div class="car-info">
                        <div class="car-brand">{{ $car->company->name ?? 'Unknown' }}</div>
                        <h3 class="car-name">{{ $car->name }}</h3>
                        <div class="car-specs">
                            <span><i class="fas fa-calendar"></i> {{ $car->year }}</span>
                            <span><i class="fas fa-palette"></i> {{ $car->color->name ?? '—' }}</span>
                            <span><i class="fas fa-road"></i> {{ $car->mileage ?? '—' }}</span>
                        </div>
                        <div class="car-price">${{ number_format($car->sale_price, 0) }}</div>
                        <a href="{{ route('car-detail', $car) }}" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
                @empty
                <div style="grid-column:1/-1;text-align:center;padding:3rem;color:var(--gray-500);">
                    <i class="fas fa-car" style="font-size:3rem;margin-bottom:1rem;"></i>
                    <p>No cars found matching your criteria.</p>
                    <a href="{{ route('cars') }}" class="btn btn-outline" style="margin-top:1rem;">Clear Filters</a>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div style="margin-top:2rem;">
                {{ $cars->withQueryString()->links() }}
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="{{ url('/') }}" class="footer-logo">
                        <i class="fas fa-car-side"></i>
                        <span>AutoDrive</span>
                    </a>
                    <p>Your trusted partner in finding the perfect vehicle. Quality cars, exceptional service.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/cars') }}">Cars</a></li>
                        <li><a href="{{ url('/brands') }}">Brands</a></li>
                        <li><a href="{{ url('/posts') }}">Blog</a></li>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="#">Car Sales</a></li>
                        <li><a href="#">Financing</a></li>
                        <li><a href="#">Trade-In</a></li>
                        <li><a href="#">Warranty</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Contact Info</h4>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> 123 Auto Street, Car City</li>
                        <li><i class="fas fa-phone"></i> +1 (555) 123-4567</li>
                        <li><i class="fas fa-envelope"></i> info@autodrive.com</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 AutoDrive. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @push('scripts')
    <script>
        // Filters are handled server-side now
    </script>
    @endpush
@endsection