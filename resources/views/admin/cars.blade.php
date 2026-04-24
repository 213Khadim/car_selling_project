@extends('layouts.app')
@php use Illuminate\Support\Facades\Storage; @endphp

@section('title', 'Cars Management - AutoDrive Admin')

@push('styles')
    @include('admin.admin-styles')
    <style>
        /* Status Tabs */
        .status-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .status-tab {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-size: 0.8125rem;
            font-weight: 600;
            text-decoration: none;
            color: var(--gray-600);
            background: var(--white);
            border: 1px solid var(--gray-200);
            transition: var(--transition);
        }
        .status-tab:hover {
            border-color: var(--primary);
            color: var(--primary);
        }
        .status-tab.active {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }
        .status-tab .count {
            background: rgba(0,0,0,0.15);
            padding: 0.1rem 0.45rem;
            border-radius: 999px;
            font-size: 0.7rem;
        }
        .status-tab.active .count {
            background: rgba(255,255,255,0.25);
        }

        /* Badge extra */
        .badge-secondary {
            background: var(--gray-200);
            color: var(--gray-700);
        }
        .badge-info {
            background: #0ea5e9;
            color: #fff;
        }
        .badge-on-way {
            background: #f59e0b;
            color: #fff;
        }
        .badge-reached {
            background: #10b981;
            color: #fff;
        }
        .badge-sold {
            background: #6366f1;
            color: #fff;
        }
        .badge-unpaid {
            background: #ef4444;
            color: #fff;
        }
        .badge-new-purchased {
            background: #3b82f6;
            color: #fff;
        }
        .badge-unsold {
            background: #64748b;
            color: #fff;
        }

        /* Modal wide */
        .modal-wide {
            width: min(860px, 95vw);
        }

        /* Car image in table */
        .car-thumb {
            width: 70px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
        }
        .car-thumb-placeholder {
            width: 70px;
            height: 50px;
            background: var(--gray-100);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Top bar logout btn */
        .topbar-logout {
            background: none;
            border: 1px solid var(--gray-300);
            padding: 0.35rem 0.85rem;
            border-radius: var(--radius);
            font-size: 0.8125rem;
            color: var(--gray-600);
            cursor: pointer;
            transition: var(--transition);
        }
        .topbar-logout:hover {
            background: var(--danger);
            color: #fff;
            border-color: var(--danger);
        }

        /* 2-col form grid inside modal */
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem 1.5rem;
        }
        @media (max-width: 600px) {
            .form-grid-2 { grid-template-columns: 1fr; }
        }

        /* Modal overlay */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.show {
            display: flex;
        }
        .modal {
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            max-height: 90vh;
            overflow-y: auto;
        }
        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-header h3 {
            margin: 0;
            font-size: 1.25rem;
        }
        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
        }
        .modal-body {
            padding: 1.5rem;
        }
        .modal-footer {
            padding: 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        /* mb utils */
        .mb-3 { margin-bottom: 1rem; }
        .mb-4 { margin-bottom: 1.5rem; }
    </style>
@endpush

@section('content')
<div class="admin-layout">
    @include('admin.sidebar')

    <main class="main-content" id="mainContent">

        <!-- Top Bar -->
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
                    <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                    <div class="user-info">
                        <div class="user-name">{{ auth()->user()->name }}</div>
                        <div class="user-role">Administrator</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="topbar-logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </header>

        <div class="page-content">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Cars Management</h1>
                    <div class="breadcrumb">
                        <a href="{{ url('/admin/dashboard') }}">Home</a>
                        <span>/</span>
                        <span>Cars</span>
                    </div>
                </div>
                <button class="btn btn-primary" onclick="openCarAddModal()">
                    <i class="fas fa-plus"></i> Add New Car
                </button>
            </div>

            <!-- Flash message -->
            @if(session('success'))
            <div id="flashMsg" style="background:var(--success);color:#fff;padding:0.85rem 1.25rem;border-radius:var(--radius);margin-bottom:1.25rem;display:flex;align-items:center;gap:0.75rem;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            <script>setTimeout(()=>{const el=document.getElementById('flashMsg');if(el)el.remove();},3000)</script>
            @endif

            @if(session('error'))
            <div style="background:var(--danger);color:#fff;padding:0.85rem 1.25rem;border-radius:var(--radius);margin-bottom:1.25rem;">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
            @endif

            <!-- Status Tabs -->
            @php
                $tabBase = array_filter([
                    'company_id'  => request('company_id'),
                    'type_id'     => request('type_id'),
                    'location_id' => request('location_id'),
                    'color_id'    => request('color_id'),
                    'year'        => request('year'),
                ]);
            @endphp
            <div class="status-tabs">
                <a href="{{ route('admin.cars', $tabBase) }}" class="status-tab {{ !request('status') ? 'active' : '' }}">
                    All Cars <span class="count">{{ $counts['all'] }}</span>
                </a>
                <a href="{{ route('admin.cars', $tabBase + ['status' => 'new_purchased']) }}" class="status-tab {{ request('status') === 'new_purchased' ? 'active' : '' }}">
                    <i class="fas fa-shopping-bag"></i> New Purchased <span class="count">{{ $counts['new_purchased'] }}</span>
                </a>
                <a href="{{ route('admin.cars', $tabBase + ['status' => 'on_way']) }}" class="status-tab {{ request('status') === 'on_way' ? 'active' : '' }}">
                    <i class="fas fa-shipping-fast"></i> On Way <span class="count">{{ $counts['on_way'] }}</span>
                </a>
                <a href="{{ route('admin.cars', $tabBase + ['status' => 'reached']) }}" class="status-tab {{ request('status') === 'reached' ? 'active' : '' }}">
                    <i class="fas fa-check-circle"></i> Reached <span class="count">{{ $counts['reached'] }}</span>
                </a>
                <a href="{{ route('admin.cars', $tabBase + ['status' => 'unpaid']) }}" class="status-tab {{ request('status') === 'unpaid' ? 'active' : '' }}">
                    <i class="fas fa-exclamation-circle"></i> Unpaid <span class="count">{{ $counts['unpaid'] }}</span>
                </a>
                <a href="{{ route('admin.cars', $tabBase + ['status' => 'sold']) }}" class="status-tab {{ request('status') === 'sold' ? 'active' : '' }}">
                    <i class="fas fa-hand-holding-usd"></i> Sold <span class="count">{{ $counts['sold'] }}</span>
                </a>
                <a href="{{ route('admin.cars', $tabBase + ['status' => 'unsold']) }}" class="status-tab {{ request('status') === 'unsold' ? 'active' : '' }}">
                    <i class="fas fa-store"></i> Unsold <span class="count">{{ $counts['unsold'] }}</span>
                </a>
            </div>

            <!-- Filters -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.cars') }}">
                        @if(request('status'))
                            <input type="hidden" name="status" value="{{ request('status') }}">
                        @endif
                        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:1rem;align-items:end;">
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label">Company</label>
                                <select class="form-select" name="company_id">
                                    <option value="">All Companies</option>
                                    @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label">Type</label>
                                <select class="form-select" name="type_id">
                                    <option value="">All Types</option>
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ request('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label">Location</label>
                                <select class="form-select" name="location_id">
                                    <option value="">All Locations</option>
                                    @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ request('location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label">Color</label>
                                <select class="form-select" name="color_id">
                                    <option value="">All Colors</option>
                                    @foreach($colors as $color)
                                    <option value="{{ $color->id }}" {{ request('color_id') == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label">Year</label>
                                <input type="number" class="form-input" name="year" placeholder="e.g. 2024" value="{{ request('year') }}" min="1990" max="2030">
                            </div>
                            <div style="display:flex;gap:0.5rem;">
                                <button type="submit" class="btn btn-primary" style="flex:1;">
                                    <i class="fas fa-filter"></i> Apply
                                </button>
                                <a href="{{ route('admin.cars') }}" class="btn btn-outline">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Cars Table -->
            <div class="data-table-wrapper">
                <div class="data-table-header">
                    <h3 class="data-table-title">
                        {{ request('status') ? ucwords(str_replace('_', ' ', request('status'))) : 'All' }} Cars
                    </h3>
                    <div class="data-table-actions">
                        <button class="btn btn-sm btn-outline">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Car Details</th>
                                <th>VIN (Chassis)</th>
                                <th>Lot Number</th>
                                <th>Purchase Cost</th>
                                <th>Sale Price</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cars as $car)
                            <tr>
                                <td>
                                    @if($car->image)
                                        <img src="{{ Storage::url($car->image) }}" class="car-thumb" alt="{{ $car->name }}">
                                    @else
                                        <div class="car-thumb-placeholder">
                                            <i class="fas fa-car" style="color:var(--gray-400);"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-weight:600;color:var(--gray-900);">{{ $car->company->name ?? '' }} {{ $car->name }}</div>
                                    <div style="font-size:0.75rem;color:var(--gray-500);margin-top:0.2rem;">{{ $car->year }} | {{ $car->type->name ?? '—' }} | {{ $car->color->name ?? '—' }}</div>
                                </td>
                                <td>
                                    @if($car->vin)
                                    <code style="background:var(--gray-100);padding:0.2rem 0.5rem;border-radius:4px;font-size:0.75rem;">{{ $car->vin }}</code>
                                    @else
                                    <span style="color:var(--gray-400);">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($car->lot_number)
                                    <span class="badge badge-secondary">{{ $car->lot_number }}</span>
                                    @else
                                    <span style="color:var(--gray-400);">—</span>
                                    @endif
                                </td>
                                <td style="font-weight:500;">${{ number_format($car->purchase_cost, 0) }}</td>
                                <td style="font-weight:600;color:var(--primary);">${{ number_format($car->sale_price, 0) }}</td>
                                <td>{{ $car->location->name ?? '—' }}</td>
                                <td><span class="badge {{ $car->status_badge }}">{{ $car->status_label }}</span></td>
                                <td>
                                    <button type="button" class="action-btn edit"
                                        title="Edit"
                                        onclick="editCar({{ $car->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form method="POST" action="{{ route('admin.cars.destroy', $car) }}" style="display:inline;" onsubmit="return confirm('Delete this car?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" style="text-align:center;padding:3rem;color:var(--gray-400);">
                                    <i class="fas fa-car" style="font-size:2rem;margin-bottom:0.75rem;display:block;"></i>
                                    No cars found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div style="display:flex;justify-content:space-between;align-items:center;padding:1rem 1.5rem;border-top:1px solid var(--gray-200);">
                    <span style="color:var(--gray-500);font-size:0.875rem;">
                        Showing {{ $cars->firstItem() ?? 0 }}–{{ $cars->lastItem() ?? 0 }} of {{ $cars->total() }} cars
                    </span>
                    {{ $cars->withQueryString()->links() }}
                </div>
            </div>

        </div><!-- /page-content -->
    </main>
</div>

<!-- ====== Add / Edit Car Modal ====== -->
<div class="modal-overlay" id="carModal">
    <div class="modal modal-wide">

        <div class="modal-header">
            <h3 id="carModalTitle">Add New Car</h3>
            <button type="button" class="modal-close" onclick="closeCarModal()"><i class="fas fa-times"></i></button>
        </div>

        <div class="modal-body">
            <form id="carForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="carFormMethod" value="POST">

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Company</label>
                        <select class="form-select" name="company_id" id="f_company_id">
                            <option value="">Select Company</option>
                            @foreach($companies as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Model / Name <span style="color:var(--danger)">*</span></label>
                        <input type="text" class="form-input" name="name" id="f_name" placeholder="e.g. M5 Competition" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">VIN (Chassis Number)</label>
                        <input type="text" class="form-input" name="vin" id="f_vin" placeholder="e.g. WBA585C55HD123456" maxlength="50">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Lot Number</label>
                        <input type="text" class="form-input" name="lot_number" id="f_lot_number" placeholder="e.g. LOT-2024-001">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Year <span style="color:var(--danger)">*</span></label>
                        <input type="number" class="form-input" name="year" id="f_year" placeholder="2024" min="1990" max="2030" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Type</label>
                        <select class="form-select" name="type_id" id="f_type_id">
                            <option value="">Select Type</option>
                            @foreach($types as $t)
                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Color</label>
                        <select class="form-select" name="color_id" id="f_color_id">
                            <option value="">Select Color</option>
                            @foreach($colors as $col)
                            <option value="{{ $col->id }}">{{ $col->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Mileage</label>
                        <input type="text" class="form-input" name="mileage" id="f_mileage" placeholder="e.g. 15,000 km">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Purchase Cost ($) <span style="color:var(--danger)">*</span></label>
                        <input type="number" class="form-input" name="purchase_cost" id="f_purchase_cost" placeholder="98000" min="0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Sale Price ($) <span style="color:var(--danger)">*</span></label>
                        <input type="number" class="form-input" name="sale_price" id="f_sale_price" placeholder="125000" min="0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Location</label>
                        <select class="form-select" name="location_id" id="f_location_id">
                            <option value="">Select Location</option>
                            @foreach($locations as $loc)
                            <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status <span style="color:var(--danger)">*</span></label>
                        <select class="form-select" name="status" id="f_status" required>
                            <option value="">Select Status</option>
                            <option value="new_purchased">New Purchased</option>
                            <option value="on_way">On Way</option>
                            <option value="reached">Reached</option>
                            <option value="unpaid">Unpaid</option>
                            <option value="sold">Sold</option>
                            <option value="unsold">Unsold</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Fuel Type</label>
                        <select class="form-select" name="fuel_type" id="f_fuel_type">
                            <option value="">Select Fuel</option>
                            <option value="petrol">Petrol</option>
                            <option value="diesel">Diesel</option>
                            <option value="electric">Electric</option>
                            <option value="hybrid">Hybrid</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Transmission</label>
                        <select class="form-select" name="transmission" id="f_transmission">
                            <option value="">Select Transmission</option>
                            <option value="automatic">Automatic</option>
                            <option value="manual">Manual</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Main Image</label>
                    <input type="file" class="form-input" name="image" id="f_image" accept="image/*">
                    <div id="currentImageWrap" style="display:none;margin-top:0.5rem;">
                        <small style="color:var(--gray-500);">Current image: </small>
                        <img id="currentImage" src="" style="height:50px;border-radius:4px;vertical-align:middle;">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <textarea class="form-textarea" name="notes" id="f_notes" rows="3" placeholder="Additional notes..."></textarea>
                </div>

                <div class="form-group">
                    <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;font-weight:500;">
                        <input type="checkbox" name="is_featured" id="f_is_featured" value="1">
                        <span>Featured car (show on homepage)</span>
                    </label>
                </div>

            </form>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-outline" onclick="closeCarModal()">Cancel</button>
            <button type="button" class="btn btn-primary" onclick="submitCarForm()">
                <i class="fas fa-save"></i> <span id="btnSaveText">Save Car</span>
            </button>
        </div>

    </div>
</div>

@push('scripts')
<script>
    /* ---- Sidebar toggle ---- */
    function toggleSidebar() {
        var sidebar = document.getElementById('sidebar');
        var mainContent = document.getElementById('mainContent');
        if (sidebar) sidebar.classList.toggle('show');
        if (mainContent) mainContent.classList.toggle('expanded');
    }

    /* ---- Car Modal Functions ---- */
    var carModal = document.getElementById('carModal');
    var carForm = document.getElementById('carForm');

    function openCarAddModal() {
        console.log('Opening Add Modal');
        document.getElementById('carModalTitle').textContent = 'Add New Car';
        document.getElementById('btnSaveText').textContent = 'Save Car';
        document.getElementById('carFormMethod').value = 'POST';
        carForm.action = "{{ route('admin.cars.store') }}";
        carForm.reset();
        document.getElementById('currentImageWrap').style.display = 'none';
        document.getElementById('f_status').value = '';
        carModal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeCarModal() {
        console.log('Closing Modal');
        carModal.classList.remove('show');
        document.body.style.overflow = '';
        carForm.reset();
    }

    function editCar(carId) {
        console.log('Editing car:', carId);
        
        // Fetch car data via AJAX
        fetch('/admin/cars/' + carId + '/edit')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(car => {
                console.log('Car data:', car);
                
                document.getElementById('carModalTitle').textContent = 'Edit Car';
                document.getElementById('btnSaveText').textContent = 'Update Car';
                document.getElementById('carFormMethod').value = 'PUT';
                carForm.action = '/admin/cars/' + car.id;
                carForm.reset();

                // Set form values
                setFormValue('f_name', car.name);
                setFormValue('f_company_id', car.company_id);
                setFormValue('f_vin', car.vin);
                setFormValue('f_lot_number', car.lot_number);
                setFormValue('f_year', car.year);
                setFormValue('f_type_id', car.type_id);
                setFormValue('f_color_id', car.color_id);
                setFormValue('f_mileage', car.mileage);
                setFormValue('f_purchase_cost', car.purchase_cost);
                setFormValue('f_sale_price', car.sale_price);
                setFormValue('f_location_id', car.location_id);
                setFormValue('f_status', car.status);
                setFormValue('f_fuel_type', car.fuel_type);
                setFormValue('f_transmission', car.transmission);
                setFormValue('f_notes', car.notes);

                // Set checkbox
                var featureCheckbox = document.getElementById('f_is_featured');
                featureCheckbox.checked = (car.is_featured == 1 || car.is_featured === true);

                // Show current image
                if (car.image) {
                    document.getElementById('currentImage').src = '/storage/' + car.image;
                    document.getElementById('currentImageWrap').style.display = 'block';
                } else {
                    document.getElementById('currentImageWrap').style.display = 'none';
                }

                // Open modal
                carModal.classList.add('show');
                document.body.style.overflow = 'hidden';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error loading car data. Please try again.');
            });
    }

    function setFormValue(id, value) {
        var element = document.getElementById(id);
        if (element) {
            element.value = value || '';
        }
    }

    function submitCarForm() {
        console.log('Submitting form');
        var form = document.getElementById('carForm');
        
        if (form.action && form.action.length > 0) {
            form.submit();
        } else {
            alert('Form action is not set');
        }
    }

    /* Close on backdrop click */
    carModal.addEventListener('click', function(e) {
        if (e.target === carModal) {
            closeCarModal();
        }
    });

    /* Close on Escape key */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && carModal.classList.contains('show')) {
            closeCarModal();
        }
    });
</script>
@endpush

@endsection