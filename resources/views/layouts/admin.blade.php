<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Mahira Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Inter', -apple-system, system-ui, sans-serif;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(135deg, #001D5F 0%, #003087 100%);
            color: white;
            padding: 30px 20px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .sidebar h4 {
            font-weight: 700;
            margin-bottom: 30px;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
        }
        
        .admin-info {
            background: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,0.5);
            background: #fff;
        }
        
        .sidebar nav .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .sidebar nav .nav-link:hover {
            background: rgba(255,255,255,0.15);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar nav .nav-link.active {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }
        
        .main-content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Mobile Responsive Styles */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            padding: 10px 15px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border: none;
            color: #001D5F;
            cursor: pointer;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
                padding-top: 80px;
            }

            .sidebar-toggle {
                display: block;
            }

            .sidebar-overlay.show {
                display: block;
                opacity: 1;
            }
        }

        /* Utility Classes for this theme */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            margin-bottom: 20px;
            background: white;
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border-color: #dee2e6;
        }

        .form-control:focus, .form-select:focus {
            border-color: #001D5F;
            box-shadow: 0 0 0 0.25rem rgba(0, 29, 95, 0.15);
        }

        /* Admin Utility: Icon Sizes */
        .admin-icon-sm { font-size: 1.1rem; }
        .admin-icon-md { font-size: 1.5rem; }
        .admin-icon-lg { font-size: 2rem; }
        .admin-icon-xl { font-size: 3rem; }
        .admin-icon-xxl { font-size: 4rem; }

        /* Admin Utility: Text Colors */
        .admin-text-navy { color: #001D5F; }
        .admin-text-blue { color: #3B82F6; }
        .admin-text-green { color: #10B981; }
        .admin-text-emerald { color: #059669; }
        .admin-text-red { color: #DC2626; }
        .admin-text-dark-red { color: #991B1B; }
        .admin-text-amber { color: #D97706; }
        .admin-text-gold { color: #F59E0B; }

        /* Admin Utility: Modal Preview */
        .admin-modal-img { max-height: 70vh; border-radius: 8px; }
        .admin-modal-iframe { width: 100%; height: 70vh; border: none; }

        /* Admin Utility: Layout */
        .admin-overflow-hidden { overflow: hidden; }
        .admin-hidden-form { display: none; }
        .admin-font-sm { font-size: 0.9rem; }
        .admin-text-uppercase { text-transform: uppercase; }
        .admin-border-dashed { border-bottom: 1px dashed #E5E7EB; }
        .admin-cursor-pointer { cursor: pointer; }
        .admin-min-w-120 { min-width: 120px; }
        .admin-icon-faded { font-size: 2rem; opacity: 0.3; }
        .admin-no-decoration { text-decoration: none; }

        /* Admin Utility: Progress */
        .admin-progress { height: 10px; width: 200px; background: #E8EBF3; border-radius: 50px; }
        .admin-progress-bar { background: linear-gradient(90deg, #10B981 0%, #059669 100%); }

        /* Admin Utility: Avatar (profile) */
        .admin-avatar-lg {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 3px solid #f8f9fa;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .admin-avatar-placeholder {
            width: 100px;
            height: 100px;
            font-size: 3rem;
        }

        /* Admin Utility: Sidebar Info */
        .admin-info-name {
            font-weight: 600;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }
        .admin-info-email {
            opacity: 0.8;
            font-size: 0.75rem;
            display: block;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }
        .admin-hr {
            border-color: rgba(255,255,255,0.2);
        }
        .admin-hr-tight {
            border-color: rgba(255,255,255,0.2);
            margin: 10px 0;
        }
    </style>
    @stack('styles')
</head>
<body x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Toggle -->
    <button class="sidebar-toggle" @click="sidebarOpen = !sidebarOpen">
        <i class="bi bi-list fs-4"></i>
    </button>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" :class="{ 'show': sidebarOpen }" @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside class="sidebar" :class="{ 'show': sidebarOpen }">
        <h4>
            <i class="bi bi-shield-check"></i>
            Admin Panel
        </h4>
        
        <div class="admin-info">
            @if(Auth::guard('admin')->user()->avatar)
                <img src="{{ Storage::url(Auth::guard('admin')->user()->avatar) }}" alt="Avatar" class="admin-avatar">
            @else
                <div class="admin-avatar d-flex align-items-center justify-content-center bg-light text-primary">
                    <i class="bi bi-person-fill fs-5"></i>
                </div>
            @endif
            <div class="admin-overflow-hidden">
                <div class="admin-info-name">
                    {{ Auth::guard('admin')->user()->name ?? 'Admin' }}
                </div>
                <small class="admin-info-email">
                    {{ Auth::guard('admin')->user()->email ?? '' }}
                </small>
            </div>
        </div>
        
        <hr class="admin-hr">
        
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}" href="{{ route('admin.registrations.index') }}">
                <i class="bi bi-people me-2"></i> Pendaftaran
            </a>
            <a class="nav-link {{ request()->routeIs('admin.pelunasan.*') ? 'active' : '' }}" href="{{ route('admin.pelunasan.index') }}">
                <i class="bi bi-wallet2 me-2"></i> Pelunasan
                @php
                    $countPelunasan = \App\Models\Registration::where('status', 'confirmed')
                        ->where('is_lunas', false)
                        ->whereHas('payments', function($q) {
                            $q->where('payment_type', 'dp')->where('status', 'verified');
                        })
                        ->count();
                @endphp
                @if($countPelunasan > 0)
                    <span class="badge bg-danger ms-auto">{{ $countPelunasan }}</span>
                @endif
            </a>
            <a class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}" href="{{ route('admin.galleries.index') }}">
                <i class="bi bi-images me-2"></i> Galeri
            </a>
            <a class="nav-link {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}" href="{{ route('admin.schedules.index') }}">
                <i class="bi bi-calendar-event me-2"></i> Jadwal
            </a>
            
            <hr class="admin-hr-tight">
            
            <a class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}" href="{{ route('admin.profile.index') }}">
                <i class="bi bi-person-gear me-2"></i> Pengaturan Akun
            </a>
            <a class="nav-link text-danger" href="{{ route('admin.logout') }}">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
