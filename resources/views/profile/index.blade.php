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
            
            <a href="#" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                    <div class="menu-subtitle">Ubah informasi profil anda</div>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Form Logout -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

@endsection