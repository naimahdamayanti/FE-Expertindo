@extends('layout')
@section('title', 'Detail Artikel')
@section('judul', 'Detail Artikel')
@section('isi')

<!-- <style>
    .detail-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 30px 15px;
    }
    
    .detail-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 30px;
    }
    
    .detail-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .detail-image-placeholder {
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 72px;
    }
    
    .detail-content {
        padding: 40px;
    }
    
    .detail-header {
        margin-bottom: 20px;
    }
    
    .detail-title {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        line-height: 1.3;
        margin-bottom: 15px;
    }
    
    .detail-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        color: #666;
        font-size: 14px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .detail-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .detail-meta-item i {
        color: #667eea;
    }
    
    .detail-body {
        margin-top: 30px;
        font-size: 16px;
        line-height: 1.8;
        color: #333;
        text-align: justify;
    }
    
    .detail-body p {
        margin-bottom: 15px;
    }
    
    .detail-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 2px solid #f0f0f0;
    }
    
    .btn-back {
        background: #6c757d;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-back:hover {
        background: #5a6268;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }
    
    .btn-edit-detail {
        background: #ffc107;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-edit-detail:hover {
        background: #e0a800;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
    }
    
    .btn-delete-detail {
        background: #dc3545;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-delete-detail:hover {
        background: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }
    
    @media (max-width: 768px) {
        .detail-content {
            padding: 25px;
        }
        
        .detail-title {
            font-size: 24px;
        }
        
        .detail-image,
        .detail-image-placeholder {
            height: 250px;
        }
        
        .detail-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        
        .detail-actions {
            flex-direction: column;
        }
        
        .btn-back,
        .btn-edit-detail,
        .btn-delete-detail {
            width: 100%;
            justify-content: center;
        }
    }
</style> -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="container mt-5">
    <div class="card shadow-lg border-0">
        @if($artikel->gambar)
            <img src="{{ asset('images/artikel/' . $artikel->gambar) }}" 
                 alt="{{ $artikel->judul }}" 
                 class="card-img-top"
                 style="height: 400px; object-fit: cover;">
        @else
            <div class="bg-gradient text-white d-flex align-items-center justify-content-center" 
                 style="height: 400px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <i class="fas fa-newspaper fa-5x"></i>
            </div>
        @endif
        
        <div class="card-body p-5">
            <h1 class="card-title display-5 fw-bold mb-3">{{ $artikel->judul }}</h1>
            
            <div class="d-flex gap-4 text-muted mb-4 pb-3 border-bottom">
                <div>
                    <i class="far fa-calendar text-primary"></i>
                    {{ \Carbon\Carbon::parse($artikel->tgl_rilis)->translatedFormat('d F Y') }}
                </div>
                <div>
                    <i class="far fa-clock text-primary"></i>
                    {{ \Carbon\Carbon::parse($artikel->created_at)->diffForHumans() }}
                </div>
            </div>
            
            <div class="article-content" style="font-size: 16px; line-height: 1.8;">
                {!! nl2br(e($artikel->isi)) !!}
            </div>
            
            <div class="d-flex gap-2 mt-4 pt-4 border-top">
                <a href="{{ route('artikel.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

@endsection