<style>
    .admin-layout {
        display: flex;
        min-height: 100vh;
        background: var(--gray-50);
    }
    .sidebar {
        width: 280px;
        background: var(--white);
        border-right: 1px solid var(--gray-200);
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 1000;
        transition: var(--transition);
    }
    .sidebar.collapsed {
        transform: translateX(-100%);
    }
    .sidebar-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--gray-200);
    }
    .sidebar-logo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--primary);
        text-decoration: none;
    }
    .sidebar-logo i {
        font-size: 1.5rem;
    }
    .sidebar-nav {
        flex: 1;
        padding: 1rem 0;
        overflow-y: auto;
    }
    .nav-section {
        margin-bottom: 1.5rem;
    }
    .nav-section-title {
        padding: 0.5rem 1.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .nav-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1.5rem;
        color: var(--gray-600);
        text-decoration: none;
        transition: var(--transition);
        position: relative;
    }
    .nav-item:hover {
        background: var(--gray-50);
        color: var(--gray-900);
    }
    .nav-item.active {
        background: var(--primary);
        color: var(--white);
    }
    .nav-item.active:hover {
        background: var(--primary-dark);
    }
    .nav-item i {
        width: 20px;
        text-align: center;
    }
    .main-content {
        flex: 1;
        margin-left: 280px;
        transition: var(--transition);
    }
    .main-content.expanded {
        margin-left: 0;
    }
    .top-bar {
        background: var(--white);
        border-bottom: 1px solid var(--gray-200);
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 100;
    }
    .top-bar-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .sidebar-toggle {
        background: none;
        border: none;
        padding: 0.5rem;
        border-radius: var(--radius);
        color: var(--gray-600);
        cursor: pointer;
        transition: var(--transition);
    }
    .sidebar-toggle:hover {
        background: var(--gray-100);
    }
    .search-bar {
        position: relative;
        display: flex;
        align-items: center;
    }
    .search-bar i {
        position: absolute;
        left: 0.75rem;
        color: var(--gray-400);
    }
    .search-bar input {
        padding: 0.5rem 0.75rem 0.5rem 2.5rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        width: 300px;
    }
    .top-bar-right {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .notification-btn {
        position: relative;
        background: none;
        border: none;
        padding: 0.5rem;
        border-radius: var(--radius);
        color: var(--gray-600);
        cursor: pointer;
    }
    .notification-dot {
        position: absolute;
        top: 0.25rem;
        right: 0.25rem;
        width: 8px;
        height: 8px;
        background: var(--danger);
        border-radius: 50%;
    }
    .user-menu {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: var(--radius);
        transition: var(--transition);
    }
    .user-menu:hover {
        background: var(--gray-50);
    }
    .user-avatar {
        width: 32px;
        height: 32px;
        background: var(--primary);
        color: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }
    .user-info {
        display: flex;
        flex-direction: column;
    }
    .user-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--gray-900);
    }
    .user-role {
        font-size: 0.75rem;
        color: var(--gray-500);
    }
    .page-content {
        padding: 1.5rem;
    }
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
    }
    .page-title {
        font-size: 1.875rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--gray-500);
    }
    .breadcrumb a {
        color: var(--gray-500);
        text-decoration: none;
    }
    .breadcrumb a:hover {
        color: var(--gray-700);
    }
    .d-flex {
        display: flex;
    }
    .gap-2 {
        gap: 0.5rem;
    }
    .mb-3 {
        margin-bottom: 1rem;
    }
    .card {
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        overflow: hidden;
    }
    .card-body {
        padding: 1.5rem;
    }
    .card-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--gray-200);
        background: var(--gray-50);
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .stat-card-header {
        display: flex;
        align-items: center;
    }
    .stat-card-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: var(--white);
    }
    .stat-card-icon.red {
        background: var(--danger);
    }
    .stat-card-icon.blue {
        background: var(--info);
    }
    .stat-card-icon.green {
        background: var(--success);
    }
    .stat-card-icon.orange {
        background: var(--warning);
    }
    .stat-card-icon.purple {
        background: #7c3aed;
    }
    .stat-card-content {
        flex: 1;
    }
    .stat-card-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 0.25rem;
    }
    .stat-card-label {
        font-size: 0.875rem;
        color: var(--gray-500);
    }
    .data-table-wrapper {
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        overflow: hidden;
    }
    .data-table-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .data-table-title {
        font-size: 1.125rem;
        font-weight: 600;
    }
    .data-table-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .table-wrapper {
        overflow-x: auto;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table th,
    .table td {
        padding: 1rem 1.5rem;
        text-align: left;
        border-bottom: 1px solid var(--gray-200);
    }
    .table th {
        font-weight: 600;
        color: var(--gray-700);
        background: var(--gray-50);
    }
    .table tbody tr:hover {
        background: var(--gray-50);
    }
    .badge {
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .badge-primary {
        background: var(--primary);
        color: var(--white);
    }
    .badge-warning {
        background: var(--warning);
        color: var(--white);
    }
    .badge-danger {
        background: var(--danger);
        color: var(--white);
    }
    .badge-success {
        background: var(--success);
        color: var(--white);
    }
    .action-btn {
        background: none;
        border: none;
        padding: 0.5rem;
        border-radius: var(--radius);
        cursor: pointer;
        margin-right: 0.25rem;
        transition: var(--transition);
    }
    .action-btn.view {
        color: var(--primary);
    }
    .action-btn.view:hover {
        background: rgba(37, 99, 235, 0.1);
    }
    .action-btn.edit {
        color: var(--warning);
    }
    .action-btn.edit:hover {
        background: rgba(245, 158, 11, 0.1);
    }
    .action-btn.delete {
        color: var(--danger);
    }
    .action-btn.delete:hover {
        background: rgba(239, 68, 68, 0.1);
    }
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 2000;
    }
    .modal-overlay.show,
    .modal-overlay.active {
        display: flex;
    }
    .modal {
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-xl);
        max-width: 500px;
        max-height: 90vh;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .modal-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modal-header h3 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
    }
    .modal-close {
        background: none;
        border: none;
        padding: 0.5rem;
        border-radius: var(--radius);
        color: var(--gray-400);
        cursor: pointer;
        transition: var(--transition);
    }
    .modal-close:hover {
        background: var(--gray-100);
        color: var(--gray-600);
    }
    .modal-body {
        padding: 1.5rem;
        overflow-y: auto;
        flex: 1;
    }
    .modal-footer {
        padding: 1.5rem;
        border-top: 1px solid var(--gray-200);
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
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
    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        font-size: 1rem;
        transition: var(--transition);
        background: var(--white);
    }
    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    .form-textarea {
        resize: vertical;
    }
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
        padding: 1rem;
    }
    .gallery-item {
        background: var(--gray-50);
        border-radius: var(--radius-xl);
        overflow: hidden;
        position: relative;
        border: 1px solid var(--gray-200);
    }
    .gallery-image {
        min-height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(243, 244, 246, 1);
    }
    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.0);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s ease;
    }
    .gallery-item:hover .gallery-overlay {
        opacity: 1;
        background: rgba(0, 0, 0, 0.25);
    }
    .gallery-actions {
        display: flex;
        gap: 0.5rem;
    }
    .gallery-btn {
        background: rgba(255,255,255,0.9);
        border: none;
        border-radius: 999px;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--gray-700);
    }
    .gallery-btn.delete {
        background: rgba(239, 68, 68, 0.95);
        color: white;
    }
    .gallery-info {
        padding: 1rem;
    }
    .gallery-name {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    .gallery-meta {
        font-size: 0.875rem;
        color: var(--gray-500);
    }
    .message-list {
        display: grid;
        gap: 1px;
        background: var(--gray-200);
        border-radius: var(--radius-xl);
        overflow: hidden;
    }
    .message-item {
        display: grid;
        grid-template-columns: auto 48px 1fr;
        gap: 1rem;
        align-items: center;
        padding: 1rem;
        background: var(--white);
        cursor: pointer;
    }
    .message-item.unread {
        background: rgba(59, 130, 246, 0.05);
    }
    .message-checkbox input {
        width: 16px;
        height: 16px;
    }
    .message-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .message-content {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }
    .message-header {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        align-items: center;
        font-weight: 600;
    }
    .message-sender {
        color: var(--gray-900);
    }
    .message-time {
        font-size: 0.75rem;
        color: var(--gray-500);
    }
    .message-subject {
        font-weight: 600;
        color: var(--gray-800);
    }
    .message-preview {
        font-size: 0.9rem;
        color: var(--gray-500);
    }
    .message-tags {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .settings-section {
        display: none;
    }
    .settings-section.active {
        display: block;
    }
    @media (max-width: 1024px) {
        .sidebar {
            transform: translateX(-100%);
        }
        .main-content {
            margin-left: 0;
        }
        .sidebar.show {
            transform: translateX(0);
        }
    }
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        .data-table-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
        .modal {
            max-width: 95vw;
            max-height: 95vh;
        }
        .modal-header,
        .modal-body,
        .modal-footer {
            padding: 1rem;
        }
        .search-bar input {
            width: 100%;
        }
    }
</style>