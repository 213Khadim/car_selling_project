// ========================================
// Car Sales Management System - Main JavaScript
// ========================================

// Sample Data
const carsData = [
    {
        id: 1,
        title: 'BMW M5 Competition',
        subtitle: '2024 Model • Automatic',
        price: 125000,
        image: 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=600',
        badge: 'Featured',
        badgeClass: 'featured',
        specs: {
            fuel: 'Petrol',
            transmission: 'Auto',
            mileage: '15K'
        },
        brand: 'BMW',
        type: 'Sedan',
        year: 2024,
        color: 'Blue',
        vin: 'WBSJF0C55KB123456',
        status: 'available'
    },
    {
        id: 2,
        title: 'Mercedes-AMG GT',
        subtitle: '2024 Model • Automatic',
        price: 165000,
        image: 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=600',
        badge: 'New',
        badgeClass: 'new',
        specs: {
            fuel: 'Petrol',
            transmission: 'Auto',
            mileage: '5K'
        },
        brand: 'Mercedes',
        type: 'Coupe',
        year: 2024,
        color: 'Silver',
        vin: 'WDDYJ7JA5FA123456',
        status: 'available'
    },
    {
        id: 3,
        title: 'Porsche 911 Turbo S',
        subtitle: '2023 Model • PDK',
        price: 215000,
        image: 'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=600',
        badge: 'Featured',
        badgeClass: 'featured',
        specs: {
            fuel: 'Petrol',
            transmission: 'Auto',
            mileage: '8K'
        },
        brand: 'Porsche',
        type: 'Coupe',
        year: 2023,
        color: 'White',
        vin: 'WP0AD2A98NS123456',
        status: 'sold'
    },
    {
        id: 4,
        title: 'Audi RS7 Sportback',
        subtitle: '2024 Model • Quattro',
        price: 145000,
        image: 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=600',
        badge: 'New',
        badgeClass: 'new',
        specs: {
            fuel: 'Petrol',
            transmission: 'Auto',
            mileage: '3K'
        },
        brand: 'Audi',
        type: 'Sedan',
        year: 2024,
        color: 'Gray',
        vin: 'WUAW2AFC4KN123456',
        status: 'available'
    },
    {
        id: 5,
        title: 'Range Rover Sport',
        subtitle: '2024 Model • AWD',
        price: 135000,
        image: 'https://images.unsplash.com/photo-1606016159991-dfe4f2746ad5?w=600',
        badge: '',
        badgeClass: '',
        specs: {
            fuel: 'Diesel',
            transmission: 'Auto',
            mileage: '12K'
        },
        brand: 'Land Rover',
        type: 'SUV',
        year: 2024,
        color: 'Black',
        vin: 'SALWR2WF4KA123456',
        status: 'available'
    },
    {
        id: 6,
        title: 'Tesla Model S Plaid',
        subtitle: '2024 Model • AWD',
        price: 109000,
        image: 'https://images.unsplash.com/photo-1617788138017-80ad40651399?w=600',
        badge: 'Electric',
        badgeClass: 'new',
        specs: {
            fuel: 'Electric',
            transmission: 'Auto',
            mileage: '2K'
        },
        brand: 'Tesla',
        type: 'Sedan',
        year: 2024,
        color: 'Red',
        vin: '5YJSA1E26MF123456',
        status: 'available'
    }
];

const brandsData = [
    { id: 1, name: 'BMW', logo: 'https://www.carlogos.org/car-logos/bmw-logo.png' },
    { id: 2, name: 'Mercedes', logo: 'https://www.carlogos.org/car-logos/mercedes-benz-logo.png' },
    { id: 3, name: 'Audi', logo: 'https://www.carlogos.org/car-logos/audi-logo.png' },
    { id: 4, name: 'Porsche', logo: 'https://www.carlogos.org/car-logos/porsche-logo.png' },
    { id: 5, name: 'Tesla', logo: 'https://www.carlogos.org/car-logos/tesla-logo.png' },
    { id: 6, name: 'Toyota', logo: 'https://www.carlogos.org/car-logos/toyota-logo.png' },
    { id: 7, name: 'Honda', logo: 'https://www.carlogos.org/car-logos/honda-logo.png' },
    { id: 8, name: 'Land Rover', logo: 'https://www.carlogos.org/car-logos/land-rover-logo.png' }
];

const postsData = [
    {
        id: 1,
        title: '2024 Best Luxury Cars to Buy This Year',
        excerpt: 'Discover the top luxury vehicles that offer the perfect blend of performance, comfort, and prestige.',
        category: 'Buying Guide',
        date: 'Mar 15, 2024',
        image: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=600'
    },
    {
        id: 2,
        title: 'Electric vs Hybrid: Which is Right for You?',
        excerpt: 'A comprehensive comparison to help you make the right choice for your next eco-friendly vehicle.',
        category: 'Tips',
        date: 'Mar 12, 2024',
        image: 'https://images.unsplash.com/photo-1593941707882-a5bba14938c7?w=600'
    },
    {
        id: 3,
        title: 'Maintenance Tips to Keep Your Car Running Smoothly',
        excerpt: 'Essential maintenance practices that every car owner should follow for optimal performance.',
        category: 'Maintenance',
        date: 'Mar 10, 2024',
        image: 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?w=600'
    }
];

const salesData = [
    { id: 1, carId: 1, customerId: 1, price: 125000, date: '2024-03-15', status: 'completed', commission: 6250 },
    { id: 2, carId: 2, customerId: 2, price: 165000, date: '2024-03-14', status: 'completed', commission: 8250 },
    { id: 3, carId: 3, customerId: 3, price: 215000, date: '2024-03-13', status: 'pending', commission: 10750 },
    { id: 4, carId: 4, customerId: 4, price: 145000, date: '2024-03-12', status: 'completed', commission: 7250 },
    { id: 5, carId: 5, customerId: 5, price: 135000, date: '2024-03-11', status: 'cancelled', commission: 0 }
];

const customersData = [
    { id: 1, name: 'John Smith', email: 'john@example.com', phone: '+1 555-0101', totalPurchases: 2, totalSpent: 285000 },
    { id: 2, name: 'Sarah Johnson', email: 'sarah@example.com', phone: '+1 555-0102', totalPurchases: 1, totalSpent: 165000 },
    { id: 3, name: 'Michael Brown', email: 'michael@example.com', phone: '+1 555-0103', totalPurchases: 1, totalSpent: 215000 },
    { id: 4, name: 'Emily Davis', email: 'emily@example.com', phone: '+1 555-0104', totalPurchases: 3, totalSpent: 420000 },
    { id: 5, name: 'David Wilson', email: 'david@example.com', phone: '+1 555-0105', totalPurchases: 1, totalSpent: 135000 }
];

const expensesData = [
    { id: 1, category: 'Marketing', description: 'Facebook Ads Campaign', amount: 5000, date: '2024-03-15' },
    { id: 2, category: 'Utilities', description: 'Electricity Bill', amount: 1200, date: '2024-03-14' },
    { id: 3, category: 'Rent', description: 'Monthly Showroom Rent', amount: 8000, date: '2024-03-01' },
    { id: 4, category: 'Salaries', description: 'Staff Salaries', amount: 25000, date: '2024-03-01' },
    { id: 5, category: 'Insurance', description: 'Vehicle Insurance', amount: 3500, date: '2024-03-10' }
];

const cashAccountsData = [
    { id: 1, name: 'Main Account', type: 'Bank', balance: 250000, currency: 'USD' },
    { id: 2, name: 'Petty Cash', type: 'Cash', balance: 5000, currency: 'USD' },
    { id: 3, name: 'Savings Account', type: 'Bank', balance: 100000, currency: 'USD' }
];

const messagesData = [
    { id: 1, name: 'Robert Williams', email: 'robert@example.com', subject: 'Inquiry about BMW M5', message: 'I am interested in the BMW M5 Competition...', date: '2024-03-15', read: false },
    { id: 2, name: 'Jennifer Lee', email: 'jennifer@example.com', subject: 'Trade-in Question', message: 'I want to know about trade-in options...', date: '2024-03-14', read: true },
    { id: 3, name: 'Thomas Anderson', email: 'thomas@example.com', subject: 'Financing Options', message: 'What financing options do you offer?', date: '2024-03-13', read: true }
];

// ========================================
// Utility Functions
// ========================================

function formatCurrency(amount, currency = 'USD') {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: currency,
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(amount);
}

function formatDate(dateString) {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('en-US', options);
}

function getStatusBadge(status) {
    const statusClasses = {
        'completed': 'badge-success',
        'pending': 'badge-warning',
        'cancelled': 'badge-danger',
        'available': 'badge-success',
        'sold': 'badge-danger',
        'reserved': 'badge-warning'
    };
    return `<span class="badge ${statusClasses[status] || 'badge-info'}">${status.charAt(0).toUpperCase() + status.slice(1)}</span>`;
}

// ========================================
// Car Functions
// ========================================

function createCarCard(car) {
    return `
        <div class="car-card" data-id="${car.id}">
            <div class="car-image">
                <img src="${car.image}" alt="${car.title}" onerror="this.src='https://via.placeholder.com/400x250?text=No+Image'">
                ${car.badge ? `<span class="car-badge ${car.badgeClass}">${car.badge}</span>` : ''}
                <button class="car-favorite" onclick="toggleFavorite(${car.id})">
                    <i class="far fa-heart"></i>
                </button>
            </div>
            <div class="car-info">
                <h3 class="car-title">${car.title}</h3>
                <p class="car-subtitle">${car.subtitle}</p>
                <div class="car-specs">
                    <span class="spec"><i class="fas fa-gas-pump"></i> ${car.specs.fuel}</span>
                    <span class="spec"><i class="fas fa-cog"></i> ${car.specs.transmission}</span>
                    <span class="spec"><i class="fas fa-tachometer-alt"></i> ${car.specs.mileage}</span>
                </div>
                <div class="car-footer">
                    <span class="car-price">${formatCurrency(car.price)}</span>
                    <a href="car-detail.html?id=${car.id}" class="btn btn-sm btn-primary">View Details</a>
                </div>
            </div>
        </div>
    `;
}

function loadFeaturedCars() {
    const container = document.getElementById('featuredCars');
    if (!container) return;
    
    const featuredCars = carsData.filter(car => car.badge === 'Featured' || car.badge === 'New').slice(0, 6);
    container.innerHTML = featuredCars.map(car => createCarCard(car)).join('');
}

function loadAllCars(filters = {}) {
    const container = document.getElementById('carsGrid');
    if (!container) return;
    
    let filteredCars = [...carsData];
    
    if (filters.type) {
        filteredCars = filteredCars.filter(car => car.type.toLowerCase() === filters.type.toLowerCase());
    }
    if (filters.brand) {
        filteredCars = filteredCars.filter(car => car.brand.toLowerCase() === filters.brand.toLowerCase());
    }
    if (filters.priceRange) {
        const [min, max] = filters.priceRange.split('-').map(Number);
        filteredCars = filteredCars.filter(car => car.price >= min && (max ? car.price <= max : true));
    }
    if (filters.search) {
        const searchTerm = filters.search.toLowerCase();
        filteredCars = filteredCars.filter(car => 
            car.title.toLowerCase().includes(searchTerm) ||
            car.brand.toLowerCase().includes(searchTerm)
        );
    }
    
    if (filteredCars.length === 0) {
        container.innerHTML = `
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="empty-state-icon"><i class="fas fa-car"></i></div>
                <h3>No Cars Found</h3>
                <p>Try adjusting your filters to find what you're looking for.</p>
            </div>
        `;
        return;
    }
    
    container.innerHTML = filteredCars.map(car => createCarCard(car)).join('');
}

function loadCarDetail() {
    const params = new URLSearchParams(window.location.search);
    const carId = parseInt(params.get('id'));
    const car = carsData.find(c => c.id === carId);
    
    if (!car) return;
    
    document.getElementById('carTitle').textContent = car.title;
    document.getElementById('carSubtitle').textContent = car.subtitle;
    document.getElementById('carPrice').textContent = formatCurrency(car.price);
    document.getElementById('carImage').src = car.image;
    document.getElementById('carBrand').textContent = car.brand;
    document.getElementById('carType').textContent = car.type;
    document.getElementById('carYear').textContent = car.year;
    document.getElementById('carColor').textContent = car.color;
    document.getElementById('carFuel').textContent = car.specs.fuel;
    document.getElementById('carTransmission').textContent = car.specs.transmission;
    document.getElementById('carMileage').textContent = car.specs.mileage;
    document.getElementById('carVIN').textContent = car.vin;
    document.getElementById('carStatus').innerHTML = getStatusBadge(car.status);
}

function toggleFavorite(carId) {
    const btn = document.querySelector(`.car-card[data-id="${carId}"] .car-favorite`);
    if (btn) {
        btn.classList.toggle('active');
        const icon = btn.querySelector('i');
        icon.classList.toggle('far');
        icon.classList.toggle('fas');
    }
}

// ========================================
// Brand Functions
// ========================================

function loadBrands() {
    const container = document.getElementById('brandsGrid');
    if (!container) return;
    
    container.innerHTML = brandsData.map(brand => `
        <a href="cars.html?brand=${brand.name.toLowerCase()}" class="brand-card">
            <img src="${brand.logo}" alt="${brand.name}" onerror="this.style.display='none'">
            <span>${brand.name}</span>
        </a>
    `).join('');
}

// ========================================
// Post Functions
// ========================================

function createPostCard(post) {
    return `
        <div class="post-card">
            <div class="post-image">
                <img src="${post.image}" alt="${post.title}" onerror="this.src='https://via.placeholder.com/400x250?text=No+Image'">
            </div>
            <div class="post-content">
                <div class="post-meta">
                    <span class="post-category">${post.category}</span>
                    <span>${post.date}</span>
                </div>
                <h3 class="post-title">${post.title}</h3>
                <p class="post-excerpt">${post.excerpt}</p>
                <a href="post-detail.html?id=${post.id}" class="post-link">
                    Read More <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    `;
}

function loadLatestPosts() {
    const container = document.getElementById('latestPosts');
    if (!container) return;
    
    container.innerHTML = postsData.slice(0, 3).map(post => createPostCard(post)).join('');
}

function loadAllPosts() {
    const container = document.getElementById('postsGrid');
    if (!container) return;
    
    container.innerHTML = postsData.map(post => createPostCard(post)).join('');
}

// ========================================
// Admin Dashboard Functions
// ========================================

function loadDashboardStats() {
    const totalCars = carsData.length;
    const availableCars = carsData.filter(c => c.status === 'available').length;
    const totalSales = salesData.filter(s => s.status === 'completed').reduce((sum, s) => sum + s.price, 0);
    const totalCustomers = customersData.length;
    const totalCommissions = salesData.filter(s => s.status === 'completed').reduce((sum, s) => sum + s.commission, 0);
    
    updateStatElement('totalCars', totalCars);
    updateStatElement('availableCars', availableCars);
    updateStatElement('totalSales', formatCurrency(totalSales));
    updateStatElement('totalCustomers', totalCustomers);
    updateStatElement('totalCommissions', formatCurrency(totalCommissions));
    updateStatElement('totalExpenses', formatCurrency(expensesData.reduce((sum, e) => sum + e.amount, 0)));
}

function updateStatElement(id, value) {
    const element = document.getElementById(id);
    if (element) element.textContent = value;
}

function loadRecentSales() {
    const container = document.getElementById('recentSalesTable');
    if (!container) return;
    
    const recentSales = salesData.slice(0, 5);
    container.innerHTML = recentSales.map(sale => {
        const car = carsData.find(c => c.id === sale.carId);
        const customer = customersData.find(c => c.id === sale.customerId);
        return `
            <tr>
                <td>${car ? car.title : 'N/A'}</td>
                <td>${customer ? customer.name : 'N/A'}</td>
                <td>${formatCurrency(sale.price)}</td>
                <td>${formatDate(sale.date)}</td>
                <td>${getStatusBadge(sale.status)}</td>
            </tr>
        `;
    }).join('');
}

function loadAdminCars() {
    const container = document.getElementById('adminCarsTable');
    if (!container) return;
    
    container.innerHTML = carsData.map(car => `
        <tr>
            <td>
                <div class="d-flex align-center gap-2">
                    <img src="${car.image}" alt="${car.title}" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                    <div>
                        <strong>${car.title}</strong>
                        <br><small class="text-muted">${car.vin}</small>
                    </div>
                </div>
            </td>
            <td>${car.brand}</td>
            <td>${car.type}</td>
            <td>${car.year}</td>
            <td>${formatCurrency(car.price)}</td>
            <td>${getStatusBadge(car.status)}</td>
            <td>
                <button class="action-btn edit" onclick="editCar(${car.id})" title="Edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="action-btn delete" onclick="deleteCar(${car.id})" title="Delete">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

function loadAdminSales() {
    const container = document.getElementById('adminSalesTable');
    if (!container) return;
    
    container.innerHTML = salesData.map(sale => {
        const car = carsData.find(c => c.id === sale.carId);
        const customer = customersData.find(c => c.id === sale.customerId);
        return `
            <tr>
                <td>#${sale.id.toString().padStart(4, '0')}</td>
                <td>${car ? car.title : 'N/A'}</td>
                <td>${customer ? customer.name : 'N/A'}</td>
                <td>${formatCurrency(sale.price)}</td>
                <td>${formatCurrency(sale.commission)}</td>
                <td>${formatDate(sale.date)}</td>
                <td>${getStatusBadge(sale.status)}</td>
                <td>
                    <button class="action-btn edit" onclick="editSale(${sale.id})" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="action-btn" onclick="viewSale(${sale.id})" title="View">
                        <i class="fas fa-eye"></i>
                    </button>
                </td>
            </tr>
        `;
    }).join('');
}

function loadAdminCustomers() {
    const container = document.getElementById('adminCustomersTable');
    if (!container) return;
    
    container.innerHTML = customersData.map(customer => `
        <tr>
            <td>
                <div class="d-flex align-center gap-2">
                    <div class="user-avatar" style="width: 36px; height: 36px; font-size: 0.875rem;">
                        ${customer.name.split(' ').map(n => n[0]).join('')}
                    </div>
                    <div>
                        <strong>${customer.name}</strong>
                        <br><small class="text-muted">${customer.email}</small>
                    </div>
                </div>
            </td>
            <td>${customer.phone}</td>
            <td>${customer.totalPurchases}</td>
            <td>${formatCurrency(customer.totalSpent)}</td>
            <td>
                <button class="action-btn edit" onclick="editCustomer(${customer.id})" title="Edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="action-btn" onclick="viewCustomer(${customer.id})" title="View">
                    <i class="fas fa-eye"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

function loadAdminExpenses() {
    const container = document.getElementById('adminExpensesTable');
    if (!container) return;
    
    container.innerHTML = expensesData.map(expense => `
        <tr>
            <td>#${expense.id.toString().padStart(4, '0')}</td>
            <td><span class="badge badge-primary">${expense.category}</span></td>
            <td>${expense.description}</td>
            <td>${formatCurrency(expense.amount)}</td>
            <td>${formatDate(expense.date)}</td>
            <td>
                <button class="action-btn edit" onclick="editExpense(${expense.id})" title="Edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="action-btn delete" onclick="deleteExpense(${expense.id})" title="Delete">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

function loadCashAccounts() {
    const container = document.getElementById('cashAccountsTable');
    if (!container) return;
    
    container.innerHTML = cashAccountsData.map(account => `
        <tr>
            <td><strong>${account.name}</strong></td>
            <td><span class="badge badge-${account.type === 'Bank' ? 'primary' : 'success'}">${account.type}</span></td>
            <td>${formatCurrency(account.balance, account.currency)}</td>
            <td>${account.currency}</td>
            <td>
                <button class="action-btn edit" onclick="editAccount(${account.id})" title="Edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="action-btn" onclick="transferFunds(${account.id})" title="Transfer">
                    <i class="fas fa-exchange-alt"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

function loadMessages() {
    const container = document.getElementById('messagesTable');
    if (!container) return;
    
    container.innerHTML = messagesData.map(msg => `
        <tr class="${!msg.read ? 'unread' : ''}">
            <td>
                <div class="d-flex align-center gap-2">
                    ${!msg.read ? '<span class="notification-dot" style="position: static;"></span>' : ''}
                    <strong>${msg.name}</strong>
                </div>
            </td>
            <td>${msg.email}</td>
            <td>${msg.subject}</td>
            <td>${formatDate(msg.date)}</td>
            <td>
                <button class="action-btn" onclick="viewMessage(${msg.id})" title="View">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="action-btn delete" onclick="deleteMessage(${msg.id})" title="Delete">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

// ========================================
// Form Handlers
// ========================================

function handleLogin(event, type) {
    event.preventDefault();
    const form = event.target;
    const email = form.querySelector('[name="email"]').value;
    const password = form.querySelector('[name="password"]').value;
    
    // Simulate login (in real app, this would be an API call)
    if (email && password) {
        if (type === 'admin') {
            localStorage.setItem('adminLoggedIn', 'true');
            localStorage.setItem('adminEmail', email);
            window.location.href = 'dashboard.html';
        } else {
            localStorage.setItem('userLoggedIn', 'true');
            localStorage.setItem('userEmail', email);
            window.location.href = 'dashboard.html';
        }
    }
}

function handleRegister(event) {
    event.preventDefault();
    const form = event.target;
    const name = form.querySelector('[name="name"]').value;
    const email = form.querySelector('[name="email"]').value;
    const password = form.querySelector('[name="password"]').value;
    
    // Simulate registration
    if (name && email && password) {
        localStorage.setItem('userLoggedIn', 'true');
        localStorage.setItem('userName', name);
        localStorage.setItem('userEmail', email);
        window.location.href = 'dashboard.html';
    }
}

function handleContactForm(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    
    // Simulate form submission
    alert('Thank you for your message! We will get back to you soon.');
    form.reset();
}

function logout(type) {
    if (type === 'admin') {
        localStorage.removeItem('adminLoggedIn');
        localStorage.removeItem('adminEmail');
        window.location.href = 'login.html';
    } else {
        localStorage.removeItem('userLoggedIn');
        localStorage.removeItem('userEmail');
        localStorage.removeItem('userName');
        window.location.href = 'login.html';
    }
}

// ========================================
// Modal Functions
// ========================================

function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-overlay')) {
        e.target.classList.remove('active');
        document.body.style.overflow = '';
    }
});

// ========================================
// CRUD Operations (Simulated)
// ========================================

function editCar(id) {
    openModal('carModal');
    // In real app, populate form with car data
    console.log('Edit car:', id);
}

function deleteCar(id) {
    if (confirm('Are you sure you want to delete this car?')) {
        // In real app, make API call
        console.log('Delete car:', id);
        alert('Car deleted successfully!');
        location.reload();
    }
}

function editSale(id) {
    console.log('Edit sale:', id);
}

function viewSale(id) {
    console.log('View sale:', id);
}

function editCustomer(id) {
    console.log('Edit customer:', id);
}

function viewCustomer(id) {
    console.log('View customer:', id);
}

function editExpense(id) {
    console.log('Edit expense:', id);
}

function deleteExpense(id) {
    if (confirm('Are you sure you want to delete this expense?')) {
        console.log('Delete expense:', id);
        alert('Expense deleted successfully!');
        location.reload();
    }
}

function editAccount(id) {
    console.log('Edit account:', id);
}

function transferFunds(id) {
    openModal('transferModal');
    console.log('Transfer from account:', id);
}

function viewMessage(id) {
    console.log('View message:', id);
}

function deleteMessage(id) {
    if (confirm('Are you sure you want to delete this message?')) {
        console.log('Delete message:', id);
        alert('Message deleted successfully!');
        location.reload();
    }
}

// ========================================
// Sidebar Toggle
// ========================================

function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        sidebar.classList.toggle('active');
    }
}

// ========================================
// Header Scroll Effect
// ========================================

window.addEventListener('scroll', function() {
    const header = document.querySelector('.header');
    if (header) {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }
});

// ========================================
// Search & Filter Functions
// ========================================

function applyFilters() {
    const type = document.getElementById('filterType')?.value || '';
    const brand = document.getElementById('filterBrand')?.value || '';
    const priceRange = document.getElementById('filterPrice')?.value || '';
    const search = document.getElementById('searchInput')?.value || '';
    
    loadAllCars({ type, brand, priceRange, search });
}

function clearFilters() {
    document.getElementById('filterType').value = '';
    document.getElementById('filterBrand').value = '';
    document.getElementById('filterPrice').value = '';
    document.getElementById('searchInput').value = '';
    loadAllCars();
}

// ========================================
// Report Functions
// ========================================

function generateCarsReport() {
    const report = {
        totalCars: carsData.length,
        byStatus: {
            available: carsData.filter(c => c.status === 'available').length,
            sold: carsData.filter(c => c.status === 'sold').length,
            reserved: carsData.filter(c => c.status === 'reserved').length
        },
        byBrand: brandsData.map(brand => ({
            brand: brand.name,
            count: carsData.filter(c => c.brand === brand.name).length
        })),
        totalValue: carsData.reduce((sum, c) => sum + c.price, 0)
    };
    
    console.log('Cars Report:', report);
    return report;
}

function generateIncomeReport() {
    const completedSales = salesData.filter(s => s.status === 'completed');
    const report = {
        totalIncome: completedSales.reduce((sum, s) => sum + s.price, 0),
        totalCommissions: completedSales.reduce((sum, s) => sum + s.commission, 0),
        salesCount: completedSales.length,
        averageSalePrice: completedSales.length > 0 
            ? completedSales.reduce((sum, s) => sum + s.price, 0) / completedSales.length 
            : 0
    };
    
    console.log('Income Report:', report);
    return report;
}

function generateExpenseReport() {
    const report = {
        totalExpenses: expensesData.reduce((sum, e) => sum + e.amount, 0),
        byCategory: [...new Set(expensesData.map(e => e.category))].map(cat => ({
            category: cat,
            total: expensesData.filter(e => e.category === cat).reduce((sum, e) => sum + e.amount, 0)
        }))
    };
    
    console.log('Expense Report:', report);
    return report;
}

function generateBalanceSheet() {
    const income = generateIncomeReport();
    const expenses = generateExpenseReport();
    const report = {
        totalIncome: income.totalIncome,
        totalExpenses: expenses.totalExpenses,
        netProfit: income.totalIncome - expenses.totalExpenses,
        cashBalance: cashAccountsData.reduce((sum, a) => sum + a.balance, 0)
    };
    
    console.log('Balance Sheet:', report);
    return report;
}

// ========================================
// Initialize on Page Load
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');
    
    if (mobileMenuBtn && navLinks) {
        mobileMenuBtn.addEventListener('click', function() {
            navLinks.classList.toggle('active');
        });
    }
    
    // Check URL params for filters
    const params = new URLSearchParams(window.location.search);
    if (params.has('brand') || params.has('type')) {
        const brand = params.get('brand') || '';
        const type = params.get('type') || '';
        
        if (document.getElementById('filterBrand')) {
            document.getElementById('filterBrand').value = brand;
        }
        if (document.getElementById('filterType')) {
            document.getElementById('filterType').value = type;
        }
        
        loadAllCars({ brand, type });
    }
});

// Export functions for use in HTML
window.loadFeaturedCars = loadFeaturedCars;
window.loadAllCars = loadAllCars;
window.loadBrands = loadBrands;
window.loadLatestPosts = loadLatestPosts;
window.loadAllPosts = loadAllPosts;
window.loadCarDetail = loadCarDetail;
window.loadDashboardStats = loadDashboardStats;
window.loadRecentSales = loadRecentSales;
window.loadAdminCars = loadAdminCars;
window.loadAdminSales = loadAdminSales;
window.loadAdminCustomers = loadAdminCustomers;
window.loadAdminExpenses = loadAdminExpenses;
window.loadCashAccounts = loadCashAccounts;
window.loadMessages = loadMessages;
window.handleLogin = handleLogin;
window.handleRegister = handleRegister;
window.handleContactForm = handleContactForm;
window.logout = logout;
window.toggleSidebar = toggleSidebar;
window.applyFilters = applyFilters;
window.clearFilters = clearFilters;
window.openModal = openModal;
window.closeModal = closeModal;
