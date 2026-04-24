@extends('layouts.app')

@section('title', 'Login - AutoDrive')

@push('styles')
<style>
    .auth-page {
        display: flex;
        min-height: 100vh;
    }
    .auth-left {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: var(--white);
    }
    .auth-box {
        width: 100%;
        max-width: 400px;
    }
    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    .auth-logo {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary);
        text-decoration: none;
        margin-bottom: 1rem;
    }
    .auth-logo i {
        font-size: 1.75rem;
    }
    .auth-header h1 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
    .auth-header p {
        color: var(--gray-600);
    }
    .auth-form {
        margin-bottom: 2rem;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--gray-800);
    }
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        font-size: 1rem;
        transition: var(--transition);
    }
    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    .auth-footer {
        text-align: center;
        padding-top: 2rem;
        border-top: 1px solid var(--gray-200);
    }
    .auth-footer a {
        color: var(--primary);
        font-weight: 500;
    }
    .auth-right {
        flex: 1;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }
    .auth-bg-shapes {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.1;
    }
    .auth-bg-shapes::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    }
    .auth-right-content {
        color: white;
        text-align: center;
        z-index: 1;
        position: relative;
    }
    .auth-right-content h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    .auth-right-content p {
        font-size: 1.125rem;
        opacity: 0.9;
        margin-bottom: 2rem;
    }
    .d-flex {
        display: flex;
    }
    .justify-between {
        justify-content: space-between;
    }
    .align-center {
        align-items: center;
    }
    .mb-3 {
        margin-bottom: 1rem;
    }
    @media (max-width: 768px) {
        .auth-page {
            flex-direction: column;
        }
        .auth-right {
            display: none;
        }
    }
</style>
@endpush

@section('content')
    <div class="auth-page">
        <!-- Left Side - Login Form -->
        <div class="auth-left">
            <div class="auth-box">
                <div class="auth-header">
                    <a href="{{ url('/') }}" class="auth-logo">
                        <i class="fas fa-car-side"></i>
                        <span>AutoDrive</span>
                    </a>
                    <h1>Welcome Back</h1>
                    <p>Sign in to your account to continue</p>
                </div>

                <form class="auth-form" method="POST" action="{{ route('login') }}">
                    @csrf

                    @if($errors->any())
                    <div style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;padding:0.75rem 1rem;border-radius:var(--radius);margin-bottom:1rem;">
                        {{ $errors->first() }}
                    </div>
                    @endif

                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-input" placeholder="you@example.com" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-input" placeholder="Enter your password" required>
                    </div>

                    <div class="d-flex justify-between align-center mb-3">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" name="remember">
                            <span style="font-size: 0.875rem; color: var(--gray-600);">Remember me</span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                        Sign In <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="auth-footer">
                    <p>Don't have an account? <a href="{{ url('/user/register') }}">Sign Up</a></p>
                </div>
            </div>
        </div>

        <!-- Right Side - Branding -->
        <div class="auth-right">
            <div class="auth-bg-shapes"></div>
            <div class="auth-right-content">
                <h2>Find Your Dream Car</h2>
                <p>Access your account to browse cars, track purchases, and manage your profile.</p>
                <div style="margin-top: 3rem;">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; opacity: 0.9;">
                        <i class="fas fa-check-circle"></i>
                        <span>Browse extensive car collection</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; opacity: 0.9;">
                        <i class="fas fa-check-circle"></i>
                        <span>Track your purchases</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem; opacity: 0.9;">
                        <i class="fas fa-check-circle"></i>
                        <span>Manage payments securely</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection