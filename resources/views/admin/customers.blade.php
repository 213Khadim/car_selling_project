@extends('layouts.app')

@section('title', 'Customers - AutoDrive Admin')

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

            <div class="page-content">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Customers</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                            <span>/</span>
                            <span>Customers</span>
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="openModal('customerModal')">
                        <i class="fas fa-plus"></i> Add Customer
                    </button>
                </div>

                <!-- Customers Table -->
                <div class="data-table-wrapper">
                    <div class="data-table-header">
                        <h3 class="data-table-title">All Customers</h3>
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
                                    <th>Customer</th>
                                    <th>Phone</th>
                                    <th>Total Purchases</th>
                                    <th>Total Spent</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $customer)
                                <tr>
                                    <td>
                                        <div style="font-weight:600;">{{ $customer->name }}</div>
                                        <div style="font-size:0.75rem;color:var(--gray-500);">{{ $customer->email ?? '—' }}</div>
                                    </td>
                                    <td>{{ $customer->phone ?? '—' }}</td>
                                    <td>{{ $customer->sales_count }}</td>
                                    <td>—</td>
                                    <td>
                                        <button class="action-btn edit" title="Edit" onclick="openEditCustomer({{ $customer->toJson() }})"><i class="fas fa-edit"></i></button>
                                        <form method="POST" action="{{ route('admin.customers.destroy', $customer) }}" style="display:inline;" onsubmit="return confirm('Delete this customer?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="action-btn delete" title="Delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="text-center" style="padding:2rem;color:var(--gray-400);">No customers found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Add Customer Modal -->
    <div class="modal-overlay" id="customerModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Add New Customer</h3>
                <button class="modal-close" onclick="closeModal('customerModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="customerForm" method="POST" action="{{ route('admin.customers.store') }}">
                    @csrf
                    <input type="hidden" name="_method" id="customerMethod" value="POST">
                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <input type="text" class="form-input" name="name" placeholder="John Smith" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-input" name="email" placeholder="john@example.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="tel" class="form-input" name="phone" placeholder="+1 (555) 000-0000">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <textarea class="form-textarea" name="address" rows="2" placeholder="Full address..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Notes</label>
                        <textarea class="form-textarea" name="notes" rows="2" placeholder="Notes..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="closeModal('customerModal')">Cancel</button>
                <button class="btn btn-primary" onclick="document.getElementById('customerForm').submit()">
                    <i class="fas fa-save"></i> Save Customer
                </button>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success" style="position:fixed;top:1rem;right:1rem;z-index:9999;background:var(--success);color:#fff;padding:1rem 1.5rem;border-radius:var(--radius);box-shadow:var(--shadow-lg);">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    <script>setTimeout(()=>document.querySelector('.alert')?.remove(),3000)</script>
    @endif
    @push('scripts')
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            sidebar.classList.toggle('show');
            mainContent.classList.toggle('expanded');
        }

        function openModal(modalId) {
            document.getElementById('customerMethod').value = 'POST';
            document.getElementById('customerForm').action = '{{ route('admin.customers.store') }}';
            document.getElementById('customerForm').reset();
            document.getElementById(modalId).classList.add('show');
        }

        function openEditCustomer(customer) {
            document.getElementById('customerMethod').value = 'PUT';
            document.getElementById('customerForm').action = '/admin/customers/' + customer.id;
            const form = document.getElementById('customerForm');
            form.querySelector('[name=name]').value = customer.name || '';
            form.querySelector('[name=email]').value = customer.email || '';
            form.querySelector('[name=phone]').value = customer.phone || '';
            form.querySelector('[name=address]').value = customer.address || '';
            form.querySelector('[name=notes]').value = customer.notes || '';
            document.getElementById('customerModal').classList.add('show');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
        }
    </script>
    @endpush
@endsection