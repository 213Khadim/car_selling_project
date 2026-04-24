@extends('layouts.app')
@php use Illuminate\Support\Facades\Storage; @endphp

@section('title', 'AutoDrive - Premium Car Sales')
@section('page', 'home')

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
                    <li><a href="{{ url('/') }}" class="active">Home</a></li>
                    <li><a href="{{ url('/cars') }}">Cars</a></li>
                    <li><a href="{{ url('/brands') }}">Brands</a></li>
                    <li><a href="{{ url('/posts') }}">Posts</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
                <div class="nav-actions">
                    @auth
                    @if(auth()->user()->isAdmin())
                    <a href="{{ url('/admin/dashboard') }}" class="btn btn-outline">Admin Panel</a>
                    @else
                    <a href="{{ url('/user/dashboard') }}" class="btn btn-outline">My Account</a>
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="hero-content">
                <span class="hero-badge">Premium Car Dealership</span>
                <h1>Find Your <span class="gradient-text">Dream Car</span> Today</h1>
                <p>Discover our extensive collection of luxury and performance vehicles. Quality assured with comprehensive service.</p>
                <div class="hero-search">
                    <div class="search-box">
                        <div class="search-field">
                            <i class="fas fa-car"></i>
                            <select id="carType">
                                <option value="">Car Type</option>
                                <option value="sedan">Sedan</option>
                                <option value="suv">SUV</option>
                                <option value="coupe">Coupe</option>
                                <option value="truck">Truck</option>
                            </select>
                        </div>
                        <div class="search-field">
                            <i class="fas fa-tag"></i>
                            <select name="company" id="brand">
                                <option value="">Brand</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="search-field">
                            <i class="fas fa-dollar-sign"></i>
                            <select name="max_price" id="priceRange">
                                <option value="">Price Range</option>
                                <option value="25000">Under $25,000</option>
                                <option value="50000">Under $50,000</option>
                                <option value="100000">Under $100,000</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary search-btn">
                            <i class="fas fa-search"></i>
                            Search
                        </button>
                    </div>
                </div>
                <div class="hero-stats">
                    <div class="stat">
                        <span class="stat-number">{{ $stats['total_cars'] }}+</span>
                        <span class="stat-label">Cars Available</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">{{ $stats['sold_cars'] }}+</span>
                        <span class="stat-label">Cars Sold</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">{{ $stats['brands'] }}+</span>
                        <span class="stat-label">Brands</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Cars -->
    <section class="section featured-cars">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Featured Vehicles</span>
                <h2>Our <span class="gradient-text">Premium</span> Collection</h2>
                <p>Handpicked vehicles that meet our highest standards of quality and performance</p>
            </div>
            <div class="cars-grid">
                @forelse($featured_cars as $car)
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
                            <span><i class="fas fa-map-marker-alt"></i> {{ $car->location->name ?? '—' }}</span>
                        </div>
                        <div class="car-price">${{ number_format($car->sale_price, 0) }}</div>
                        <a href="{{ route('car-detail', $car) }}" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
                @empty
                <p style="color:var(--gray-500);text-align:center;padding:2rem;grid-column:1/-1;">No featured cars available yet.</p>
                @endforelse
            </div>
            <div class="section-footer">
                <a href="{{ url('/cars') }}" class="btn btn-outline btn-lg">
                    View All Cars <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="section why-us">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Why Choose Us</span>
                <h2>The <span class="gradient-text">AutoDrive</span> Difference</h2>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Quality Assured</h3>
                    <p>Every vehicle undergoes a rigorous 150-point inspection before being listed.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h3>Best Prices</h3>
                    <p>Competitive pricing with flexible financing options available.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <h3>Vehicle History</h3>
                    <p>Complete transparency with full vehicle history reports.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>24/7 Support</h3>
                    <p>Our dedicated team is always here to assist you.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section class="section brands-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Trusted Brands</span>
                <h2>Popular <span class="gradient-text">Brands</span></h2>
            </div>
            <div class="brands-grid">
                @foreach($brands as $brand)
                <a href="{{ route('cars', ['company' => $brand->id]) }}" class="brand-card">
                    @if($brand->logo)
                    <img src="{{ Storage::url($brand->logo) }}" alt="{{ $brand->name }}" style="max-height:60px;object-fit:contain;">
                    @else
                    <div class="brand-icon"><i class="fas fa-car-side"></i></div>
                    @endif
                    <span class="brand-name">{{ $brand->name }}</span>
                    <span class="brand-count">{{ $brand->cars_count }} cars</span>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Latest Posts -->
    <section class="section posts-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Latest News</span>
                <h2>From Our <span class="gradient-text">Blog</span></h2>
            </div>
            <div class="posts-grid">
                @forelse($recent_posts as $post)
                <div class="post-card">
                    @if($post->image)
                    <div class="post-image"><img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" style="width:100%;height:200px;object-fit:cover;"></div>
                    @endif
                    <div class="post-content">
                        <div class="post-date">{{ $post->created_at->format('M d, Y') }}</div>
                        <h3 class="post-title">{{ $post->title }}</h3>
                        <p class="post-excerpt">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                        <a href="#" class="post-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                @empty
                <p style="color:var(--gray-500);text-align:center;padding:2rem;grid-column:1/-1;">No posts yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Find Your Perfect Car?</h2>
                <p>Contact us today and let our experts help you find the vehicle of your dreams.</p>
                <div class="cta-buttons">
                    <a href="{{ url('/contact') }}" class="btn btn-white">Contact Us</a>
                    <a href="{{ url('/cars') }}" class="btn btn-outline-white">Browse Cars</a>
                </div>
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
                        <li><a href="#">Maintenance</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Contact Info</h4>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> 123 Auto Street, Car City</li>
                        <li><i class="fas fa-phone"></i> +1 (555) 123-4567</li>
                        <li><i class="fas fa-envelope"></i> info@autodrive.com</li>
                        <li><i class="fas fa-clock"></i> Mon-Sat: 9AM - 8PM</li>
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
        // Hero search form
        document.querySelector('.search-btn')?.addEventListener('click', function(e) {
            e.preventDefault();
            const brand = document.getElementById('brand').value;
            const price = document.getElementById('priceRange').value;
            let url = '{{ route("cars") }}';
            const params = new URLSearchParams();
            if (brand) params.set('company', brand);
            if (price) params.set('max_price', price);
            if (params.toString()) url += '?' + params.toString();
            window.location.href = url;
        });
    </script>
    @endpush
@endsection