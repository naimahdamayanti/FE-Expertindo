@extends('layout')
@section('title','Edit Profile')
@section('judul','Form Edit Profile')
@section('isi')

<style>
    body {
        background: #e0e0e0;
    }
    
    .profile-edit-container {
        max-width: 900px;
        margin: 50px auto;
        padding: 0 20px;
    }
    
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #e53935;
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .back-button:hover {
        color: #c62828;
        transform: translateX(-5px);
    }
    
    .profile-edit-layout {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 30px;
    }
    
    .avatar-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        height: fit-content;
    }
    
    .avatar-wrapper {
        position: relative;
        width: 180px;
        height: 180px;
        margin: 0 auto 20px;
    }
    
    .avatar-preview {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #f0f0f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .avatar-edit-btn {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 45px;
        height: 45px;
        background: #e53935;
        border: 3px solid white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }
    
    .avatar-edit-btn:hover {
        background: #c62828;
        transform: scale(1.1);
    }
    
    #avatarInput {
        display: none;
    }
    
    .avatar-name {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-top: 10px;
    }
    
    .form-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    
    .form-label {
        font-size: 14px;
        font-weight: 600;
        color: #666;
        margin-bottom: 8px;
    }
    
    .form-control {
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    
    .form-control:focus {
        border-color: #e53935;
        box-shadow: 0 0 0 0.2rem rgba(229, 57, 53, 0.15);
        background: white;
    }
    
    .password-link {
        text-align: right;
        margin-top: -10px;
        margin-bottom: 15px;
    }
    
    .password-link a {
        color: #e53935;
        text-decoration: none;
        font-size: 13px;
    }
    
    .btn-update-profile {
        width: 100%;
        background: #e53935;
        border: none;
        color: white;
        padding: 14px 30px;
        font-weight: 600;
        border-radius: 10px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }
    
    .btn-update-profile:hover {
        background: #c62828;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(229, 57, 53, 0.3);
    }
    
    @media (max-width: 768px) {
        .profile-edit-layout {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="profile-edit-container">
    <a href="{{ route('profile') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Profil
    </a>
    
    <div class="profile-edit-layout">
        <!-- Left Section - Avatar -->
        <div class="avatar-card">
            <div class="avatar-wrapper">
                <img id="avatarPreview" 
                     src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->nama) . '&size=180&background=10b981&color=fff' }}" 
                     alt="Avatar" 
                     class="avatar-preview">
                <label for="avatarInput" class="avatar-edit-btn">
                    <i class="fas fa-pencil-alt"></i>
                </label>
            </div>
            <div class="avatar-name">{{ $user->nama }}</div>
        </div>
        
        <!-- Right Section - Form -->
        <div class="form-card">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <input type="file" 
                       id="avatarInput" 
                       name="avatar"
                       accept="image/*"
                       onchange="previewAvatar(event)">
                
                <div class="form-group mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           id="nama" 
                           name="nama"
                           value="{{ old('nama', $user->nama) }}" 
                           required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email"
                           value="{{ old('email', $user->email) }}" 
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password"
                           placeholder="••••••••">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="password-link">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                </div>
                
                <button type="submit" class="btn-update-profile">
                    Update Profile
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function previewAvatar(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection