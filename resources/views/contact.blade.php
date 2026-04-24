@extends('layouts.app')

@section('title', 'Contact Us - AutoDrive')
@section('page', 'contact')

@push('styles')
<style>
    .contact-section {
        padding: 120px 0 80px;
    }
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 4rem;
    }
    .contact-info-card {
        background: var(--gray-900);
        color: var(--white);
        padding: 3rem;
        border-radius: var(--radius-xl);
        position: relative;
        overflow: hidden;
    }
    .contact-info-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: var(--gradient);
        opacity: 0.1;
        border-radius: 50%;
    }
    .contact-info-card h2 {
        color: var(--white);
        margin-bottom: 1rem;
        position: relative;
    }
    .contact-info-card > p {
        color: var(--gray-400);
        margin-bottom: 2.5rem;
        position: relative;
    }
    .contact-info-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 2rem;
        position: relative;
    }
    .contact-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.1);
        border-radius: var(--radius);
        color: var(--primary-light);
        flex-shrink: 0;
    }
    .contact-info-item h4 {
        color: var(--white);
        margin-bottom: 0.25rem;
        font-size: 1rem;
    }
    .contact-info-item p {
        color: var(--gray-400);
        font-size: 0.9375rem;
    }
    .contact-social {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
    }
    .contact-social h4 {
        color: var(--white);
        margin-bottom: 1rem;
    }
    .contact-form-card {
        background: var(--white);
        padding: 3rem;
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-xl);
    }
    .contact-form-card h2 {
        margin-bottom: 0.5rem;
    }
    .contact-form-card > p {
        color: var(--gray-500);
        margin-bottom: 2rem;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    @media (max-width: 1024px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        .contact-info-card,
        .contact-form-card {
            padding: 2rem;
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
                    <li><a href="{{ url('/cars') }}">Cars</a></li>
                    <li><a href="{{ url('/brands') }}">Brands</a></li>
                    <li><a href="{{ url('/posts') }}">Posts</a></li>
                    <li><a href="{{ url('/contact') }}" class="active">Contact</a></li>
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

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Info -->
                <div class="contact-info-card">
                    <h2>Get In Touch</h2>
                    <p>Ready to find your dream car? Contact our team today and let us help you make the right choice.</p>

                    <div class="contact-info-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4>Visit Us</h4>
                            <p>123 Auto Street<br>Car City, CC 12345</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h4>Call Us</h4>
                            <p>+1 (555) 123-4567<br>+1 (555) 123-4568</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4>Email Us</h4>
                            <p>info@autodrive.com<br>sales@autodrive.com</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h4>Business Hours</h4>
                            <p>Mon - Sat: 9AM - 8PM<br>Sunday: 10AM - 6PM</p>
                        </div>
                    </div>

                    <div class="contact-social">
                        <h4>Follow Us</h4>
                        <div class="social-links">
                            <a href="#" style="color: var(--gray-400); margin-right: 1rem;"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" style="color: var(--gray-400); margin-right: 1rem;"><i class="fab fa-twitter"></i></a>
                            <a href="#" style="color: var(--gray-400); margin-right: 1rem;"><i class="fab fa-instagram"></i></a>
                            <a href="#" style="color: var(--gray-400);"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form-card">
                    <h2>Send us a Message</h2>
                    <p>Fill out the form below and we'll get back to you as soon as possible.</p>

                    <form class="contact-form" onsubmit="handleContactForm(event)">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                                <input type="text" name="firstName" class="form-input" placeholder="John" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="lastName" class="form-input" placeholder="Doe" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-input" placeholder="john@example.com" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone" class="form-input" placeholder="+1 (555) 123-4567">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-input" placeholder="How can we help you?" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-textarea" rows="5" placeholder="Tell us about your inquiry..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                            Send Message <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
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
        function handleContactForm(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            // Simulate form submission
            alert('Thank you for your message! We will get back to you soon.');
            form.reset();
        }
    </script>
    @endpush
@endsection