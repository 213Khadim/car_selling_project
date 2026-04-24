@extends('layouts.app')

@section('title', 'Car Details - AutoDrive')
@section('page', 'car-detail')

@push('styles')
<style>
    .car-detail-section {
        padding: 120px 0 60px;
    }
    .car-detail-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 3rem;
    }
    .car-gallery {
        position: relative;
    }
    .car-main-image {
        width: 100%;
        height: 450px;
        object-fit: cover;
        border-radius: var(--radius-xl);
    }
    .car-thumbnails {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }
    .car-thumbnail {
        width: 100px;
        height: 70px;
        object-fit: cover;
        border-radius: var(--radius);
        cursor: pointer;
        opacity: 0.6;
        transition: var(--transition);
    }
    .car-thumbnail:hover,
    .car-thumbnail.active {
        opacity: 1;
    }
    .car-detail-info h1 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }
    .car-detail-subtitle {
        font-size: 1.125rem;
        color: var(--gray-500);
        margin-bottom: 1.5rem;
    }
    .car-detail-price {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 2rem;
    }
    .specs-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .spec-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .spec-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--gray-100);
        border-radius: var(--radius);
        color: var(--gray-600);
    }
    .spec-label {
        font-size: 0.8125rem;
        color: var(--gray-500);
    }
    .spec-value {
        font-weight: 600;
        color: var(--gray-800);
    }
    .car-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }
    .car-actions .btn {
        flex: 1;
    }
    .car-description {
        margin-top: 3rem;
    }
    .car-description h3 {
        margin-bottom: 1rem;
    }
    .car-description p {
        color: var(--gray-600);
        line-height: 1.8;
    }
    .features-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
        margin-top: 1.5rem;
    }
    .feature-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--gray-700);
    }
    .feature-item i {
        color: var(--success);
    }
    @media (max-width: 1024px) {
        .car-detail-grid {
            grid-template-columns: 1fr;
        }
        .car-main-image {
            height: 350px;
        }
    }
    @media (max-width: 768px) {
        .car-detail-info h1 {
            font-size: 1.75rem;
        }
        .car-detail-price {
            font-size: 2rem;
        }
        .specs-grid {
            grid-template-columns: 1fr;
        }
        .car-actions {
            flex-direction: column;
        }
    }
</style>
@endpush

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
                    <a href="{{ url('/user/login') }}" class="btn btn-outline">Login</a>
                    <a href="{{ url('/admin/login') }}" class="btn btn-primary">Admin</a>
                </div>
                <button class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </nav>
        </div>
    </header>

    <!-- Breadcrumb -->
    <section style="padding: 40px 0; background: var(--gray-50);">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol style="display: flex; align-items: center; gap: 0.5rem; margin: 0; padding: 0; list-style: none;">
                    <li><a href="{{ url('/') }}" style="color: var(--gray-500);">Home</a></li>
                    <li style="color: var(--gray-400);">/</li>
                    <li><a href="{{ url('/cars') }}" style="color: var(--gray-500);">Cars</a></li>
                    <li style="color: var(--gray-400);">/</li>
                    <li style="color: var(--gray-900);" id="carTitle">Car Details</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Car Detail Section -->
    <section class="car-detail-section">
        <div class="container">
            <div class="car-detail-grid">
                <!-- Car Gallery -->
                <div class="car-gallery">
                    <img id="carImage" src="https://via.placeholder.com/600x400?text=No+Image" alt="Car" class="car-main-image">
                    <div class="car-thumbnails">
                        <img src="https://via.placeholder.com/100x70?text=1" alt="Thumbnail 1" class="car-thumbnail active">
                        <img src="https://via.placeholder.com/100x70?text=2" alt="Thumbnail 2" class="car-thumbnail">
                        <img src="https://via.placeholder.com/100x70?text=3" alt="Thumbnail 3" class="car-thumbnail">
                        <img src="https://via.placeholder.com/100x70?text=4" alt="Thumbnail 4" class="car-thumbnail">
                    </div>
                </div>

                <!-- Car Info -->
                <div class="car-detail-info">
                    <h1 id="carTitle">BMW M5 Competition</h1>
                    <p class="car-detail-subtitle" id="carSubtitle">2024 Model • Automatic</p>
                    <div class="car-detail-price" id="carPrice">$125,000</div>

                    <div class="specs-grid">
                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fas fa-gas-pump"></i>
                            </div>
                            <div>
                                <div class="spec-label">Fuel Type</div>
                                <div class="spec-value" id="carFuel">Petrol</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fas fa-cog"></i>
                            </div>
                            <div>
                                <div class="spec-label">Transmission</div>
                                <div class="spec-value" id="carTransmission">Auto</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <div>
                                <div class="spec-label">Mileage</div>
                                <div class="spec-value" id="carMileage">15K</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div>
                                <div class="spec-label">Year</div>
                                <div class="spec-value" id="carYear">2024</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fas fa-palette"></i>
                            </div>
                            <div>
                                <div class="spec-label">Color</div>
                                <div class="spec-value" id="carColor">Blue</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fas fa-hashtag"></i>
                            </div>
                            <div>
                                <div class="spec-label">VIN</div>
                                <div class="spec-value" id="carVIN">WBSJF0C55KB123456</div>
                            </div>
                        </div>
                    </div>

                    <div class="car-actions">
                        <button class="btn btn-primary btn-lg">
                            <i class="fas fa-phone"></i> Contact Seller
                        </button>
                        <button class="btn btn-outline btn-lg">
                            <i class="fas fa-heart"></i> Add to Favorites
                        </button>
                    </div>

                    <div class="car-description">
                        <h3>Description</h3>
                        <p>This BMW M5 Competition is a masterpiece of German engineering, combining breathtaking performance with luxurious comfort. The twin-turbocharged 4.4-liter V8 engine delivers 617 horsepower and 553 lb-ft of torque, propelling this sedan from 0-60 mph in just 3.1 seconds.</p>

                        <p>The interior features premium leather upholstery, advanced driver assistance systems, and the latest infotainment technology. This vehicle has been meticulously maintained and comes with a comprehensive warranty.</p>

                        <h4 style="margin-top: 2rem;">Key Features</h4>
                        <div class="features-list">
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>All-wheel drive system</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Adaptive suspension</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Carbon fiber interior trim</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Head-up display</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Premium audio system</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Wireless charging</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Make This Car Yours?</h2>
                <p>Contact us today to schedule a test drive or get more information about this vehicle.</p>
                <div class="cta-buttons">
                    <a href="{{ url('/contact') }}" class="btn btn-white">Contact Us</a>
                    <a href="{{ url('/cars') }}" class="btn btn-outline-white">View More Cars</a>
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
        loadCarDetail();
    </script>
    @endpush
@endsection