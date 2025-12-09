@extends('layout')
@section('title','Kontak')
@section('judul','Kontak')
@section('isi')
@if (Session::has('create'))
@csrf
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Data Berhasil Di Tambah</strong> You should check in on some of those fields below.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (Session::has('delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Data Berhasil Di Hapus!</strong> You should check in on some of those fields below.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('update'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Data Berhasil Di Edit!</strong> You should check in on some of those fields below.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<style>
    .kontak-container {
        max-width: 1200px;
        margin: 50px auto;
        padding: 0 20px;
    }
    
    .kontak-header {
        text-align: center;
        font-size: 32px;
        font-weight: 600;
        color: #333;
        margin-bottom: 50px;
    }
    
    .kontak-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        background: white;
        padding: 50px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .kontak-info {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
    
    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 20px;
    }
    
    .info-icon {
        width: 50px;
        height: 50px;
        background: #f8f9fa;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: #333;
        flex-shrink: 0;
    }
    
    .info-text {
        flex: 1;
    }
    
    .info-title {
        font-size: 18px;
        font-weight: 600;
        color: #dc3545;
        margin-bottom: 5px;
    }
    
    .info-detail {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
    }
    
    .kontak-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .form-title {
        font-size: 20px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }
    
    .form-group-kontak {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .form-group-kontak input,
    .form-group-kontak textarea {
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    .form-group-kontak input:focus,
    .form-group-kontak textarea:focus {
        outline: none;
        border-color: #dc3545;
    }
    
    .form-group-kontak textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .btn-kirim {
        background: #dc3545;
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 10px;
    }
    
    .btn-kirim:hover {
        background: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }
    
    @media (max-width: 768px) {
        .kontak-content {
            grid-template-columns: 1fr;
            padding: 30px;
            gap: 40px;
        }
        
        .kontak-header {
            font-size: 24px;
            margin-bottom: 30px;
        }
    }
</style>

<div class="kontak-container">
    <h1 class="kontak-header">Kontak Kami</h1>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    @if(session('user') && session('user')->role === 'admin')
    <div class="text-end mb-3">
        <a href="{{ route('kontak.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Tambah Kontak Baru
        </a>
    </div>
    @endif
    
    <div class="kontak-content">
        <!-- Informasi Kontak -->
        <div class="kontak-info">
            @if(isset($kontakInfo) && count($kontakInfo) > 0)
                @foreach($kontakInfo as $info)
                <div class="info-item">
                    <div class="info-icon">
                        <i class="{{ $info->icon }}"></i>
                    </div>
                    <div class="info-text">
                        <div class="info-title">{{ $info->judul }}</div>
                        <div class="info-detail">{!! nl2br(e($info->isi)) !!}</div>
                    </div>
                    
                    @if(session('user') && session('user')->role === 'admin')
                    <div class="info-actions">
                        <a href="{{ route('kontak.edit', $data->id) }}">
                            <button class="btn btn-warning btn-sm text-white">
                                <i class="fas fa-edit"></i> EDIT
                            </button>
                        </a>
                        <form action="{{ route('kontak.destroy', $info->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete-small" onclick="return confirm('Apakah Anda yakin ingin menghapus kontak ini?');">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
                @endforeach
            @else
                {{-- Data hardcoded jika database kosong --}}
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="info-text">
                        <div class="info-title">Alamat Kami</div>
                        <div class="info-detail">
                            Jl. Kalirunggu Km 10, Sleman,<br>
                            Yogyakarta
                        </div>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="info-text">
                        <div class="info-title">Hubungi Via WhatsApp</div>
                        <div class="info-detail">
                            (+62) 85326075006 (Aqua)
                        </div>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-text">
                        <div class="info-title">Email Kami</div>
                        <div class="info-detail">
                            mail@expartindo-training.com
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Form Kirim Pesan -->
        <div class="kontak-form">
            <div class="form-title">Kirim Pesan</div>
            
            <form action="{{ route('kontak.store') }}" method="POST">
                @csrf
                
                <div class="form-group-kontak">
                    <input 
                        type="text" 
                        name="nama" 
                        placeholder="Nama Lengkap"
                        required
                    >
                </div>
                
                <div class="form-group-kontak">
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email"
                        required
                    >
                </div>
                
                <div class="form-group-kontak">
                    <input 
                        type="tel" 
                        name="telepon" 
                        placeholder="Nomor Telepon"
                        required
                    >
                </div>
                
                <div class="form-group-kontak">
                    <textarea 
                        name="pesan" 
                        placeholder="Pesan Anda"
                        required
                    ></textarea>
                </div>
                
                <button type="submit" class="btn-kirim">Kirim</button>
            </form>
        </div>
    </div>
</div>

@endsection