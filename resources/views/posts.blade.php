@extends('layouts.app')

@section('title', 'Blog Posts - AutoDrive')
@section('page', 'posts')

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
                    <li><a href="{{ url('/brands') }}">Brands</a></li>
                    <li><a href="{{ url('/posts') }}" class="active">Posts</a></li>
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
                <span class="section-badge">Latest Updates</span>
                <h1>Our <span class="gradient-text">Blog</span></h1>
                <p>Stay informed with the latest news, tips, and insights from the automotive world</p>
            </div>
        </div>
    </section>

    <!-- Posts Section -->
    <section class="section" style="padding-top: 3rem;">
        <div class="container">
            <div class="posts-grid" id="postsGrid">
                <!-- Posts will be loaded dynamically -->
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <button class="pagination-btn" disabled><i class="fas fa-chevron-left"></i></button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">3</button>
                <button class="pagination-btn"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="section" style="background: var(--gray-50);">
        <div class="container">
            <div style="max-width: 600px; margin: 0 auto; text-align: center;">
                <span class="section-badge">Stay Updated</span>
                <h2>Subscribe to Our <span class="gradient-text">Newsletter</span></h2>
                <p style="color: var(--gray-500); margin-bottom: 2rem;">Get the latest news and exclusive offers delivered to your inbox.</p>
                <form style="display: flex; gap: 1rem;">
                    <input type="email" class="form-input" placeholder="Enter your email" style="flex: 1;">
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
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
        loadAllPosts();
    </script>
    @endpush
@endsection