@extends('layouts.app')

@section('title', 'Brands - AutoDrive')
@section('page', 'brands')

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
                    <li><a href="{{ url('/cars') }}">Cars</a></li>
                    <li><a href="{{ url('/brands') }}" class="active">Brands</a></li>
                    <li><a href="{{ url('/posts') }}">Posts</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
                <div class="nav-actions">
                    <a href="{{ url('/user/login') }}" class="btn btn-outline">Login</a>
                    <a href="{{ url('/admin/login') }}" class="btn btn-primary">Admin</a>
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
                <span class="section-badge">Our Partners</span>
                <h1>Trusted <span class="gradient-text">Brands</span></h1>
                <p>We partner with the world&apos;s leading automotive manufacturers</p>
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section class="section">
        <div class="container">
            <div class="brands-grid" id="brandsGrid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;">
                <!-- Brands will be loaded dynamically -->
            </div>
        </div>
    </section>

    <!-- Featured Brands -->
    <section class="section" style="background: var(--gray-50);">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Premium Selection</span>
                <h2>Featured <span class="gradient-text">Manufacturers</span></h2>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem;">
                <div class="card">
                    <div class="card-body" style="text-align: center; padding: 3rem 2rem;">
                        <img src="https://www.carlogos.org/car-logos/bmw-logo.png" alt="BMW" style="height: 80px; margin: 0 auto 1.5rem;">
                        <h3>BMW</h3>
                        <p style="color: var(--gray-500); margin: 1rem 0;">The Ultimate Driving Machine. German engineering at its finest with performance and luxury combined.</p>
                        <a href="{{ url('/cars?brand=bmw') }}" class="btn btn-primary">View BMW Cars</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body" style="text-align: center; padding: 3rem 2rem;">
                        <img src="https://www.carlogos.org/car-logos/mercedes-benz-logo.png" alt="Mercedes" style="height: 80px; margin: 0 auto 1.5rem;">
                        <h3>Mercedes-Benz</h3>
                        <p style="color: var(--gray-500); margin: 1rem 0;">The best or nothing. Synonymous with luxury, innovation, and uncompromising quality.</p>
                        <a href="{{ url('/cars?brand=mercedes') }}" class="btn btn-primary">View Mercedes Cars</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body" style="text-align: center; padding: 3rem 2rem;">
                        <img src="https://www.carlogos.org/car-logos/porsche-logo.png" alt="Porsche" style="height: 80px; margin: 0 auto 1.5rem;">
                        <h3>Porsche</h3>
                        <p style="color: var(--gray-500); margin: 1rem 0;">There is no substitute. Legendary sports cars with unmatched performance heritage.</p>
                        <a href="{{ url('/cars?brand=porsche') }}" class="btn btn-primary">View Porsche Cars</a>
                    </div>
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
        loadBrands();
    </script>
    @endpush
@endsection