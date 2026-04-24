<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="{{ url('/') }}" class="sidebar-logo">
            <i class="fas fa-car-side"></i>
            <span>AutoDrive</span>
        </a>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <a href="{{ url('/admin/dashboard') }}" class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ url('/admin/cars') }}" class="nav-item {{ request()->is('admin/cars') ? 'active' : '' }}">
                <i class="fas fa-car"></i>
                <span>Cars</span>
            </a>
            <a href="{{ url('/admin/sales') }}" class="nav-item {{ request()->is('admin/sales') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i>
                <span>Sales</span>
            </a>
            <a href="{{ url('/admin/customer-payments') }}" class="nav-item {{ request()->is('admin/customer-payments') ? 'active' : '' }}">
                <i class="fas fa-credit-card"></i>
                <span>Customer Payments</span>
            </a>
            <a href="{{ url('/admin/customers') }}" class="nav-item {{ request()->is('admin/customers') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Customers</span>
            </a>
        </div>
        <div class="nav-section">
            <div class="nav-section-title">Finance</div>
            <a href="{{ url('/admin/cash-accounts') }}" class="nav-item {{ request()->is('admin/cash-accounts') ? 'active' : '' }}">
                <i class="fas fa-wallet"></i>
                <span>Cash Accounts</span>
            </a>
            <a href="{{ url('/admin/cash-transfer') }}" class="nav-item {{ request()->is('admin/cash-transfer') ? 'active' : '' }}">
                <i class="fas fa-exchange-alt"></i>
                <span>Cash Transfer</span>
            </a>
            <a href="{{ url('/admin/expenses') }}" class="nav-item {{ request()->is('admin/expenses') ? 'active' : '' }}">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Expenses</span>
            </a>
            <a href="{{ url('/admin/commissions') }}" class="nav-item {{ request()->is('admin/commissions') ? 'active' : '' }}">
                <i class="fas fa-percentage"></i>
                <span>Commissions</span>
            </a>
        </div>
        <div class="nav-section">
            <div class="nav-section-title">Reports</div>
            <a href="{{ url('/admin/reports') }}" class="nav-item {{ request()->is('admin/reports') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Reports</span>
            </a>
        </div>
        <div class="nav-section">
            <div class="nav-section-title">Website</div>
            <a href="{{ url('/admin/posts') }}" class="nav-item {{ request()->is('admin/posts') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i>
                <span>Cars/Posts</span>
            </a>
            <a href="{{ url('/admin/gallery') }}" class="nav-item {{ request()->is('admin/gallery') ? 'active' : '' }}">
                <i class="fas fa-images"></i>
                <span>Gallery</span>
            </a>
            <a href="{{ url('/admin/messages') }}" class="nav-item {{ request()->is('admin/messages') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i>
                <span>Messages</span>
            </a>
        </div>
        <div class="nav-section">
            <div class="nav-section-title">Settings</div>
            <a href="{{ url('/admin/settings') }}" class="nav-item {{ request()->is('admin/settings') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
        </div>
    </nav>
</aside>