@extends('layouts.app')

@section('title', 'Settings - AutoDrive Admin')

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
                </div>
                <div class="top-bar-right">
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
                        <h1 class="page-title">Settings</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                            <span>/</span>
                            <span>Settings</span>
                        </div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 250px 1fr; gap: 2rem;">
                    <div class="card" style="position: sticky; top: 1rem; align-self: start;">
                        <div class="card-body" style="padding: 1rem;">
                            <nav>
                                <button class="nav-item active" id="tab-general" onclick="showSection('general', this)">
                                    <i class="fas fa-cog"></i>
                                    <span>General</span>
                                </button>
                                <button class="nav-item" id="tab-currency" onclick="showSection('currency', this)">
                                    <i class="fas fa-dollar-sign"></i>
                                    <span>Currency</span>
                                </button>
                                <button class="nav-item" id="tab-car-types" onclick="showSection('car-types', this)">
                                    <i class="fas fa-car"></i>
                                    <span>Car Types</span>
                                </button>
                                <button class="nav-item" id="tab-colors" onclick="showSection('colors', this)">
                                    <i class="fas fa-palette"></i>
                                    <span>Colors</span>
                                </button>
                                <button class="nav-item" id="tab-locations" onclick="showSection('locations', this)">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Locations</span>
                                </button>
                                <button class="nav-item" id="tab-companies" onclick="showSection('companies', this)">
                                    <i class="fas fa-building"></i>
                                    <span>Companies</span>
                                </button>
                            </nav>
                        </div>
                    </div>

                    <div>
                        <div class="card mb-3 settings-section active" id="general">
                            <div class="card-header">
                                <h3><i class="fas fa-cog" style="margin-right: .5rem;"></i> General Settings</h3>
                            </div>
                            <div class="card-body">
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                                    <div class="form-group">
                                        <label class="form-label">Company Name</label>
                                        <input type="text" class="form-input" value="AutoDrive">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Contact Email</label>
                                        <input type="email" class="form-input" value="info@autodrive.com">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-input" value="+93 700 123 456">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">WhatsApp Number</label>
                                        <input type="text" class="form-input" value="+93 700 123 456">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-textarea" rows="2">Main Street, Herat, Afghanistan</textarea>
                                </div>
                                <button class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                            </div>
                        </div>

                        <div class="card mb-3 settings-section" id="currency">
                            <div class="card-header">
                                <h3><i class="fas fa-dollar-sign" style="margin-right: .5rem;"></i> Currency Settings</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group" style="max-width: 320px;">
                                    <label class="form-label">Default Currency</label>
                                    <select class="form-select">
                                        <option value="USD" selected>USD - US Dollar</option>
                                        <option value="AFN">AFN - Afghan Afghani</option>
                                        <option value="AED">AED - UAE Dirham</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary"><i class="fas fa-save"></i> Save Currency</button>
                            </div>
                        </div>

                        <div class="card mb-3 settings-section" id="car-types">
                            <div class="card-header">
                                <h3><i class="fas fa-car" style="margin-right: .5rem;"></i> Car Types</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Car Types</label>
                                    <textarea class="form-textarea" rows="4">SUV
Sedan
Coupe
Convertible
Hatchback
Truck</textarea>
                                </div>
                                <button class="btn btn-primary"><i class="fas fa-save"></i> Save Types</button>
                            </div>
                        </div>

                        <div class="card mb-3 settings-section" id="colors">
                            <div class="card-header">
                                <h3><i class="fas fa-palette" style="margin-right: .5rem;"></i> Colors</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Available Colors</label>
                                    <textarea class="form-textarea" rows="4">Black
White
Red
Blue
Silver
Gold</textarea>
                                </div>
                                <button class="btn btn-primary"><i class="fas fa-save"></i> Save Colors</button>
                            </div>
                        </div>

                        <div class="card mb-3 settings-section" id="locations">
                            <div class="card-header">
                                <h3><i class="fas fa-map-marker-alt" style="margin-right: .5rem;"></i> Locations</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Service Locations</label>
                                    <textarea class="form-textarea" rows="4">Herat
Kabul
Mazar-i-Sharif
Dubai
Istanbul</textarea>
                                </div>
                                <button class="btn btn-primary"><i class="fas fa-save"></i> Save Locations</button>
                            </div>
                        </div>

                        <div class="card mb-3 settings-section" id="companies">
                            <div class="card-header">
                                <h3><i class="fas fa-building" style="margin-right: .5rem;"></i> Companies</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Companies</label>
                                    <textarea class="form-textarea" rows="4">Toyota
BMW
Mercedes
Lexus
Porsche</textarea>
                                </div>
                                <button class="btn btn-primary"><i class="fas fa-save"></i> Save Companies</button>
                            </div>
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

        function showSection(section, button) {
            document.querySelectorAll('.settings-section').forEach((sectionEl) => {
                sectionEl.classList.remove('active');
            });
            document.getElementById(section).classList.add('active');
            document.querySelectorAll('.card-body .nav-item').forEach((btn) => {
                btn.classList.remove('active');
            });
            if (button) {
                button.classList.add('active');
            }
        }
    </script>
    @endpush
@endsection