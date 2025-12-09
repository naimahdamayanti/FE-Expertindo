@extends('layout')
@section('title','Profile')
@section('judul','Profile')
@section('isi')

<style>
    body {
        background: #f0f0f0;
    }
    
    .profile-container {
        max-width: 900px;
        margin: 50px auto;
        padding: 0 20px;
    }
    
    .profile-layout {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 30px;
    }
    
    .profile-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        height: fit-content;
    }
    
    .profile-title {
        font-size: 22px;
        font-weight: 600;
        color: #333;
        margin-bottom: 30px;
    }
    
    .profile-avatar-large {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin: 0 auto 20px;
        object-fit: cover;
        border: 5px solid #f0f0f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .profile-name {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }
    
    .profile-email {
        font-size: 14px;
        color: #666;
    }
    
    .menu-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    
    .menu-item {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px;
        border-radius: 15px;
        text-decoration: none;
        color: #333;
        transition: all 0.3s ease;
        margin-bottom: 15px;
        background: #f8f9fa;
        cursor: pointer;
    }
    
    .menu-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
        color: #333;
    }
    
    .menu-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    
    .menu-icon.blue {
        background: #e3f2fd;
        color: #1976d2;
    }
    
    .menu-icon.red {
        background: #ffebee;
        color: #d32f2f;
    }
    
    .menu-icon.orange {
        background: #fff3e0;
        color: #f57c00;
    }
    
    .menu-content {
        flex: 1;
    }
    
    .menu-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 3px;
    }
    
    .menu-subtitle {
        font-size: 13px;
        color: #999;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }
    
    .modal-overlay.show {
        display: flex;
    }
    
    .modal-content {
        background: white;
        border-radius: 20px;
        padding: 40px;
        max-width: 450px;
        width: 90%;
        text-align: center;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        animation: modalFadeIn 0.3s ease-out;
    }
    
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    
    .modal-icon {
        width: 80px;
        height: 80px;
        background: #ffebee;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    
    .modal-icon i {
        font-size: 40px;
        color: #d32f2f;
    }
    
    .modal-title {
        font-size: 24px;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }
    
    .modal-text {
        font-size: 15px;
        color: #666;
        margin-bottom: 30px;
    }
    
    .modal-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
    }
    
    .btn-modal {
        padding: 12px 30px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 15px;
    }
    
    .btn-yes {
        background: #d32f2f;
        color: white;
    }
    
    .btn-yes:hover {
        background: #b71c1c;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(211, 47, 47, 0.3);
    }
    
    .btn-no {
        background: #e0e0e0;
        color: #333;
    }
    
    .btn-no:hover {
        background: #bdbdbd;
    }
    
    @media (max-width: 768px) {
        .profile-layout {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .profile-card {
            padding: 30px 20px;
        }
    }
</style>

<div class="profile-container">
    <div class="profile-layout">
        <!-- Left Section - Profile Card -->
        <div class="profile-card">
            <h2 class="profile-title">Profil</h2>
            @php
    $avatarUrl = $user->avatar 
        ? asset($user->avatar) 
        : 'https://ui-avatars.com/api/?name=' . urlencode($user->nama) . '&size=150&background=10b981&color=fff';
@endphp

<img src="{{ $avatarUrl }}" 
     alt="Profile" 
     class="profile-avatar-large"
     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&size=150&background=10b981&color=fff'">
            <div class="profile-name">{{ $user->nama }}</div>
            <div class="profile-email">{{ $user->email }}</div>
        </div>
        
        <!-- Right Section - Menu Card -->
        <div class="menu-card">
            <a href="{{ route('profile.edit') }}" class="menu-item">
                <div class="menu-icon blue">
                    <i class="fas fa-user"></i>
                </div>
                <div class="menu-content">
                    <div class="menu-title">Akun Saya</div>
                    <div class="menu-subtitle">Lakukan Perubahan Pada akun anda</div>
                </div>
            </a>
            
            <a href="#" class="menu-item" onclick="event.preventDefault(); showLogoutModal();">
                <div class="menu-icon red">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="menu-content">
                    <div class="menu-title">Log Out</div>
                    <div class="menu-subtitle">Akhiri sesi akun anda</div>
                </div>
            </a>
            
            <a href="{{ route('profile.create') }}" class="menu-item">
                <div class="menu-icon orange">
                    <i class="fas fa-user-edit"></i>
                </div>
                <div class="menu-content">
                    <div class="menu-title">Profil Kami</div>
                    <div class="menu-subtitle">Lihat informasi profil anda</div>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Modal Logout -->
<div class="modal-overlay" id="logoutModal">
    <div class="modal-content">
        <div class="modal-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        <h3 class="modal-title">Peringatan Keluar!</h3>
        <p class="modal-text">Apakah Anda yakin ingin Keluar?</p>
        <div class="modal-buttons">
            <button class="btn-modal btn-yes" onclick="confirmLogout()">YA</button>
            <button class="btn-modal btn-no" onclick="closeLogoutModal()">TIDAK</button>
        </div>
    </div>
</div>

<!-- Form Logout -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    function showLogoutModal() {
        document.getElementById('logoutModal').classList.add('show');
    }
    
    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('show');
    }
    
    function confirmLogout() {
        document.getElementById('logout-form').submit();
    }
    
    // Close modal when clicking outside
    document.getElementById('logoutModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLogoutModal();
        }
    });
</script>

@endsection