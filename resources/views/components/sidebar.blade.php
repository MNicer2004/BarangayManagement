<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="logo-container me-3">
                    <img src="{{ asset('assets/images/logo.png') }}" class="sidebar-logo" alt="BM System Logo">
                </div>
                <div>
                    <span class="fw-bold text-white fs-5 d-block">Barangay Management & Medicine Inventory</span>
                    <small class="text-light opacity-75">Brgy. San Pedro Apartado, Alcala Pangasinan</small>
                </div>
            </div>
            <button class="btn-close-sidebar d-md-none" id="closeSidebar" type="button">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <div class="user-info">
        <div class="d-flex align-items-center">
            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <div class="fw-semibold text-white">
                    {{ Auth::user()->role === 'captain' ? 'Ador G. Espiritu' : (Auth::user()->name ?? 'Admin') }}
                </div>
                <div class="small text-light">
                    @if(Auth::check())
                        @if(Auth::user()->role === 'captain')
                            Barangay Captain
                        @elseif(Auth::user()->role === 'staff')
                            Barangay Secretary
                        @else
                            Administrator
                        @endif
                    @else
                        Administrator
                    @endif
                </div>
            </div>
        </div>
    </div>

    <nav class="nav flex-column">
        <div class="px-3 py-2">
            <small class="text-light opacity-75">MENU</small>
        </div>
        <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : url('/admin/dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt me-3"></i> Dashboard
        </a>
        <a href="{{ Route::has('admin.officials') ? route('admin.officials') : url('/admin/officials') }}" class="nav-link {{ request()->is('admin/officials*') ? 'active' : '' }}">
            <i class="fas fa-users me-3"></i> Brgy Officials and Staff
        </a>
        <a href="{{ Route::has('admin.residents') ? route('admin.residents') : url('/admin/residents') }}" class="nav-link {{ request()->is('admin/residents*') ? 'active' : '' }}">
            <i class="fas fa-address-book me-3"></i> Residents Record
        </a>
        <a href="{{ Route::has('admin.certificates') ? route('admin.certificates') : url('/admin/certificates') }}" class="nav-link {{ request()->is('admin/certificates*') ? 'active' : '' }}">
            <i class="fas fa-file-text me-3"></i> Certificate Management
        </a>
        <a href="{{ Route::has('admin.blotter') ? route('admin.blotter') : url('/admin/blotter') }}" class="nav-link {{ request()->is('admin/blotter*') ? 'active' : '' }}">
            <i class="fas fa-gavel me-3"></i> Crime / Blotter Records
        </a>
        <a href="{{ Route::has('admin.purok') ? route('admin.purok') : url('/admin/purok') }}" class="nav-link {{ request()->is('admin/purok*') ? 'active' : '' }}">
            <i class="fas fa-house-user me-3"></i> Purok & Household Records
        </a>
        <a href="{{ Route::has('admin.medicine') ? route('admin.medicine') : url('/admin/medicine') }}" class="nav-link {{ request()->is('admin/medicine*') ? 'active' : '' }}">
            <i class="fas fa-pills me-3"></i> Medicine Inventory
        </a>
        
        @if(Auth::check() && Auth::user()->isCaptain())
            <div class="px-3 py-2 mt-3">
                <small class="text-light opacity-75">ADMINISTRATION</small>
            </div>
            <a href="{{ Route::has('admin.account-approvals') ? route('admin.account-approvals') : url('/admin/account-approvals') }}" class="nav-link {{ request()->is('admin/account-approvals*') ? 'active' : '' }}">
                <i class="fas fa-user-check me-3"></i> Account Approvals
            </a>
        @endif
        
        <!-- Live Date and Time -->
        <div class="px-3 py-3 mt-auto border-top border-secondary">
            <div class="text-center">
                <small class="text-light opacity-75 d-block mb-1">PHILIPPINES TIME</small>
                <div class="text-light" id="live-datetime">
                    <div class="fw-bold" id="live-date">Loading...</div>
                    <div class="fs-6" id="live-time">Loading...</div>
                </div>
            </div>
        </div>
    </nav>
</div>

<!-- Live time functionality -->
<script>
function updateDateTime() {
    const now = new Date();
    const phTime = new Date(now.toLocaleString("en-US", {timeZone: "Asia/Manila"}));
    
    const dateOptions = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    
    const timeOptions = {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    };
    
    const dateElement = document.getElementById('live-date');
    const timeElement = document.getElementById('live-time');
    
    if (dateElement && timeElement) {
        dateElement.textContent = phTime.toLocaleDateString('en-US', dateOptions);
        timeElement.textContent = phTime.toLocaleTimeString('en-US', timeOptions);
    }
}

// Initialize immediately and set interval
updateDateTime();
setInterval(updateDateTime, 1000);

// Also run when DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    updateDateTime();
});
</script>